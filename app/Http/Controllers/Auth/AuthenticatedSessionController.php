<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     *
     * Order matters here:
     * 1. Log the user out of the guard first (clears auth state).
     * 2. Invalidate the session (destroys session data, issues new session ID).
     * 3. Regenerate the CSRF token (so the new session has a valid token).
     * 4. Redirect to the welcome page.
     *
     * Doing step 2 before step 1 caused a race condition where the redirect
     * would hit routes that check auth before the guard had fully cleared,
     * producing the loop. Regenerating the token after invalidation ensures
     * the next request (the GET to welcome) carries a fresh, valid token.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}