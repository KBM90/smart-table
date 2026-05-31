<?php

namespace Tests\Feature\Customer;

use App\Livewire\Customer\TablePage;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CallWaiterTest extends TestCase
{
    use RefreshDatabase;

    public function test_call_waiter_creates_pending_request_and_shows_status_view(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->assertSeeText('Waiting for a waiter');

        $this->assertDatabaseHas('requests', [
            'tenant_id' => $table->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);
    }

    public function test_customer_can_cancel_request_and_return_to_action_view(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->call('cancelRequest')
            ->assertSeeText('Call Waiter');

        $this->assertDatabaseHas('requests', [
            'table_session_id' => $session->id,
            'status' => ServiceRequest::STATUS_CANCELLED,
        ]);
    }

    public function test_customer_cannot_create_second_pending_request_for_same_session(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->call('callWaiter');

        $this->assertDatabaseCount('requests', 1);
        $this->assertDatabaseHas('requests', [
            'table_session_id' => $session->id,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);
    }
}
