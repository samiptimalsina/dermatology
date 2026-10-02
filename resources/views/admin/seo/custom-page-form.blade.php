@extends('layouts.admin')
@section('title', $customPage->exists ? 'Edit Custom Page' : 'Create Custom Page')
@section('content')
<div class="w-full">
    <a href="{{ route('admin.seo.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back to SEO</a>
    @if($errors->any())
    <div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ $customPage->exists ? route('admin.seo.custom-pages.update', $customPage) : route('admin.seo.custom-pages.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @if($customPage->exists) @method('PUT') @endif

        <div>
            <label class="form-label">Page Title <span style="color:#EF4444">*</span></label>
            <input type="text" name="title" value="{{ old('title', $customPage->title) }}" class="form-input" maxlength="255" required>
        </div>
        <div>
            <label class="form-label">Page Slug <span style="color:#EF4444">*</span></label>
            <div class="flex items-center gap-2">
                <span class="text-sm whitespace-nowrap" style="color:var(--muted)">{{ url('/') }}/</span>
                <input type="text" name="slug" value="{{ old('slug', $customPage->slug) }}" class="form-input" maxlength="255" pattern="[a-z0-9]+(-[a-z0-9]+)*" onblur="this.value = this.value.trim()" required>
            </div>
            <p class="text-xs mt-1" style="color:var(--muted)">Lowercase letters, numbers, and hyphens only. Spaces at the start or end are trimmed when saved.</p>
        </div>
        <div>
            <label class="form-label">Page Content <span style="color:#EF4444">*</span></label>
            <textarea name="content" rows="12" class="form-input rich-editor resize-y" required>{{ old('content', $customPage->content) }}</textarea>
        </div>
        <div>
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $customPage->meta_title) }}" class="form-input" maxlength="200">
        </div>
        <div>
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" rows="3" class="form-input resize-none" maxlength="500">{{ old('meta_description', $customPage->meta_description) }}</textarea>
        </div>
        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $customPage->is_published ?? true) ? 'checked' : '' }}>
                Published
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="no_index" value="0">
                <input type="checkbox" name="no_index" value="1" {{ old('no_index', $customPage->no_index) ? 'checked' : '' }}>
                Hide from search engines
            </label>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">{{ $customPage->exists ? 'Update Custom Page' : 'Create Custom Page' }}</button>
            <a href="{{ route('admin.seo.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection