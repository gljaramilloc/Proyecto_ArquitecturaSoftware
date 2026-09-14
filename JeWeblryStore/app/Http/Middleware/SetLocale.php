<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $availableLocales = ['en', 'es'];
        $sessionLocale = $request->session()->get('locale');

        if (is_string($sessionLocale) && in_array($sessionLocale, $availableLocales, true)) {
            app()->setLocale($sessionLocale);
        }

        return $next($request);
    }
}
