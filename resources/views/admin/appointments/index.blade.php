@extends('layouts.admin')
@section('title','Appointments')
@section('content')

{{-- Status tabs --}}
<div class="flex flex-wrap gap-2 mb-6">
    @foreach(['all'=>'All','pending'=>'Pending','confirmed'=>'Confirmed','completed'=>'Completed','cancelled'=>'Cancelled'] as $key => $label)
    <a href="{{ route('admin.appointments.index',['status'=>$key==='all'?null:$key]) }}"
       class="badge {{ request('status',$key==='all'?null:null) == ($key==='all'?null:$key) ? ($key==='all'?'badge-blue':'badge-'.($key==='pending'?'yellow':($key==='confirmed'?'green':($key==='completed'?'blue':'red')))) : 'badge-gray' }} cursor-pointer"
       style="padding:.4rem .9rem;font-size:.75rem;text-decoration:none">
        {{ $label }} <span class="ml-1">({{ $statusCounts[$key] }})</span>
    </a>
    @endforeach
</div>

{{-- Search --}}
<form method="GET" class="flex gap-3 mb-5">
    <input type="hidden" name="status" value="{{ request('status') }}">
    <input type="text" name="search" value="{{ request('search') }}" class="form-input max-w-sm" placeholder="Search name, phone, email...">
    <button type="submit" class="btn-primary">Search</button>
    @if(request('search'))<a href="{{ route('admin.appointments.index') }}" class="btn-outline">Clear</a>@endif
</form>

<div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
    <div class="table-scroll"><table class="admin-table w-full" data-no-datatable="true">
        <thead><tr><th>Patient</th><th>Phone</th><th>Service</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        @forelse($appointments as $appt)
        <tr>
            <td>
                <div class="font-medium" style="color:var(--primary)">{{ $appt->full_name }}</div>
                @if($appt->email)<div class="text-xs" style="color:var(--muted)">{{ $appt->email }}</div>@endif
            </td>
            <td><a href="tel:{{ $appt->phone }}" style="color:var(--primary);text-decoration:none">{{ $appt->phone }}</a></td>
            <td class="text-xs" style="color:var(--muted)">{{ $appt->service ?? '—' }}</td>
            <td class="text-xs" style="color:var(--muted)">
                {{ $appt->preferred_date?->format('M d, Y') ?? '—' }}
                @if($appt->preferred_time)<br>{{ $appt->preferred_time }}@endif
            </td>
            <td>
                <span class="badge {{ match($appt->status){
                    'pending'  =>'badge-yellow',
                    'confirmed'=>'badge-green',
                    'cancelled'=>'badge-red',
                    'completed'=>'badge-blue',
                    default    =>'badge-gray'
                } }}">{{ ucfirst($appt->status) }}</span>
            </td>
            <td>
                <div class="flex gap-2">
                    <a href="{{ route('admin.appointments.show',$appt) }}" class="badge badge-blue" style="text-decoration:none">View</a>
                    <form action="{{ route('admin.appointments.destroy',$appt) }}" method="POST" onsubmit="return confirm('Delete appointment?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="badge badge-red border-0 cursor-pointer">Del</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-10" style="color:var(--muted)">No appointments found.</td></tr>
        @endforelse
        </tbody>
    </table></div>
</div>
<div class="mt-4">{{ $appointments->links() }}</div>
@endsection
