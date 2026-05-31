<?php

namespace Tests\Feature\Owner;

use App\Livewire\Owner\Products\Form;
use App\Livewire\Owner\Products\Index;
use App\Models\Product;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_creates_product_with_decimal_price_stored_as_cents(): void
    {
        $owner = User::factory()->owner()->create();

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Cappuccino')
            ->set('price', '12.50')
            ->set('description', 'Foamy coffee')
            ->set('sortOrder', 3)
            ->set('isActive', true)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('products', [
            'tenant_id' => $owner->tenant_id,
            'name' => 'Cappuccino',
            'price_cents' => 1250,
        ]);
    }

    public function test_duplicate_name_in_same_tenant_fails_validation(): void
    {
        $owner = User::factory()->owner()->create();
        Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Latte',
        ]);

        Livewire::actingAs($owner)
            ->test(Form::class)
            ->set('name', 'Latte')
            ->set('price', '4.50')
            ->call('save')
            ->assertHasErrors(['name' => 'unique']);
    }

    public function test_owner_cannot_see_edit_or_delete_another_tenants_products(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $productA = Product::factory()->create(['tenant_id' => $tenantA->id, 'name' => 'Alpha']);
        $productB = Product::factory()->create(['tenant_id' => $tenantB->id, 'name' => 'Bravo']);

        $this->actingAs($ownerA)
            ->get('/owner/products')
            ->assertOk()
            ->assertSeeText('Alpha')
            ->assertDontSeeText('Bravo');

        Livewire::actingAs($ownerA)
            ->test(Index::class)
            ->call('deleteProduct', $productB->id)
            ->assertNotFound();

        Livewire::actingAs($ownerA)
            ->test(Form::class, ['productId' => $productB->id])
            ->assertNotFound();

        $this->assertDatabaseHas('products', ['id' => $productA->id]);
        $this->assertDatabaseHas('products', ['id' => $productB->id]);
    }

    public function test_soft_delete_works_and_deleted_product_is_not_in_index(): void
    {
        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'To Delete',
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('deleteProduct', $product->id);

        $this->assertSoftDeleted('products', ['id' => $product->id]);

        $this->actingAs($owner)
            ->get('/owner/products')
            ->assertDontSeeText('To Delete');
    }

    public function test_is_active_toggle_works(): void
    {
        $owner = User::factory()->owner()->create();
        $product = Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'is_active' => true,
        ]);

        Livewire::actingAs($owner)
            ->test(Index::class)
            ->call('toggleActive', $product->id);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'is_active' => false,
        ]);
    }

    public function test_sort_order_is_respected_in_index_list(): void
    {
        $owner = User::factory()->owner()->create();
        Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'Second',
            'sort_order' => 2,
        ]);
        Product::factory()->create([
            'tenant_id' => $owner->tenant_id,
            'name' => 'First',
            'sort_order' => 1,
        ]);

        $response = $this->actingAs($owner)->get('/owner/products');

        $response->assertOk();
        $response->assertSeeTextInOrder(['First', 'Second']);
    }

    public function test_waiter_cannot_access_owner_products(): void
    {
        $waiter = User::factory()->waiter()->create();

        $this->actingAs($waiter)
            ->get('/owner/products')
            ->assertForbidden();
    }
}