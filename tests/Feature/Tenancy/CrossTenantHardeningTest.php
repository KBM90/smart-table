<?php

namespace Tests\Feature\Tenancy;

use App\Livewire\Owner\Products\Index as OwnerProductsIndex;
use App\Livewire\Owner\Staff\Index as StaffIndex;
use App\Livewire\Owner\Tables\Index as OwnerTablesIndex;
use App\Models\Product;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CrossTenantHardeningTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_of_tenant_a_cannot_access_tenant_b_models(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();

        $tableB = Table::factory()->create(['tenant_id' => $tenantB->id]);
        $productB = Product::factory()->create(['tenant_id' => $tenantB->id]);
        $waiterB = User::factory()->waiter($tenantB)->create();
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

        $this->actingAs($ownerA)
            ->get(route('owner.tables.qr.download', $tableB))
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(OwnerTablesIndex::class)
            ->call('deleteTable', $tableB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(OwnerProductsIndex::class)
            ->call('deleteProduct', $productB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(StaffIndex::class)
            ->call('deleteWaiter', $waiterB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(\App\Livewire\Owner\Requests\Index::class)
            ->call('acceptRequest', $requestB->id)
            ->assertNotFound();
    }
}