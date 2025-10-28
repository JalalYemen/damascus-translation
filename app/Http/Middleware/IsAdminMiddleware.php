<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // --- START DEBUG LOGGING ---
        // These logs are crucial to understand Auth state within this middleware.
        if (Auth::check()) {
            $user = Auth::user();
            Log::debug('IsAdminMiddleware Debug: User Authenticated.', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'is_admin_value' => $user->is_admin, // Log the raw boolean/int
                'session_id_in_req' => $request->session()->getId(),
                'from_path' => $request->path(),
                'middleware_auth_status' => 'CHECKED_OK'
            ]);
        } else {
            Log::debug('IsAdminMiddleware Debug: User NOT Authenticated.', [
                'from_path' => $request->path(),
                'session_id_in_req' => $request->session()->getId(),
                'middleware_auth_status' => 'NOT_AUTHED'
            ]);
        }
        // --- END DEBUG LOGGING ---

        if (Auth::guest()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('You must be logged in to access this page.')], 403);
            }
            return redirect()->route('login')->with('error', __('You must be logged in to access this page.'));
        }

        if (!Auth::user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('You do not have administrative privileges.')], 403);
            }
            return redirect()->route('home')->with('error', __('You do not have administrative privileges.'));
        }

        return $next($request);
    }
}