<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request): \Illuminate\View\View
    {
        $tenantId = $request->user()->tenant_id;
        $requestStats = $this->requestStats($tenantId);
        $activeSessionsCount = $this->activeSessionsCount($tenantId);

        return view('owner.dashboard', [
            'pendingCount' => (int) ($requestStats->pending_count ?? 0),
            'avgResponseForHumans' => $this->formatSeconds($requestStats->avg_response_seconds ?? null),
            'activeSessionsCount' => $activeSessionsCount,
            'completionRate' => $this->completionRateFromStats($requestStats),
        ]);
    }

    // ---------------------------------------------------------------------------
    // Stat helpers
    // ---------------------------------------------------------------------------

    private function requestStats(int $tenantId): object
    {
        $since = now()->subHours(24);
        $todayStart = today();
        $tomorrowStart = today()->addDay();

        if (DB::getDriverName() === 'pgsql') {
            return DB::table('requests')
                ->where('tenant_id', $tenantId)
                ->selectRaw(
                    <<<'SQL'
COUNT(*) FILTER (WHERE status = ?) AS pending_count,
COUNT(*) FILTER (WHERE created_at >= ?) AS total_24h,
COUNT(*) FILTER (WHERE status = ? AND created_at >= ?) AS resolved_24h,
AVG(EXTRACT(EPOCH FROM (accepted_at - created_at))) FILTER (
    WHERE accepted_at IS NOT NULL
      AND created_at >= ?
      AND created_at < ?
) AS avg_response_seconds
SQL,
                    ['pending', $since, 'resolved', $since, $todayStart, $tomorrowStart],
                )
                ->first() ?? (object) [];
        }

        return DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->selectRaw(
                <<<'SQL'
SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) AS pending_count,
SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) AS total_24h,
SUM(CASE WHEN status = ? AND created_at >= ? THEN 1 ELSE 0 END) AS resolved_24h,
AVG(CASE
    WHEN accepted_at IS NOT NULL AND created_at >= ? AND created_at < ?
    THEN strftime('%s', accepted_at) - strftime('%s', created_at)
END) AS avg_response_seconds
SQL,
                ['pending', $since, 'resolved', $since, $todayStart, $tomorrowStart],
            )
            ->first() ?? (object) [];
    }

    private function formatSeconds(mixed $seconds): ?string
    {
        if ($seconds === null) {
            return null;
        }

        $total = (int) round((float) $seconds);
        $minutes = intdiv($total, 60);
        $seconds = $total % 60;

        return $minutes > 0 ? "{$minutes}m {$seconds}s" : "{$seconds}s";
    }

    private function activeSessionsCount(int $tenantId): int
    {
        return DB::table('table_sessions')
            ->where('tenant_id', $tenantId)
            ->where('status', 'active')
            ->count();
    }

    private function completionRateFromStats(object $requestStats): float
    {
        $total = (int) ($requestStats->total_24h ?? 0);

        if ($total === 0) {
            return 100.0;
        }

        $resolved = (int) ($requestStats->resolved_24h ?? 0);

        return round(($resolved / $total) * 100, 1);
    }
}
