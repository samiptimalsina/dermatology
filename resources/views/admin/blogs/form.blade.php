@extends('layouts.admin')
@section('title', $blog->exists ? 'Edit Blog Post' : 'New Blog Post')
@section('content')
@php($thumbnailInputId = 'thumbnail-input-' . \Illuminate\Support\Str::uuid())
<div class="w-full max-w-6xl mx-auto">
    <a href="{{ route('admin.blogs.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back</a>

    @if($errors->any())
    <div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ $blog->exists ? route('admin.blogs.update',$blog) : route('admin.blogs.store') }}"
          method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @if($blog->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <label class="form-label">Title <span style="color:#EF4444">*</span></label>
                <input type="text" name="title" value="{{ old('title',$blog->title) }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Category</label>
                <div class="flex flex-col sm:flex-row gap-2">
                    <select name="category" class="form-input flex-1">
                        <option value="">Select category</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->name }}" {{ old('category', $blog->category ?? '') == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn-outline whitespace-nowrap">Manage Categories</a>
                </div>
            </div>
            <div>
                <label class="form-label">Author</label>
                <input type="text" name="author" value="{{ old('author',$blog->author ?? 'Dr. Rajan Tajhya') }}" class="form-input">
            </div>
            <div class="sm:col-span-2">
                <label class="form-label">Excerpt <span style="color:#EF4444">*</span></label>
                <textarea name="excerpt" rows="2" class="form-input resize-none">{{ old('excerpt',$blog->excerpt) }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="form-label">Content <span style="color:#EF4444">*</span></label>
                <textarea name="content" rows="16" class="form-input rich-editor resize-y">{{ old('content',$blog->content) }}</textarea>
                <p class="text-xs mt-1" style="color:var(--muted)">Use the editor to format text, add links, and upload images directly.</p>
            </div>
            <div>
                <label class="form-label">Thumbnail</label>
                @if($blog->thumbnail)<div class="mb-2"><img src="{{ $blog->thumbnail_url }}" alt="" class="h-20 rounded-lg object-cover"></div>@endif
                <div class="dropzone-wrap">
                    <label class="dropzone-label" for="{{ $thumbnailInputId }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0-12l-4 4m4-4l4 4"/></svg>
                        Choose or drop thumbnail image
                    </label>
                    <input id="{{ $thumbnailInputId }}" type="file" name="thumbnail" class="form-input hidden" accept="image/*">
                    <div class="dropzone-files"><span>No file chosen</span></div>
                </div>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 1200×800 px</p>
            </div>
            <div></div>
            <div>
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title',$blog->meta_title) }}" class="form-input">
            </div>
            <div>
                <label class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords',$blog->meta_keywords) }}" class="form-input" placeholder="keyword1, keyword2">
            </div>
            <div class="sm:col-span-2">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" rows="2" class="form-input resize-none">{{ old('meta_description',$blog->meta_description) }}</textarea>
            </div>
        </div>

        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$blog->is_featured) ? 'checked' : '' }}>
                Featured
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published',$blog->is_published) ? 'checked' : '' }}>
                Published (visible on site)
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">{{ $blog->exists ? 'Update Post' : 'Create Post' }}</button>
            <a href="{{ route('admin.blogs.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
