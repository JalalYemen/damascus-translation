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
        // If a locale is in the session and is supported, use it.
        // Otherwise, default to the app's default locale (usually 'en') and store it.
        if (Session::has('locale') && in_array(Session::get('locale'), ['en', 'ar'])) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale(config('app.locale', 'en')); // Use 'en' as a safe default
            Session::put('locale', config('app.locale', 'en'));
        }

        return $next($request);
    }
}