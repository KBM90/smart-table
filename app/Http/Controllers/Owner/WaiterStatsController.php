<?php

namespace App\Http\Controllers\Owner;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WaiterStatsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WaiterStatsController extends Controller
{
    /**
     * GET /api/owner/waiters
     */
    public function index(Request $request, WaiterStatsService $stats): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        return response()->json([
            'data' => $stats->summaryForTenant($request->user()->tenant_id),
        ]);
    }

    /**
     * GET /api/owner/waiters/{waiter}/stats
     */
    public function show(User $waiter, WaiterStatsService $stats): JsonResponse
    {
        abort_if($waiter->role?->value !== UserRole::Waiter->value, Response::HTTP_NOT_FOUND);

        $this->authorize('view', $waiter);

        return response()->json([
            'data' => $stats->statsFor($waiter),
        ]);
    }
}