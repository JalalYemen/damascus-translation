<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str; // <-- Added for Str::random()
use App\Models\User; // <-- Added for User model access
use Illuminate\Support\Facades\Storage;

Route::get('/test-r2', function () {
    try {
        $disk = Storage::disk('s3');
        $disk->put('test.txt', 'Hello, R2!');
        $url = $disk->url('test.txt');
        return "File uploaded successfully. URL: {$url}";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Language switcher route
Route::get('lang/{locale}', [LocalizationController::class, 'setLocale'])->name('lang.switch');

// --- GOOGLE AUTHENTICATION ROUTES ---
// These are placed outside the main 'web' group initially for simplicity,
// as Socialite manages its own session state during the redirect dance.
Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google.redirect');

Route::get('/auth/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')->user();

        // Find or create the user in your database
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                // Create a secure random password for users who sign up with Google
                // This password is not used for login, but fills the required field.
                'password' => Illuminate\Support\Facades\Hash::make(Str::random(24))
            ]
        );

        // Log the user in
        Auth::login($user, true); // 'true' for "Remember Me" functionality

        return redirect()->route('home');

    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Google login failed: ' . $e->getMessage());
        return redirect()->route('home')->with('error', 'Login with Google failed. Please try again.');
    }
});


Route::middleware(['web'])->group(function () {
    // --- Existing Public Page Routes ---
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', function () { return view('about'); })->name('about');
    Route::get('/quotation', function () { return view('quotation'); })->name('quotation');
    Route::get('/translations', function () { return view('translations'); })->name('translations');
    Route::get('/localizations', function () { return view('localizations'); })->name('localizations');
    Route::get('/solutions', function () { return view('solutions'); })->name('solutions');

    // Contact form submission route
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    // --- Authentication Routes (Simple Login/Register/Logout) ---

    // Guest routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [HomeController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
    });

    // Authenticated routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
        Route::get('/profile', function () {
            // This is just a placeholder, you should create a real profile view
            return 'This is the user profile page.';
        })->name('profile');
    });

    // Admin Routes
    Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});