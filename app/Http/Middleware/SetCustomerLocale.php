<?php

namespace App\Http\Middleware;

use App\Support\CustomerLocale;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SetCustomerLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->isCustomerContext($request)) {
            return $next($request);
        }

        $selectedLocale = CustomerLocale::normalize($request->query('lang'));
        $locale = $selectedLocale
            ?? CustomerLocale::normalize($request->cookie(CustomerLocale::COOKIE))
            ?? CustomerLocale::DEFAULT;

        App::setLocale($locale);

        $response = $next($request);

        if ($selectedLocale !== null) {
            Cookie::queue(Cookie::make(
                CustomerLocale::COOKIE,
                $selectedLocale,
                60 * 24 * 365,
                '/',
                null,
                null,
                config('session.secure', false),
                false,
                'lax'
            ));
        }

        return $response;
    }

    protected function isCustomerContext(Request $request): bool
    {
        $path = trim($request->path(), '/');

        if (
            str_starts_with($path, 't/')
            || str_starts_with($path, 'api/table/request')
            || $path === 'api/reviews'
        ) {
            return true;
        }

        foreach ((array) $request->input('components', []) as $component) {
            $snapshot = $component['snapshot'] ?? null;

            if (! is_string($snapshot)) {
                continue;
            }

            $decoded = json_decode($snapshot, true);

            if (! is_array($decoded)) {
                continue;
            }

            $componentName = (string) data_get($decoded, 'memo.name', '');
            $snapshotPath = trim((string) data_get($decoded, 'memo.path', ''), '/');

            if (str_starts_with($componentName, 'customer.') || str_starts_with($snapshotPath, 't/')) {
                return true;
            }
        }

        return false;
    }
}
