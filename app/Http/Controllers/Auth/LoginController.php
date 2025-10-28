<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /**
     * Handle a login request to the application via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. Validate incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('Validation failed'), 'errors' => $validator->errors()], 422);
            }
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // 2. Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // If user is verified or MustVerifyEmail is not implemented
            if ($request->expectsJson()) {
                return response()->json(['message' => __('Login successful!')], 200);
            }
            return Redirect::intended(route('home'))->with('success', __('Login successful!'));
        }

        // 3. Authentication failed: Return JSON error
        $errorMessage = __('These credentials do not match our records.');
        if ($request->expectsJson()) {
            return response()->json(['message' => $errorMessage], 401); // 401 Unauthorized for bad credentials
        }
        return Redirect::back()->withErrors(['email' => $errorMessage])->withInput($request->only('email'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json(['message' => __('Logout successful!')], 200);
        }
        return Redirect::route('home')->with('success', __('Logout successful!'));
    }
}