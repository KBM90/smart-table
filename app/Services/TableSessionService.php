<?php

namespace App\Services;

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
                // If the table status is free but a session is still marked active,
                // it is an orphaned/stale session (e.g. customer left without the owner
                // explicitly closing it). Close it silently and start a new one.
                if ($lockedTable->status === Table::STATUS_FREE) {
                    $activeSession->forceFill([
                        'status'   => TableSession::STATUS_CLOSED,
                        'ended_at' => now(),
                    ])->save();
                } else {
                    // Table is genuinely occupied — only the same customer (matching cookie) may resume
                    $matches = $sessionTokenFromCookie !== null
                        && hash_equals($activeSession->session_token, $sessionTokenFromCookie);

                    return [
                        'session' => $activeSession,
                        'isNew'   => false,
                        'blocked' => ! $matches,
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
