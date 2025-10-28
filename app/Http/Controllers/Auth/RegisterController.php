<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /**
     * Handle a registration request for the application via AJAX.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // 1. Validate incoming request data.
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('Validation failed'), 'errors' => $validator->errors()], 422);
            }
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // 2. Create the user
        $user = User::create([
            'name' => $request->input('name', explode('@', $request->email)[0]),
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // This final `return` is a fallback, which typically wouldn't be hit for new regs with MustVerifyEmail.
        // It's mostly here for completion, in case the above verification-specific redirect logic is ever removed.
        if ($request->expectsJson()) {
            return response()->json(['message' => __('Registration successful!')], 201);
        }
        return Redirect::route('home')->with('success', __('Registration successful!'));
    }
}