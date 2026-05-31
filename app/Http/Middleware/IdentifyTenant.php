<?php

namespace App\Http\Middleware;

use App\Support\CurrentTenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenant
{
    public function handle(Request $request, Closure $next): Response
    {
        $tenant = app(CurrentTenant::class)->resolveFromAuth();

        if ($request->user() !== null && $tenant === null) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
