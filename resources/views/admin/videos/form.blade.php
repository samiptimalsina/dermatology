@extends('layouts.admin')
@section('title', $video->exists ? 'Edit Video' : 'Add Video')
@section('content')
@php($thumbnailValue = old('thumbnail_url', $video->thumbnail_url ?: ($video->exists && $video->thumbnail !== asset('images/placeholder-gallery.jpg') ? $video->thumbnail : '')))
<a href="{{ route('admin.videos.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back to Videos</a>
<div class="bg-white rounded-2xl shadow-sm p-6 max-w-3xl">
    <form action="{{ $video->exists ? route('admin.videos.update', $video) : route('admin.videos.store') }}" method="POST">
        @csrf
        @if($video->exists) @method('PUT') @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2"><label class="form-label">Video title</label><input name="title" value="{{ old('title', $video->title) }}" class="form-input" required></div>
            <div><label class="form-label">Category</label><select name="category" id="video-category" class="form-input" required><option value="">Select a category</option>@if($video->exists && $video->category && ! $categories->contains($video->category))<option value="{{ $video->category }}" selected>{{ $video->category }}</option>@endif @foreach($categories as $category)<option value="{{ $category }}" {{ old('category', $video->category) === $category ? 'selected' : '' }}>{{ $category }}</option>@endforeach<option value="__new__" {{ old('category') === '__new__' ? 'selected' : '' }}>+ Add new category</option></select><input name="new_category" id="new-video-category" value="{{ old('new_category') }}" class="form-input mt-2 {{ old('category') === '__new__' ? '' : 'hidden' }}" placeholder="Enter new category" {{ old('category') === '__new__' ? 'required' : '' }}></div>
            <div><label class="form-label">Duration</label><input name="duration" value="{{ old('duration', $video->duration) }}" class="form-input" placeholder="04:12"></div>
            <div class="md:col-span-2"><label class="form-label">Video URL</label><input type="url" name="video_url" value="{{ old('video_url', $video->video_url) }}" class="form-input" placeholder="https://www.youtube.com/watch?v=..." required><p class="text-xs mt-1" style="color:var(--muted)">Paste the YouTube, Vimeo, or other public video link.</p></div>
            <div class="md:col-span-2"><label class="form-label">Thumbnail URL <span class="font-normal" style="color:var(--muted)">(optional)</span></label><input type="url" name="thumbnail_url" value="{{ $thumbnailValue }}" class="form-input" placeholder="https://..."><p class="text-xs mt-1" style="color:var(--muted)">For YouTube videos, this is automatically filled from the video URL when a YouTube video ID is available.</p>@if($thumbnailValue)<div class="mt-3 flex items-center gap-3"><img src="{{ $thumbnailValue }}" alt="Video thumbnail preview" class="w-32 h-20 object-cover rounded-lg"><span class="text-xs break-all" style="color:var(--muted)">{{ $thumbnailValue }}</span></div>@endif</div>
            <div class="md:col-span-2"><label class="form-label">Description</label><textarea name="description" rows="4" class="form-input">{{ old('description', $video->description) }}</textarea></div>
            <div><label class="form-label">Sort order</label><input type="number" name="sort_order" value="{{ old('sort_order', $video->sort_order ?? 0) }}" min="0" class="form-input"></div>
            <div class="flex flex-col gap-3 justify-end pb-2">
                <label class="inline-flex items-center gap-2"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $video->exists ? $video->is_active : true) ? 'checked' : '' }}> Active on website</label>
                <label class="inline-flex items-center gap-2"><input type="hidden" name="is_featured" value="0"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $video->is_featured) ? 'checked' : '' }}> Featured video</label>
            </div>
        </div>
        @if($errors->any())<div class="mt-5 text-sm text-red-700">{{ $errors->first() }}</div>@endif
        <div class="flex gap-3 mt-6"><button type="submit" class="btn-primary">{{ $video->exists ? 'Update Video' : 'Save Video' }}</button><a href="{{ route('admin.videos.index') }}" class="btn-outline">Cancel</a></div>
    </form>
</div>
<script>
    document.getElementById('video-category')?.addEventListener('change', function () {
        const field = document.getElementById('new-video-category');
        const isNew = this.value === '__new__';
        field.classList.toggle('hidden', !isNew);
        field.required = isNew;
        if (!isNew) field.value = '';
    });
</script>
@endsection
