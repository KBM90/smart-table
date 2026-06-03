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

        return view('owner.dashboard', [
            'pendingCount' => $this->pendingCount($tenantId),
            'avgResponseForHumans' => $this->avgResponseForHumans($tenantId),
            'activeSessionsCount' => $this->activeSessionsCount($tenantId),
            'completionRate' => $this->completionRate($tenantId),
        ]);
    }

    // ---------------------------------------------------------------------------
    // Stat helpers
    // ---------------------------------------------------------------------------

    private function pendingCount(int $tenantId): int
    {
        return DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->where('status', 'pending')
            ->count();
    }

    private function avgResponseForHumans(int $tenantId): ?string
    {
        $avgSeconds = DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->whereNotNull('accepted_at')
            ->whereDate('created_at', today())
            ->selectRaw('AVG(EXTRACT(EPOCH FROM (accepted_at - created_at))) as avg_seconds')
            ->value('avg_seconds');

        if ($avgSeconds === null) {
            return null;
        }

        $total = (int) round($avgSeconds);
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

    private function completionRate(int $tenantId): float
    {
        $since = now()->subHours(24);

        $total = DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->where('created_at', '>=', $since)
            ->count();

        if ($total === 0) {
            return 100.0;
        }

        $resolved = DB::table('requests')
            ->where('tenant_id', $tenantId)
            ->where('status', 'resolved')
            ->where('created_at', '>=', $since)
            ->count();

        return round(($resolved / $total) * 100, 1);
    }
}