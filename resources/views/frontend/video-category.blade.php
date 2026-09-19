@extends('layouts.app')

@section('content')
<section class="video-catalog-shell">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="video-search-bar">
            <div class="video-search-wrap">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10.5 3a7.5 7.5 0 015.95 12.55l4.25 4.25 1.41-1.41-4.25-4.25A7.5 7.5 0 1110.5 3zm0 2a5.5 5.5 0 100 11 5.5 5.5 0 000-11z"/></svg>
                <input type="text" placeholder="Search all videos..." aria-label="Search all videos">
            </div>
            <button type="button">Search</button>
        </div>

        <div class="video-catalog-layout">
            <aside class="video-catalog-sidebar">
                <div class="video-cat-heading">CATEGORIES</div>
                <ul>
                    @foreach($categories as $category => $categoryVideos)
                        <li>
                            <a href="{{ route('videos.category', ['category' => Str::slug($category)]) }}" class="video-cat-link {{ $category === $selectedCategory ? 'active' : '' }}">
                                <span class="video-cat-dot"></span>
                                <span>{{ $category }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <div class="video-catalog-main">
                <div class="video-section-head">
                    <h2>{{ $selectedCategory }}</h2>
                    <a href="{{ route('videos') }}" class="video-view-all">&lt; All Videos</a>
                </div>

                @if($categoryVideos->count())
                    <div class="video-section-grid">
                        @foreach($categoryVideos as $video)
                            <article class="video-list-card">
                                <a href="{{ route('videos.show', $video) }}" class="video-card-link" style="text-decoration:none">
                                    <div class="video-thumb">
                                        <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}">
                                        <span class="video-play" aria-hidden="true">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </span>
                                    </div>
                                    <div class="video-text">
                                        <h3>{{ $video->title }}</h3>
                                        <p>{{ Str::limit($video->description, 130) }}</p>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                @else
                    <div class="video-empty">No videos available in this category yet.</div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
