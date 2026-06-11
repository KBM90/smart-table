<?php

namespace App\Services;

use App\Models\ServiceRequest;
use App\Models\TableSession;
use Illuminate\Support\Facades\DB;

class ServiceRequestService
{
    /**
     * Atomically create a new service request or return the existing open one.
     *
     * Uses SELECT … FOR UPDATE on the session row so that concurrent "call waiter"
     * taps (double-tap, two browsers, etc.) are serialized.  Without this lock the
     * old code could pass the idempotency check in parallel and create duplicate
     * requests for the same table.
     *
     * @return array{request: ServiceRequest, created: bool, requests_ahead: int}
     */
    public function createOrReturnExisting(TableSession $session): array
    {
        return DB::transaction(function () use ($session): array {

            // Re-acquire the session inside the transaction with a row-level lock.
            // Any concurrent call blocks here until the first one commits.
            $locked = TableSession::withoutGlobalScopes()
                ->whereKey($session->getKey())
                ->where('status', TableSession::STATUS_ACTIVE)
                ->lockForUpdate()
                ->first();

            if ($locked === null) {
                // Session became inactive between the initial check and this point.
                abort(403, 'Table session is no longer active.');
            }

            // Idempotency: return any existing open request for this session.
            $existing = ServiceRequest::withoutGlobalScopes()
                ->where('table_session_id', $locked->getKey())
                ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                ->oldest('created_at')
                ->first();

            if ($existing !== null) {
                return [
                    'request' => $existing,
                    'created' => false,
                    'requests_ahead' => $this->countAhead($existing),
                ];
            }

            // Mark table occupied (status update, not a new lock needed).
            $locked->table()->withoutGlobalScopes()->first()?->markOccupied();

            // Resolve any stale open requests for this table across ALL sessions
            // (e.g. a previous session that never explicitly cancelled).
            ServiceRequest::withoutGlobalScopes()
                ->whereHas(
                    'tableSession',
                    fn($q) => $q->where('table_id', $locked->table_id)
                )
                ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                ->update(['status' => ServiceRequest::STATUS_RESOLVED, 'resolved_at' => now()]);

            $request = ServiceRequest::withoutGlobalScopes()->create([
                'tenant_id' => $locked->tenant_id,
                'table_session_id' => $locked->getKey(),
                'type' => ServiceRequest::TYPE_CALL_WAITER,
                'status' => ServiceRequest::STATUS_PENDING,
            ]);

            return [
                'request' => $request,
                'created' => true,
                'requests_ahead' => 0,
            ];
        });
    }

    /**
     * Atomically cancel a request and, when no other active requests remain for
     * the same table, mark that table free (but keep the session open).
     *
     * Previously the model's cancel() had no transaction: between the
     * status update and the "any other active requests?" check, a new request
     * could slip in, causing the table to be wrongly freed.
     */
    public function cancel(ServiceRequest $serviceRequest): void
    {
        DB::transaction(function () use ($serviceRequest): void {

            $locked = ServiceRequest::withoutGlobalScopes()
                ->whereKey($serviceRequest->getKey())
                ->lockForUpdate()
                ->first();

            if ($locked === null) {
                return;
            }

            if (
                !in_array($locked->status, [
                    ServiceRequest::STATUS_PENDING,
                    ServiceRequest::STATUS_ACCEPTED,
                ], true)
            ) {
                return;
            }

            $locked->forceFill(['status' => ServiceRequest::STATUS_CANCELLED])->save();

            // Sync the caller's model instance so it reflects the new status.
            $serviceRequest->status = ServiceRequest::STATUS_CANCELLED;

            $session = $locked->tableSession()->withoutGlobalScopes()->first();

            if ($session === null) {
                return;
            }

            $hasOtherActive = ServiceRequest::withoutGlobalScopes()
                ->whereHas('tableSession', fn($q) => $q->where('table_id', $session->table_id))
                ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
                ->exists();

            if (!$hasOtherActive) {
                $session->table()->withoutGlobalScopes()->first()?->markFreeKeepSession();
            }
        });
    }

    /**
     * Count how many active requests were created before the given one.
     * Used to show the customer their queue position.
     */
    public function countAhead(ServiceRequest $serviceRequest): int
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('tenant_id', $serviceRequest->tenant_id)
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->where('created_at', '<', $serviceRequest->created_at)
            ->count();
    }

}