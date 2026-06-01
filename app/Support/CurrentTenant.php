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
        if ($this->tenant === null) {
            $this->resolveFromAuth();
        }

        return $this->tenant;
    }

    public function id(): ?int
    {
        if ($this->tenant !== null) {
            return $this->tenant->getKey();
        }

        $user = Auth::user();

        if ($user !== null && method_exists($user, 'tenant')) {
            return $this->resolveFromAuth()?->getKey();
        }

        return null;
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
