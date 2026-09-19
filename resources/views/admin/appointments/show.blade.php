@extends('layouts.admin')
@section('title','Appointment Details')
@section('content')
<div class="w-full max-w-5xl mx-auto">
    <a href="{{ route('admin.appointments.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back</a>

    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
        <h2 class="font-bold text-xl mb-4" style="color:var(--primary)">{{ $appointment->full_name }}</h2>
        <dl class="grid grid-cols-2 gap-4 text-sm">
            @foreach(['Phone'=>$appointment->phone,'Email'=>$appointment->email??'—','Service'=>$appointment->service??'—','Preferred Date'=>$appointment->preferred_date?->format('F d, Y')??'—','Preferred Time'=>$appointment->preferred_time??'—','Submitted'=>$appointment->created_at->format('M d, Y H:i')] as $label=>$value)
            <div><dt class="font-semibold" style="color:var(--muted)">{{ $label }}</dt><dd style="color:var(--primary)">{{ $value }}</dd></div>
            @endforeach
        </dl>
        @if($appointment->message)
        <div class="mt-4 p-4 rounded-xl text-sm" style="background:var(--primary-light);color:var(--text)">
            <strong>Message:</strong> {{ $appointment->message }}
        </div>
        @endif
    </div>

    <form action="{{ route('admin.appointments.status',$appointment) }}" method="POST"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-4">
        @csrf @method('PATCH')
        <h3 class="font-bold" style="color:var(--primary)">Update Status</h3>
        <div>
            <label class="form-label">Status</label>
            <select name="status" class="form-input">
                @foreach(['pending','confirmed','cancelled','completed'] as $s)
                <option value="{{ $s }}" {{ $appointment->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label">Admin Notes</label>
            <textarea name="admin_notes" rows="3" class="form-input resize-none">{{ $appointment->admin_notes }}</textarea>
        </div>
        <button type="submit" class="btn-primary">Update Appointment</button>
    </form>
</div>
@endsection
