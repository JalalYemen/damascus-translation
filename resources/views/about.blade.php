@extends('layouts.app')

{{-- Dynamically set the page title based on the current locale --}}
@section('title', __('About Us'))

{{-- If there were page-specific styles beyond global ones, we'd @push('styles') them here.
     Based on provided about.html, none are explicitly needed if default Bootstrap/global CSS suffice.
     We rely on main style.css and styleAr.css.
--}}
{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush --}}


@section('content')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">{{ __('Our Story') }}</h1>
            <p class="page-subtitle">{{ __('Connecting cultures and bridging communication gaps with precision, passion, and professionalism.') }}</p>
        </div>
    </header>

    <main>
        <!-- Our Mission Section -->
        <section class="service-detail-section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        {{-- External image, no asset helper needed for direct URL --}}
                        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-3 shadow-sm" alt="{{ __('A diverse team collaborating in a modern office') }}">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ __('Our Mission') }}</h2>
                        <p>{{ __('At Damascus Translation, our mission is to deliver flawless and culturally nuanced language solutions that empower our clients to succeed in the global marketplace. We believe that every word matters and strive to provide translations that are not only accurate but also resonate with the target audience.') }}</p>
                        <p>{{ __('We are committed to leveraging a combination of expert human linguists and cutting-edge technology to ensure quality, speed, and confidentiality in everything we do.') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Meet the Team Section -->
        <section class="team-section">
            <div class="container">
                <h2 class="section-title">{{ __('Meet Our Team') }}</h2>
                <div class="row g-4">
                    <!-- Team Member 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="team-card">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="team-card-img" alt="{{ __('Team Member') }}">
                            <h5 class="team-card-name">{{ __('John Doe') }}</h5>
                            <p class="team-card-role">{{ __('Founder & Lead Linguist') }}</p>
                        </div>
                    </div>
                    <!-- Team Member 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="team-card">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="team-card-img" alt="{{ __('Team Member') }}">
                            <h5 class="team-card-name">{{ __('Jane Smith') }}</h5>
                            <p class="team-card-role">{{ __('Head of Operations') }}</p>
                        </div>
                    </div>
                    <!-- Team Member 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="team-card">
                            <img src="https://randomuser.me/api/portraits/men/34.jpg" class="team-card-img" alt="{{ __('Team Member') }}">
                            <h5 class="team-card-name">{{ __('Peter Jones') }}</h5>
                            <p class="team-card-role">{{ __('Project Manager') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ __('Ready to Work With Us?') }}</h2>
            <p>{{ __('Let\'s discuss your translation needs. Get a free, no-obligation quote from our team today.') }}</p>
            <a href="{{ route('home') }}#contact" class="btn btn-primary btn-lg px-5 py-3">{{ __('Get a Quote') }}</a>
        </div>
    </section>

@endsection

{{-- No specific JavaScript is needed for the About page based on the provided HTML. --}}
{{-- If any JS specific to this page emerged, it would be loaded like this: --}}
{{-- @push('scripts')
    <script type="module" src="{{ asset('js/about.js') }}" defer></script>
@endpush --}}