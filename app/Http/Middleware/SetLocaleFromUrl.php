<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromUrl
{
    /**
     * Already handled by SetLocale global middleware.
     * This middleware is kept as a no-op for compatibility.
     */
    public function handle(Request $request, Closure $next, string $locale = 'ar'): Response
    {
        App::setLocale($locale);
        return $next($request);
    }
}
