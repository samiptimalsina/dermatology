@extends('layouts.app')

@section('content')
<section class="page-hero py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="breadcrumb mb-4"><a href="{{ route('videos') }}">Videos</a> &rsaquo; <span>{{ $video->category }}</span></div>
        <span class="section-label">{{ $video->category }}</span>
        <h1 class="section-title text-4xl">{{ $video->title }}</h1>
    </div>
</section>

<section class="py-16" style="background:var(--bg)">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="video-detail-player">
            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center" style="background:rgba(0,61,54,.38)">
                <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="video-play-button" aria-label="Watch {{ $video->title }}">
                    <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </a>
            </div>
        </div>
        <div class="bg-white p-6 lg:p-8" style="border:1px solid var(--border);border-top:0;border-radius:0 0 18px 18px">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="blog-category-badge">{{ $video->category }}</span>
                @if($video->duration)<span class="text-sm" style="color:var(--muted)">{{ $video->duration }}</span>@endif
            </div>
            <p class="leading-relaxed" style="color:var(--muted)">{{ $video->description }}</p>
            <a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="btn-primary mt-6">Watch Video</a>
        </div>

        @if($relatedVideos->count())
        <div class="mt-16">
            <span class="section-label">Keep Learning</span>
            <h2 class="section-title text-2xl mb-6">More From {{ $video->category }}</h2>
            <div class="video-shelf">
                @foreach($relatedVideos as $video)
                    @include('frontend.partials.video-card', ['video' => $video])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection