@extends('layouts.admin')
@section('title','Before / After Results')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm" style="color:var(--muted)">{{ $items->total() }} results</p>
    <a href="{{ route('admin.before-afters.create') }}" class="btn-primary">+ Add Result</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($items as $item)
    <div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
        <div class="grid grid-cols-2" style="height:160px">
            <div class="relative overflow-hidden bg-gray-100">
                @if($item->before_image)<img src="{{ $item->before_image_url }}" alt="Before" class="w-full h-full object-cover">@else<div class="w-full h-full flex items-center justify-center text-xs" style="color:var(--muted)">No image</div>@endif
                <span class="absolute top-2 left-2 badge" style="background:var(--accent);color:#fff;font-size:.6rem">Before</span>
            </div>
            <div class="relative overflow-hidden bg-gray-100">
                @if($item->after_image)<img src="{{ $item->after_image_url }}" alt="After" class="w-full h-full object-cover">@else<div class="w-full h-full flex items-center justify-center text-xs" style="color:var(--muted)">No image</div>@endif
                <span class="absolute top-2 left-2 badge" style="background:var(--primary);color:#fff;font-size:.6rem">After</span>
            </div>
        </div>
        <div class="p-4">
            <div class="font-bold text-sm mb-0.5" style="color:var(--primary)">{{ $item->title }}</div>
            <div class="text-xs mb-3" style="color:var(--accent)">{{ $item->treatment }}</div>
            <div class="flex gap-2">
                <a href="{{ route('admin.before-afters.edit',$item) }}" class="badge badge-blue" style="text-decoration:none">Edit</a>
                <form action="{{ route('admin.before-afters.destroy',$item) }}" method="POST" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12" style="color:var(--muted)">No before/after results. <a href="{{ route('admin.before-afters.create') }}" style="color:var(--accent)">Add one →</a></div>
    @endforelse
</div>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
