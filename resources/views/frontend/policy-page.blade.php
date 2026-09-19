@extends('layouts.app')

@section('content')
<section class="page-hero py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="breadcrumb mb-4"><a href="{{ route('home') }}">Home</a> &rsaquo; <span>{{ $seo->menu_label ?: $seo->meta_title }}</span></div>
        <span class="section-label">{{ $seo->menu_label ?: 'Information' }}</span>
        <h1 class="section-title text-4xl">{{ $seo->meta_title }}</h1>
        <div class="section-divider"></div>
    </div>
</section>
<section class="py-16" style="background:var(--bg)">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-2xl p-6 sm:p-10 shadow-sm policy-content" style="border:1px solid var(--border)">
            {!! $seo->content !!}
        </article>
    </div>
</section>
@endsection