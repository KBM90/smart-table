<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AccountVerificationService;
use App\Services\TenantRegistrationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * Supports optional query parameter ?plan=trial|monthly|annual
     *
     * - trial:   Sets a 7-day local cardless trial (trial_ends_at). No Paddle interaction.
     * - monthly: Creates the tenant, logs the user in, then redirects to the monthly checkout.
     * - annual:  Creates the tenant, logs the user in, then redirects to the annual checkout.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'business_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'verification_method' => ['nullable', Rule::in(['email', 'whatsapp'])],
            'phone' => ['nullable', 'required_if:verification_method,whatsapp', 'string', 'max:32', 'regex:/^\+?[0-9\s().-]{7,32}$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ], [
            'terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy to create an account.',
            'phone.required_if' => 'Enter the WhatsApp number that should receive your verification code.',
            'phone.regex' => 'Enter a valid WhatsApp phone number.',
        ]);

        // Determine the selected plan. Defaults to 'trial' when not supplied.
        $plan = $request->query('plan', 'trial');

        // Build the base attributes used by the registration service.
        $attributes = [
            'tenant_name' => $request->string('business_name')->toString(),
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->toString(),
            'phone' => $request->filled('phone') ? $request->string('phone')->toString() : null,
            'verification_method' => $request->input('verification_method', 'email'),
            'password' => $request->string('password')->toString(),
        ];

        // For the trial plan, inject trial_ends_at so the service persists it.
        if ($plan === 'trial') {
            $attributes['trial_ends_at'] = now()->addDays(7);
        }

        $user = app(TenantRegistrationService::class)->registerOwner($attributes);

        event(new Registered($user));

        Auth::login($user);

        try {
            app(AccountVerificationService::class)->sendCode($user);
        } catch (Throwable $exception) {
            report($exception);
            $request->session()->flash('verification_status', 'verification-code-failed');
        }

        // After a trial registration, go straight to the owner dashboard.
        if ($plan === 'trial') {
            return redirect(route('dashboard', absolute: false));
        }

        // For monthly / annual plans, redirect to the Paddle Checkout flow.
        // The plan value is passed through so BillingController selects the right price.
        return redirect()->route('owner.billing.checkout', ['plan' => $plan]);
    }
}
