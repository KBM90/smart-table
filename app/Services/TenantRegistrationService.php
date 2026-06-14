<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantRegistrationService
{
    /**
     * Register a new owner and their tenant.
     *
     * @param  array{
     *     name: string,
     *     email: string,
     *     password: string,
     *     tenant_name: string,
     *     trial_ends_at?: Carbon|null
     * }  $attributes
     */
    public function registerOwner(array $attributes): User
    {
        return DB::transaction(function () use ($attributes): User {
            $tenant = Tenant::create([
                'name'          => $attributes['tenant_name'],
                'slug'          => $this->uniqueSlug($attributes['tenant_name']),
                'trial_ends_at' => $attributes['trial_ends_at'] ?? null,
            ]);

            return User::create([
                'tenant_id' => $tenant->id,
                'name'      => $attributes['name'],
                'email'     => $attributes['email'],
                'password'  => Hash::make($attributes['password']),
                'role'      => UserRole::Owner->value,
            ]);
        });
    }

    protected function uniqueSlug(string $tenantName): ?string
    {
        $baseSlug = Str::slug($tenantName);

        if ($baseSlug === '') {
            return null;
        }

        $slug = $baseSlug;
        $suffix = 2;

        while (Tenant::query()->where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
