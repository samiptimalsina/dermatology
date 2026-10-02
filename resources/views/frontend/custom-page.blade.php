@extends('layouts.app')

@section('meta_title', $customPage->meta_title ?: $customPage->title)
@section('meta_description', $customPage->meta_description ?: '')

@section('content')
<section class="page-hero py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="breadcrumb mb-4"><a href="{{ route('home') }}">Home</a> &rsaquo; <span>{{ $customPage->title }}</span></div>
        <h1 class="section-title text-4xl">{{ $customPage->title }}</h1>
        <div class="section-divider"></div>
    </div>
</section>
<section class="py-16" style="background:var(--bg)">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-2xl p-6 sm:p-10 shadow-sm policy-content" style="border:1px solid var(--border)">
            {!! $customPage->content !!}
        </article>
    </div>
</section>
@endsection