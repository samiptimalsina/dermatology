@extends('layouts.app')

@section('meta_title', $blog->meta_title ?? $blog->title . ' | Aakar Dermatology Blog')
@section('meta_description', $blog->meta_description ?? $blog->excerpt)

@section('content')

<section class="page-hero py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="breadcrumb mb-4">
            <a href="{{ route('home') }}">Home</a> &rsaquo;
            <a href="{{ route('blog') }}">Blog</a> &rsaquo;
            <span>{{ Str::limit($blog->title, 40) }}</span>
        </div>
        <span class="blog-category-badge">{{ $blog->category }}</span>
        <h1 class="section-title text-4xl mt-3">{{ $blog->title }}</h1>
        <div class="flex items-center gap-4 mt-4 text-sm" style="color:var(--muted)">
            <span>By <strong style="color:var(--primary)">{{ $blog->author }}</strong></span>
            <span>·</span>
            <span>{{ $blog->published_at?->format('F d, Y') }}</span>
            <span>·</span>
            <span>{{ $blog->reading_time }}</span>
        </div>
    </div>
</section>

<section class="py-14" style="background:var(--bg)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            {{-- Article --}}
            <article class="lg:col-span-2">
                @if($blog->thumbnail)
                <div class="rounded-2xl overflow-hidden mb-8 shadow-lg" style="height:380px">
                    <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}"
                         class="w-full h-full object-cover">
                </div>
                @endif

                <div style="color:var(--text);line-height:1.9;font-size:1.05rem">
                    <p class="text-lg font-medium mb-6" style="color:var(--muted)">{{ $blog->excerpt }}</p>
                    {!! $blog->content !!}
                </div>

                {{-- Share --}}
                <div class="mt-10 pt-6 border-t flex items-center gap-4" style="border-color:var(--border)">
                    <span class="font-semibold text-sm" style="color:var(--dark)">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                       target="_blank"
                       class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm font-bold"
                       style="background:#1877F2">f</a>
                    <a href="https://wa.me/?text={{ urlencode($blog->title.' '.request()->url()) }}"
                       target="_blank"
                       class="w-9 h-9 rounded-full flex items-center justify-center text-white text-sm font-bold"
                       style="background:#25D366">w</a>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                <div class="rounded-2xl p-6"
                     style="background:linear-gradient(135deg,var(--primary-dark),var(--primary))">
                    <h3 class="font-bold text-lg mb-2" style="color:#fff;font-family:'Playfair Display',serif;line-height:1.3">
                        Book a Consultation
                    </h3>
                    <p class="text-sm mb-4" style="color:rgba(255,255,255,0.88);line-height:1.7">
                        Have questions about your skin? Our expert is here to help.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-accent w-full justify-center">Book Now</a>
                </div>

                @if($recentBlogs->count())
                <div class="bg-white rounded-2xl p-5" style="border:1px solid var(--border)">
                    <h4 class="font-bold mb-4" style="color:var(--dark)">Recent Posts</h4>
                    <div class="space-y-4">
                        @foreach($recentBlogs as $recent)
                        <a href="{{ route('blog.show', $recent) }}" class="flex gap-3" style="text-decoration:none">
                            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0"
                                 style="background:linear-gradient(135deg,var(--primary-light),var(--primary))">
                                @if($recent->thumbnail)
                                <img src="{{ $recent->thumbnail_url }}" alt="" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-medium leading-snug" style="color:var(--dark)">
                                    {{ Str::limit($recent->title, 55) }}
                                </p>
                                <p class="text-xs mt-1" style="color:var(--muted)">
                                    {{ $recent->published_at?->format('M d, Y') }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@endsection
