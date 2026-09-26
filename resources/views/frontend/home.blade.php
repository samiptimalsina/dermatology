@extends('layouts.app')

@section('content')

{{-- ══════════════════════════════════════════
     HERO
     Matches reference design:
     Left = label + large heading + description + buttons + inline stats
     Right = tall/wide rounded card  →  photo (no video) OR video player
     Video orientation (portrait/landscape) is set in admin → Hero Settings
══════════════════════════════════════════ --}}

@php
    /* ── Video resolution ── */
    $heroVideoUrl   = $settings->get('hero_video', '');
    $heroEmbedUrl   = \App\View\Components\HeroVideoEmbed::embedUrl($heroVideoUrl);
    $orientation    = trim(strtolower($settings->get('hero_video_orientation', 'landscape')));
    $isPortrait     = ($orientation === 'portrait');

    /* YouTube poster thumbnail */
    $ytThumb = '';
    if ($heroEmbedUrl && str_contains($heroEmbedUrl, 'youtube.com/embed/')) {
        preg_match('/embed\/([A-Za-z0-9_\-]{11})/', $heroEmbedUrl, $ytM);
        $ytThumb = $ytM[1] ?? '';
    }

    /* ── Image mosaic vars (fallback when no video) ── */
    $hi1     = $settings->get('hero_image_1');
    $hi2     = $settings->get('hero_image_2');
    $hi3     = $settings->get('hero_image_3');
    $hi4     = $settings->get('hero_image_4');
    $hi5     = $settings->get('hero_image_5');
    $drPhoto = $settings->get('doctor_photo') ?: ($doctor && $doctor->photo ? $doctor->photo : null);
    $img1src = $hi1 ? asset('storage/'.$hi1) : ($drPhoto ? asset('storage/'.$drPhoto) : null);
    $img2src = $hi2 ? asset('storage/'.$hi2) : null;
    $img3src = $hi3 ? asset('storage/'.$hi3) : null;
    $img4src = $hi4 ? asset('storage/'.$hi4) : null;
    $img5src = $hi5 ? asset('storage/'.$hi5) : null;
    $anyUploaded = $img1src || $img2src || $img3src;
@endphp

<section class="hero-section overflow-hidden">
    <div class="w-full py-10 lg:py-14 relative z-10">
        <div class="hero-inner-pad">

        {{-- ══ TWO-COLUMN GRID ══
             .hv-grid handles columns purely in CSS — no Tailwind grid override.
             Portrait: 58/42 split, card fills column height.
             Landscape: 52/48 split, card is 16:9.
        --}}
        <div class="hv-grid {{ $heroEmbedUrl ? ($isPortrait ? 'is-portrait' : 'is-landscape') : 'is-landscape' }}">

            {{-- ════════════════════════════════════════
                 LEFT — copy + inline stats
            ════════════════════════════════════════ --}}
            <div class="hv-copy">

                {{-- Clinic label pill --}}
                <div class="inline-flex items-center gap-2 mb-6 hero-copy-enter delay-1">
                    <span class="w-2 h-2 rounded-full flex-shrink-0" style="background:var(--primary)"></span>
                    <span class="text-xs font-semibold tracking-widest uppercase" style="color:var(--muted)">
                        Board Certified Dermatologist · Lalitpur, Nepal
                    </span>
                </div>

                {{-- Heading — large, Playfair, dark --}}
                <h1 class="mb-6 hero-copy-enter delay-2"
                    style="font-family:'Playfair Display',Georgia,serif;
                           font-size:clamp(2.4rem,5.5vw,4rem);
                           font-weight:700;
                           line-height:1.08;
                           letter-spacing:-.02em;
                           color:var(--dark)">
                    {!! $settings->get('hero_heading','Nurturing Skin,<br><em style="font-style:italic;color:var(--primary)">Carving</em> Confidence') !!}
                </h1>

                {{-- Divider --}}
                <div class="section-divider mb-6 hero-copy-enter delay-2"></div>

                {{-- Description --}}
                <p class="mb-8 leading-relaxed hero-copy-enter delay-3"
                         style="color:var(--muted);font-size:1rem;line-height:1.75">
                    {{ $settings->get('hero_subheading','Your skin deserves more than quick fixes — it deserves genuine care that understands you. At Aakar Dermatology, we help you achieve healthy, radiant skin.') }}
                </p>

                {{-- CTA buttons --}}
                <div class="flex flex-wrap items-center gap-3 hero-copy-enter delay-3">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $settings->get('hero_btn_primary','Book a Consultation') }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('services') }}" class="btn-outline">
                        {{ $settings->get('hero_btn_secondary','Explore Treatments') }}
                    </a>
                </div>

                {{-- ── Inline stats row (like reference — below buttons, above divider) ── --}}
                <div class="hv-inline-stats hero-copy-enter delay-4">
                    <div class="hv-inline-stat">
                        <span class="hv-inline-stat__value"
                              data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_patients','86')) }}">
                            {{ $settings->get('stat_patients','86+') }}
                        </span>
                        <span class="hv-inline-stat__label">Patients Treated</span>
                    </div>

                    <div class="hv-inline-stat__sep" aria-hidden="true"></div>

                    <div class="hv-inline-stat">
                        <span class="hv-inline-stat__value"
                              data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_years','10')) }}">
                            {{ $settings->get('stat_years','10+') }}
                        </span>
                        <span class="hv-inline-stat__label">Years Experience</span>
                    </div>

                    <div class="hv-inline-stat__sep" aria-hidden="true"></div>

                    <div class="hv-inline-stat">
                        <span class="hv-inline-stat__value"
                              data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_procedures','500')) }}">
                            {{ $settings->get('stat_procedures','500+') }}
                        </span>
                        <span class="hv-inline-stat__label">Procedures Done</span>
                    </div>
                </div>
            </div>

            {{-- ════════════════════════════════════════
                 RIGHT — rounded card
                 Shows VIDEO if set, otherwise IMAGE mosaic
            ════════════════════════════════════════ --}}
            <div class="hv-media {{ $heroEmbedUrl ? 'has-video' : '' }} relative flex items-center
                        {{ ($heroEmbedUrl && $isPortrait) ? 'justify-center lg:justify-end lg:items-stretch' : 'justify-center lg:justify-end' }}">

                {{-- Ambient glow behind card --}}
                <div class="hv-card-glow" aria-hidden="true"></div>

                @if($heroEmbedUrl)
                {{-- ── VIDEO CARD ── --}}
                <div class="hv-card {{ $isPortrait ? 'is-portrait' : 'is-landscape' }}"
                     id="hv-player">

                    {{-- Decorative corner dots --}}
                    <span class="hv-deco-tl" aria-hidden="true"></span>
                    <span class="hv-deco-tr" aria-hidden="true"></span>

                    {{-- Poster / thumbnail --}}
                    @if($ytThumb)
                    <img src="https://img.youtube.com/vi/{{ $ytThumb }}/maxresdefault.jpg"
                         onerror="this.src='https://img.youtube.com/vi/{{ $ytThumb }}/hqdefault.jpg'"
                         alt="{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}"
                         class="hv-thumb" loading="lazy">
                    @else
                    <div class="hv-thumb-fallback"></div>
                    @endif

                    {{-- Muted autoplay indicator — tap to unmute --}}
                    <div class="hv-unmute" id="hv-unmute" onclick="heroUnmute()" title="Click to unmute">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/>
                        </svg>
                        <span>Muted</span>
                    </div>

                    {{-- Iframe — autoplays immediately on page load.
                         Browsers require mute=1 for autoplay to work without user gesture. --}}
                    <iframe id="hv-iframe"
                            src="{{ $heroEmbedUrl }}&autoplay=1&mute=1&rel=0&modestbranding=1&playsinline=1&loop=1&playlist={{ $ytThumb }}"
                            class="hv-iframe is-playing"
                            title="{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }} — Introduction"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>

                    {{-- Name badge inside card (reference design) --}}
                    <div class="hv-badge-card">
                        <span class="hv-live-dot" aria-hidden="true"></span>
                        <span class="hv-badge-card__name">
                            {{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}
                        </span>
                        <span class="hv-badge-card__title">
                            {{ $settings->get('doctor_title','Founder & Lead Dermatologist') }}
                        </span>
                    </div>
                </div>

                @elseif($anyUploaded)
                {{-- ── IMAGE MOSAIC (video not set, images uploaded) ── --}}
                <div class="relative hidden lg:block" style="height:520px;width:100%">
                    <div class="grid h-full gap-3" style="grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr 1fr">
                        <div class="rounded-2xl overflow-hidden shadow-xl row-span-3 img-sweep"
                             style="background:linear-gradient(160deg,var(--primary-light),var(--primary))">
                            @if($img1src)
                            <img src="{{ $img1src }}" alt="{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}"
                                 class="w-full h-full object-cover object-top transition-transform duration-700 hover:scale-105">
                            @endif
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-lg img-sweep"
                             style="background:linear-gradient(135deg,var(--accent-light),var(--accent))">
                            @if($img2src)<img src="{{ $img2src }}" alt="Clinic" class="w-full h-full object-cover">@endif
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-lg img-sweep"
                             style="background:linear-gradient(135deg,var(--primary),var(--primary-mid))">
                            @if($img3src)<img src="{{ $img3src }}" alt="Treatment" class="w-full h-full object-cover">@endif
                        </div>
                        <div class="rounded-2xl overflow-hidden shadow-lg img-sweep"
                             style="background:linear-gradient(135deg,var(--accent-dark),var(--accent))">
                            @if($img4src)<img src="{{ $img4src }}" alt="Hair" class="w-full h-full object-cover">@endif
                        </div>
                    </div>
                    {{-- Floating badges on mosaic --}}
                    <div class="absolute -bottom-5 -left-3 bg-white rounded-2xl p-4 shadow-xl z-20 hero-badge-float-left"
                         style="border-left:4px solid var(--primary)">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:var(--primary-light)">
                                <svg class="w-5 h-5" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-lg leading-none" style="color:var(--dark)"
                                     data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_patients','86')) }}">
                                    {{ $settings->get('stat_patients','86+') }}
                                </div>
                                <div class="text-xs mt-0.5" style="color:var(--muted)">Happy Patients</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-3 -right-3 bg-white rounded-2xl p-4 shadow-xl text-center z-20 hero-badge-float-right"
                         style="border-top:4px solid var(--accent);min-width:110px">
                        <div class="font-bold text-2xl leading-none" style="color:var(--accent);font-family:'Playfair Display',serif"
                             data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_years','10')) }}">
                            {{ $settings->get('stat_years','10+') }}
                        </div>
                        <div class="text-xs mt-1" style="color:var(--muted)">Years<br>Experience</div>
                    </div>
                </div>
                {{-- Mobile mosaic card --}}
                <div class="lg:hidden flex justify-center">
                    <div class="relative">
                        <div class="w-72 rounded-3xl overflow-hidden shadow-2xl img-sweep"
                             style="aspect-ratio:3/4;background:linear-gradient(160deg,var(--primary-light),var(--primary))">
                            @if($img1src)
                            <img src="{{ $img1src }}" alt="{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}"
                                 class="w-full h-full object-cover object-top">
                            @endif
                        </div>
                        <div class="absolute -bottom-4 -left-3 bg-white rounded-xl p-3 shadow-xl hero-badge-float-left"
                             style="border-left:4px solid var(--primary)">
                            <div class="font-bold text-sm" style="color:var(--dark)"
                                 data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_patients','86')) }}">
                                {{ $settings->get('stat_patients','86+') }}
                            </div>
                            <div class="text-xs" style="color:var(--muted)">Happy Patients</div>
                        </div>
                    </div>
                </div>

                @else
                {{-- ── PLACEHOLDER CARD (no video, no images) ── --}}
                <div class="hv-card is-portrait"
                     style="max-width:340px;width:100%;margin:0 auto;
                            background:linear-gradient(160deg,var(--primary-light) 0%,var(--primary) 100%)">
                    <div class="absolute inset-0 flex flex-col items-center justify-end pb-20 px-6 text-center z-2">
                        <div class="w-24 h-24 rounded-full mb-4 flex items-center justify-center text-white font-bold text-4xl"
                             style="background:rgba(255,255,255,.18);font-family:'Playfair Display',serif">
                            {{ strtoupper(substr($settings->get('doctor_name','Dr. Rajan Tajhya'), 3, 1)) }}T
                        </div>
                        <p class="text-white font-bold">{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}</p>
                        <p class="text-xs mt-1" style="color:rgba(255,255,255,.65)">Dermatologist · Lalitpur</p>
                        <p class="text-xs mt-3 px-3" style="color:rgba(255,255,255,.45)">Add video URL in Admin → Settings → Hero</p>
                    </div>
                    {{-- Name badge --}}
                    <div class="hv-badge-card">
                        <span class="hv-live-dot" aria-hidden="true"></span>
                        <span class="hv-badge-card__name">{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}</span>
                        <span class="hv-badge-card__title">{{ $settings->get('doctor_title','Founder & Lead Dermatologist') }}</span>
                    </div>
                </div>
                @endif

            </div>{{-- end right column --}}
        </div>{{-- end hv-grid --}}
    </div>

    {{-- Scroll cue --}}
    <a href="#about-section"
       class="absolute bottom-6 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 hero-copy-enter delay-4"
       style="color:var(--primary);opacity:0.65">
        <span class="text-xs tracking-widest uppercase">Scroll</span>
        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </a>
</section>

@push('scripts')
<script>
// Unmute the autoplaying hero video when user clicks the muted indicator
function heroUnmute() {
    var iframe = document.getElementById('hv-iframe');
    var btn    = document.getElementById('hv-unmute');
    if (!iframe) return;

    // Rebuild src without mute=1 — browser will reload the iframe with sound
    var src = iframe.src.replace('&mute=1', '').replace('mute=1&', '');
    iframe.src = src;

    // Hide the muted indicator
    if (btn) {
        btn.style.opacity = '0';
        btn.style.pointerEvents = 'none';
    }
}
</script>
@endpush


{{-- ══════════════════════════════════════════
     STATS STRIP  (always visible)
══════════════════════════════════════════ --}}
<section class="stats-strip py-12 hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center sr-stagger">
            @foreach([
                ['key'=>'stat_years',      'label'=>'Years Experience'],
                ['key'=>'stat_patients',   'label'=>'Happy Patients'],
                ['key'=>'stat_procedures', 'label'=>'Procedures Done'],
                ['key'=>'stat_treatments', 'label'=>'Treatments Offered'],
            ] as $stat)
            <div>
                <div class="stat-number"
                     data-count="{{ preg_replace('/[^0-9]/','',$settings->get($stat['key'],'0')) }}">
                    {{ $settings->get($stat['key'],'0+') }}
                </div>
                <div class="text-sm mt-1" style="color:rgba(255,255,255,0.65)">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════
     TESTIMONIAL MARQUEE  — infinite auto-scroll
     Second section after hero, like brand logos.
     Cards flow left continuously, pause on hover.
══════════════════════════════════════════ --}}
@if($testimonials->count())
<section class="tq-section py-14 sr">
    {{-- Section label centred --}}
    <div class="text-center mb-8">
        <span class="section-label" style="justify-content:center">What Patients Say</span>
        <h2 class="section-title">Happiest Clients</h2>
        <div class="section-divider center"></div>
    </div>

    {{-- Marquee wrapper — clips overflow, gradient fade edges --}}
    <div class="tq-outer" aria-label="Patient testimonials">
        {{-- The track: two identical sets of cards side by side.
             CSS animates translateX so when set-1 is scrolled fully
             off-screen, set-2 is already in place — seamless loop. --}}
        <div class="tq-track" id="tq-track">

            {{-- Set 1 --}}
            @foreach($testimonials as $t)
            <article class="tq-card" aria-label="Review by {{ $t->patient_name }}">
                {{-- Stars --}}
                <div class="tq-stars">{{ str_repeat('★', min($t->rating, 5)) }}</div>
                {{-- Review text --}}
                <p class="tq-text">"{{ Str::limit($t->review, 140) }}"</p>
                {{-- Footer: avatar + name + source badge --}}
                <div class="tq-footer">
                    <div class="tq-avatar">{{ strtoupper(substr($t->patient_name, 0, 1)) }}</div>
                    <div class="tq-meta">
                        <span class="tq-name">{{ $t->patient_name }}</span>
                        @if($t->treatment)
                        <span class="tq-treatment">{{ $t->treatment }}</span>
                        @endif
                    </div>
                    @if($t->source === 'google')
                    <div class="tq-source ml-auto flex-shrink-0">
                        {{-- Google G --}}
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="Google review">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                    </div>
                    @endif
                </div>
            </article>
            @endforeach

            {{-- Set 2 — exact duplicate, no aria so screen readers skip it --}}
            @foreach($testimonials as $t)
            <article class="tq-card" aria-hidden="true">
                <div class="tq-stars">{{ str_repeat('★', min($t->rating, 5)) }}</div>
                <p class="tq-text">"{{ Str::limit($t->review, 140) }}"</p>
                <div class="tq-footer">
                    <div class="tq-avatar">{{ strtoupper(substr($t->patient_name, 0, 1)) }}</div>
                    <div class="tq-meta">
                        <span class="tq-name">{{ $t->patient_name }}</span>
                        @if($t->treatment)
                        <span class="tq-treatment">{{ $t->treatment }}</span>
                        @endif
                    </div>
                    @if($t->source === 'google')
                    <div class="tq-source ml-auto flex-shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                    </div>
                    @endif
                </div>
            </article>
            @endforeach

        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════
     WELCOME / ABOUT
     • Images: sr-left (slide from left)
     • Copy: sr-right (slide from right)
     • Image cells get img-sweep shine on hover
══════════════════════════════════════════ --}}
<section id="about-section" class="py-20 lg:py-28" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Image collage --}}
            @php
                $clinicImg = $settings->get('about_clinic_image');
                $clinicSrc = $clinicImg ? asset('storage/'.$clinicImg) : null;
                $hi2src    = $settings->get('hero_image_2') ? asset('storage/'.$settings->get('hero_image_2')) : null;
                $hi3src    = $settings->get('hero_image_3') ? asset('storage/'.$settings->get('hero_image_3')) : null;
            @endphp
            <div class="relative sr-left">
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-2xl overflow-hidden shadow-lg img-sweep"
                         style="height:280px;background:linear-gradient(135deg,var(--primary),var(--primary-mid))">
                        @if($clinicSrc)
                        <img src="{{ $clinicSrc }}" alt="Aakar Dermatology Clinic"
                             class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        @elseif($hi2src)
                        <img src="{{ $hi2src }}" alt="Aakar Dermatology"
                             class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-center gap-3 px-4 text-center">
                            <svg class="w-12 h-12" style="color:rgba(255,255,255,.5)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <p class="text-xs" style="color:rgba(255,255,255,.6)">Upload in<br>Settings → About Clinic Image</p>
                        </div>
                        @endif
                    </div>

                    <div class="rounded-2xl overflow-hidden shadow-lg mt-8 img-sweep"
                         style="height:280px;background:linear-gradient(135deg,var(--accent-dark),var(--accent))">
                        @if($hi3src)
                        <img src="{{ $hi3src }}" alt="Dermatology Treatment"
                             class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-center gap-3 px-4 text-center">
                            <svg class="w-12 h-12" style="color:rgba(255,255,255,.5)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <p class="text-xs" style="color:rgba(255,255,255,.6)">Upload in<br>Settings → Hero Image 3</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Floating trust badge --}}
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white rounded-2xl px-5 py-3 shadow-xl
                            flex items-center gap-3 z-10 sr-pop"
                     style="white-space:nowrap">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background:var(--primary-light)">
                        <svg class="w-5 h-5" style="color:var(--accent)" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm" style="color:var(--dark)">Trusted Dermatology</div>
                        <div class="stars text-xs">★★★★★ Google Rated</div>
                    </div>
                </div>
            </div>

            {{-- Copy --}}
            <div class="sr-right">
                <span class="section-label">Welcome to Aakar Dermatology</span>
                <h2 class="section-title">Comprehensive Skin, Hair &amp; Laser Care</h2>
                <div class="section-divider"></div>
                <p class="mb-6 leading-relaxed" style="color:var(--muted)">
                    At Aakar Dermatology, we're dedicated to helping you achieve healthy, radiant skin that boosts your confidence every single day. Led by our expert team, we create a welcoming space where your concerns are heard and personalized solutions help you feel your best.
                </p>

                {{-- Check-list — staggered --}}
                <div class="space-y-3 mb-8 sr-stagger">
                    @foreach(['LASER & Dermato-surgery Specialist','Personalized Treatment Plans','State-of-the-Art Technology','10+ Years of Expertise'] as $point)
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0"
                             style="background:var(--primary)">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium" style="color:var(--text)">{{ $point }}</span>
                    </div>
                    @endforeach
                </div>

                <a href="{{ route('about') }}" class="btn-primary">
                    Learn More About Us
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════
     MEET THE DOCTOR
     • Stats boxes: tilt-card
     • Photo: sr-right + img-sweep
     • Specialization badge: sr-pop
══════════════════════════════════════════ --}}
@if($doctor)
<section class="py-20 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Copy --}}
            <div class="sr-left">
                <span class="section-label">Our Expert</span>
                <h2 class="section-title">Meet {{ $doctor->name }}</h2>
                <div class="section-divider"></div>
                <p class="font-semibold mb-1" style="color:var(--accent)">{{ $doctor->designation }}</p>
                <p class="text-sm mb-4" style="color:var(--muted)">{{ $doctor->qualification }}</p>
                <p class="leading-relaxed mb-6" style="color:var(--muted)">{{ $doctor->bio }}</p>

                <div class="grid grid-cols-2 gap-4 mb-8 sr-stagger">
                    <div class="rounded-2xl p-4 text-center tilt-card"
                         style="background:var(--primary-light);border:1px solid var(--border)">
                        <div class="text-3xl font-bold" style="color:var(--primary);font-family:'Playfair Display',serif"
                             data-count="{{ $doctor->years_experience }}">0+</div>
                        <div class="text-sm" style="color:var(--muted)">Years Experience</div>
                    </div>
                    <div class="rounded-2xl p-4 text-center tilt-card"
                         style="background:var(--accent-light);border:1px solid var(--border)">
                        <div class="text-3xl font-bold" style="color:var(--accent);font-family:'Playfair Display',serif"
                             data-count="{{ $doctor->total_patients }}">0+</div>
                        <div class="text-sm" style="color:var(--muted)">Happy Patients</div>
                    </div>
                </div>

                <a href="{{ route('about') }}" class="btn-outline">View Full Profile</a>
            </div>

            {{-- Photo --}}
            <div class="sr-right flex justify-center">
                <div class="relative doctor-photo-wrap">
                    @php
                        $drImgSrc = $settings->get('doctor_photo')
                            ? asset('storage/'.$settings->get('doctor_photo'))
                            : ($settings->get('hero_image_1') ? asset('storage/'.$settings->get('hero_image_1')) : ($doctor && $doctor->photo ? $doctor->photo_url : null));
                    @endphp
                    <div class="w-full h-80 rounded-3xl overflow-hidden shadow-2xl img-sweep"
                         style="background:linear-gradient(160deg,var(--primary-light),var(--primary))">
                        @if($drImgSrc)
                        <img src="{{ $drImgSrc }}" alt="{{ $doctor->name }}"
                             class="w-full h-full object-cover object-top transition-transform duration-700 hover:scale-105">
                        @else
                        <div class="w-full h-full flex items-end justify-center pb-8">
                            <div class="text-center">
                                <div class="font-bold text-white mb-2"
                                     style="font-size:4rem;font-family:'Playfair Display',serif">
                                    {{ strtoupper(substr($doctor->name,3,1)) }}T
                                </div>
                                <div class="text-white text-sm opacity-75">{{ $doctor->name }}</div>
                                <div class="text-xs mt-1" style="color:rgba(255,255,255,.5)">Upload photo in Admin → Settings</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-2xl p-4 shadow-xl sr-pop"
                         style="border-right:4px solid var(--accent)">
                        <div class="text-xs font-semibold" style="color:var(--dark)">Specialization</div>
                        <div class="text-sm font-bold" style="color:var(--primary)">{{ $doctor->specialization }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════
     WHY CHOOSE US
     • Section header: sr (fade-up)
     • Cards: sr-stagger grid → 90 ms apart
     • wcu-icon spins on hover (CSS only)
══════════════════════════════════════════ --}}
@if($whyChooseUs->count())
<section class="py-20 lg:py-24" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 sr">
            <span class="section-label">Why Aakar</span>
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="section-divider center"></div>
            <p class="max-w-2xl mx-auto" style="color:var(--muted)">
                Dr. Rajan brings specialized expertise in LASER and Dermato-surgery, ensuring you receive exceptional dermatological care in a comfortable, welcoming setting.
            </p>
        </div>

        @php
        $wcuIcons = [
            'personalized' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            'technology'   => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'accessible'   => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
            'results'      => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
        ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sr-stagger">
            @foreach($whyChooseUs as $item)
            <div class="wcu-card">
                <div class="wcu-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="{{ $wcuIcons[$item->icon] ?? $wcuIcons['results'] }}"/>
                    </svg>
                </div>
                <h3 class="font-bold text-base mb-2" style="color:var(--dark)">{{ $item->title }}</h3>
                <p class="text-sm leading-relaxed" style="color:var(--muted)">{{ $item->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════
     OUR SERVICES
     • Header: sr
     • Cards: sr-stagger + tilt-card + img-sweep on image
══════════════════════════════════════════ --}}
@if($featuredServices->count())
<section class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 sr">
            <span class="section-label">What We Offer</span>
            <h2 class="section-title">Our Services</h2>
            <div class="section-divider center"></div>
            <p class="max-w-2xl mx-auto" style="color:var(--muted)">
                Transform your skin with our complete range of medical and aesthetic dermatology services, personalized to help you look and feel your best.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 sr-stagger">
            @foreach($featuredServices as $service)
            <a href="{{ route('services.show', $service) }}"
               class="service-card tilt-card block" style="text-decoration:none">
                @if($service->image)
                <div class="mb-4 rounded-xl overflow-hidden img-sweep service-img" style="height:160px">
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}"
                         class="w-full h-full object-cover service-img transition-transform duration-500">
                </div>
                @else
                <div class="mb-4 rounded-xl flex items-center justify-center"
                     style="height:100px;background:linear-gradient(135deg,var(--primary-light),var(--accent-light))">
                    <svg class="w-12 h-12" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                @endif
                <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded mb-2"
                      style="background:var(--primary-light);color:var(--primary)">
                    {{ ucfirst($service->category) }}
                </span>
                <h3 class="font-bold text-base mb-2" style="color:var(--dark)">{{ $service->title }}</h3>
                <p class="text-sm leading-relaxed mb-3" style="color:var(--muted)">{{ Str::limit($service->short_description, 100) }}</p>
                <div class="flex items-center gap-1 text-sm font-semibold" style="color:var(--primary)">
                    Learn More
                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center sr">
            <a href="{{ route('services') }}" class="btn-outline">View All Services</a>
        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════
     BEFORE / AFTER
     • Header: sr
     • Cards: sr-stagger + img-sweep
══════════════════════════════════════════ --}}
@if($beforeAfters->count())
<section class="py-20 lg:py-24" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 sr">
            <span class="section-label">Transformations</span>
            <h2 class="section-title">Real Results From Real Patients</h2>
            <div class="section-divider center"></div>
            <p class="max-w-2xl mx-auto" style="color:var(--muted)">
                From acne relief to anti-aging rejuvenation, our patients share the visible, lasting results that have helped them love their skin again.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sr-stagger">
            @foreach($beforeAfters as $ba)
            <div class="ba-card">
                <div class="grid grid-cols-2" style="height:220px">
                    <div class="relative overflow-hidden img-sweep">
                        <img src="{{ $ba->before_image_url }}" alt="Before"
                             class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        <span class="ba-label absolute top-2 left-2">Before</span>
                    </div>
                    <div class="relative overflow-hidden img-sweep">
                        <img src="{{ $ba->after_image_url }}" alt="After"
                             class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        <span class="ba-label after absolute top-2 left-2">After</span>
                    </div>
                </div>
                <div class="p-4 bg-white">
                    <h4 class="font-bold text-sm mb-0.5" style="color:var(--dark)">{{ $ba->title }}</h4>
                    <p class="text-xs" style="color:var(--accent)">{{ $ba->treatment }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif




{{-- ══════════════════════════════════════════
     BLOGS
     • Header row: sr
     • Cards: sr-stagger + img-sweep on thumbnail
══════════════════════════════════════════ --}}
@if($featuredBlogs->count())
<section class="py-20 lg:py-24" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 sr">
            <div>
                <span class="section-label">Knowledge Hub</span>
                <h2 class="section-title">Read Our Blogs</h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('blog') }}" class="btn-outline mt-4 sm:mt-0">View All Posts</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sr-stagger">
            @foreach($featuredBlogs as $post)
            <a href="{{ route('blog.show', $post) }}"
               class="blog-card block" style="text-decoration:none">
                <div class="overflow-hidden img-sweep" style="height:200px;background:linear-gradient(135deg,var(--primary-light),var(--primary))">
                    @if($post->thumbnail)
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                         class="blog-img w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="blog-category-badge">{{ $post->category }}</span>
                        <span class="text-xs" style="color:var(--muted)">{{ $post->reading_time }}</span>
                    </div>
                    <h3 class="font-bold text-base mb-2" style="color:var(--dark)">{{ $post->title }}</h3>
                    <p class="text-sm leading-relaxed mb-3" style="color:var(--muted)">{{ Str::limit($post->excerpt, 100) }}</p>
                    <div class="flex items-center justify-between text-xs" style="color:var(--muted)">
                        <span>{{ $post->author }}</span>
                        <span>{{ $post->published_at?->format('M d, Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════
     CTA BANNER
     • Whole block: sr (fade-up)
     • Buttons get shimmer on hover (CSS ::before)
══════════════════════════════════════════ --}}
<section class="py-20 overflow-hidden"
         style="background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 100%)">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center sr">
        <span class="section-label" style="color:var(--accent)">Start Today</span>
        <h2 class="text-4xl lg:text-5xl font-bold mb-6"
            style="color:#fff;font-family:'Playfair Display',serif;line-height:1.15;letter-spacing:-0.02em">
            {{ $settings->get('cta_heading','Begin Your Journey with Aakar') }}
        </h2>
        <p class="text-lg mb-10 mx-auto"
           style="color:rgba(255,255,255,0.88);max-width:600px;line-height:1.7">
            {{ $settings->get('cta_subheading','Whether you\'re dealing with a skin concern or exploring aesthetic enhancements, we are here to help.') }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('contact') }}" class="btn-accent">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Book Appointment
            </a>
            @if($settings->get('contact_phone'))
            <a href="tel:{{ $settings->get('contact_phone') }}" class="btn-outline-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Call Us Now
            </a>
            @endif
        </div>
    </div>
</section>

@endsection
