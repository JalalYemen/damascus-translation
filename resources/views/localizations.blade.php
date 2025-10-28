@extends('layouts.app')

{{-- Dynamically set the page title based on the current locale --}}
@section('title', __('Digital Localization Services'))

{{-- No specific styles or scripts push needed at this time as the HTML relies on global CSS/JS. --}}

@section('content')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">{{ __('Digital Localization Services') }}</h1>
            <p class="page-subtitle">{{ __('Beyond translation, we adapt your digital content, software, and marketing campaigns to resonate culturally and functionally with local audiences.') }}</p>
        </div>
    </header>

    <main>
        <!-- Website Localization Section (from localizationsAr.html structure) -->
        <section class="service-detail-section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/images/students-working-study-group.jpg') }}" class="img-fluid rounded-3 shadow-sm" alt="{{ __('Website localization on multiple devices') }}">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ __('Website Localization') }}</h2>
                        <p>{{ __('A successful global website feels local to every visitor. We go beyond direct translation to adapt the entire user experience, from UI and imagery to payment methods and local customs.') }}</p>
                        <ul>
                            <li><strong>{{ __('Cultural Adaptation:') }}</strong> {{ __('Adjusting graphics, colors, and tone to align with local values.') }}</li>
                            <li><strong>{{ __('Technical SEO Optimization:') }}</strong> {{ __('Implementing hreflang tags, local keyword optimization, and international site structures.') }}</li>
                            <li><strong>{{ __('CMS Integration:') }}</strong> {{ __('Working directly within your Content Management System for a seamless workflow.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Software & App Localization Section (from localizationsAr.html structure) -->
        <section class="service-detail-section">
            <div class="container">
                <div class="row align-items-center g-5 flex-row-reverse">
                    <div class="col-lg-6">
                        <img src="{{ asset('assets/images/students-working-study-group.jpg') }}" class="img-fluid rounded-3 shadow-sm" alt="{{ __('Software and Mobile App Localization') }}">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ __('Software & App Localization') }}</h2>
                        <p>{{ __('Launch your software or apps into new markets with confidence. Our localization engineers and linguists work together to ensure your application is functional, user-friendly, and culturally appropriate for users everywhere.') }}</p>
                        <ul>
                            <li><strong>{{ __('UI/UX Adaptation:') }}</strong> {{ __('Resizing dialogs and adjusting layouts to fit different languages.') }}</li>
                            <li><strong>{{ __('String Extraction:') }}</strong> {{ __('Separating embedded texts from code for easier translation.') }}</li>
                            <li><strong>{{ __('Linguistic & Functional Testing:') }}</strong> {{ __('Rigorous quality assurance to catch bugs and cultural discrepancies before release.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section (Re-used) -->
        <section class="service-detail-section">
            <div class="container">
                <div class="text-center mb-5">
                    {{-- The inline style should be moved to a CSS class if reused, otherwise remove if already global --}}
                    <h2 class="section-title" style="font-weight: 700; color: var(--dark); font-size: 2.2rem;">{{ __('Our Commitment to Excellence') }}</h2>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-check-double"></i></div>
                            <h5>{{ __('Quality Assurance') }}</h5>
                            <p class="mb-0">{{ __('Every project undergoes a multi-step review process for accuracy and consistency.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-users-gear"></i></div>
                            <h5>{{ __('Expert Teams') }}</h5>
                            <p class="mb-0">{{ __('Our network includes localization engineers and subject-matter experts.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-bolt"></i></div>
                            <h5>{{ __('Agile Workflow') }}</h5>
                            <p class="mb-0">{{ __('We integrate with your development cycle for continuous localization and fast delivery.') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card text-center">
                            <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
                            <h5>{{ __('Confidentiality') }}</h5>
                            <p class="mb-0">{{ __('Your source code and documents are handled with the utmost security and strict NDAs.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ __('Ready for a Global Audience?') }}</h2>
            <p>{{ __('Let\'s discuss your localization needs. Get a free, no-obligation quote from our team today.') }}</p>
            <a href="{{ route('home') }}#contact" class="btn btn-primary btn-lg px-5 py-3">{{ __('Get a Quote') }}</a>
        </div>
    </section>

@endsection