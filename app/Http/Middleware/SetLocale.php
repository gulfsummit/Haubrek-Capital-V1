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
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the URL starts with /ar, the SetLocaleFromUrl middleware handles it.
        // For all other URLs (English routes), force locale to 'en' and clear
        // any stale Arabic session value so switching back to EN always works.
        if (!$request->is('ar') && !$request->is('ar/*')) {
            App::setLocale('en');
            Session::put('locale', 'en');
        } else {
            App::setLocale(Session::get('locale', config('app.locale')));
        }

        return $next($request);
    }
}
