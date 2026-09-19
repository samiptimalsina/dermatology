@extends('layouts.app')

@section('content')

{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
<section class="hero-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Left copy --}}
            <div class="fade-in-up">
                <span class="section-label">Aakar Dermatology · Lalitpur, Nepal</span>
                <h1 class="text-5xl lg:text-6xl font-bold mb-6" style="color:var(--dark);font-family:'Playfair Display',serif;line-height:1.12">
                    {!! $settings->get('hero_heading','Nurturing Skin,<br>Carving Confidence') !!}
                </h1>
                <div class="section-divider"></div>
                <p class="text-lg mb-8 leading-relaxed" style="color:var(--muted);max-width:520px">
                    {{ $settings->get('hero_subheading','Your skin deserves more than quick fixes—it deserves genuine care that understands you.') }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $settings->get('hero_btn_primary','Book Appointment') }}
                    </a>
                    <a href="{{ route('services') }}" class="btn-outline">
                        {{ $settings->get('hero_btn_secondary','Our Services') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                {{-- Trust row --}}
                <div class="flex items-center gap-5 mt-10">
                    <div class="flex -space-x-2">
                        @foreach(['var(--primary)','var(--accent)','var(--primary-dark)','var(--accent-dark)'] as $c)
                        <div class="w-9 h-9 rounded-full border-2 border-white flex items-center justify-center text-white text-xs font-bold"
                             style="background:{{ $c }}">★</div>
                        @endforeach
                    </div>
                    <div class="text-sm" style="color:var(--muted)">
                        <strong style="color:var(--dark)">{{ $settings->get('stat_patients','86+') }} patients</strong> trust us
                        <div class="stars text-xs">★★★★★</div>
                    </div>
                </div>
            </div>

            {{-- ── RIGHT SIDE — 5-image mosaic (matches aakardermatology.com layout) ── --}}
            {{--
                Layout (desktop):
                ┌────────────┬──────────┐
                │            │  img 2   │
                │   img 1    ├──────────┤
                │ (portrait) │  img 3   │
                │            ├──────────┤
                ├─────┬──────┤  img 4   │
                │img5 │            └─────────────────────┘
                └─────┘
            --}}
            @php
                $hi1 = $settings->get('hero_image_1');
                $hi2 = $settings->get('hero_image_2');
                $hi3 = $settings->get('hero_image_3');
                $hi4 = $settings->get('hero_image_4');
                $hi5 = $settings->get('hero_image_5');
                $drPhoto = $settings->get('doctor_photo') ?: ($doctor && $doctor->photo ? $doctor->photo : null);
                // Use doctor photo as img1 fallback
                $img1src = $hi1 ? asset('storage/'.$hi1) : ($drPhoto ? asset('storage/'.$drPhoto) : null);
                $img2src = $hi2 ? asset('storage/'.$hi2) : null;
                $img3src = $hi3 ? asset('storage/'.$hi3) : null;
                $img4src = $hi4 ? asset('storage/'.$hi4) : null;
                $img5src = $hi5 ? asset('storage/'.$hi5) : null;
                $anyUploaded = $img1src || $img2src || $img3src;
            @endphp

            <div class="relative fade-in-up delay-200 hidden lg:block" style="height:520px">
                @if($anyUploaded)
                {{-- Real mosaic grid --}}
                <div class="grid h-full gap-3" style="grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr 1fr">

                    {{-- Image 1 — large portrait spans all 3 rows, left column --}}
                    <div class="rounded-2xl overflow-hidden shadow-xl row-span-3"
                         style="background:linear-gradient(160deg,var(--primary-light),var(--primary))">
                        @if($img1src)
                        <img src="{{ $img1src }}" alt="{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}"
                             class="w-full h-full object-cover object-top">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-end pb-10 px-6 text-center">
                            <div class="w-20 h-20 rounded-full mb-4 flex items-center justify-center"
                                 style="background:rgba(255,255,255,.2)">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <p class="text-white font-bold text-base">{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}</p>
                            <p class="text-xs mt-1" style="color:rgba(255,255,255,.7)">{{ $settings->get('doctor_title','Founder & Lead Dermatologist') }}</p>
                        </div>
                        @endif
                    </div>

                    {{-- Image 2 — top right --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg"
                         style="background:linear-gradient(135deg,var(--accent-light),var(--accent))">
                        @if($img2src)
                        <img src="{{ $img2src }}" alt="Aakar Dermatology Clinic"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-10 h-10" style="color:rgba(255,255,255,.5)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        @endif
                    </div>

                    {{-- Image 3 — middle right --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg"
                         style="background:linear-gradient(135deg,var(--primary),var(--primary-mid))">
                        @if($img3src)
                        <img src="{{ $img3src }}" alt="Skin Treatment"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-10 h-10" style="color:rgba(255,255,255,.5)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        @endif
                    </div>

                    {{-- Image 4 — bottom right --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg"
                         style="background:linear-gradient(135deg,var(--accent-dark),var(--accent))">
                        @if($img4src)
                        <img src="{{ $img4src }}" alt="Hair Treatment"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-10 h-10" style="color:rgba(255,255,255,.5)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                </div>

                @else
                {{-- Fallback when NO images uploaded — styled placeholder mosaic with brand colors --}}
                <div class="grid h-full gap-3" style="grid-template-columns:1fr 1fr;grid-template-rows:1fr 1fr 1fr">
                    <div class="rounded-2xl row-span-3 shadow-xl flex flex-col items-center justify-end pb-10 px-6 text-center"
                         style="background:linear-gradient(160deg,var(--primary-light) 0%,var(--primary) 100%)">
                        <div class="w-24 h-24 rounded-full mb-4 flex items-center justify-center text-white font-bold text-4xl"
                             style="background:rgba(255,255,255,.18);font-family:'Playfair Display',serif">
                            {{ strtoupper(substr($settings->get('doctor_name','Dr. Rajan Tajhya'), 3, 1)) }}T
                        </div>
                        <p class="text-white font-bold">{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}</p>
                        <p class="text-xs mt-1" style="color:rgba(255,255,255,.7)">Dermatologist · Lalitpur</p>
                        <p class="text-xs mt-3 px-2" style="color:rgba(255,255,255,.5)">
                            Upload doctor photo in<br>Admin → Settings → Hero Image 1
                        </p>
                    </div>
                    @foreach([
                        ['label'=>'Skin Treatment',  'color'=>'var(--accent-light),var(--accent)',     'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                        ['label'=>'Hair Transplant', 'color'=>'var(--primary),var(--primary-mid)',      'icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                        ['label'=>'Laser Treatment', 'color'=>'var(--accent-dark),var(--accent)',       'icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                    ] as $ph)
                    <div class="rounded-2xl shadow-lg flex flex-col items-center justify-center gap-2"
                         style="background:linear-gradient(135deg,{{ $ph['color'] }})">
                        <svg class="w-8 h-8" style="color:rgba(255,255,255,.65)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $ph['icon'] }}"/>
                        </svg>
                        <span class="text-xs font-semibold" style="color:rgba(255,255,255,.8)">{{ $ph['label'] }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Floating stats — always shown over the mosaic --}}
                <div class="absolute -bottom-5 -left-3 bg-white rounded-2xl p-4 shadow-xl z-20"
                     style="border-left:4px solid var(--primary)">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background:var(--primary-light)">
                            <svg class="w-5 h-5" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
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

                <div class="absolute -top-3 -right-3 bg-white rounded-2xl p-4 shadow-xl text-center z-20"
                     style="border-top:4px solid var(--accent);min-width:110px">
                    <div class="font-bold text-2xl leading-none" style="color:var(--accent);font-family:'Playfair Display',serif"
                         data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_years','10')) }}">
                        {{ $settings->get('stat_years','10+') }}
                    </div>
                    <div class="text-xs mt-1" style="color:var(--muted)">Years<br>Experience</div>
                </div>

                {{-- Image 5 — small square badge bottom-right, only when uploaded --}}
                @if($img5src)
                <div class="absolute bottom-16 right-0 w-20 h-20 rounded-xl overflow-hidden shadow-xl border-2 border-white z-20">
                    <img src="{{ $img5src }}" alt="Laser Equipment" class="w-full h-full object-cover">
                </div>
                @endif
            </div>

            {{-- Mobile: single doctor card --}}
            <div class="lg:hidden flex justify-center fade-in-up delay-200">
                <div class="relative">
                    <div class="w-72 rounded-3xl overflow-hidden shadow-2xl"
                         style="aspect-ratio:3/4;background:linear-gradient(160deg,var(--primary-light),var(--primary))">
                        @if($img1src)
                        <img src="{{ $img1src }}" alt="{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}"
                             class="w-full h-full object-cover object-top">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-end pb-8 text-center">
                            <p class="text-white font-bold">{{ $settings->get('doctor_name','Dr. Rajan Tajhya') }}</p>
                            <p class="text-xs mt-1" style="color:var(--accent)">Dermatologist · Lalitpur</p>
                        </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-4 -left-3 bg-white rounded-xl p-3 shadow-xl"
                         style="border-left:4px solid var(--primary)">
                        <div class="font-bold text-sm" style="color:var(--dark)"
                             data-count="{{ preg_replace('/[^0-9]/','',$settings->get('stat_patients','86')) }}">
                            {{ $settings->get('stat_patients','86+') }}
                        </div>
                        <div class="text-xs" style="color:var(--muted)">Happy Patients</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#about-section"
       class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1"
       style="color:var(--primary);opacity:0.65">
        <span class="text-xs tracking-widest uppercase">Scroll</span>
        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </a>
</section>

{{-- ══════════════════════════════════════════
     STATS STRIP
══════════════════════════════════════════ --}}
<section class="stats-strip py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @foreach([
                ['key'=>'stat_years',     'label'=>'Years Experience'],
                ['key'=>'stat_patients',  'label'=>'Happy Patients'],
                ['key'=>'stat_procedures','label'=>'Procedures Done'],
                ['key'=>'stat_treatments','label'=>'Treatments Offered'],
            ] as $stat)
            <div class="reveal">
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
     WELCOME / ABOUT
══════════════════════════════════════════ --}}
<section id="about-section" class="py-20 lg:py-28" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Image collage — pulls from admin Settings → About group --}}
            @php
                $clinicImg  = $settings->get('about_clinic_image');
                $clinicSrc  = $clinicImg ? asset('storage/'.$clinicImg) : null;
                $hi2src     = $settings->get('hero_image_2') ? asset('storage/'.$settings->get('hero_image_2')) : null;
                $hi3src     = $settings->get('hero_image_3') ? asset('storage/'.$settings->get('hero_image_3')) : null;
            @endphp
            <div class="relative reveal">
                <div class="grid grid-cols-2 gap-4">
                    {{-- Left column — large image (800×600 clinic photo) --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg"
                         style="height:280px;background:linear-gradient(135deg,var(--primary),var(--primary-mid))">
                        @if($clinicSrc)
                        <img src="{{ $clinicSrc }}" alt="Aakar Dermatology Clinic"
                             class="w-full h-full object-cover">
                        @elseif($hi2src)
                        <img src="{{ $hi2src }}" alt="Aakar Dermatology"
                             class="w-full h-full object-cover">
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

                    {{-- Right column — second image offset down (600×400 treatment photo) --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg mt-8"
                         style="height:280px;background:linear-gradient(135deg,var(--accent-dark),var(--accent))">
                        @if($hi3src)
                        <img src="{{ $hi3src }}" alt="Dermatology Treatment"
                             class="w-full h-full object-cover">
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
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-white rounded-2xl px-5 py-3 shadow-xl flex items-center gap-3 z-10"
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
            <div class="reveal delay-200">
                <span class="section-label">Welcome to Aakar Dermatology</span>
                <h2 class="section-title">Comprehensive Skin, Hair &amp; Laser Care</h2>
                <div class="section-divider"></div>
                <p class="mb-6 leading-relaxed" style="color:var(--muted)">
                    At Aakar Dermatology, we're dedicated to helping you achieve healthy, radiant skin that boosts your confidence every single day. Led by our expert team, we create a welcoming space where your concerns are heard and personalized solutions help you feel your best.
                </p>
                <div class="space-y-3 mb-8">
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
══════════════════════════════════════════ --}}
@if($doctor)
<section class="py-20 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <span class="section-label">Our Expert</span>
                <h2 class="section-title">Meet {{ $doctor->name }}</h2>
                <div class="section-divider"></div>
                <p class="font-semibold mb-1" style="color:var(--accent)">{{ $doctor->designation }}</p>
                <p class="text-sm mb-4" style="color:var(--muted)">{{ $doctor->qualification }}</p>
                <p class="leading-relaxed mb-6" style="color:var(--muted)">{{ $doctor->bio }}</p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="rounded-2xl p-4 text-center" style="background:var(--primary-light);border:1px solid var(--primary);border-opacity:.2">
                        <div class="text-3xl font-bold" style="color:var(--primary);font-family:'Playfair Display',serif"
                             data-count="{{ $doctor->years_experience }}">0+</div>
                        <div class="text-sm" style="color:var(--muted)">Years Experience</div>
                    </div>
                    <div class="rounded-2xl p-4 text-center" style="background:var(--accent-light);border:1px solid var(--accent);border-opacity:.2">
                        <div class="text-3xl font-bold" style="color:var(--accent);font-family:'Playfair Display',serif"
                             data-count="{{ $doctor->total_patients }}">0+</div>
                        <div class="text-sm" style="color:var(--muted)">Happy Patients</div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn-outline">View Full Profile</a>
            </div>

            <div class="reveal delay-300 flex justify-center">
                <div class="relative">
                    @php
                        $drImgSrc = $settings->get('doctor_photo')
                            ? asset('storage/'.$settings->get('doctor_photo'))
                            : ($settings->get('hero_image_1') ? asset('storage/'.$settings->get('hero_image_1')) : ($doctor && $doctor->photo ? $doctor->photo_url : null));
                    @endphp
                    <div class="w-72 h-80 rounded-3xl overflow-hidden shadow-2xl"
                         style="background:linear-gradient(160deg,var(--primary-light),var(--primary))">
                        @if($drImgSrc)
                        <img src="{{ $drImgSrc }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover object-top">
                        @else
                        <div class="w-full h-full flex items-end justify-center pb-8">
                            <div class="text-center">
                                <div class="font-bold text-white mb-2" style="font-size:4rem;font-family:'Playfair Display',serif">
                                    {{ strtoupper(substr($doctor->name,3,1)) }}T
                                </div>
                                <div class="text-white text-sm opacity-75">{{ $doctor->name }}</div>
                                <div class="text-xs mt-1" style="color:rgba(255,255,255,.5)">Upload photo in Admin → Settings</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-white rounded-2xl p-4 shadow-xl"
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
══════════════════════════════════════════ --}}
@if($whyChooseUs->count())
<section class="py-20 lg:py-24" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="section-label">Why Aakar</span>
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="section-divider center"></div>
            <p class="max-w-2xl mx-auto" style="color:var(--muted)">
                Dr. Rajan brings specialized expertise in LASER and Dermato-surgery, ensuring you receive exceptional dermatological care in a comfortable, welcoming setting.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
            $wcuIcons = [
                'personalized' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'technology'   => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'accessible'   => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                'results'      => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
            ];
            @endphp
            @foreach($whyChooseUs as $i => $item)
            <div class="wcu-card reveal delay-{{ ($i % 4) * 100 }}">
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
══════════════════════════════════════════ --}}
@if($featuredServices->count())
<section class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="section-label">What We Offer</span>
            <h2 class="section-title">Our Services</h2>
            <div class="section-divider center"></div>
            <p class="max-w-2xl mx-auto" style="color:var(--muted)">
                Transform your skin with our complete range of medical and aesthetic dermatology services, personalized to help you look and feel your best.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            @foreach($featuredServices as $i => $service)
            <a href="{{ route('services.show', $service) }}"
               class="service-card block reveal delay-{{ ($i % 4) * 100 }}" style="text-decoration:none">
                @if($service->image)
                <div class="mb-4 rounded-xl overflow-hidden" style="height:160px">
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}"
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
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
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('services') }}" class="btn-outline">View All Services</a>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════
     BEFORE / AFTER
══════════════════════════════════════════ --}}
@if($beforeAfters->count())
<section class="py-20 lg:py-24" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="section-label">Transformations</span>
            <h2 class="section-title">Real Results From Real Patients</h2>
            <div class="section-divider center"></div>
            <p class="max-w-2xl mx-auto" style="color:var(--muted)">
                From acne relief to anti-aging rejuvenation, our patients share the visible, lasting results that have helped them love their skin again.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($beforeAfters as $i => $ba)
            <div class="ba-card reveal delay-{{ ($i % 3) * 100 }}">
                <div class="grid grid-cols-2" style="height:220px">
                    <div class="relative overflow-hidden">
                        <img src="{{ $ba->before_image_url }}" alt="Before" class="w-full h-full object-cover">
                        <span class="ba-label absolute top-2 left-2">Before</span>
                    </div>
                    <div class="relative overflow-hidden">
                        <img src="{{ $ba->after_image_url }}" alt="After" class="w-full h-full object-cover">
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
     TESTIMONIALS
══════════════════════════════════════════ --}}
@if($testimonials->count())
<section class="py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 reveal">
            <div>
                <span class="section-label">What Patients Say</span>
                <h2 class="section-title">Our Patient's Voice</h2>
                <div class="section-divider"></div>
            </div>
            <div class="flex gap-3 mt-4 sm:mt-0">
                <button id="prev-btn" aria-label="Previous"
                        class="w-10 h-10 rounded-full border-2 flex items-center justify-center transition-all"
                        style="border-color:var(--primary);color:var(--primary)"
                        onmouseover="this.style.background='var(--primary)';this.style.color='#fff'"
                        onmouseout="this.style.background='';this.style.color='var(--primary)'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="next-btn" aria-label="Next"
                        class="w-10 h-10 rounded-full flex items-center justify-center transition-all text-white"
                        style="background:var(--primary)">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="overflow-hidden">
            <div id="testimonial-track" class="flex gap-6 transition-transform duration-500">
                @foreach($testimonials as $t)
                <div class="testimonial-card flex-shrink-0" style="width:calc(33.333% - 1rem);min-width:280px">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0"
                             style="background:linear-gradient(135deg,var(--primary),var(--accent))">
                            {{ strtoupper(substr($t->patient_name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-bold text-sm" style="color:var(--dark)">{{ $t->patient_name }}</div>
                            @if($t->treatment)
                            <div class="text-xs" style="color:var(--primary)">{{ $t->treatment }}</div>
                            @endif
                        </div>
                        @if($t->source === 'google')
                        <div class="ml-auto">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" style="color:#4285F4">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="stars text-sm mb-3">{{ str_repeat('★', $t->rating) }}</div>
                    <p class="text-sm leading-relaxed" style="color:var(--muted)">"{{ Str::limit($t->review, 180) }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════
     VIDEO TUTORIALS
══════════════════════════════════════════ --}}
@if(false)
<section class="py-20 lg:py-24" style="background:var(--bg)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-10 reveal">
            <div>
                <span class="section-label">Tutorials &amp; Training</span>
                <h2 class="section-title">Learn About Your Skin</h2>
                <div class="section-divider"></div>
                <p class="max-w-2xl" style="color:var(--muted)">
                    Clear, practical guidance from Aakar Dermatology to help you make informed decisions about your skin, hair, and treatments.
                </p>
            </div>
            <a href="#video-library" class="btn-outline mt-4 sm:mt-0">Browse Tutorials</a>
        </div>

        @if($featuredVideos->count())
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-14">
            @foreach($featuredVideos as $i => $video)
            <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="video-feature-card reveal delay-{{ $i * 100 }}" style="text-decoration:none">
                <div class="relative overflow-hidden" style="height:250px;background:linear-gradient(135deg,var(--primary-dark),var(--primary))">
                    <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-full h-full object-cover opacity-50">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="video-play-button" aria-hidden="true">
                            <svg class="w-7 h-7 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </span>
                    </div>
                    <span class="absolute top-4 left-4 blog-category-badge">Featured</span>
                    @if($video->duration)<span class="video-duration absolute bottom-4 right-4">{{ $video->duration }}</span>@endif
                </div>
                <div class="p-5 bg-white">
                    <span class="text-xs font-semibold uppercase tracking-wider" style="color:var(--accent)">{{ $video->category }}</span>
                    <h3 class="font-bold text-lg mt-1 mb-2" style="color:var(--dark)">{{ $video->title }}</h3>
                    <p class="text-sm" style="color:var(--muted)">{{ $video->description }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif

        <div id="video-library" class="space-y-12">
            @foreach($videos as $category => $categoryVideos)
            <div class="reveal">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold" style="color:var(--dark)">{{ $category }}</h3>
                    <span class="text-xs font-semibold" style="color:var(--muted)">{{ $categoryVideos->count() }} {{ Str::plural('tutorial', $categoryVideos->count()) }}</span>
                </div>
                <div class="video-shelf">
                    @foreach($categoryVideos as $video)
                    <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="video-card" style="text-decoration:none">
                        <div class="relative overflow-hidden" style="height:132px;background:linear-gradient(135deg,var(--primary-light),var(--accent-light))">
                            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-full h-full object-cover opacity-65">
                            <span class="absolute inset-0 flex items-center justify-center">
                                <span class="video-play-small" aria-hidden="true">
                                    <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </span>
                            </span>
                            @if($video->duration)<span class="video-duration absolute bottom-2 right-2">{{ $video->duration }}</span>@endif
                        </div>
                        <div class="p-3">
                            <h4 class="font-semibold text-sm leading-snug" style="color:var(--dark)">{{ $video->title }}</h4>
                            <span class="text-xs mt-1 block" style="color:var(--muted)">Watch tutorial</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════
     BLOGS
══════════════════════════════════════════ --}}
@if($featuredBlogs->count())
<section class="py-20 lg:py-24" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between mb-12 reveal">
            <div>
                <span class="section-label">Knowledge Hub</span>
                <h2 class="section-title">Read Our Blogs</h2>
                <div class="section-divider"></div>
            </div>
            <a href="{{ route('blog') }}" class="btn-outline mt-4 sm:mt-0">View All Posts</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredBlogs as $i => $post)
            <a href="{{ route('blog.show', $post) }}"
               class="blog-card block reveal delay-{{ $i * 100 }}" style="text-decoration:none">
                <div class="overflow-hidden" style="height:200px;background:linear-gradient(135deg,var(--primary-light),var(--primary))">
                    @if($post->thumbnail)
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}"
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
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
     CTA
══════════════════════════════════════════ --}}
<section class="py-20" style="background:linear-gradient(135deg,var(--primary-dark) 0%,var(--primary) 100%)">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <span class="section-label" style="color:var(--accent)">Start Today</span>
        <h2 class="text-4xl lg:text-5xl font-bold mb-6" style="color:#fff;font-family:'Playfair Display',serif;line-height:1.15;letter-spacing:-0.02em">
            {{ $settings->get('cta_heading','Begin Your Journey with Aakar') }}
        </h2>
        <p class="text-lg mb-10 mx-auto" style="color:rgba(255,255,255,0.88);max-width:600px;line-height:1.7">
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
