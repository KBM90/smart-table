<?php

namespace Tests\Feature;

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
}
