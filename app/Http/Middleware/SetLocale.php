<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Determine locale purely from the URL prefix.
     * /ar/* → Arabic, everything else → English.
     * No session involved — the URL is the single source of truth.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('ar') || $request->is('ar/*')) {
            App::setLocale('ar');
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
