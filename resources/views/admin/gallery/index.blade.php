@extends('layouts.admin')
@section('title','Gallery')
@section('content')

{{-- Upload form --}}
<div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
    <h2 class="font-bold mb-4" style="color:var(--primary)">Upload Images</h2>
    @if($errors->any())<div class="alert-error mb-4"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
                <label class="form-label">Images <span style="color:#EF4444">*</span></label>
                <div class="dropzone-wrap">
                    <label class="dropzone-label" for="gallery-images-input">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0-12l-4 4m4-4l4 4"/></svg>
                        Choose or drop gallery images
                    </label>
                    <input id="gallery-images-input" type="file" name="images[]" multiple class="form-input hidden" accept="image/*" required>
                    <div class="dropzone-files"><span>No files chosen</span></div>
                </div>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 1200×1200 px or 4:5/landscape</p>
            </div>
            <div>
                <label class="form-label">Category</label>
                <select name="category" class="form-input">
                    @foreach(['clinic'=>'Clinic','treatment'=>'Treatment','team'=>'Team','events'=>'Events'] as $val=>$lbl)
                    <option value="{{ $val }}">{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Title (optional)</label>
                <input type="text" name="title" class="form-input" placeholder="Image title">
            </div>
        </div>
        <button type="submit" class="btn-primary mt-4">Upload</button>
    </form>
</div>

{{-- Images grid --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
    @forelse($images as $img)
    <div class="relative group rounded-xl overflow-hidden shadow-sm" style="aspect-ratio:1;background:var(--primary-light)">
        <img src="{{ $img->image_url }}" alt="{{ $img->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 flex flex-col items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"
             style="background:rgba(0,43,38,0.78)">
            <span class="badge badge-gray text-xs">{{ ucfirst($img->category) }}</span>
            <form action="{{ route('admin.gallery.toggle',$img) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="badge {{ $img->is_active ? 'badge-green' : 'badge-red' }} cursor-pointer border-0">
                    {{ $img->is_active ? 'Active':'Hidden' }}
                </button>
            </form>
            <form action="{{ route('admin.gallery.destroy',$img) }}" method="POST" onsubmit="return confirm('Delete image?')">
                @csrf @method('DELETE')
                <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-5 text-center py-16" style="color:var(--muted)">
        <svg class="w-16 h-16 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        No images yet. Upload some above.
    </div>
    @endforelse
</div>
<div class="mt-4">{{ $images->links() }}</div>
@endsection
