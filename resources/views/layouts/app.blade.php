<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ (app()->getLocale() == 'ar') ? 'rtl' : 'ltr' }}">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') | {{ config('app.name', 'Damascus Translation') }}</title>

    {{-- Hreflang for SEO: points to dynamic routes for language versions --}}
    <link rel="alternate" hreflang="en" href="{{ route('lang.switch', ['locale' => 'en', 'return_to' => Route::currentRouteName() ?? 'home']) }}" />
    <link rel="alternate" hreflang="ar" href="{{ route('lang.switch', ['locale' => 'ar', 'return_to' => Route::currentRouteName() ?? 'home']) }}" />
    <link rel="alternate" hreflang="x-default" href="{{ route('lang.switch', ['locale' => 'en', 'return_to' => Route::currentRouteName() ?? 'home']) }}" /> {{-- Default to English --}}

    <link rel="icon" type="image/png" href="{{ asset('assets/images/circle.png') }}" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    {{-- Conditionally load Arabic fonts and RTL CSS based on current locale --}}
    @if (app()->getLocale() == 'ar')
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/styleAr.css') }}" />
    @else
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @endif
    @stack('styles')
  </head>

  <body class="bg-white">
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('home') }}">
          <img
            src="{{ asset('assets/images/text.png') }}"
            alt="Logo"
            width="80"
            height="80"
            style="object-fit: cover"
          />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
          <ul class="navbar-nav ms-auto align-items-center gap-2">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}#services">{{ __('Services') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('about') }}">{{ __('About Us') }}</a>
            </li>
            <li class="nav-item">
              @if (app()->getLocale() == 'ar')
                <a class="nav-link" href="{{ route('lang.switch', ['locale' => 'en', 'return_to' => Route::currentRouteName() ?? 'home']) }}">EN</a>
              @else
                <a class="nav-link" href="{{ route('lang.switch', ['locale' => 'ar', 'return_to' => Route::currentRouteName() ?? 'home']) }}">AR</a>
              @endif
            </li>
                        {{-- Authentication related navigation items (NOW DYNAMIC via Laravel Auth) --}}
            @if ($signedIn) {{-- True if a user is authenticated --}}
                <li class="nav-item" id="user-nav" style="position: relative;">
                    <div id="user-avatar" class="user-avatar-circle" style="cursor: pointer;">
                        {{ mb_strtoupper(mb_substr($authUser->email, 0, 1)) }} {{-- Display first letter of email --}}
                    </div>
                    <div id="user-dropdown-menu" class="user-dropdown">
                        <div id="dropdown-user-email" class="dropdown-email">{{ $authUser->email }}</div>
                        <button id="logout-button" class="btn btn-outline-danger w-100">{{ __('Log Out') }}</button>
                    </div>
                </li>
            @else {{-- If no user is signed in --}}
                <li class="nav-item" id="auth-toggle-li">
                    <button id="auth-toggle" class="btn btn-outline-primary">{{ __('Sign Up / Log In') }}</button>
                </li>
            @endif

            <li class="nav-item">
              <a
                href="{{ route('quotation') }}"
                class="btn btn-primary px-4 quote-slide-btn"
                id="quoteSlideBtn"
                >{{ __('Get a Quote') }}</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    {{-- Main content section, unique for each page --}}
    @yield('content')

    {{-- Shared Auth Modal Popup --}}
    <section id="auth-modal-section">
      <div id="auth-modal">
        <div class="modal-content">
          <button id="auth-close" class="close-btn" aria-label="{{ __('Close') }}">×</button>
          <h2>{{ __('Welcome') }}</h2>
          <form id="auth-form">
            <input
              type="email"
              id="auth-email"
              class="form-control mb-3"
              placeholder="{{ __('Email') }}"
              required
            />
            <input
              type="password"
              id="auth-password"
              class="form-control mb-3"
              placeholder="{{ __('Password') }}"
              required
            />
            <div
              id="auth-error"
              style="color: red; font-size: 0.9rem; margin-bottom: 10px"
            ></div>
            <button
              type="button"
              id="signup-button"
              class="btn btn-warning w-100 mb-3"
            >
              {{ __('Sign Up') }}
            </button>
            <button
              type="button"
              id="login-button"
              class="btn btn-primary w-100 mb-3"
            >
              {{ __('Log In') }}
            </button>
          </form>
          <hr />
          <div class="or-text">{{ __('or') }}</div>
          <button id="google-signin" class="google-btn">
            <i class="fab fa-google"></i> {{ __('Continue with Google') }}
          </button>
        </div>
      </div>
      <div id="overlay" class="overlay"></div>
    </section>

    <footer class="footer">
      <div class="container">
        <div class="footer-links">
          <a href="{{ route('home') }}" class="footer-link">{{ __('Home') }}</a>
          <a href="{{ route('home') }}#services" class="footer-link">{{ __('Services') }}</a>
          <a href="{{ route('home') }}#how" class="footer-link">{{ __('How it Works') }}</a>
          <a href="{{ route('home') }}#testimonials" class="footer-link">{{ __('Testimonials') }}</a>
          <a href="{{ route('home') }}#faq" class="footer-link">{{ __('FAQ') }}</a>
          <a href="{{ route('home') }}#contact" class="footer-link">{{ __('Contact') }}</a>
          <a href="#" class="footer-link">{{ __('Privacy Policy') }}</a>
          <a href="#" class="footer-link">{{ __('Terms') }}</a>
        </div>
        <div class="social-icons">
          <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        </div>
        <p class="mb-0 text-center">
          © {{ date('Y') }} {{ __('Damascus Translation Services. All rights reserved.') }}
          
        </p>
      </div>
    </footer>

            <!-- Core JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Your new shared JS logic (global utilities) --}}
    <script type="module" src="{{ asset('js/main.js') }}" defer></script>
    {{-- Auth frontend JS for handling modal interactions and Laravel API calls --}}
    <script type="module" src="{{ asset('js/auth-frontend.js') }}" defer></script>

    {{-- Optional: For page-specific scripts that push to this stack --}}
    @stack('scripts')
  </body>
</html>