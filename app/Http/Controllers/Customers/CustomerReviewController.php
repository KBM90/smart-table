<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ServiceRequest;
use App\Models\TableSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerReviewController extends Controller
{
    public const SESSION_COOKIE = 'st_session_token';

    /**
     * POST /api/reviews
     *
     * Body: { session_id: int, request_id: int, rating: int (1-5), comment?: string }
     *
     * The customer must own the session that generated the request,
     * the request must be resolved, and only one review per request is allowed.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'session_id' => ['required', 'integer'],
            'request_id' => ['required', 'integer'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        // Verify the session cookie matches the claimed session.
        $session = $this->authorizedSession(
            $validated['session_id'],
            $request->cookie(self::SESSION_COOKIE),
        );

        // Load the service request and confirm it belongs to this session.
        $serviceRequest = ServiceRequest::withoutGlobalScopes()
            ->whereKey($validated['request_id'])
            ->where('table_session_id', $session->getKey())
            ->first();

        if ($serviceRequest === null) {
            return response()->json(['message' => 'Request not found.'], Response::HTTP_NOT_FOUND);
        }

        // Only resolved requests can be reviewed.
        if ($serviceRequest->status !== ServiceRequest::STATUS_RESOLVED) {
            return response()->json(['message' => 'Only resolved requests can be reviewed.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Duplicate guard — one review per request.
        if (Review::withoutGlobalScopes()->where('request_id', $serviceRequest->getKey())->exists()) {
            return response()->json(['message' => 'You have already reviewed this request.'], Response::HTTP_CONFLICT);
        }

        // The waiter to credit is whoever accepted the request.
        $waiterId = $serviceRequest->accepted_by;

        if ($waiterId === null) {
            return response()->json(['message' => 'No waiter was assigned to this request.'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $review = Review::withoutGlobalScopes()->create([
            'tenant_id' => $serviceRequest->tenant_id,
            'waiter_id' => $waiterId,
            'request_id' => $serviceRequest->getKey(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return response()->json(['id' => $review->getKey()], Response::HTTP_CREATED);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function authorizedSession(int $sessionId, ?string $cookieToken): TableSession
    {
        $session = TableSession::withoutGlobalScopes()
            ->whereKey($sessionId)
            ->firstOrFail();

        abort_unless(
            $cookieToken !== null && hash_equals($session->session_token, $cookieToken),
            Response::HTTP_FORBIDDEN,
        );

        return $session;
    }
}