<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Requests\Index;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RequestsManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_sees_only_own_tenant_requests(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();

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
            'tenant_id' => $tenantB->id,
            'table_session_id' => $sessionB->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $this->actingAs($ownerA)
            ->get('/owner/requests')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo');
    }

    public function test_owner_can_accept_request(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create(['tenant_id' => $owner->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('acceptRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $owner->id,
        ]);
    }

    public function test_owner_can_resolve_request(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create(['tenant_id' => $owner->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_ACCEPTED,
            'accepted_by' => $owner->id,
            'accepted_at' => now(),
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('resolveRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_RESOLVED,
        ]);

        $this->assertNotNull($request->fresh()->resolved_at);
    }

    public function test_waiter_cannot_access_owner_requests_page(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/requests')
            ->assertForbidden();
    }
}
