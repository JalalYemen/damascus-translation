@extends('layouts.app') {{-- Extends our master layout --}}

{{-- Dynamically set the page title based on the current locale --}}
@section('title', (app()->getLocale() == 'ar' ? 'دمشق لخدمات الترجمة' : 'Damascus Translation Services'))

@section('content')

    <section class="hero-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-4 mb-lg-0 hero-text-col">
            <h1 class="display-4 fw-bold mb-3">
              {{ __('Hero Title') }}
            </h1>
            <p class="lead mb-4">
              {{ __('Hero Subtitle') }}
            </p>
            <ul class="list-unstyled mb-4">
              <li class="mb-2">
                <i class="fas fa-check-circle me-2 text-success"></i>
                {{ __('Hero List Item 1') }}
              </li>
              <li class="mb-2">
                <i class="fas fa-check-circle me-2 text-success"></i>
                {{ __('Hero List Item 2') }}
              </li>
                <li class="mb-2">
                <i class="fas fa-check-circle me-2 text-success"></i>
                {{ __('Hero List Item 3') }}
                </li>
                <li class="mb-2">
                <i class="fas fa-check-circle me-2 text-success"></i>
                {{ __('Hero List Item 4') }}
                </li>
                <li class="mb-2">
                <i class="fas fa-check-circle me-2 text-success"></i>
                {{ __('Hero List Item 5') }}
                </li>
            </ul>

            <a href="{{ route('quotation') }}" class="btn btn-primary px-4 py-2 fw-bold">{{ __('Get a Quote') }}</a>
          </div>
          <div class="col-lg-6 text-center">
            <img
              src="{{ asset('assets/images/4.jpg') }}"
              class="img-fluid hero-image"
              alt="{{ __('Translation Illustration') }}"
            />
          </div>
        </div>
      </div>
    </section>

    <section id="services" class="services-section">
      <div class="container">
        <h2 class="section-title">{{ __('Our Translation Services') }}</h2>
        <div class="row g-4">
          <!-- Card 1: Document Translation -->
          <div class="col-md-4">
              <div class="service-card">
                <div class="service-icon">
                  <i class="fas fa-file-alt"></i>
                </div>
                <h3 class="service-title">{{ __('Service Card 1 Title') }}</h3>
                <p>
                    {{-- Using {!! !!} and nl2br to render line breaks if description has them --}}
                    {!! nl2br(e(__('Service Card 1 Description'))) !!}
                </p>
                <a href="{{ route('translations') }}" class="service-card-cta">
                    <span>{{ __('More') }}</span>
                    @if (app()->getLocale() == 'ar')
                        <i class="fas fa-arrow-left"></i>
                    @else
                        <i class="fas fa-arrow-right"></i>
                    @endif
                </a>
              </div>
          </div>

          <!-- Card 2: Website Localization -->
          <div class="col-md-4">
              <div class="service-card">
                <div class="service-icon">
                  <i class="fas fa-headset"></i>
                </div>
                <h3 class="service-title">{{ __('Service Card 2 Title') }}</h3>
                <p>
                  {!! nl2br(e(__('Service Card 2 Description'))) !!}
                </p>
                <a href="{{ route('localizations') }}" class="service-card-cta">
                    <span>{{ __('More') }}</span>
                    @if (app()->getLocale() == 'ar')
                        <i class="fas fa-arrow-left"></i>
                    @else
                        <i class="fas fa-arrow-right"></i>
                    @endif
                </a>
              </div>
          </div>

          <!-- Card 3: Creative Solutions -->
          <div class="col-md-4">
              <div class="service-card">
                <div class="service-icon">
                  <i class="fas fa-photo-video"></i>
                </div>
                <h3 class="service-title">{{ __('Service Card 3 Title') }}</h3>
                <p>
                  {!! nl2br(e(__('Service Card 3 Description'))) !!}
                </p>
                <a href="{{ route('solutions') }}" class="service-card-cta">
                    <span>{{ __('More') }}</span>
                    @if (app()->getLocale() == 'ar')
                        <i class="fas fa-arrow-left"></i>
                    @else
                        <i class="fas fa-arrow-right"></i>
                    @endif
                </a>
              </div>
          </div>
        </div>
      </div>
    </section>

    <section id="how" class="how-section">
      <div class="container">
        <h2 class="section-title">{{ __('How it Works') }}</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="how-step">
              <div class="step-icon"><i class="fas fa-upload"></i></div>
              <div class="how-step-title">{{ __('How Step 1 Title') }}</div>
              <div>
                {{ __('How Step 1 Description') }}
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="how-step">
              <div class="step-icon"><i class="fas fa-user-check"></i></div>
              <div class="how-step-title">{{ __('How Step 2 Title') }}</div>
              <div>
                {{ __('How Step 2 Description') }}
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="how-step">
              <div class="step-icon">
                <i class="fas fa-file-signature"></i>
              </div>
              <div class="how-step-title">{{ __('How Step 3 Title') }}</div>
              <div>
                {{ __('How Step 3 Description') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<section id="resources" class="resources-section">
  <div class="container">
    <h2 class="section-title">{{ __('Resources') }}</h2>

    <div id="resourcesCarousel" class="carousel slide"  data-bs-interval="false">
      <div class="carousel-inner">

        <div class="carousel-item active">
          <div class="resource-card">
            <img src="{{ asset('assets/images/dawha.jpg') }}" class="resource-logo" alt="{{ __('Resource Logo') }}">
            <h5 class="resource-name">{{ __('Resource 1 Name') }}</h5>
            <p class="resource-desc">
              {{ __('Resource 1 Description') }}
            </p>
            <a href="https://www.dohadictionary.org/" target="_blank" rel="noopener noreferrer" class="resource-link">
              <span>{{ __('Visit') }}</span>
              <i class="fas fa-external-link-alt"></i>
            </a>
          </div>
        </div>

        <div class="carousel-item">
          <div class="resource-card">
            <img src="{{ asset('assets/images/ryadh.jpg') }}" class="resource-logo" alt="{{ __('Resource Logo') }}">
            <h5 class="resource-name">{{ __('Resource 2 Name') }}</h5>
            <p class="resource-desc">
              {{ __('Resource 2 Description') }}
            </p>
            <a href="https://dictionary.ksaa.gov.sa/" target="_blank" rel="noopener noreferrer" class="resource-link">
              <span>{{ __('Visit') }}</span>
              <i class="fas fa-external-link-alt"></i>
            </a>
          </div>
        </div>

        <div class="carousel-item">
          <div class="resource-card">
            <img src="{{ asset('assets/images/abu dhabi.png') }}" class="resource-logo" alt="{{ __('Resource Logo') }}">
            <h5 class="resource-name">{{ __('Resource 3 Name') }}</h5>
            <p class="resource-desc">
              {{ __('Resource 3 Description') }}
            </p>
            <a href="https://dictionary.alc.ae/" target="_blank" rel="noopener noreferrer" class="resource-link">
              <span>{{ __('Visit') }}</span>
              <i class="fas fa-external-link-alt"></i>
            </a>
          </div>
        </div>

      </div>

      <button class="carousel-control-prev custom-carousel-control-prev-resources" type="button" data-bs-target="#resourcesCarousel" data-bs-slide="prev">
        <span class="visually-hidden">{{ __('Previous') }}</span>
      </button>

      <button class="carousel-control-next custom-carousel-control-resources" type="button" data-bs-target="#resourcesCarousel" data-bs-slide="next">
        <span class="visually-hidden">{{ __('Next') }}</span>
      </button>

    </div>
  </div>
</section>

    <section id="contact" class="contact-section">
  <div class="container">
    <h2 class="section-title">{{ __('Contact Us') }}</h2>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="contact-form">
          {{-- We'll link this form to a Laravel route later --}}
          <form id="contactForm" action="{{ route('contact.submit') }}" method="POST">
            @csrf {{-- CSRF token for security --}}
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="user_name" {{-- Added name attribute for form submission --}}
                  required
                />
              </div>
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="user_email" {{-- Added name attribute for form submission --}}
                  required
                />
              </div>
            </div>
            <div class="mb-3">
              <label for="service" class="form-label">{{ __('Service Needed') }}</label>
              <select class="form-select" id="service" name="user_service" required>
                <option value="" selected disabled>{{ __('Select a service') }}</option>
                <option>{{ __('Document Translation') }}</option>
                <option>{{ __('Creative Language Solutions') }}</option>
                <option>{{ __('Interpretation') }}</option>
                <option>{{ __('Other') }}</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">{{ __('Message') }}</label>
              <textarea
                class="form-control"
                id="message"
                rows="5"
                name="user_message" {{-- Added name attribute for form submission --}}
                required
              ></textarea>
            </div>
                        
                        <!-- Message display area -->
            <div id="contactFormMessage" class="mt-3 mb-3 text-center">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error')) 
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <button
              type="submit"
              class="btn btn-primary w-100 py-3 fw-bold"
              id="contactSubmitBtn"
            >
              {{ __('Send') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@push('scripts')    
    <script type="module" src="{{ asset('js/index.js') }}" defer></script>
@endpush