<?php

namespace Tests\Feature\Authorization;

use App\Livewire\Owner\Requests\Index as OwnerRequestsIndex;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use App\Services\TableSessionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PoliciesTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_of_tenant_a_cannot_accept_request_from_tenant_b(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $tableB = Table::factory()->create(['tenant_id' => $tenantB->id]);
        $sessionB = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_id' => $tableB->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $requestB = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $tenantB->id,
            'table_session_id' => $sessionB->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        Livewire::actingAs($ownerA)
            ->test(OwnerRequestsIndex::class)
            ->call('acceptRequest', $requestB->id)
            ->assertNotFound();
    }

    public function test_waiter_in_same_tenant_can_accept_and_resolve_request(): void
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
            ->test(\App\Livewire\Waiter\Requests\Index::class)
            ->call('acceptRequest', $request->id)
            ->call('resolveRequest', $request->id);

        $this->assertDatabaseHas('requests', [
            'id' => $request->id,
            'status' => ServiceRequest::STATUS_RESOLVED,
            'accepted_by' => $waiter->id,
        ]);
    }

    public function test_cannot_accept_request_that_is_already_accepted(): void
    {
        $owner = User::factory()->owner()->create();
        $waiter = User::factory()->waiter($owner->tenant)->create();
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

        Livewire::actingAs($waiter)
            ->test(\App\Livewire\Waiter\Requests\Index::class)
            ->call('acceptRequest', $request->id)
            ->assertForbidden();
    }

    public function test_only_owner_can_close_table_session_manually(): void
    {
        $tenant = Tenant::factory()->create();
        $owner = User::factory()->owner($tenant)->create();
        $waiter = User::factory()->waiter($tenant)->create();
        $table = Table::factory()->create([
            'tenant_id' => $tenant->id,
            'status' => Table::STATUS_OCCUPIED,
        ]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $tenant->id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $this->assertTrue($owner->can('close', $session));
        $this->assertFalse($waiter->can('close', $session));

        app(TableSessionService::class)->close($session);

        $this->assertDatabaseHas('table_sessions', [
            'id' => $session->id,
            'status' => TableSession::STATUS_CLOSED,
        ]);
    }
}