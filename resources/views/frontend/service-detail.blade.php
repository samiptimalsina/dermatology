@extends('layouts.app')

@section('meta_title', $service->meta_title ?? $service->title . ' | Aakar Dermatology')
@section('meta_description', $service->meta_description ?? $service->short_description)

@section('content')

<section class="page-hero py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="breadcrumb mb-4">
            <a href="{{ route('home') }}">Home</a> &rsaquo;
            <a href="{{ route('services') }}">Services</a> &rsaquo;
            <span>{{ $service->title }}</span>
        </div>
        <span class="section-label">{{ ucfirst($service->category) }} Treatment</span>
        <h1 class="section-title text-4xl">{{ $service->title }}</h1>
        <div class="section-divider"></div>
    </div>
</section>

<section class="py-16 lg:py-20" style="background:var(--bg)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Main content --}}
            <div class="lg:col-span-2">
                @if($service->image)
                <div class="rounded-2xl overflow-hidden mb-8 shadow-lg" style="height:380px">
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}"
                         class="w-full h-full object-cover">
                </div>
                @endif
                <div style="color:var(--text);line-height:1.9;font-size:1.05rem">
                    <p class="text-lg font-medium mb-6" style="color:var(--muted)">{{ $service->short_description }}</p>
                    @if($service->full_description)
                    {!! $service->full_description !!}
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                <div class="rounded-2xl p-6"
                     style="background:linear-gradient(135deg,var(--primary-dark),var(--primary))">
                    <h3 class="font-bold text-xl mb-2" style="color:#fff;font-family:'Playfair Display',serif;line-height:1.3">Ready to Get Started?</h3>
                    <p class="text-sm mb-5" style="color:rgba(255,255,255,0.88);line-height:1.7">
                        Book your consultation today and take the first step toward healthier skin.
                    </p>
                    <a href="{{ route('contact') }}?service={{ urlencode($service->title) }}"
                       class="btn-accent w-full justify-center">Book Appointment</a>
                </div>

                <div class="rounded-2xl p-6" style="border:1.5px solid var(--border);background:#fff">
                    <h4 class="font-bold mb-4" style="color:var(--dark)">Contact Us</h4>
                    @if($globalSettings->get('contact_phone'))
                    <a href="tel:{{ $globalSettings->get('contact_phone') }}"
                       class="flex items-center gap-3 mb-3 text-sm" style="color:var(--text);text-decoration:none">
                        <svg class="w-4 h-4 flex-shrink-0" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ $globalSettings->get('contact_phone') }}
                    </a>
                    @endif
                    <p class="text-sm" style="color:var(--muted)">{{ $globalSettings->get('contact_hours') }}</p>
                </div>

                @if($relatedServices->count())
                <div>
                    <h4 class="font-bold mb-4" style="color:var(--dark)">Related Services</h4>
                    <div class="space-y-3">
                        @foreach($relatedServices as $related)
                        <a href="{{ route('services.show', $related) }}"
                           class="flex items-center gap-3 p-3 rounded-xl transition hover:shadow-md"
                           style="background:var(--primary-light);text-decoration:none">
                            <svg class="w-5 h-5 flex-shrink-0" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="text-sm font-medium" style="color:var(--dark)">{{ $related->title }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
