@extends('layouts.admin')
@section('title', $testimonial->exists ? 'Edit Testimonial' : 'Add Testimonial')
@section('content')
<div class="w-full max-w-5xl mx-auto">
    <a href="{{ route('admin.testimonials.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back</a>
    @if($errors->any())<div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <form action="{{ $testimonial->exists ? route('admin.testimonials.update',$testimonial) : route('admin.testimonials.store') }}"
          method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @if($testimonial->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="form-label">Patient Name <span style="color:#EF4444">*</span></label>
                <input type="text" name="patient_name" value="{{ old('patient_name',$testimonial->patient_name) }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Treatment</label>
                <input type="text" name="treatment" value="{{ old('treatment',$testimonial->treatment) }}" class="form-input">
            </div>
            <div>
                <label class="form-label">Rating</label>
                <select name="rating" class="form-input">
                    @for($i=5;$i>=1;$i--)
                    <option value="{{ $i }}" {{ old('rating',$testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Stars</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="form-label">Source</label>
                <select name="source" class="form-input">
                    @foreach(['google'=>'Google','facebook'=>'Facebook','direct'=>'Direct'] as $val=>$lbl)
                    <option value="{{ $val }}" {{ old('source',$testimonial->source) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="form-label">Review <span style="color:#EF4444">*</span></label>
                <textarea name="review" rows="5" class="form-input resize-none" required>{{ old('review',$testimonial->review) }}</textarea>
            </div>
            <div>
                <label class="form-label">Patient Photo</label>
                @if($testimonial->patient_photo)<img src="{{ $testimonial->photo_url }}" alt="" class="h-16 w-16 rounded-full object-cover mb-2">@endif
                <input type="file" name="patient_photo" class="form-input" accept="image/*">
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 800×800 px square</p>
            </div>
            <div>
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order',$testimonial->sort_order ?? 0) }}" class="form-input" min="0">
            </div>
        </div>

        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$testimonial->is_featured) ? 'checked':'' }}>
                Featured
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active',$testimonial->is_active ?? true) ? 'checked':'' }}>
                Active
            </label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">{{ $testimonial->exists ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
