<?php

namespace App\Livewire\Customer;

use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
use App\Services\ServiceRequestService;
use App\Services\TableSessionService;
use App\Support\ComponentRateLimiter;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

#[Layout('layouts.customer')]
class TablePage extends Component
{
    public const SESSION_COOKIE = 'st_session_token';

    public const SESSION_TTL_MINUTES = 60;

    public int $tableId;

    public int $sessionId;

    public string $qrToken;

    public string $tableName;

    public string $tenantName;

    public bool $blocked = false;

    public ?int $activeRequestId = null;

    public string $requestStatus = 'idle';

    public bool $requestCompleted = false;

    /**
     * When a request transitions to resolved, we store its ID here so
     * the frontend can prompt the customer for a review.
     */
    public ?int $resolvedRequestId = null;

    public function mount(string $qr_token, TableSessionService $tableSessionService): void
    {
        $table = Table::withoutGlobalScopes()
            ->where('qr_token', $qr_token)
            ->whereNull('deleted_at')
            ->with('tenant')
            ->firstOrFail();

        $result = $tableSessionService->resolveOrStart($table, request()->cookie(self::SESSION_COOKIE));
        $session = $result['session'];

        $this->tableId = $table->getKey();
        $this->sessionId = $session->getKey();
        $this->qrToken = $qr_token;
        $this->tableName = $table->name;
        $this->tenantName = $table->tenant->name;
        $this->blocked = $result['blocked'];

        if (!$this->blocked) {
            Cookie::queue($this->sessionCookie($session->session_token));
            $this->syncActiveRequest();
            $this->requestStatus = $this->computedStatus();
        }
    }

    public function callWaiter(ServiceRequestService $serviceRequests): void
    {
        $session = $this->authorizedActiveSession();
        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);
        $this->requestCompleted = false;

        $result = $serviceRequests->createOrReturnExisting($session);
        $this->activeRequestId = $result['request']->getKey();
    }

    public function cancelRequest(ServiceRequestService $serviceRequests): void
    {
        $session = $this->authorizedActiveSession();
        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);
        $this->requestCompleted = false;

        $request = ServiceRequest::withoutGlobalScopes()
            ->whereKey($this->activeRequestId)
            ->where('table_session_id', $session->getKey())
            ->first();

        if ($request === null) {
            $this->activeRequestId = null;

            return;
        }

        $serviceRequests->cancel($request);
        $this->activeRequestId = null;
    }

public function refreshRequestStatus(): void
{
    if ($this->blocked) {
        return;
    }

    $previousStatus = $this->requestStatus;
    $this->syncActiveRequest();
    $newStatus = $this->computedStatus();
    $this->requestStatus = $newStatus;

    // Notify Alpine if status changed so it updates the UI immediately
    if ($previousStatus !== $newStatus) {
        $currentReq = $this->activeRequestId ? \App\Models\ServiceRequest::withoutGlobalScopes()->find($this->activeRequestId) : null;
        $this->dispatch('status-changed', 
            status: $newStatus, 
            requestId: $this->activeRequestId,
            reviewable: $currentReq?->isReviewable() ?? false
        );
    }
}


private function computedStatus(): string
{
    if ($this->blocked) return 'blocked';
    if ($this->activeRequestId === null) return 'idle';

    $request = \App\Models\ServiceRequest::withoutGlobalScopes()->find($this->activeRequestId);
    return $request?->status ?? 'idle';
}

    #[On('refresh-status')]
    public function refreshStatusFromRealtime(): void
    {
        $this->refreshRequestStatus();
    }

    /** Called by the frontend when the customer dismisses the review prompt. */
    public function dismissReview(): void
    {
        $this->resolvedRequestId = null;
    }

    public function render()
    {
        $activeRequest = null;
        $requestsAhead = 0;
        $status = $this->blocked ? 'blocked' : 'idle';
        $requestId = null;
        $elapsedSeconds = 0;

        if (!$this->blocked && $this->activeRequestId !== null) {
            $found = ServiceRequest::withoutGlobalScopes()
                ->find($this->activeRequestId);

            if (
                $found !== null && in_array($found->status, [
                    ServiceRequest::STATUS_RESOLVED,
                    ServiceRequest::STATUS_CANCELLED,
                ], true)
            ) {
                // If the request was resolved (not cancelled), trigger the review prompt.
                if ($found->status === ServiceRequest::STATUS_RESOLVED) {
                    $this->requestCompleted = true;

                    if ($found->isReviewable()) {
                        $this->resolvedRequestId = $found->getKey();
                    }
                }

                $this->activeRequestId = null;
                $found = null;
            }

            if ($found !== null) {
                $activeRequest = $found;

                $requestsAhead = ServiceRequest::withoutGlobalScopes()
                    ->where('tenant_id', $activeRequest->tenant_id)
                    ->whereIn('status', [
                        ServiceRequest::STATUS_PENDING,
                        ServiceRequest::STATUS_ACCEPTED,
                    ])
                    ->where('created_at', '<', $activeRequest->created_at)
                    ->count();

                $status = $activeRequest->status; // 'pending' or 'accepted'
                $requestId = $activeRequest->getKey();
                $elapsedSeconds = max(0, (int) abs(now()->diffInSeconds($activeRequest->created_at)));
            }
        }

        return view('livewire.customer.table-page', [
            'activeRequest' => $activeRequest,
            'requestsAhead' => $requestsAhead,
            'status' => $status,
            'requestId' => $requestId,
            'elapsedSeconds' => $elapsedSeconds,
            'requestCompleted' => $this->requestCompleted,
        ]);
    }

    protected function syncActiveRequest(): void
    {
        if ($this->activeRequestId !== null) {
            $currentReq = ServiceRequest::withoutGlobalScopes()->find($this->activeRequestId);
            if ($currentReq !== null && in_array($currentReq->status, [
                ServiceRequest::STATUS_RESOLVED,
                ServiceRequest::STATUS_CANCELLED,
            ], true)) {
                // Keep the activeRequestId so that `render()` and `computedStatus()` can process the transition.
                return;
            }
        }

        $session = TableSession::withoutGlobalScopes()->find($this->sessionId);

        if ($session === null || !$session->isActive()) {
            $this->activeRequestId = null;

            return;
        }

        $request = $this->currentOpenRequest($session);
        $this->activeRequestId = $request?->getKey();
    }

    protected function currentOpenRequest(TableSession $session): ?ServiceRequest
    {
        return ServiceRequest::withoutGlobalScopes()
            ->where('table_session_id', $session->getKey())
            ->whereIn('status', [
                ServiceRequest::STATUS_PENDING,
                ServiceRequest::STATUS_ACCEPTED,
            ])
            ->oldest('created_at')
            ->first();
    }

    protected function authorizedActiveSession(): TableSession
    {
        abort_if($this->blocked, Response::HTTP_FORBIDDEN);

        $session = TableSession::withoutGlobalScopes()
            ->whereKey($this->sessionId)
            ->where('table_id', $this->tableId)
            ->where('status', TableSession::STATUS_ACTIVE)
            ->firstOrFail();

        $cookieToken = request()->cookie(self::SESSION_COOKIE);

        abort_unless(
            $cookieToken !== null && hash_equals($session->session_token, $cookieToken),
            Response::HTTP_FORBIDDEN
        );

        return $session;
    }

    protected function sessionCookie(string $token): \Symfony\Component\HttpFoundation\Cookie
    {
        return Cookie::make(
            self::SESSION_COOKIE,
            $token,
            self::SESSION_TTL_MINUTES,
            '/',
            null,
            null,
            config('session.secure', false),
            false,
            'lax'
        );
    }
}
