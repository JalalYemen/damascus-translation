<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMailable;

class ContactController extends Controller
{
    /**
     * Handle the contact form submission from the homepage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // 1. Validate the incoming request data
        //    Define validation rules to ensure data is clean and valid.
        $validator = Validator::make($request->all(), [
            'user_name'    => 'required|string|max:255',
            'user_email'   => 'required|email|max:255',
            'user_service' => 'required|string|max:255',
            'user_message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            // If validation fails, redirect back with input and errors.
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // 2. Data is validated. Now, process it.
        //    For now, let's log the data to verify it's received correctly.
        Log::info('Homepage Contact Form Submission:', $request->except('_token'));

        // 3. Prepare for Email Sending
       try {
            Mail::to('jalalaljabri63@gmail.com') 
                ->send(new ContactFormMailable($request->all()));
            Log::info('Contact form email dispatched successfully (via SMTP).');
        } catch (\Exception $e) {
            Log::error('Failed to dispatch contact form email: ' . $e->getMessage());
            
            return Redirect::back()->withInput()->with('error', __('Failed to send email. Please try again.'));
        }

        // 4. Redirect back to the homepage with a success message
        return Redirect::route('home')->with('success', __('Your message has been sent successfully!'));
    }
}