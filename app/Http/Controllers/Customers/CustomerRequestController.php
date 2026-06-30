<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use App\Models\TableSession;
use App\Services\ServiceRequestService;
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
    public function store(Request $request, ServiceRequestService $serviceRequests): JsonResponse
    {
        $request->validate(['session_id' => ['required', 'integer']]);

        $session = $this->authorizedActiveSession(
            $request->integer('session_id'),
            $request->cookie(self::SESSION_COOKIE),
        );

        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        // Idempotent — return existing open request if one exists
        $result = $serviceRequests->createOrReturnExisting($session);
        $serviceRequest = $result['request'];

        return response()->json([
            'id' => $serviceRequest->getKey(),
            'status' => $serviceRequest->status,
            'requests_ahead' => $result['requests_ahead'],
        ], $result['created'] ? Response::HTTP_CREATED : Response::HTTP_OK);
    }

    /**
     * DELETE /api/table/request/{id}
     * Body: { session_id: int }
     */
    public function cancel(Request $request, int $id, ServiceRequestService $serviceRequests): JsonResponse
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
            $serviceRequests->cancel($serviceRequest);
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

}
