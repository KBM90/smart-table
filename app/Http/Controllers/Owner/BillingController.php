<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Support\CurrentTenant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

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
     * Show a Paddle Checkout overlay trigger for the selected plan.
     *
     * Expected query parameter: ?plan=monthly|annual
     */
    public function checkout(Request $request): View|RedirectResponse
    {
        $plan = $request->query('plan', 'monthly');

        $priceId = match ($plan) {
            'annual' => config('services.paddle.price_annual'),
            default => config('services.paddle.price_monthly'),
        };

        if (! $priceId) {
            return redirect()
                ->route('owner.billing.index')
                ->with('billing_error', __('owner.billing.price_missing'));
        }

        $tenant = app(CurrentTenant::class)->tenant();

        try {
            $checkout = $tenant
                ->subscribe($priceId, 'default')
                ->returnTo(route('owner.billing.success'));
        } catch (Throwable $exception) {
            Log::error('Unable to create Paddle checkout.', [
                'tenant_id' => $tenant->id,
                'plan' => $plan,
                'exception' => $exception,
            ]);

            return redirect()
                ->route('owner.billing.index')
                ->with('billing_error', __('owner.billing.checkout_failed'));
        }

        return view('owner.billing.checkout', [
            'checkout' => $checkout,
            'plan' => $plan === 'annual' ? 'annual' : 'monthly',
        ]);
    }

    /**
     * Redirect the owner to Paddle's payment-method management page.
     */
    public function portal(Request $request): RedirectResponse
    {
        $tenant = app(CurrentTenant::class)->tenant();
        $subscription = $tenant->subscription('default');

        if (! $subscription) {
            return redirect()->route('owner.billing.index');
        }

        return $subscription->redirectToUpdatePaymentMethod();
    }

    /**
     * Show a simple checkout-success confirmation page.
     */
    public function success(): View
    {
        return view('owner.billing.success');
    }
}
