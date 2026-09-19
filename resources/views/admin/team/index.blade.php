@extends('layouts.admin')
@section('title','Team Members')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm" style="color:var(--muted)">{{ $members->total() }} members</p>
    <a href="{{ route('admin.team.create') }}" class="btn-primary">+ Add Member</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($members as $member)
    <div class="bg-white rounded-2xl shadow-sm p-5">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 rounded-full overflow-hidden flex-shrink-0" style="background:linear-gradient(135deg,var(--primary-light),var(--accent))">
                @if($member->photo)
                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center text-white font-bold">{{ strtoupper(substr($member->name,0,1)) }}</div>
                @endif
            </div>
            <div>
                <div class="font-bold" style="color:var(--primary)">{{ $member->name }}</div>
                <div class="text-xs" style="color:var(--accent)">{{ $member->designation }}</div>
            </div>
        </div>
        <p class="text-xs mb-4" style="color:var(--muted)">{{ Str::limit($member->bio, 100) }}</p>
        <div class="flex gap-2">
            <a href="{{ route('admin.team.edit',$member) }}" class="badge badge-blue" style="text-decoration:none">Edit</a>
            <form action="{{ route('admin.team.destroy',$member) }}" method="POST" onsubmit="return confirm('Delete member?')">
                @csrf @method('DELETE')
                <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12" style="color:var(--muted)">No team members. <a href="{{ route('admin.team.create') }}" style="color:var(--accent)">Add one →</a></div>
    @endforelse
</div>
<div class="mt-4">{{ $members->links() }}</div>
@endsection
