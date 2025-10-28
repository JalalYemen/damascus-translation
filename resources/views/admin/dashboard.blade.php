@extends('layouts.app')

@section('title', __('Admin Dashboard'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>
                    <div class="card-body">
                        <h1>{{ __('Welcome, Admin!') }}</h1>
                        <p>{{ __('You have access to the administrative section of the website.') }}</p>
                        <p>{{ __('Here you can manage users, view quotes, and other site settings.') }}</p>
                        
                        {{-- Optional: Display Admin specific information --}}
                        @auth
                            <p>{{ __('Logged in as:') }} <strong>{{ Auth::user()->email }}</strong></p>
                        @endauth

                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">{{ __('Go to Homepage') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection