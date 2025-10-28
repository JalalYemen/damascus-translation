@extends('layouts.app')

{{-- Dynamically set the page title based on the current locale --}}
@section('title', __('Translation & Language Services'))

{{-- Check for any unique CSS required for this page.
     Your provided HTML used global styles only, but it had an inline style in one h2.
     We will migrate that here if it becomes truly page-specific, or adapt the main CSS if it's general.
--}}
{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('css/translations.css') }}">
@endpush --}}


@section('content')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">{{ __('Professional Document Translation') }}</h1>
            <p class="page-subtitle">{{ __('Certified Document Translation Services - Precision Across Industries.') }}</p>
        </div>
    </header>

    <main>
        <!-- Document Translation Section -->
        <section class="service-detail-section">
            <div class="container">
                <!-- Centered Image -->
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8 text-center">
                        <img src="{{ asset('assets/images/students-working-study-group.jpg') }}" class="img-fluid rounded-3 shadow-sm" alt="{{ __('Official document translation') }}">
                    </div>
                </div>

                <!-- Separate Boxes for Each Category -->
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Legal Translation') }}</h5>
                            <p class="category-items">
                                {{ __('Contracts & Agreements | Litigation Documents | Trademarks/Copyrights | Licenses | Arbitration Papers | Terms & Conditions') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Technical Translation') }}</h5>
                            <p class="category-items">
                                {{ __('Engineering Manuals | Scientific Papers | Technical Data Sheets | User Guides | Renewable Energy Docs | Operating Procedures') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Medical Translation') }}</h5>
                            <p class="category-items">
                                {{ __('Patient Records | Medical Journals | Drug Labeling | Case Reports | Medical Device Manuals | Research Findings') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Financial Translation') }}</h5>
                            <p class="category-items">
                                {{ __('Bank Documents | Financial Reports | Balance Sheets | AML/CFT Compliance | Accounting Records | Correspondence') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Academic Translation') }}</h5>
                            <p class="category-items">
                                {{ __('Research Papers | Theses/Dissertations | Textbooks | Certificates | Education Projects | Academic Articles') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Media & Marketing Translation') }}</h5>
                            <p class="category-items">
                                {{ __('Press Releases | Ad Campaigns | Social Media Content | Brochures | Websites | Newsletters') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="service-detail-section">
            <div class="container">
                <div class="text-center mb-5">
                    {{-- The inline style 'color:var(--dark); font-size: 2.2rem;' should be moved to CSS class if consistently used --}}
                    {{-- For now, let's keep it here, but generally inline styles are to be avoided --}}
                    <h2 class="section-title" style="color:var(--dark); font-size: 2.2rem;">{{ __('Our Commitment to Excellence') }}</h2>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-check-double"></i></div>
                            <h5>{{ __('Quality Assurance') }}</h5>
                            <p class="mb-0">{{ __('Every translation undergoes a multi-step review process to ensure accuracy and consistency.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-users-gear"></i></div>
                            <h5>{{ __('Expert Linguists') }}</h5>
                            <p class="mb-0">{{ __('Our global network consists of native-speaking, subject-matter experts in over 100 languages.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-bolt"></i></div>
                            <h5>{{ __('Fast Turnaround') }}</h5>
                            <p class="mb-0">{{ __('We leverage cutting-edge technology to deliver high-quality translations on your schedule.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
                            <h5>{{ __('Confidentiality') }}</h5>
                            <p class="mb-0">{{ __('Your documents are handled with the utmost security, protected by strict NDAs and secure servers.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ __('Ready to Start Your Project?') }}</h2>
            <p>{{ __('Let\'s discuss your translation needs. Get a free, no-obligation quote from our team today.') }}</p>
            <a href="{{ route('home') }}#contact" class="btn btn-primary btn-lg px-5 py-3">{{ __('Get a Quote') }}</a>
        </div>
    </section>

@endsection

{{-- No specific JavaScript or custom CSS file is immediately evident for this page beyond global. --}}
{{-- The original had the duplicated global scripts, but those are gone, covered by layouts/app.blade.php --}}