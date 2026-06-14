<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Support\CurrentTenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BillingController extends Controller
{
    /**
     * Show the current subscription status for the authenticated owner's tenant.
     */
    public function index(): View
    {
        $tenant = app(CurrentTenant::class)->tenant();

        $subscription = $tenant->subscription('default');

        return view('owner.billing.index', compact('tenant', 'subscription'));
    }

    /**
     * Initiate a Stripe Checkout Session for the selected plan (monthly or annual).
     *
     * Expected query parameter: ?plan=monthly|annual
     */
    public function checkout(Request $request): RedirectResponse
    {
        $plan = $request->query('plan', 'monthly');

        $priceId = match ($plan) {
            'annual'  => config('services.stripe.price_annual'),
            default   => config('services.stripe.price_monthly'),
        };

        $tenant = app(CurrentTenant::class)->tenant();

        $checkoutSession = $tenant->newSubscription('default', $priceId)
            ->checkout([
                'success_url' => route('owner.billing.success'),
                'cancel_url'  => route('owner.billing.index'),
            ]);

        return redirect($checkoutSession->url);
    }

    /**
     * Redirect the owner to the Stripe Customer Portal to manage their subscription.
     */
    public function portal(Request $request): RedirectResponse
    {
        $tenant = app(CurrentTenant::class)->tenant();

        return $tenant->redirectToBillingPortal(route('owner.billing.index'));
    }

    /**
     * Show a simple checkout-success confirmation page.
     */
    public function success(): View
    {
        return view('owner.billing.success');
    }
}
