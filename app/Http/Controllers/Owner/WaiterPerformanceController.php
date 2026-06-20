<?php

namespace App\Http\Controllers\Owner;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class WaiterPerformanceController extends Controller
{
    /**
     * GET /owner/waiters
     * Renders the page shell; waiter data is fetched client-side from
     * GET /api/owner/waiters (see WaiterStatsController).
     */
    public function index(): View
    {
        $this->authorize('viewAny', User::class);

        return view('owner.waiters.index');
    }

    /**
     * GET /owner/waiters/{waiter}
     * Detail page target for card click-through. Full stats blocks
     * land in Phase 4 — this currently renders a header-only shell.
     */
    public function show(User $waiter): View
    {
        abort_if($waiter->role?->value !== UserRole::Waiter->value, Response::HTTP_NOT_FOUND);

        $this->authorize('view', $waiter);

        return view('owner.waiters.show', [
            'waiter' => $waiter,
        ]);
    }
}