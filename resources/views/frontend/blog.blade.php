@extends('layouts.app')

@section('content')

<section class="page-hero py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="breadcrumb mb-4"><a href="{{ route('home') }}">Home</a> &rsaquo; <span>Blog</span></div>
        <span class="section-label">Knowledge Hub</span>
        <h1 class="section-title text-4xl">Skin &amp; Hair Care Blog</h1>
        <div class="section-divider"></div>
        <p class="max-w-xl" style="color:var(--muted)">
            Expert tips, treatment guides, and skin care advice from Dr. Rajan Tajhya and the Aakar Dermatology team.
        </p>
    </div>
</section>

<section class="py-16 lg:py-20" style="background:var(--bg)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($blogs->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($blogs as $i => $post)
            <a href="{{ route('blog.show', $post) }}"
               class="blog-card block reveal delay-{{ ($i % 3) * 100 }}" style="text-decoration:none">
                <div class="overflow-hidden"
                     style="height:210px;background:linear-gradient(135deg,var(--primary-light),var(--primary))">
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
                    <h2 class="font-bold text-base mb-2" style="color:var(--dark)">{{ $post->title }}</h2>
                    <p class="text-sm leading-relaxed mb-3" style="color:var(--muted)">{{ Str::limit($post->excerpt, 120) }}</p>
                    <div class="flex items-center justify-between text-xs" style="color:var(--muted)">
                        <span>{{ $post->author }}</span>
                        <span>{{ $post->published_at?->format('M d, Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        {{ $blogs->links() }}
        @else
        <div class="text-center py-20">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <p style="color:var(--muted)">No blog posts published yet. Check back soon!</p>
        </div>
        @endif
    </div>
</section>

@endsection
