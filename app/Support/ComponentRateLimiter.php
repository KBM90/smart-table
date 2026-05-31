<?php

namespace App\Support;

use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ComponentRateLimiter
{
    public function ensureCustomerActionLimit(string $sessionToken): void
    {
        $key = $this->customerKey($sessionToken);

        if (RateLimiter::tooManyAttempts($key, 30)) {
            abort(Response::HTTP_TOO_MANY_REQUESTS);
        }

        RateLimiter::hit($key, 60);
    }

    public function ensureStaffActionLimit(int|string|null $userId): void
    {
        $key = 'staff-actions|'.($userId ?? 'guest');

        if (RateLimiter::tooManyAttempts($key, 60)) {
            abort(Response::HTTP_TOO_MANY_REQUESTS);
        }

        RateLimiter::hit($key, 60);
    }

    protected function customerKey(string $sessionToken): string
    {
        return 'customer-actions|'.request()->ip().'|'.$sessionToken;
    }
}