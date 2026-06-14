<?php

namespace App\Http\Middleware;

use App\Support\CurrentTenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifySubscription
{
    /**
     * Allow the request to continue only when the tenant has an active
     * subscription (local trial or Stripe-backed).
     *
     * - Owner with expired billing  → redirect to owner.billing.index with a flash message.
     * - Waiter with expired billing → 403 Forbidden (no redirect, keeps API-friendly).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = app(CurrentTenant::class)->tenant();

        // If no tenant is resolved the request has already been gated by
        // IdentifyTenant; we simply pass through rather than double-fault.
        if ($tenant === null) {
            return $next($request);
        }

        if ($tenant->hasActiveSubscription()) {
            return $next($request);
        }

        // ── Subscription is inactive ──────────────────────────────────────────

        $user = $request->user();

        if ($user?->isOwner()) {
            return redirect()
                ->route('owner.billing.index')
                ->with('billing_required', 'Your subscription has expired. Please update your billing details to continue.');
        }

        // Waiter (or any unrecognised role): hard 403.
        abort(Response::HTTP_FORBIDDEN, 'Your account is inactive. Please contact the restaurant owner.');
    }
}
