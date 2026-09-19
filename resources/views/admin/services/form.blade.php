@extends('layouts.admin')
@section('title', $service->exists ? 'Edit Service' : 'Add Service')
@section('content')
@php($serviceImageInputId = 'service-image-input-' . \Illuminate\Support\Str::uuid())

<div class="w-full max-w-6xl mx-auto">
    <a href="{{ route('admin.services.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">
        ← Back to Services
    </a>

    @if($errors->any())
    <div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ $service->exists ? route('admin.services.update',$service) : route('admin.services.store') }}"
          method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @if($service->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <label class="form-label">Title <span style="color:#EF4444">*</span></label>
                <input type="text" name="title" value="{{ old('title',$service->title) }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Category</label>
                <select name="category" class="form-input">
                    @foreach(['skin','hair','laser','surgical','general'] as $cat)
                    <option value="{{ $cat }}" {{ old('category',$service->category) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order',$service->sort_order ?? 0) }}" class="form-input" min="0">
            </div>
            <div class="sm:col-span-2">
                <label class="form-label">Short Description <span style="color:#EF4444">*</span></label>
                <textarea name="short_description" rows="3" class="form-input resize-none">{{ old('short_description',$service->short_description) }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="form-label">Full Description</label>
                <textarea name="full_description" rows="8" class="form-input rich-editor resize-y">{{ old('full_description',$service->full_description) }}</textarea>
            </div>
            <div>
                <label class="form-label">Service Image</label>
                @if($service->image)
                <div class="mb-2"><img src="{{ $service->image_url }}" alt="" class="h-24 rounded-lg object-cover"></div>
                @endif
                <div class="dropzone-wrap">
                    <label class="dropzone-label" for="{{ $serviceImageInputId }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0-12l-4 4m4-4l4 4"/></svg>
                        Choose or drop service image
                    </label>
                    <input id="{{ $serviceImageInputId }}" type="file" name="image" class="form-input hidden" accept="image/*">
                    <div class="dropzone-files"><span>No file chosen</span></div>
                </div>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 1200×900 px (landscape)</p>
            </div>
            <div>
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title',$service->meta_title) }}" class="form-input">
            </div>
            <div class="sm:col-span-2">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" rows="2" class="form-input resize-none">{{ old('meta_description',$service->meta_description) }}</textarea>
            </div>
        </div>

        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$service->is_featured) ? 'checked' : '' }}>
                Featured on Homepage
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active',$service->is_active ?? true) ? 'checked' : '' }}>
                Active (visible on site)
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">
                {{ $service->exists ? 'Update Service' : 'Create Service' }}
            </button>
            <a href="{{ route('admin.services.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
