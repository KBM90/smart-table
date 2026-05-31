<?php

namespace Tests\Feature\Waiter;

use App\Livewire\Waiter\Requests\Index;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class WaiterRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_waiter_sees_pending_and_accepted_requests_for_own_tenant_only(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $waiter = User::factory()->waiter($tenantA)->create();

        $tableA = Table::factory()->create(['tenant_id' => $tenantA->id, 'name' => 'Alpha']);
        $tableB = Table::factory()->create(['tenant_id' => $tenantB->id, 'name' => 'Bravo']);

        $sessionA = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_id' => $tableA->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $sessionB = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_id' => $tableB->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_session_id' => $sessionA->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantA->id,
            'table_session_id' => $sessionA->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $waiter->id,
            'accepted_at' => now(),
        ]);

        ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_session_id' => $sessionB->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $this->actingAs($waiter)
            ->get('/waiter/dashboard')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo')
            ->assertSeeText('Pending')
            ->assertSeeText('Accepted');
    }

    public function test_waiter_can_accept_request(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        Livewire::actingAs($waiter)
            ->test(Index::class)
            ->call('acceptRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $waiter->id,
        ]);
    }

    public function test_waiter_can_resolve_request(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $waiter->id,
            'accepted_at' => now(),
        ]);

        Livewire::actingAs($waiter)
            ->test(Index::class)
            ->call('resolveRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_RESOLVED,
        ]);

        $this->assertNotNull($request->fresh()->resolved_at);
    }

    public function test_owner_cannot_access_waiter_dashboard(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)
            ->get('/waiter/dashboard')
            ->assertForbidden();
    }

    public function test_anonymous_user_is_redirected_to_login_for_waiter_routes(): void
    {
        $this->get('/waiter/dashboard')
            ->assertRedirect('/login');
    }
}