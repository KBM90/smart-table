<?php

namespace App\Livewire\Customer;

use App\Models\ServiceRequest;
use App\Models\Table;
use App\Models\TableSession;
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

    public const SESSION_TTL_MINUTES = 360;

    public int $tableId;

    public int $sessionId;

    public string $qrToken;

    public string $tableName;

    public string $tenantName;

    public bool $blocked = false;

    public ?int $activeRequestId = null;

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

        if (! $this->blocked) {
            Cookie::queue($this->sessionCookie($session->session_token));
            $this->syncActiveRequest();
        }
    }

    public function callWaiter(): void
    {
        $session = $this->authorizedActiveSession();
        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        $existingRequest = $this->currentOpenRequest($session);

        if ($existingRequest !== null) {
            $this->activeRequestId = $existingRequest->getKey();

            return;
        }

        // Mark the table occupied now that a customer has actively engaged
        $session->table()->withoutGlobalScopes()->first()?->markOccupied();

        $request = ServiceRequest::withoutGlobalScopes()->create([
            'tenant_id' => $session->tenant_id,
            'table_session_id' => $session->getKey(),
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
        ]);

        $this->activeRequestId = $request->getKey();
    }

    public function cancelRequest(): void
    {
        $session = $this->authorizedActiveSession();
        app(ComponentRateLimiter::class)->ensureCustomerActionLimit($session->session_token);

        $request = ServiceRequest::withoutGlobalScopes()
            ->whereKey($this->activeRequestId)
            ->where('table_session_id', $session->getKey())
            ->first();

        if ($request === null) {
            $this->activeRequestId = null;

            return;
        }

        $request->cancel();
        $this->activeRequestId = null;
    }

    public function refreshRequestStatus(): void
    {
        if ($this->blocked) {
            return;
        }

        $this->syncActiveRequest();
    }

    #[On('refresh-status')]
    public function refreshStatusFromRealtime(): void
    {
        $this->refreshRequestStatus();
    }

    public function render()
    {
        $activeRequest = null;

        if ($this->activeRequestId !== null) {
            $activeRequest = ServiceRequest::withoutGlobalScopes()
                ->with('acceptedBy')
                ->find($this->activeRequestId);

            if ($activeRequest !== null && in_array($activeRequest->status, [
                ServiceRequest::STATUS_RESOLVED,
                ServiceRequest::STATUS_CANCELLED,
            ], true)) {
                $activeRequest = null;
                $this->activeRequestId = null;
            }
        }

        return view('livewire.customer.table-page', [
            'activeRequest' => $activeRequest,
        ]);
    }

    protected function syncActiveRequest(): void
    {
        $session = TableSession::withoutGlobalScopes()->find($this->sessionId);

        if ($session === null || ! $session->isActive()) {
            $this->activeRequestId = null;
            Cookie::queue(Cookie::forget(self::SESSION_COOKIE));

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
            true,
            false,
            'lax'
        );
    }
}
