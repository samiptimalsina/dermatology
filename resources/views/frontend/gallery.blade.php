@extends('layouts.app')

@section('content')

<section class="py-16" style="background:linear-gradient(135deg,#F7F3EC,#F0FAF8)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="breadcrumb mb-4"><a href="{{ route('home') }}">Home</a> &rsaquo; <span>Gallery</span></div>
        <span class="section-label">Our Clinic</span>
        <h1 class="section-title text-4xl">Gallery</h1>
        <div class="section-divider"></div>
        <p class="max-w-xl" style="color:var(--muted)">A glimpse into our state-of-the-art clinic, advanced equipment, and the welcoming environment we've created for our patients.</p>
    </div>
</section>

<section class="py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @forelse($images as $category => $categoryImages)
        <div class="mb-14">
            <h2 class="text-xl font-bold mb-6 capitalize pb-3" style="color:var(--primary-dark);border-bottom:2px solid var(--accent-light)">
                {{ ucfirst($category) }}
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($categoryImages as $img)
                <div class="rounded-xl overflow-hidden shadow-md reveal" style="aspect-ratio:1;background:var(--primary-light)">
                    <img src="{{ $img->image_url }}" alt="{{ $img->title ?? 'Gallery image' }}"
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="text-center py-20" style="color:var(--muted)">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p>Gallery images will be added soon. Check back later!</p>
        </div>
        @endforelse
    </div>
</section>

@endsection
