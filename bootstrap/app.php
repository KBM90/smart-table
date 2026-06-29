<?php

use App\Http\Middleware\EnsureRole;
use App\Http\Middleware\IdentifyTenant;
use App\Http\Middleware\VerifySubscription;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $trustedProxies = env('TRUSTED_PROXIES');

        if ($trustedProxies) {
            $middleware->trustProxies(
                at: $trustedProxies === '*'
                ? '*'
                : array_map('trim', explode(',', $trustedProxies))
            );
        }
        $middleware->validateCsrfTokens(except: [
            'paddle/*',
        ]);


        $middleware->alias([
            'role' => EnsureRole::class,
            'tenant' => IdentifyTenant::class,
            'subscription' => VerifySubscription::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Redirect to login (not a 419 error page) when the CSRF token
        // has expired — this is the "Page Expired" scenario that occurs
        // when a user submits the logout form after their session has
        // already timed out or been invalidated on another tab.
        $exceptions->render(function (TokenMismatchException $e, $request) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Your session expired. Please log in again.']);
        });
    })->create();
