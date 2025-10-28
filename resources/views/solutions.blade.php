@extends('layouts.app')

{{-- Dynamically set the page title based on the current locale --}}
@section('title', __('Creative Solutions'))

{{-- No specific styles or scripts push needed at this time as the HTML relies on global CSS/JS. --}}
{{-- If any unique CSS (like `solutions.css`) or JS (`solutions.js`) emerges, it will be added here. --}}

@section('content')

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">{{ __('Creative Language Solutions') }}</h1>
            <p class="page-subtitle">{{ __('Beyond Translation - Content Innovation & Media Adaptation.') }}</p>
        </div>
    </header>

    <main>
        <!-- Content Creation Section -->
        <section class="service-detail-section">
            <div class="container">

                <!-- Centered Image -->
                <div class="row justify-content-center mb-5">
                    <div class="col-md-8 text-center">
                        <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=600&q=80"
                             class="img-fluid rounded-3 shadow-sm"
                             alt="{{ __('Creative content creation') }}">
                    </div>
                </div>

                <!-- Content Creation Boxes -->
                <div class="row g-4">
                    <!-- Box 1: Content Development -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Content Development') }}</h5>
                            <p class="category-items">
                                {{ __('Multilingual Copywriting | Transcreation | Brand Localization') }}<br>
                                {{ __('Marketing Content | Technical Writing | Press Kits') }}
                            </p>
                        </div>
                    </div>

                    <!-- Box 2: Media Solutions -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Media Solutions') }}</h5>
                            <p class="category-items">
                                {{ __('Video Subtitling (Films/Documentaries/E-learning)') }}<br>
                                {{ __('Transcription (Interviews/Meetings) | Voice-over Scripts') }}
                            </p>
                        </div>
                    </div>

                    <!-- Box 3: Quality Enhancement -->
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card h-100">
                            <h5 class="category-title">{{ __('Quality Enhancement') }}</h5>
                            <p class="category-items">
                                {{ __('Professional Proofreading | Terminology Management') }}<br>
                                {{ __('Formatting & Desktop Publishing | Consistency Checks') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        {{-- Section from solutionsAr.html that alternates image/text for "Multilingual Content Creation" --}}
        <section class="service-detail-section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=600&q=80" class="img-fluid rounded-3 shadow-sm" alt="{{ __('Creative content creation') }}">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ __('Multilingual Content Creation') }}</h2>
                        <p>{{ __('Engage your global audience with original, high-quality content crafted by our team of international writers and strategists. We develop content that is not just translated, but born from a deep understanding of the target culture.') }}</p>
                        <ul>
                            <li><strong>{{ __('Articles & Blog Posts:') }}</strong> {{ __('SEO-optimized content that drives traffic and establishes credibility.') }}</li>
                            <li><strong>{{ __('Social Media Content:') }}</strong> {{ __('Culturally relevant posts that spark engagement.') }}</li>
                            <li><strong>{{ __('Marketing Copy:') }}</strong> {{ __('Compelling ad copies, landing pages, and email campaigns that convert.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section from solutionsAr.html that alternates image/text for "Explainer Videos" --}}
        <section class="service-detail-section">
            <div class="container">
                <div class="row align-items-center g-5 flex-row-reverse"> {{-- Note: This is flex-row-reverse for image on right in LTR --}}
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1558655146-d09347e92766?auto=format&fit=crop&w=600&q=80" class="img-fluid rounded-3 shadow-sm" alt="{{ __('Animated Explainer Videos Production') }}">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ __('Explainer Videos') }}</h2>
                        <p>{{ __('Simplify complex ideas and capture your audience\'s attention with custom animated explainer videos. We handle the entire production process, from scriptwriting and storyboarding to animation and multilingual voice-over.') }}</p>
                        <ul>
                            <li><strong>{{ __('2D & 3D Animation:') }}</strong> {{ __('High-quality motion graphics that align with your brand identity.') }}</li>
                            <li><strong>{{ __('Script Localization:') }}</strong> {{ __('Adapting text to be culturally effective, not just a literal translation.') }}</li>
                            <li><strong>{{ __('Global Voice Talent:') }}</strong> {{ __('Network of professional voice actors for authentic narration.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        {{-- Section from solutionsAr.html that alternates image/text for "Proofreading and Editing" --}}
        <section class="service-detail-section">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=600&q=80" class="img-fluid rounded-3 shadow-sm" alt="{{ __('Professional Proofreading and Editing') }}">
                    </div>
                    <div class="col-lg-6">
                        <h2>{{ __('Proofreading and Editing') }}</h2>
                        <p>{{ __('Ensure your content is flawless, professional, and ready for publication. Our expert editors review your documents for grammatical accuracy, style, tone, and cultural appropriateness, adding the final touch that builds credibility.') }}</p>
                        <ul>
                            <li><strong>{{ __('Academic Editing:') }}</strong> {{ __('Polishing research papers, theses, and dissertations.') }}</li>
                            <li><strong>{{ __('Business Proofreading:') }}</strong> {{ __('Refining reports, proposals, and marketing materials.') }}</li>
                            <li><strong>{{ __('Post-Translation Review:') }}</strong> {{ __('Final check by a native-speaking linguist for quality assurance.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <h2>{{ __('Ready to Bring Your Creative Vision to Life?') }}</h2>
            <p>{{ __('Let\'s build something great together. Get a free, no-obligation quote from our creative team.') }}</p>
            <a href="{{ route('home') }}#contact" class="btn btn-primary btn-lg px-5 py-3">{{ __('Get a Quote') }}</a>
        </div>
    </section>

@endsection