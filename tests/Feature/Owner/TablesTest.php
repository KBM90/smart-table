<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Tables\Form;
use App\Livewire\Owner\Tables\Index;
use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TablesTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_create_a_table_with_generated_unique_qr_token(): void
    {
        $owner = User::factory()->owner()->create();

        $this->actingAs($owner)->get('/owner/tables')->assertOk();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Table 5')
            ->call('save')
            ->assertHasNoErrors();

        $table = Table::first();

        $this->assertNotNull($table);
        $this->assertSame('Table 5', $table->name);
        $this->assertSame(32, strlen($table->qr_token));
        $this->assertDatabaseCount('tables', 1);

        Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Table 6',
        ]);

        $this->assertDatabaseCount('tables', 2);
        $this->assertSame(2, Table::withoutGlobalScopes()->pluck('qr_token')->unique()->count());
    }

    public function test_duplicate_name_in_same_tenant_fails_validation(): void
    {
        $owner = User::factory()->owner()->create();
        Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Table 1',
        ]);

        $this->actingAs($owner)->get('/owner/tables')->assertOk();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Table 1')
            ->call('save')
            ->assertHasErrors(['name' => 'unique']);
    }

    public function test_duplicate_name_across_tenants_is_allowed(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $ownerB = User::factory()->owner($tenantB)->create();

        Table::factory()->create([
            'tenant_id' => $tenantA->id,
            'name' => 'Patio',
        ]);

        $this->actingAs($ownerB)->get('/owner/tables')->assertOk();

        Livewire::actingAs($ownerB)
            ->test(Form::class)
            ->set('name', 'Patio')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('tables', [
            'tenant_id' => $tenantB->id,
            'name' => 'Patio',
        ]);
    }

    public function test_owner_can_soft_delete_a_table_and_deleted_table_is_not_in_index(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'To Delete',
        ]);

        $this->actingAs($owner)->get('/owner/tables')->assertSeeText('To Delete');

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteTable', $table->id);

        $this->assertSoftDeleted('tables', ['id' => $table->id]);

        $this->actingAs($owner)->get('/owner/tables')
            ->assertOk()
            ->assertDontSeeText('To Delete');
    }

    public function test_owner_cannot_see_another_tenants_tables(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();

        Table::factory()->create([
            'tenant_id' => $tenantA->id,
            'name' => 'Alpha',
        ]);

        Table::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Bravo',
        ]);

        $this->actingAs($ownerA)->get('/owner/tables')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo');
    }

    public function test_owner_cannot_edit_or_delete_another_tenants_table(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $tableB = Table::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Private Table',
        ]);

        $this->actingAs($ownerA)
            ->get(route('owner.tables.qr.download', $tableB))
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(Index::class)
            ->call('deleteTable', $tableB->id)
            ->assertNotFound();
    }

    public function test_waiter_cannot_access_owner_tables(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/tables')
            ->assertForbidden();
    }
}
