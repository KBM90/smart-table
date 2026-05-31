<?php

namespace Tests\Feature\Security;

use App\Livewire\Customer\TablePage;
use App\Livewire\Waiter\Requests\Index as WaiterRequestsIndex;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class RateLimitTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_six_failed_logins_from_same_ip_hit_429_on_sixth_attempt(): void
    {
        User::factory()->owner()->create([
            'email' => 'owner@test.com',
            'password' => 'Password123',
        ]);

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post('/login', [
                'email' => 'owner@test.com',
                'password' => 'wrong-password',
            ])->assertStatus(302);
        }

        $this->post('/login', [
            'email' => 'owner@test.com',
            'password' => 'wrong-password',
        ])->assertStatus(429);
    }

    public function test_four_register_requests_in_a_minute_hit_429_on_fourth_attempt(): void
    {
        for ($attempt = 1; $attempt <= 3; $attempt++) {
            $this->post('/register', [
                'business_name' => 'Cafe '.$attempt,
                'name' => 'Owner '.$attempt,
                'email' => 'owner'.$attempt.'@test.com',
                'password' => 'Password123',
                'password_confirmation' => 'Password123',
            ])->assertStatus(302);

            auth()->logout();
        }

        $this->post('/register', [
            'business_name' => 'Cafe 4',
            'name' => 'Owner 4',
            'email' => 'owner4@test.com',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ])->assertStatus(429);
    }

    public function test_customer_call_waiter_spam_hits_429_after_threshold(): void
    {
        $table = Table::factory()->create();
        $this->get('/t/'.$table->qr_token)->assertOk();
        $session = TableSession::withoutGlobalScopes()->firstOrFail();

        $key = 'customer-actions|127.0.0.1|'.$session->session_token;

        RateLimiter::clear($key);
        RateLimiter::increment($key, 60, 30);

        Livewire::withCookie(TablePage::SESSION_COOKIE, $session->session_token)
            ->test(TablePage::class, ['qr_token' => $table->qr_token])
            ->call('callWaiter')
            ->assertStatus(429);
    }

    public function test_staff_accept_spam_hits_429_after_threshold(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);

        $blockedRequest = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $key = 'staff-actions|'.$waiter->id;

        RateLimiter::clear($key);
        RateLimiter::increment($key, 60, 60);

        Livewire::actingAs($waiter)
            ->test(WaiterRequestsIndex::class)
            ->call('acceptRequest', $blockedRequest->id)
            ->assertStatus(429);
    }
}