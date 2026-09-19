@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Before/After' : 'Add Before/After')
@section('content')
<div class="w-full max-w-5xl mx-auto">
    <a href="{{ route('admin.before-afters.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back</a>
    @if($errors->any())<div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <form action="{{ $item->exists ? route('admin.before-afters.update',$item) : route('admin.before-afters.store') }}"
          method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @if($item->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div><label class="form-label">Title <span style="color:#EF4444">*</span></label>
                <input type="text" name="title" value="{{ old('title',$item->title) }}" class="form-input" required></div>
            <div><label class="form-label">Treatment <span style="color:#EF4444">*</span></label>
                <input type="text" name="treatment" value="{{ old('treatment',$item->treatment) }}" class="form-input" required></div>
            <div>
                <label class="form-label">Before Image {{ $item->exists ? '' : '*' }}</label>
                @if($item->before_image)<img src="{{ $item->before_image_url }}" alt="Before" class="h-24 rounded-lg object-cover mb-2">@endif
                <input type="file" name="before_image" class="form-input" accept="image/*" {{ $item->exists ? '' : 'required' }}>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 1200×900 px</p>
            </div>
            <div>
                <label class="form-label">After Image {{ $item->exists ? '' : '*' }}</label>
                @if($item->after_image)<img src="{{ $item->after_image_url }}" alt="After" class="h-24 rounded-lg object-cover mb-2">@endif
                <input type="file" name="after_image" class="form-input" accept="image/*" {{ $item->exists ? '' : 'required' }}>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 1200×900 px</p>
            </div>
            <div class="sm:col-span-2"><label class="form-label">Description</label>
                <textarea name="description" rows="3" class="form-input resize-none">{{ old('description',$item->description) }}</textarea></div>
            <div><label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order',$item->sort_order ?? 0) }}" class="form-input" min="0"></div>
        </div>

        <label class="flex items-center gap-2 text-sm cursor-pointer">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active',$item->is_active ?? true) ? 'checked':'' }}>
            Active (visible on site)
        </label>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">{{ $item->exists ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.before-afters.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
