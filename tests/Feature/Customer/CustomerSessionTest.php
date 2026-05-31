<?php

namespace Tests\Feature\Customer;

use App\Livewire\Customer\TablePage;
use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_free_table_route_creates_session_sets_cookie_and_marks_table_occupied(): void
    {
        $table = Table::factory()->create([
            'name' => 'Deck 7',
        ]);

        $response = $this->get('/t/'.$table->qr_token);

        $response->assertOk()
            ->assertSeeText('Call Waiter')
            ->assertCookie(TablePage::SESSION_COOKIE);

        $session = TableSession::withoutGlobalScopes()->first();

        $this->assertNotNull($session);
        $this->assertSame($table->id, $session->table_id);
        $this->assertSame(TableSession::STATUS_ACTIVE, $session->status);
        $this->assertDatabaseHas('tables', [
            'id' => $table->id,
            'status' => Table::STATUS_OCCUPIED,
        ]);
    }

    public function test_same_device_rescan_resumes_existing_session(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token)->assertOk();

        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        $this->withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->get('/t/'.$table->qr_token)
            ->assertOk()
            ->assertSeeText('Call Waiter');

        $this->assertDatabaseCount('table_sessions', 1);
        $this->assertSame($session->id, TableSession::withoutGlobalScopes()->firstOrFail()->id);
    }

    public function test_different_device_on_occupied_table_is_blocked(): void
    {
        $table = Table::factory()->create();

        $this->get('/t/'.$table->qr_token)->assertOk();

        $this->get('/t/'.$table->qr_token)
            ->assertOk()
            ->assertSeeText('currently in use')
            ->assertDontSeeText('Call Waiter');

        $this->assertDatabaseCount('table_sessions', 1);
    }

    public function test_soft_deleted_table_returns_404(): void
    {
        $table = Table::factory()->create();
        $table->delete();

        $this->get('/t/'.$table->qr_token)->assertNotFound();
    }
}
