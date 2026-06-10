<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TableAssignmentController extends Controller
{
    /**
     * POST /waiter/tables/assign-via-qr
     * Body: { qr_token: string }  (or full table URL — we extract the token)
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'qr_token' => ['required', 'string'],
        ]);

        $qrToken = $this->extractToken($request->string('qr_token')->toString());

        $table = Table::query()
            ->where('qr_token', $qrToken)
            ->whereNull('deleted_at')
            ->first();

        if ($table === null) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'This QR code does not match any table for your restaurant.',
            ], 404);
        }

        $user = Auth::user();

        return DB::transaction(function () use ($table, $user) {
            $alreadyAssigned = $table->assignedWaiters()
                ->withoutGlobalScopes()
                ->where('users.id', $user->getKey())
                ->lockForUpdate()
                ->exists();

            if ($alreadyAssigned) {
                return response()->json([
                    'status' => 'already_assigned',
                    'table' => $table->name,
                    'message' => "You're already assigned to {$table->name}.",
                ]);
            }

            // Assign to this waiter, regardless of any other existing assignments.
            $table->assignedWaiters()->syncWithoutDetaching([$user->getKey()]);

            return response()->json([
                'status' => 'assigned',
                'table' => $table->name,
                'message' => "{$table->name} has been assigned to you.",
            ]);
        });
    }

    /**
     * Accept either a raw qr_token or a full customer table URL and
     * extract the token segment from the path.
     */
    private function extractToken(string $value): string
    {
        if (!str_contains($value, '/')) {
            return $value;
        }

        $path = trim((string) parse_url($value, PHP_URL_PATH), '/');
        $segments = explode('/', $path);

        // Expect .../t/{qr_token} or .../t/{qr_token}/catalog
        $index = array_search('t', $segments, true);

        if ($index !== false && isset($segments[$index + 1])) {
            return $segments[$index + 1];
        }

        return $value;
    }
}