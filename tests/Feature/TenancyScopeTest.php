<?php

namespace Tests\Feature;

use App\Models\Concerns\BelongsToTenant;
use App\Models\Tenant;
use App\Models\User;
use App\Support\CurrentTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TenancyScopeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('tenant_scope_test_records', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        Schema::dropIfExists('tenant_scope_test_records');

        parent::tearDown();
    }

    public function test_tenant_scope_returns_only_current_tenant_records(): void
    {
        $tenantA = Tenant::factory()->create();
        $tenantB = Tenant::factory()->create();

        $ownerA = User::factory()->owner()->create(['tenant_id' => $tenantA->id]);
        User::factory()->owner()->create(['tenant_id' => $tenantB->id]);

        TestTenantRecord::create([
            'tenant_id' => $tenantA->id,
            'name' => 'A only',
        ]);

        TestTenantRecord::create([
            'tenant_id' => $tenantB->id,
            'name' => 'B only',
        ]);

        $this->actingAs($ownerA)->get('/owner/dashboard')->assertOk();

        app(CurrentTenant::class)->set($tenantA);

        $visibleRecords = TestTenantRecord::query()->pluck('name')->all();

        $this->assertSame(['A only'], $visibleRecords);
    }
}

class TestTenantRecord extends Model
{
    use BelongsToTenant;

    protected $table = 'tenant_scope_test_records';

    protected $fillable = [
        'tenant_id',
        'name',
    ];
}
