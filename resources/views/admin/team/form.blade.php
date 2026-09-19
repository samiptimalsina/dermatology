@extends('layouts.admin')
@section('title', $member->exists ? 'Edit Team Member' : 'Add Team Member')
@section('content')
@php($teamPhotoInputId = 'team-photo-input-' . \Illuminate\Support\Str::uuid())
<div class="w-full max-w-5xl mx-auto">
    <a href="{{ route('admin.team.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back</a>
    @if($errors->any())<div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <form action="{{ $member->exists ? route('admin.team.update',$member) : route('admin.team.store') }}"
          method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @if($member->exists) @method('PUT') @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div><label class="form-label">Full Name <span style="color:#EF4444">*</span></label>
                <input type="text" name="name" value="{{ old('name',$member->name) }}" class="form-input" required></div>
            <div><label class="form-label">Designation <span style="color:#EF4444">*</span></label>
                <input type="text" name="designation" value="{{ old('designation',$member->designation) }}" class="form-input" required></div>
            <div><label class="form-label">Qualification</label>
                <input type="text" name="qualification" value="{{ old('qualification',$member->qualification) }}" class="form-input"></div>
            <div><label class="form-label">Specialization</label>
                <input type="text" name="specialization" value="{{ old('specialization',$member->specialization) }}" class="form-input"></div>
            <div><label class="form-label">Years Experience</label>
                <input type="number" name="years_experience" value="{{ old('years_experience',$member->years_experience ?? 0) }}" class="form-input" min="0"></div>
            <div><label class="form-label">Total Patients</label>
                <input type="number" name="total_patients" value="{{ old('total_patients',$member->total_patients ?? 0) }}" class="form-input" min="0"></div>
            <div class="sm:col-span-2"><label class="form-label">Bio <span style="color:#EF4444">*</span></label>
                <textarea name="bio" rows="5" class="form-input resize-y" required>{{ old('bio',$member->bio) }}</textarea></div>
            <div><label class="form-label">Photo</label>
                @if($member->photo)<img src="{{ $member->photo_url }}" alt="" class="h-20 w-20 rounded-full object-cover mb-2">@endif
                <div class="dropzone-wrap">
                    <label class="dropzone-label" for="{{ $teamPhotoInputId }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0-12l-4 4m4-4l4 4"/></svg>
                        Choose or drop team photo
                    </label>
                    <input id="{{ $teamPhotoInputId }}" type="file" name="photo" class="form-input hidden" accept="image/*">
                    <div class="dropzone-files"><span>No file chosen</span></div>
                </div>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 900×1200 px portrait</p></div>
            <div><label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order',$member->sort_order ?? 0) }}" class="form-input" min="0"></div>
        </div>

        <div class="flex gap-6">
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="hidden" name="is_featured" value="0">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$member->is_featured) ? 'checked':'' }}>
                Featured
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active',$member->is_active ?? true) ? 'checked':'' }}>
                Active
            </label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">{{ $member->exists ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.team.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
