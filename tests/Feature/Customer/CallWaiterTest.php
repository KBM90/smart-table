<?php

namespace Tests\Feature\Customer;

use App\Livewire\Customer\TablePage;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\User;
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

    public function test_call_waiter_assigns_request_to_tables_waiter_when_present(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $table->assignedWaiters()->attach($waiter->id);

        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter');

        $this->assertDatabaseHas('requests', [
            'tenant_id' => $table->tenant_id,
            'table_session_id' => $session->id,
            'assigned_waiter_id' => $waiter->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);
    }

    public function test_resolved_request_without_assigned_waiter_shows_thank_you_instead_of_call_button(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        $component = Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter');

        $request = ServiceRequest::withoutGlobalScopes()->firstOrFail();
        $request->forceFill([
            'status' => ServiceRequest::STATUS_RESOLVED,
            'resolved_at' => now(),
        ])->save();

        $component
            ->call('refreshRequestStatus')
            ->assertSeeText('Thank you!')
            ->assertDontSeeText('Call Waiter');
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
