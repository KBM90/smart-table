<?php

namespace Tests\Feature\Owner;

use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TableQrDownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_download_qr_png(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create([
            'tenant_id' => $owner->tenant_id,
        ]);

        $response = $this->actingAs($owner)->get(route('owner.tables.qr.download', $table));

        $response->assertOk();
        $response->assertHeader('content-type', 'image/png');
        $this->assertGreaterThan(100, strlen($response->getContent()));
    }

    public function test_cross_tenant_owner_cannot_download_other_tenant_qr(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();
        $ownerA = User::factory()->owner($tenantA)->create();
        $tableB = Table::factory()->create([
            'tenant_id' => $tenantB->id,
        ]);

        $this->actingAs($ownerA)
            ->get(route('owner.tables.qr.download', $tableB))
            ->assertNotFound();
    }
}
