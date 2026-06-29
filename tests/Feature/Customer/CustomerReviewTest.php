<?php

namespace Tests\Feature\Customer;

use App\Http\Controllers\Customers\CustomerReviewController;
use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_review_request_handled_by_waiter(): void
    {
        $waiter = User::factory()->waiter()->create();
        $table = Table::factory()->create(['tenant_id' => $waiter->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $waiter->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_RESOLVED,
            'accepted_by' => $waiter->id,
            'accepted_at' => now()->subMinute(),
            'resolved_at' => now(),
        ]);

        $this->withCredentials()
            ->withCookie(CustomerReviewController::SESSION_COOKIE, $session->session_token)
            ->post('/api/reviews', [
                'session_id' => $session->id,
                'request_id' => $request->id,
                'rating' => 5,
                'comment' => 'Great service',
            ], ['Accept' => 'application/json'])
            ->assertCreated();

        $this->assertDatabaseHas('reviews', [
            'tenant_id' => $waiter->tenant_id,
            'waiter_id' => $waiter->id,
            'request_id' => $request->id,
            'rating' => 5,
            'comment' => 'Great service',
        ]);
    }

    public function test_customer_cannot_review_request_handled_by_owner_without_waiter(): void
    {
        $owner = User::factory()->owner()->create();
        $table = Table::factory()->create(['tenant_id' => $owner->tenant_id]);
        $session = TableSession::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_id' => $table->id,
            'status' => TableSession::STATUS_ACTIVE,
            'started_at' => now(),
        ]);
        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $owner->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_RESOLVED,
            'accepted_by' => $owner->id,
            'accepted_at' => now()->subMinute(),
            'resolved_at' => now(),
        ]);

        $this->withCredentials()
            ->withCookie(CustomerReviewController::SESSION_COOKIE, $session->session_token)
            ->post('/api/reviews', [
                'session_id' => $session->id,
                'request_id' => $request->id,
                'rating' => 5,
                'comment' => 'Great service',
            ], ['Accept' => 'application/json'])
            ->assertUnprocessable()
            ->assertJson([
                'message' => 'This request was not handled by a waiter, so it cannot be reviewed.',
            ]);

        $this->assertDatabaseCount('reviews', 0);
    }
}
