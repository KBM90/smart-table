<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Services\AccountVerificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class AccountVerificationController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if ($request->user()->hasVerifiedAccount()) {
            return redirect()->route('owner.dashboard');
        }

        return view('owner.account-verification', [
            'user' => $request->user(),
        ]);
    }

    public function send(Request $request, AccountVerificationService $verificationService): RedirectResponse
    {
        if ($request->user()->hasVerifiedAccount()) {
            return redirect()->route('owner.dashboard');
        }

        try {
            $verificationService->sendCode($request->user());
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'verification' => __('owner.verification.send_failed'),
            ]);
        }

        return back()->with('status', 'verification-code-sent');
    }

    public function verify(Request $request, AccountVerificationService $verificationService): RedirectResponse
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'digits:6'],
        ]);

        if ($verificationService->verify($request->user(), $validated['code'])) {
            return redirect()
                ->route('owner.dashboard')
                ->with('status', 'account-verified');
        }

        return back()
            ->withInput()
            ->withErrors(['code' => __('owner.verification.invalid_code')]);
    }
}
