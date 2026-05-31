<?php

namespace Tests\Feature\Tenancy;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TenantRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_registration_creates_tenant_and_owner_role(): void
    {
        $response = $this->post('/register', [
            'business_name' => 'Northwind Cafe',
            'name' => 'Karim Owner',
            'email' => 'owner@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('dashboard', absolute: false));
        $this->assertAuthenticated();

        $user = User::query()->with('tenant')->first();

        $this->assertNotNull($user);
        $this->assertTrue($user->isOwner());
        $this->assertSame('Northwind Cafe', $user->tenant?->name);
        $this->assertSame('northwind-cafe', $user->tenant?->slug);
    }
}
