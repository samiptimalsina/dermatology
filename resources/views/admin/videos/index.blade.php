@extends('layouts.admin')
@section('title','Videos')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm" style="color:var(--muted)">{{ $videos->total() }} videos</p>
    <a href="{{ route('admin.videos.create') }}" class="btn-primary">+ Add Video</a>
</div>
<div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    <div class="table-scroll">
        <table class="admin-table w-full">
            <thead><tr><th>Thumbnail</th><th>Title</th><th>Category</th><th>Video URL</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($videos as $video)
                <tr>
                    <td><img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-24 h-14 object-cover rounded-lg" loading="lazy"></td>
                    <td><div class="font-semibold">{{ $video->title }}</div><div class="text-xs" style="color:var(--muted)">{{ $video->duration ?: 'Duration not set' }}</div></td>
                    <td>{{ $video->category }}</td>
                    <td><a href="{{ $video->video_url }}" target="_blank" rel="noopener" class="text-sm underline" style="color:var(--primary)">{{ Str::limit($video->video_url, 42) }}</a></td>
                    <td><span class="badge {{ $video->is_active ? 'badge-green' : 'badge-gray' }}">{{ $video->is_active ? 'Active' : 'Hidden' }}</span></td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.videos.edit', $video) }}" class="badge badge-blue" style="text-decoration:none">Edit</a>
                            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Delete this video?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center py-12" style="color:var(--muted)">No videos yet. Add your first video.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $videos->links() }}</div>
@endsection
