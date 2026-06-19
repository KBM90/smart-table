<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Review;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WaiterStatsService
{
    /**
     * Snapshot stats for every waiter belonging to the tenant.
     * Used by GET /api/owner/waiters
     */
    public function summaryForTenant(int $tenantId): Collection
    {
        $waiters = User::query()
            ->where('tenant_id', $tenantId)
            ->where('role', UserRole::Waiter->value)
            ->orderBy('name')
            ->get(['id', 'name', 'photo', 'joined_at', 'is_active']);

        $responseStats = $this->responseStatsByWaiter($tenantId);
        $reviewStats = $this->reviewStatsByWaiter($tenantId);

        return $waiters->map(function (User $waiter) use ($responseStats, $reviewStats) {
            return $this->formatWaiter(
                $waiter,
                $responseStats->get($waiter->id),
                $reviewStats->get($waiter->id),
            );
        })->values();
    }

    /**
     * Full stats for a single waiter, including the individual reviews.
     * Used by GET /api/owner/waiters/{waiter}/stats
     */
    public function statsFor(User $waiter): array
    {
        $response = $this->responseStatsByWaiter($waiter->tenant_id, $waiter->id)->get($waiter->id);
        $review = $this->reviewStatsByWaiter($waiter->tenant_id, $waiter->id)->get($waiter->id);

        return array_merge(
            $this->formatWaiter($waiter, $response, $review),
            ['reviews' => $this->reviewsFor($waiter->id)],
        );
    }

    /**
     * Per-waiter (keyed by accepted_by) resolved-request response time aggregates.
     */
    protected function responseStatsByWaiter(int $tenantId, ?int $waiterId = null): Collection
    {
        return DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->where('status', ServiceRequest::STATUS_RESOLVED)
            ->whereNotNull('accepted_by')
            ->whereNotNull('resolved_at')
            ->when($waiterId !== null, fn($q) => $q->where('accepted_by', $waiterId))
            ->selectRaw('accepted_by as waiter_id, COUNT(*) as resolved_count, AVG(EXTRACT(EPOCH FROM (resolved_at - created_at))) as avg_response_seconds')
            ->groupBy('accepted_by')
            ->get()
            ->keyBy('waiter_id');
    }

    /**
     * Per-waiter review aggregates (avg rating + count).
     */
    protected function reviewStatsByWaiter(int $tenantId, ?int $waiterId = null): Collection
    {
        return Review::query()
            ->where('tenant_id', $tenantId)
            ->when($waiterId !== null, fn($q) => $q->where('waiter_id', $waiterId))
            ->selectRaw('waiter_id, COUNT(*) as review_count, AVG(rating) as avg_rating')
            ->groupBy('waiter_id')
            ->get()
            ->keyBy('waiter_id');
    }

    /**
     * Individual reviews for one waiter, most recent first.
     */
    protected function reviewsFor(int $waiterId): array
    {
        return Review::query()
            ->where('waiter_id', $waiterId)
            ->latest('created_at')
            ->get(['id', 'rating', 'comment', 'created_at'])
            ->map(fn(Review $review) => [
                'id' => $review->id,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'created_at' => $review->created_at?->toIso8601String(),
            ])
            ->all();
    }

    protected function formatWaiter(User $waiter, ?object $response, ?object $review): array
    {
        return [
            'id' => $waiter->id,
            'name' => $waiter->name,
            'photo' => $waiter->photo,
            'joined_at' => $waiter->joined_at?->toIso8601String(),
            'is_active' => $waiter->is_active,
            'resolved_count' => (int) ($response->resolved_count ?? 0),
            'avg_response_seconds' => $response?->avg_response_seconds !== null
                ? (int) round((float) $response->avg_response_seconds)
                : null,
            'avg_rating' => $review?->avg_rating !== null
                ? round((float) $review->avg_rating, 1)
                : null,
            'review_count' => (int) ($review->review_count ?? 0),
        ];
    }
}