<?php

namespace App\Support;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;

class CurrentTenant
{
    protected ?Tenant $tenant = null;

    public function set(?Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function tenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function id(): ?int
    {
        $user = Auth::user();

        if ($user !== null && method_exists($user, 'tenant')) {
            return $this->resolveFromAuth()?->getKey();
        }

        return $this->tenant?->getKey();
    }

    public function clear(): void
    {
        $this->tenant = null;
    }

    public function resolveFromAuth(): ?Tenant
    {
        $user = Auth::user();

        if (! $user || ! method_exists($user, 'tenant')) {
            $this->clear();

            return null;
        }

        $tenant = $user->tenant;

        $this->set($tenant);

        return $tenant;
    }
}
