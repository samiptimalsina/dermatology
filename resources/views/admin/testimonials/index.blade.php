@extends('layouts.admin')
@section('title','Testimonials')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm" style="color:var(--muted)">{{ $testimonials->total() }} total</p>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">+ Add Testimonial</a>
</div>
<div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
    <div class="table-scroll"><table class="admin-table w-full">
        <thead><tr><th>Patient</th><th>Treatment</th><th>Rating</th><th>Source</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($testimonials as $t)
        <tr>
            <td class="font-medium" style="color:var(--primary)">{{ $t->patient_name }}</td>
            <td class="text-xs" style="color:var(--muted)">{{ $t->treatment ?? '—' }}</td>
            <td class="stars text-sm">{{ str_repeat('★',$t->rating) }}</td>
            <td><span class="badge badge-gray">{{ ucfirst($t->source) }}</span></td>
            <td>
                <form action="{{ route('admin.testimonials.toggle',$t) }}" method="POST" class="inline">
                    @csrf @method('PATCH')
                    <button type="submit" class="badge {{ $t->is_active ? 'badge-green' : 'badge-red' }} cursor-pointer border-0 bg-transparent p-0">
                        {{ $t->is_active ? 'Active' : 'Hidden' }}
                    </button>
                </form>
            </td>
            <td>
                <div class="flex gap-2">
                    <a href="{{ route('admin.testimonials.edit',$t) }}" class="badge badge-blue" style="text-decoration:none">Edit</a>
                    <form action="{{ route('admin.testimonials.destroy',$t) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-10" style="color:var(--muted)">No testimonials. <a href="{{ route('admin.testimonials.create') }}" style="color:var(--accent)">Add one →</a></td></tr>
        @endforelse
        </tbody>
    </table></div>
</div>
<div class="mt-4">{{ $testimonials->links() }}</div>
@endsection
