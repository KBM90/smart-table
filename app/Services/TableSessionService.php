<?php

namespace App\Services;

use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Support\Facades\DB;

class TableSessionService
{
    public function resolveOrStart(Table $table, ?string $sessionTokenFromCookie): array
    {
        return DB::transaction(function () use ($table, $sessionTokenFromCookie): array {
            $lockedTable = Table::withoutGlobalScopes()
                ->whereKey($table->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $activeSession = TableSession::withoutGlobalScopes()
                ->where('table_id', $lockedTable->getKey())
                ->where('status', TableSession::STATUS_ACTIVE)
                ->lockForUpdate()
                ->first();

            if ($activeSession !== null) {
                // If it is the same customer (matching cookie), always resume the session,
                // regardless of whether the table is currently free or occupied.
                $matches = $sessionTokenFromCookie !== null
                    && hash_equals($activeSession->session_token, $sessionTokenFromCookie);

                if ($matches) {
                    return [
                        'session' => $activeSession,
                        'isNew'   => false,
                        'blocked' => false,
                    ];
                }

                // If the cookie does not match:
                if ($lockedTable->status === Table::STATUS_FREE) {
                    // Since the table is free, the active session is orphaned/stale
                    // (e.g. previous customer scanned but never called a waiter and left).
                    // Close it silently so we can start a new one.
                    $activeSession->forceFill([
                        'status'   => TableSession::STATUS_CLOSED,
                        'ended_at' => now(),
                    ])->save();
                } else {
                    // Table is genuinely occupied by another device. Block the new device.
                    return [
                        'session' => $activeSession,
                        'isNew'   => false,
                        'blocked' => true,
                    ];
                }
            }

            $session = TableSession::withoutGlobalScopes()->create([
                'tenant_id' => $lockedTable->tenant_id,
                'table_id' => $lockedTable->getKey(),
                'status' => TableSession::STATUS_ACTIVE,
                'started_at' => now(),
            ]);

            return [
                'session' => $session,
                'isNew' => true,
                'blocked' => false,
            ];
        });
    }

    public function close(TableSession $session): TableSession
    {
        return DB::transaction(function () use ($session): TableSession {
            $lockedSession = TableSession::withoutGlobalScopes()
                ->whereKey($session->getKey())
                ->lockForUpdate()
                ->firstOrFail();

            $lockedTable = Table::withoutGlobalScopes()
                ->whereKey($lockedSession->table_id)
                ->lockForUpdate()
                ->first();

            if ($lockedSession->isActive()) {
                $lockedSession->forceFill([
                    'status' => TableSession::STATUS_CLOSED,
                    'ended_at' => now(),
                ])->save();

                // Cancel all unresolved requests for the closed session.
                ServiceRequest::withoutGlobalScopes()
                    ->where('table_session_id', $lockedSession->getKey())
                    ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                    ->update(['status' => ServiceRequest::STATUS_CANCELLED]);
            }

            if ($lockedTable !== null) {
                $lockedTable->forceFill([
                    'status' => Table::STATUS_FREE,
                ])->save();
            }

            return $lockedSession->fresh();
        });
    }
}
