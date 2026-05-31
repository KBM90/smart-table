<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if ($user === null) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $requiredRole = UserRole::tryFrom($role);

        if ($requiredRole === null || $user->role?->value !== $requiredRole->value) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
