<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
use Masbug\Flysystem\GoogleDriveAdapter;
use League\Flysystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share authenticated user data with all views
        // This makes `Auth::user()` and `Auth::check()` directly accessible in all Blade templates.
        View::composer('*', function ($view) {
            $view->with('signedIn', Auth::check());
            $view->with('authUser', Auth::user()); // authUser will be null if not logged in
        });

        
    }
}