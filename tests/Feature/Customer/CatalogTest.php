<?php

namespace Tests\Feature\Customer;

use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_lists_only_active_products_in_sort_order(): void
    {
        $tenant = Tenant::factory()->create(['name' => 'Cafe One']);
        $table = Table::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Main',
        ]);

        Product::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Mocha',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Product::factory()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Americano',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Product::factory()->inactive()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Hidden',
            'sort_order' => 0,
        ]);

        $this->get('/t/'.$table->qr_token.'/catalog')
            ->assertOk()
            ->assertSeeTextInOrder(['Americano', 'Mocha'])
            ->assertDontSeeText('Hidden');
    }

    public function test_inactive_products_are_hidden(): void
    {
        $table = Table::factory()->create();

        Product::factory()->inactive()->create([
            'tenant_id' => $table->tenant_id,
            'name' => 'Invisible Tea',
        ]);

        $this->get('/t/'.$table->qr_token.'/catalog')
            ->assertOk()
            ->assertDontSeeText('Invisible Tea');
    }

    public function test_cross_tenant_products_never_appear(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $tableA = Table::factory()->create(['tenant_id' => $tenantA->id, 'name' => 'A']);

        Product::factory()->create([
            'tenant_id' => $tenantA->id,
            'name' => 'Shown',
        ]);
        Product::factory()->create([
            'tenant_id' => $tenantB->id,
            'name' => 'Hidden Elsewhere',
        ]);

        $this->get('/t/'.$tableA->qr_token.'/catalog')
            ->assertOk()
            ->assertSeeText('Shown')
            ->assertDontSeeText('Hidden Elsewhere');
    }

    public function test_invalid_token_returns_404(): void
    {
        $this->get('/t/not-a-real-token/catalog')->assertNotFound();
    }
}