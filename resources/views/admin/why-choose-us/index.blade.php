@extends('layouts.admin')
@section('title','Why Choose Us')
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Add new --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="font-bold mb-4" style="color:var(--primary)">Add New Item</h2>
        @if($errors->any())<div class="alert-error mb-4"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <form action="{{ route('admin.why-choose-us.store') }}" method="POST" class="space-y-4">
            @csrf
            <div><label class="form-label">Title <span style="color:#EF4444">*</span></label>
                <input type="text" name="title" class="form-input" required></div>
            <div><label class="form-label">Description <span style="color:#EF4444">*</span></label>
                <textarea name="description" rows="3" class="form-input resize-none" required></textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="form-label">Icon Key</label>
                    <input type="text" name="icon" class="form-input" placeholder="e.g. results"></div>
                <div><label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="form-input" min="0"></div>
            </div>
            <button type="submit" class="btn-primary">Add Item</button>
        </form>
    </div>

    {{-- Existing items --}}
    <div class="space-y-4">
        <h2 class="font-bold" style="color:var(--primary)">Current Items</h2>
        @forelse($items as $item)
        <div class="bg-white rounded-xl shadow-sm p-4">
            <form action="{{ route('admin.why-choose-us.update',$item) }}" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <input type="text" name="title" value="{{ $item->title }}" class="form-input font-semibold">
                <textarea name="description" rows="2" class="form-input resize-none text-sm">{{ $item->description }}</textarea>
                <div class="flex gap-3 items-center">
                    <input type="text" name="icon" value="{{ $item->icon }}" class="form-input flex-1 text-xs" placeholder="icon key">
                    <input type="number" name="sort_order" value="{{ $item->sort_order }}" class="form-input w-20 text-xs">
                    <label class="flex items-center gap-1 text-xs cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked':'' }}>
                        Active
                    </label>
                    <button type="submit" class="badge badge-blue border-0 cursor-pointer">Save</button>
                </div>
            </form>
            <form action="{{ route('admin.why-choose-us.destroy',$item) }}" method="POST" class="mt-2" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')
                <button type="submit" class="badge badge-red border-0 cursor-pointer text-xs">Delete</button>
            </form>
        </div>
        @empty
        <p class="text-sm" style="color:var(--muted)">No items yet.</p>
        @endforelse
    </div>
</div>
@endsection
