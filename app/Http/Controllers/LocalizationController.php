<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route; // Import the Route facade

class LocalizationController extends Controller
{
    public function setLocale(Request $request, $locale)
    {
        // Ensure the locale is one of our supported ones
        if (in_array($locale, ['en', 'ar'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        // Get the route name from the 'return_to' query parameter, defaulting to 'home'
        $returnToRoute = $request->query('return_to', 'home');

        // Attempt to redirect to the named route for consistency,
        // or fall back to the previous URL if the named route doesn't exist
        if (Route::has($returnToRoute)) {
            return Redirect::route($returnToRoute);
        }

        // Fallback to previous page, which also takes into account where the user was before
        return Redirect::back();
    }
}