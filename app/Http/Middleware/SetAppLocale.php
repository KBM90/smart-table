<?php

namespace App\Http\Middleware;

use App\Support\AppLocale;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SetAppLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $selectedLocale = AppLocale::normalize($request->query('lang'));
        $locale = $selectedLocale
            ?? AppLocale::normalize($request->cookie(AppLocale::COOKIE))
            ?? AppLocale::DEFAULT;

        App::setLocale($locale);

        $response = $next($request);

        if ($selectedLocale !== null) {
            Cookie::queue(Cookie::make(
                AppLocale::COOKIE,
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
}
