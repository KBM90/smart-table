<?php

namespace App\Livewire\Owner\Requests;

use App\Models\ServiceRequest;
use App\Support\ComponentRateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.owner')]
class Index extends Component
{
    #[On('refresh')]
    public function refreshRequests(): void
    {
    }

    public function acceptRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('accept', $request);
        $request->accept(auth()->user());
    }

    public function resolveRequest(int $requestId): void
    {
        app(ComponentRateLimiter::class)->ensureStaffActionLimit(auth()->id());

        $request = ServiceRequest::query()->find($requestId);
        abort_if($request === null, Response::HTTP_NOT_FOUND);
        $this->authorize('resolve', $request);
        $request->resolve();
    }

    public function render()
    {
        return view('livewire.owner.requests.index', [
            'requests' => ServiceRequest::query()
                ->with(['tableSession.table', 'acceptedBy', 'order.items'])
                ->whereIn('status', [
                    ServiceRequest::STATUS_PENDING,
                    ServiceRequest::STATUS_ACCEPTED,
                ])
                ->oldest('created_at')
                ->get(),
        ]);
    }
}
