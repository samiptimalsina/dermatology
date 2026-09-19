@extends('layouts.app')

@section('content')

{{-- Page hero --}}
<section class="page-hero py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="breadcrumb mb-4">
            <a href="{{ route('home') }}">Home</a> &rsaquo; <span>Services</span>
        </div>
        <span class="section-label">What We Offer</span>
        <h1 class="section-title text-4xl">Our Services</h1>
        <div class="section-divider"></div>
        <p class="max-w-2xl" style="color:var(--muted)">
            Transform your skin with our complete range of medical and aesthetic dermatology services, personalized to help you look and feel your best.
        </p>
    </div>
</section>

{{-- Filter tabs --}}
<div class="sticky top-20 z-30 bg-white shadow-sm" style="border-bottom:1px solid var(--border)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-wrap gap-2">
            @foreach(['all'=>'All Services','skin'=>'Skin','hair'=>'Hair','laser'=>'Laser','surgical'=>'Surgical'] as $key => $label)
            <button data-filter="{{ $key }}"
                    class="px-4 py-2 rounded-full text-sm font-semibold transition-all active-filter-btn"
                    style="{{ $key === 'all' ? 'background:var(--primary);color:#fff;' : 'background:var(--primary-light);color:var(--primary);' }}">
                {{ $label }}
            </button>
            @endforeach
        </div>
    </div>
</div>

{{-- Services grid --}}
<section class="py-16 lg:py-20" style="background:var(--bg)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach($services as $category => $categoryServices)
        <div class="mb-14">
            <h2 class="text-2xl font-bold mb-8 capitalize pb-3"
                style="color:var(--dark);border-bottom:2px solid var(--primary-light)">
                {{ ucfirst($category) }} Treatments
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categoryServices as $service)
                <a href="{{ route('services.show', $service) }}"
                   data-category="{{ $service->category }}"
                   class="service-card block reveal" style="text-decoration:none">
                    @if($service->image)
                    <div class="mb-4 rounded-xl overflow-hidden" style="height:180px">
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
                    <h3 class="font-bold text-lg mb-2" style="color:var(--dark)">{{ $service->title }}</h3>
                    <p class="text-sm leading-relaxed mb-4" style="color:var(--muted)">{{ $service->short_description }}</p>
                    <span class="inline-flex items-center gap-1 text-sm font-semibold" style="color:var(--primary)">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<section class="py-16" style="background:linear-gradient(135deg,var(--primary-dark),var(--primary))">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4" style="color:#fff;font-family:'Playfair Display',serif;line-height:1.2">
            Not sure which treatment is right for you?
        </h2>
        <p class="mb-8" style="color:rgba(255,255,255,0.88);line-height:1.7">
            Book a consultation and our expert will guide you to the best solution for your skin.
        </p>
        <a href="{{ route('contact') }}" class="btn-accent">Book Free Consultation</a>
    </div>
</section>

@endsection
