@extends('layouts.app')

@section('content')

<section class="py-16" style="background:linear-gradient(135deg,#F7F3EC,#F0FAF8)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="breadcrumb mb-4"><a href="{{ route('home') }}">Home</a> &rsaquo; <span>About</span></div>
        <span class="section-label">Our Story</span>
        <h1 class="section-title text-4xl">About Aakar Dermatology</h1>
        <div class="section-divider"></div>
    </div>
</section>

{{-- Doctor section --}}
@foreach($team as $member)
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center {{ !$loop->odd ? 'lg:flex-row-reverse' : '' }}">
            <div class="reveal">
                <span class="section-label">{{ $member->designation }}</span>
                <h2 class="section-title text-4xl">{{ $member->name }}</h2>
                <div class="section-divider"></div>
                @if($member->qualification)
                <p class="font-semibold mb-1" style="color:var(--accent)">{{ $member->qualification }}</p>
                @endif
                @if($member->specialization)
                <p class="text-sm mb-4" style="color:var(--muted)">Specialization: {{ $member->specialization }}</p>
                @endif
                <p class="leading-relaxed mb-6" style="color:var(--muted)">{{ $member->bio }}</p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="rounded-xl p-4 text-center" style="background:var(--primary-light)">
                        <div class="text-3xl font-bold" style="color:var(--accent);font-family:'Playfair Display',serif" data-count="{{ $member->years_experience }}">0+</div>
                        <div class="text-sm" style="color:var(--muted)">Years Experience</div>
                    </div>
                    <div class="rounded-xl p-4 text-center" style="background:var(--primary-light)">
                        <div class="text-3xl font-bold" style="color:var(--accent);font-family:'Playfair Display',serif" data-count="{{ $member->total_patients }}">0+</div>
                        <div class="text-sm" style="color:var(--muted)">Happy Patients</div>
                    </div>
                </div>
                <a href="{{ route('contact') }}" class="btn-primary">Book a Consultation</a>
            </div>

            <div class="reveal delay-200 flex justify-center">
                @php
                    $aboutDrSrc = $settings->get('doctor_photo')
                        ? asset('storage/'.$settings->get('doctor_photo'))
                        : ($settings->get('hero_image_1') ? asset('storage/'.$settings->get('hero_image_1')) : ($member->photo ? $member->photo_url : null));
                @endphp
                <div class="w-80 h-96 rounded-3xl overflow-hidden shadow-2xl"
                     style="background:linear-gradient(160deg,var(--accent-light),var(--accent))">
                    @if($aboutDrSrc)
                    <img src="{{ $aboutDrSrc }}" alt="{{ $member->name }}" class="w-full h-full object-cover object-top">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="text-center text-white px-6">
                            <div class="w-24 h-24 rounded-full mb-4 mx-auto flex items-center justify-center"
                                 style="background:rgba(255,255,255,.2)">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="text-lg font-bold mb-1" style="font-family:'Playfair Display',serif">{{ $member->name }}</div>
                            <div class="text-xs opacity-75">{{ $member->designation }}</div>
                            <div class="text-xs mt-3 opacity-50">Upload photo in<br>Admin → Settings → Doctor Photo</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach

{{-- Why Choose Us --}}
@if($whyChooseUs->count())
<section class="py-20" style="background:var(--primary-light)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="section-label">Why Aakar</span>
            <h2 class="section-title">Why Choose Us?</h2>
            <div class="section-divider center"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($whyChooseUs as $i => $item)
            <div class="wcu-card reveal delay-{{ $i * 100 }}">
                <div class="wcu-icon">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-base mb-2" style="color:var(--primary-dark)">{{ $item->title }}</h3>
                <p class="text-sm leading-relaxed" style="color:var(--muted)">{{ $item->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-16" style="background:var(--primary-dark)">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4" style="color:#fff;font-family:'Playfair Display',serif;line-height:1.2">Begin Your Skin Journey</h2>
        <p class="mb-8" style="color:rgba(255,255,255,0.88);line-height:1.7">Schedule your consultation with Dr. Rajan Tajhya today.</p>
        <a href="{{ route('contact') }}" class="btn-primary" style="background:var(--accent)">Book Appointment</a>
    </div>
</section>

@endsection
