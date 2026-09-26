<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoNoIndex  = isset($seo) && $seo && $seo->no_index;
        $seoTitle    = isset($seo) && $seo ? $seo->meta_title : null;
        $seoDesc     = isset($seo) && $seo ? $seo->meta_description : null;
        $seoKeywords = isset($seo) && $seo ? $seo->meta_keywords : null;
        $seoOgTitle  = isset($seo) && $seo ? ($seo->og_title ?: $seo->meta_title) : null;
        $seoOgDesc   = isset($seo) && $seo ? $seo->og_description : null;
        $seoOgImage  = isset($seo) && $seo ? $seo->og_image : null;
        $seoCanon    = isset($seo) && $seo ? $seo->canonical_url : null;
        $siteName    = $globalSettings->get('site_name','Aakar Dermatology');
        $siteDesc    = $globalSettings->get('site_description','Comprehensive Medical & Aesthetic Dermatology Services in Lalitpur');
        $uploadedLogos = json_decode($globalSettings->get('site_logos', '[]'), true) ?: [];
        $defaultLogo  = $uploadedLogos[0] ?? $globalSettings->get('site_logo');
        $headerLogo  = $defaultLogo;
        $footerLogo  = $defaultLogo;
        $managedMenuPages = App\Models\SeoMeta::whereIn('page', ['videos', 'privacy_policy', 'terms_and_conditions'])->get()->keyBy('page');
    @endphp
    <meta name="robots" content="{{ $seoNoIndex ? 'noindex,nofollow' : 'index,follow' }}">

    {{-- SEO Meta --}}
    <title>@yield('meta_title', $seoTitle ?? ($siteName . ' | Skin · Hair · Laser'))</title>
    <meta name="description" content="@yield('meta_description', $seoDesc ?? $siteDesc)">
    @if($seoKeywords)
    <meta name="keywords" content="{{ $seoKeywords }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="@yield('og_title', $seoOgTitle ?? $siteName)">
    <meta property="og:description" content="@yield('og_description', $seoOgDesc ?? $seoDesc ?? '')">
    @if($seoOgImage)
    <meta property="og:image" content="{{ asset('storage/'.$seoOgImage) }}">
    @endif
    @if($seoCanon)
    <link rel="canonical" href="{{ $seoCanon }}">
    @else
    <link rel="canonical" href="{{ url()->current() }}">
    @endif

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoOgTitle ?? $seoTitle ?? $siteName }}">
    <meta name="twitter:description" content="{{ $seoOgDesc ?? $seoDesc ?? '' }}">

    {{-- Schema.org Local Business --}}
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "MedicalBusiness",
      "name": "{{ $siteName }}",
      "description": "{{ $siteDesc }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ $globalSettings->get('contact_phone') }}",
      "address": {
        "@@type": "PostalAddress",
        "addressLocality": "Lalitpur",
        "addressCountry": "NP",
        "streetAddress": "{{ $globalSettings->get('contact_address','Lalitpur Metropolitan City') }}"
      },
      "openingHours": "{{ $globalSettings->get('contact_hours','Mo-Fr 09:00-18:00') }}",
      "medicalSpecialty": "Dermatology"
    }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ── Live brand colors injected from DB — no rebuild needed when admin changes colors ── --}}
    @php
        $cp  = $globalSettings->get('color_primary',      '#006E61');
        $cpd = $globalSettings->get('color_primary_dark',  '#004D44');
        $cpm = $globalSettings->get('color_primary_mid',   '#007D6E');
        $cpl = $globalSettings->get('color_primary_light', '#F0FAF8');
        $ca  = $globalSettings->get('color_accent',        '#CC9134');
        $cad = $globalSettings->get('color_accent_dark',   '#A87228');
        $cal = $globalSettings->get('color_accent_light',  '#FBF4E8');
        $ct  = $globalSettings->get('color_text',          '#1A1A1A');
    @endphp
    <style>
        :root {
            --primary:       {{ $cp }};
            --primary-dark:  {{ $cpd }};
            --primary-mid:   {{ $cpm }};
            --primary-light: {{ $cpl }};
            --primary-glow:  {{ hexToRgba($cp, 0.15) }};
            --accent:        {{ $ca }};
            --accent-dark:   {{ $cad }};
            --accent-mid:    {{ $ca }};
            --accent-light:  {{ $cal }};
            --accent-glow:   {{ hexToRgba($ca, 0.20) }};
            --dark:          {{ $cpd }};
            --text:          {{ $ct }};
            --muted:         #4D7A75;
            --border:        #D8EDE9;
            --bg:            #F7F3EC;
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- ════════════ NAVBAR ════════════ --}}
<header id="navbar" class="navbar">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Nav row — taller on desktop, standard on tablet/mobile --}}
        <div class="flex items-center justify-between h-14 sm:h-16 lg:h-18" style="--tw-height:4.5rem">

            {{-- ── Logo ── --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 flex-shrink-0" style="text-decoration:none">
                @if($headerLogo)
                    <img src="{{ asset('storage/'.$headerLogo) }}"
                         alt="{{ $siteName }}"
                         class="h-9 sm:h-11 lg:h-12 w-auto">
                @else
                    <div class="flex items-center gap-2">
                        {{-- Icon mark: slightly smaller on mobile --}}
                        <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background:linear-gradient(135deg,var(--primary),var(--accent))">
                            <span class="text-white font-bold text-sm sm:text-base lg:text-lg"
                                  style="font-family:'Playfair Display',serif">AR</span>
                        </div>
                        <div class="leading-tight">
                            <div class="font-bold text-sm lg:text-base"
                                 style="color:var(--dark);font-family:'Playfair Display',serif">AAKAR</div>
                            <div class="text-xs font-semibold tracking-widest"
                                 style="color:var(--accent);font-size:.6rem;letter-spacing:.15em">DERMATOLOGY</div>
                        </div>
                    </div>
                @endif
            </a>

            {{-- ── Desktop Nav (1024px+) ── --}}
            {{-- gap shrinks at 1024–1279px via .desktop-nav CSS class --}}
            <ul class="hidden lg:flex items-center desktop-nav list-none m-0 p-0"
                style="gap:clamp(0.9rem, 1.8vw, 2rem)">
                <li><a href="{{ route('home') }}"
                       class="nav-link inline-flex items-center gap-1">@include('frontend.partials.menu-icon', ['icon' => 'home'])<span>Home</span></a></li>
                <li><a href="{{ route('about') }}"
                       class="nav-link inline-flex items-center gap-1">@include('frontend.partials.menu-icon', ['icon' => 'info'])<span>About</span></a></li>
                <li><a href="{{ route('services') }}"
                       class="nav-link inline-flex items-center gap-1">@include('frontend.partials.menu-icon', ['icon' => 'services'])<span>Services</span></a></li>
                <li><a href="{{ route('gallery') }}"
                       class="nav-link inline-flex items-center gap-1">@include('frontend.partials.menu-icon', ['icon' => 'gallery'])<span>Gallery</span></a></li>
                <li><a href="{{ route('blog') }}"
                       class="nav-link inline-flex items-center gap-1">@include('frontend.partials.menu-icon', ['icon' => 'blog'])<span>Blog</span></a></li>
                <li class="nav-dropdown">
                    <button type="button" class="nav-link inline-flex items-center gap-1" aria-haspopup="true">
                        More
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6"/>
                        </svg>
                    </button>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('videos') }}" class="nav-dropdown-item">@include('frontend.partials.menu-icon', ['icon' => $managedMenuPages->get('videos')?->menu_icon ?: 'play']){{ $managedMenuPages->get('videos')?->menu_label ?: 'Videos' }}</a>
                        @foreach(['privacy_policy'=>'privacy-policy','terms_and_conditions'=>'terms-and-conditions'] as $pageKey => $routeName)
                        @if($managedMenuPages->has($pageKey))
                        <a href="{{ route($routeName) }}" class="nav-dropdown-item">@include('frontend.partials.menu-icon', ['icon' => $managedMenuPages->get($pageKey)->menu_icon]){{ $managedMenuPages->get($pageKey)->menu_label }}</a>
                        @endif
                        @endforeach
                    </div>
                </li>
                <li><a href="{{ route('contact') }}"
                       class="nav-link inline-flex items-center gap-1">@include('frontend.partials.menu-icon', ['icon' => 'contact'])<span>Contact</span></a></li>
            </ul>

            {{-- ── Right side: CTA + Hamburger ── --}}
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">

                {{-- Book Appointment CTA
                     • <480px  : hidden (see .nav-cta-btn CSS)
                     • 480–639px: icon only (circle button)
                     • 640–1023px: compact "Book Appt" with icon
                     • 1024px+: larger with full text
                --}}
                <a href="{{ route('contact') }}" class="nav-cta-btn" aria-label="Book Appointment">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{-- Short label on sm-md, full label on lg+ --}}
                    <span class="cta-text hidden lg:inline">Book Appointment</span>
                </a>

                {{-- Hamburger — shows below lg (1024px) --}}
                <button id="menu-btn"
                        aria-label="Toggle navigation menu"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        class="lg:hidden p-2 rounded-lg transition-colors hover:bg-gray-50 focus:outline-none focus-visible:ring-2"
                        style="color:var(--primary)">
                    <svg id="menu-icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="menu-icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- ── Mobile / Tablet Menu (below lg) ──
             On tablet landscape (600–1023px) items render in a 2-column grid (see CSS)
             On phones (<600px) single-column list
        --}}
        <div id="mobile-menu"
             class="lg:hidden border-t"
             style="border-color:var(--primary-light)">
            <ul class="py-3 space-y-0.5 list-none m-0 p-0" id="mobile-menu-list">
                <li><a href="{{ route('home') }}" class="mobile-nav-link">
                    @include('frontend.partials.menu-icon', ['icon' => 'home'])<span>Home</span>
                </a></li>
                <li><a href="{{ route('about') }}" class="mobile-nav-link">
                    @include('frontend.partials.menu-icon', ['icon' => 'info'])<span>About</span>
                </a></li>
                <li><a href="{{ route('services') }}" class="mobile-nav-link">
                    @include('frontend.partials.menu-icon', ['icon' => 'services'])<span>Services</span>
                </a></li>
                <li><a href="{{ route('gallery') }}" class="mobile-nav-link">
                    @include('frontend.partials.menu-icon', ['icon' => 'gallery'])<span>Gallery</span>
                </a></li>
                <li><a href="{{ route('blog') }}" class="mobile-nav-link">
                    @include('frontend.partials.menu-icon', ['icon' => 'blog'])<span>Blog</span>
                </a></li>
                <li>
                    <details class="mobile-nav-more">
                        <summary class="mobile-nav-link cursor-pointer">
                            <span class="mobile-nav-more-icon" aria-hidden="true">+</span>
                            <span>More</span>
                            <svg class="mobile-nav-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9l6 6 6-6"/>
                            </svg>
                        </summary>
                        <div class="pl-4 pt-0.5">
                            <a href="{{ route('videos') }}" class="mobile-nav-link">
                                @include('frontend.partials.menu-icon', ['icon' => $managedMenuPages->get('videos')?->menu_icon ?: 'play'])
                                <span>{{ $managedMenuPages->get('videos')?->menu_label ?: 'Videos' }}</span>
                            </a>
                            @foreach(['privacy_policy'=>'privacy-policy','terms_and_conditions'=>'terms-and-conditions'] as $pageKey => $routeName)
                            @if($managedMenuPages->has($pageKey))
                            <a href="{{ route($routeName) }}" class="mobile-nav-link">
                                @include('frontend.partials.menu-icon', ['icon' => $managedMenuPages->get($pageKey)->menu_icon])
                                <span>{{ $managedMenuPages->get($pageKey)->menu_label }}</span>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </details>
                </li>
                <li><a href="{{ route('contact') }}" class="mobile-nav-link">
                    @include('frontend.partials.menu-icon', ['icon' => 'contact'])<span>Contact</span>
                </a></li>
                {{-- Full-width CTA at bottom of mobile menu --}}
                <li class="pt-2 pb-1" style="grid-column: 1 / -1 !important">
                    <a href="{{ route('contact') }}"
                       class="btn-primary w-full justify-center"
                       style="border-radius:10px; font-size:.85rem; padding:.65rem 1rem; letter-spacing:.03em">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Book Appointment
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

{{-- Flash Messages --}}
@if(session('success'))
<div id="flash-message" class="fixed top-20 right-4 z-50 max-w-sm w-full">
    <div class="alert-success flex items-start gap-3 shadow-lg">
        <svg class="w-5 h-5 mt-0.5 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
</div>
@endif

{{-- Main Content --}}
<main>
    @yield('content')
</main>

{{-- ════════════ FOOTER ════════════ --}}
<footer class="footer pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    @if($footerLogo)
                        <img src="{{ asset('storage/'.$footerLogo) }}"
                             alt="{{ $siteName }}"
                             class="h-11 w-auto">
                    @else
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center"
                             style="background:linear-gradient(135deg,var(--primary),var(--accent))">
                            <span class="text-white font-bold" style="font-family:'Playfair Display',serif">AR</span>
                        </div>
                        <div class="leading-tight">
                            <div class="font-bold text-sm text-white" style="font-family:'Playfair Display',serif">AAKAR</div>
                            <div class="text-xs tracking-widest" style="color:var(--accent)">DERMATOLOGY</div>
                        </div>
                    @endif
                </div>
                <p class="text-sm leading-relaxed mb-4">
                    Comprehensive Medical &amp; Aesthetic Dermatology Services. Nurturing Skin, Carving Confidence.
                </p>
                <div class="flex gap-3">
                    @if($globalSettings->get('social_facebook'))
                    <a href="{{ $globalSettings->get('social_facebook') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full flex items-center justify-center transition"
                       style="background:rgba(255,255,255,0.08)" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    @endif
                    @if($globalSettings->get('social_instagram'))
                    <a href="{{ $globalSettings->get('social_instagram') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full flex items-center justify-center transition"
                       style="background:rgba(255,255,255,0.08)" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    @endif
                    @if($globalSettings->get('social_youtube'))
                    <a href="{{ $globalSettings->get('social_youtube') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full flex items-center justify-center transition"
                       style="background:rgba(255,255,255,0.08)" aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4>Quick Links</h4>
                <ul class="space-y-2 list-none p-0 m-0">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Dr. Rajan</a></li>
                    <li><a href="{{ route('services') }}">Our Services</a></li>
                    <li><a href="{{ route('gallery') }}">Gallery</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('videos') }}" class="inline-flex items-center gap-2">@include('frontend.partials.menu-icon', ['icon' => $managedMenuPages->get('videos')?->menu_icon ?: 'play']){{ $managedMenuPages->get('videos')?->menu_label ?: 'Videos' }}</a></li>
                    @foreach(['privacy_policy'=>'privacy-policy','terms_and_conditions'=>'terms-and-conditions'] as $pageKey => $routeName)
                    @if($managedMenuPages->has($pageKey))
                    <li><a href="{{ route($routeName) }}" class="inline-flex items-center gap-2">@include('frontend.partials.menu-icon', ['icon' => $managedMenuPages->get($pageKey)->menu_icon]){{ $managedMenuPages->get($pageKey)->menu_label }}</a></li>
                    @endif
                    @endforeach
                    <li><a href="{{ route('contact') }}">Book Appointment</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4>Our Services</h4>
                <ul class="space-y-2 list-none p-0 m-0">
                    <li><a href="{{ route('services.show','acne-treatment') }}">Acne Treatment</a></li>
                    <li><a href="{{ route('services.show','hair-transplant') }}">Hair Transplant</a></li>
                    <li><a href="{{ route('services.show','laser-hair-removal') }}">Laser Hair Removal</a></li>
                    <li><a href="{{ route('services.show','eyelid-surgery') }}">Eyelid Surgery</a></li>
                    <li><a href="{{ route('services.show','prp-therapy') }}">PRP Therapy</a></li>
                    <li><a href="{{ route('services.show','laser-facial') }}">Laser Facial</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4>Contact Us</h4>
                <ul class="space-y-3 list-none p-0 m-0 text-sm">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color:var(--accent)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $globalSettings->get('contact_address','Lalitpur, Nepal') }}</span>
                    </li>
                    @if($globalSettings->get('contact_phone'))
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" style="color:var(--accent)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ $globalSettings->get('contact_phone') }}">{{ $globalSettings->get('contact_phone') }}</a>
                    </li>
                    @endif
                    @if($globalSettings->get('contact_email'))
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" style="color:var(--accent)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $globalSettings->get('contact_email') }}">{{ $globalSettings->get('contact_email') }}</a>
                    </li>
                    @endif
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color:var(--accent)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $globalSettings->get('contact_hours','Sun–Fri: 9 AM – 6 PM') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Footer bottom --}}
        <div class="footer-bottom pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
            <span>© {{ date('Y') }} {{ $siteName }}. All rights reserved.</span>
            <div class="flex flex-wrap justify-center gap-4">
                <span>Developed by <a href="https://techbabal.com" target="_blank" rel="noopener">Techbabal.com</a></span>
                <a href="{{ route('sitemap') }}">Sitemap</a>
                <a href="{{ route('robots') }}">Robots.txt</a>
            </div>
        </div>
    </div>
</footer>

{{-- WhatsApp FAB --}}
@php $waPhone = $globalSettings->get('contact_phone'); @endphp
@if($waPhone)
<a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$waPhone) }}"
   target="_blank" rel="noopener"
   class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full flex items-center justify-center shadow-xl transition-transform hover:scale-110"
   style="background:#25D366" aria-label="WhatsApp Chat">
    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>
@endif

@stack('scripts')
</body>
</html>
