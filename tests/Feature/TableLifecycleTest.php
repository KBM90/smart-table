<?php

namespace Tests\Feature;

use App\Livewire\Customer\TablePage;
use App\Models\Table;
use App\Models\TableSession;
use App\Services\TableSessionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TableLifecycleTest extends TestCase
{
    use RefreshDatabase;

    public function test_mark_free_closes_active_session_and_sets_table_free(): void
    {
        $table = Table::factory()->create(['status' => Table::STATUS_OCCUPIED]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $table->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $table->markFree();

        $this->assertDatabaseHas('tables', [
            'id' => $table->id,
            'status' => Table::STATUS_FREE,
        ]);
        $this->assertDatabaseHas('table_sessions', [
            'id' => $session->id,
            'status' => TableSession::STATUS_CLOSED,
        ]);
        $this->assertNotNull($session->fresh()->ended_at);
    }

    public function test_closing_session_via_service_frees_table(): void
    {
        $table = Table::factory()->create(['status' => Table::STATUS_OCCUPIED]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $table->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        app(TableSessionService::class)->close($session);

        $this->assertDatabaseHas('tables', [
            'id' => $table->id,
            'status' => Table::STATUS_FREE,
        ]);
        $this->assertDatabaseHas('table_sessions', [
            'id' => $session->id,
            'status' => TableSession::STATUS_CLOSED,
        ]);
    }

    public function test_new_customer_can_start_fresh_session_after_table_is_freed(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token)->assertOk();

        $firstSession = TableSession::withoutGlobalScopes()->firstOrFail();

        $table->fresh()->markFree();

        $this->get('/t/'.$table->qr_token)
            ->assertOk()
            ->assertCookie(TablePage::SESSION_COOKIE);

        $this->assertDatabaseCount('table_sessions', 2);

        $secondSession = TableSession::withoutGlobalScopes()->latest('id')->firstOrFail();

        $this->assertNotSame($firstSession->id, $secondSession->id);
        $this->assertSame(TableSession::STATUS_CLOSED, $firstSession->fresh()->status);
        $this->assertSame(TableSession::STATUS_ACTIVE, $secondSession->status);
    }
}
