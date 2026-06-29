<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\TableSession;
use App\Support\ComponentRateLimiter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerRequestController extends Controller
{
    public const SESSION_COOKIE = 'st_session_token';

    /**
     * POST /api/table/request
     * Body: { session_id: int }
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate(['session_id' => ['required', 'integer']]);

        $session = $this->authorizedActiveSession(
            $request->integer('session_id'),
            $request->cookie(self::SESSION_COOKIE),
        );

        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        // Idempotent — return existing open request if one exists
        $existing = $this->currentOpenRequest($session);
        if ($existing !== null) {
            return response()->json([
                'id' => $existing->getKey(),
                'status' => $existing->status,
                'requests_ahead' => $this->countAhead($existing),
            ]);
        }

        // Mark table occupied
        $session->table()->withoutGlobalScopes()->first()?->markOccupied();

        // Resolve stale pending/accepted requests for this table across all sessions
        ServiceRequest::withoutGlobalScopes()
            ->whereHas('tableSession', fn($q) => $q->where('table_id', $session->table_id))
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->update(['status' => ServiceRequest::STATUS_RESOLVED, 'resolved_at' => now()]);

        $serviceRequest = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $session->tenant_id,
            'table_session_id' => $session->getKey(),
            'assigned_waiter_id' => ServiceRequest::assignedWaiterIdForSession($session),
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        return response()->json([
            'id' => $serviceRequest->getKey(),
            'status' => $serviceRequest->status,
            'requests_ahead' => 0,
        ], Response::HTTP_CREATED);
    }

    /**
     * DELETE /api/table/request/{id}
     * Body: { session_id: int }
     */
    public function cancel(Request $request, int $id): JsonResponse
    {
        $request->validate(['session_id' => ['required', 'integer']]);

        $session = $this->authorizedActiveSession(
            $request->integer('session_id'),
            $request->cookie(self::SESSION_COOKIE),
        );

        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        $serviceRequest = ServiceRequest::withoutGlobalScopes()
            ->whereKey($id)
            ->where('table_session_id', $session->getKey())
            ->first();

        if ($serviceRequest !== null) {
            $serviceRequest->cancel();
        }

        return response()->json(['ok' => true]);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function authorizedActiveSession(int $sessionId, ?string $cookieToken): TableSession
    {
        $session = TableSession::withoutGlobalScopes()
            ->whereKey($sessionId)
            ->where('status', TableSession::STATUS_ACTIVE)
            ->firstOrFail();

        abort_unless(
            $cookieToken !== null && hash_equals($session->session_token, $cookieToken),
            Response::HTTP_FORBIDDEN,
        );

        return $session;
    }

    private function currentOpenRequest(TableSession $session): ?ServiceRequest
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('table_session_id', $session->getKey())
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->oldest('created_at')
            ->first();
    }

    private function countAhead(ServiceRequest $request): int
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('tenant_id', $request->tenant_id)
            ->whereIn('status', [ServiceRequest::STATUS_PENDING, ServiceRequest::STATUS_ACCEPTED])
            ->where('created_at', '<', $request->created_at)
            ->count();
    }
}
