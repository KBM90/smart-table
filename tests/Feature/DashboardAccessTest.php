<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_hit_owner_dashboard(): void
    {
        $owner = User::factory()->owner()->create();

        $response = $this->actingAs($owner)->get('/owner/dashboard');

        $response
            ->assertOk()
            ->assertSeeText('Owner Dashboard')
            ->assertSeeText($owner->tenant->name);
    }

    public function test_waiter_cannot_access_owner_dashboard(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/dashboard')
            ->assertForbidden();
    }

    public function test_owner_cannot_access_waiter_dashboard(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/waiter/dashboard')
            ->assertForbidden();
    }

    public function test_owner_with_expired_trial_is_redirected_to_billing(): void
    {
        $tenant = Tenant::factory()->expiredTrial()->create();
        $owner = User::factory()->owner($tenant)->create();

        $this->actingAs($owner)
            ->get('/owner/dashboard')
            ->assertRedirect(route('owner.billing.index'))
            ->assertSessionHas('billing_required');
    }

    public function test_owner_with_expired_trial_can_access_billing(): void
    {
        $tenant = Tenant::factory()->expiredTrial()->create();
        $owner = User::factory()->owner($tenant)->create();

        $this->actingAs($owner)
            ->get('/owner/billing')
            ->assertOk();
    }

    public function test_waiter_with_expired_trial_is_forbidden_from_dashboard(): void
    {
        $tenant = Tenant::factory()->expiredTrial()->create();
        $waiter = User::factory()->waiter($tenant)->create();

        $this->actingAs($waiter)
            ->get('/waiter/dashboard')
            ->assertForbidden();
    }
}
