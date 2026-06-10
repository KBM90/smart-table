<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TableAssignmentController extends Controller
{
    public function __invoke(string $qr_token): RedirectResponse
    {
        $table = Table::query()
            ->where('qr_token', $qr_token)
            ->whereNull('deleted_at')
            ->firstOrFail();

        $user = Auth::user();

        $table->assignedWaiters()->syncWithoutDetaching([$user->getKey()]);

        return redirect()
            ->route('waiter.tables.index')
            ->with('status', "You have been assigned to {$table->name}.");
    }
}