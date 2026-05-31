<?php

namespace Tests\Feature\Authorization;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_redirects_users_to_their_role_dashboard(): void
    {
        $tenant = Tenant::factory()->create();

        $owner = User::factory()->owner($tenant)->create();
        $waiter = User::factory()->waiter($tenant)->create();

        $this->actingAs($owner)
            ->get('/dashboard')
            ->assertRedirect(route('owner.dashboard', absolute: false));

        $this->actingAs($waiter)
            ->get('/dashboard')
            ->assertRedirect(route('waiter.dashboard', absolute: false));
    }

    public function test_waiter_cannot_access_owner_dashboard(): void
    {
        $tenant = Tenant::factory()->create();
        $waiter = User::factory()->waiter($tenant)->create();

        $this->actingAs($waiter)
            ->get('/owner/dashboard')
            ->assertForbidden();
    }

    public function test_owner_cannot_access_waiter_dashboard(): void
    {
        $tenant = Tenant::factory()->create();
        $owner = User::factory()->owner($tenant)->create();

        $this->actingAs($owner)
            ->get('/waiter/dashboard')
            ->assertForbidden();
    }
}
