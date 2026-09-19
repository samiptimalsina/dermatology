@extends('layouts.admin')
@section('title','Dashboard')

@section('content')

{{-- ── Stat cards ── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @foreach([
        ['label'=>'Total Appointments', 'value'=>$stats['total_appointments'], 'sub'=>$stats['pending_appointments'].' pending',   'color'=>'var(--primary)', 'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['label'=>'Active Services',    'value'=>$stats['active_services'],    'sub'=>$stats['total_services'].' total',           'color'=>'var(--accent)',  'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
        ['label'=>'Published Blogs',    'value'=>$stats['published_blogs'],    'sub'=>$stats['total_blogs'].' total',              'color'=>'var(--primary)', 'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
        ['label'=>'Testimonials',       'value'=>$stats['total_testimonials'], 'sub'=>'patient reviews',                          'color'=>'var(--accent)',  'icon'=>'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
    ] as $card)
    <div class="stat-card" style="border-left-color:{{ $card['color'] }}">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-sm mb-1" style="color:var(--muted)">{{ $card['label'] }}</div>
                <div class="text-3xl font-bold" style="color:var(--dark);font-family:'Playfair Display',serif">{{ $card['value'] }}</div>
                <div class="text-xs mt-1 font-semibold" style="color:{{ $card['color'] }}">{{ $card['sub'] }}</div>
            </div>
            <div class="w-11 h-11 rounded-xl flex items-center justify-center"
                 style="background:{{ $card['color'] === 'var(--primary)' ? 'var(--primary-light)' : 'var(--accent-light)' }}">
                <svg class="w-5 h-5" style="color:{{ $card['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
                </svg>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- ── Quick actions ── --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-8">
    @foreach([
        ['label'=>'New Service',    'href'=>route('admin.services.create'),     'bg'=>'var(--primary)'],
        ['label'=>'New Blog Post',  'href'=>route('admin.blogs.create'),        'bg'=>'var(--primary-dark)'],
        ['label'=>'Add Testimonial','href'=>route('admin.testimonials.create'), 'bg'=>'var(--accent)'],
        ['label'=>'Upload Gallery', 'href'=>route('admin.gallery.index'),       'bg'=>'var(--accent-dark)'],
        ['label'=>'Before/After',   'href'=>route('admin.before-afters.create'),'bg'=>'var(--primary)'],
        ['label'=>'View Site',      'href'=>route('home'),                       'bg'=>'var(--dark)', 'blank'=>true],
    ] as $action)
    <a href="{{ $action['href'] }}" {{ isset($action['blank']) ? 'target=_blank' : '' }}
       class="flex items-center justify-center py-2.5 px-3 rounded-xl text-xs font-semibold text-white transition hover:opacity-85 hover:-translate-y-0.5"
       style="background:{{ $action['bg'] }};box-shadow:0 3px 10px rgba(0,0,0,.12)">
        {{ $action['label'] }}
    </a>
    @endforeach
</div>

{{-- ── Tables row ── --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Recent appointments --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" style="border:1px solid var(--border)">
        <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color:var(--primary-light)">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full" style="background:var(--primary)"></div>
                <h2 class="font-bold text-sm" style="color:var(--dark)">Recent Appointments</h2>
            </div>
            <a href="{{ route('admin.appointments.index') }}" class="text-xs font-semibold"
               style="color:var(--accent)">View All →</a>
        </div>
        <div class="table-scroll"><table class="admin-table w-full" data-no-datatable="true">
            <thead>
                <tr>
                    <th>Patient</th><th>Phone</th><th>Service</th><th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentAppointments as $appt)
                <tr>
                    <td class="font-medium" style="color:var(--dark)">{{ $appt->full_name }}</td>
                    <td>{{ $appt->phone }}</td>
                    <td class="text-xs" style="color:var(--muted)">{{ $appt->service ?? '—' }}</td>
                    <td>
                        <span class="badge {{ match($appt->status){
                            'pending'  =>'badge-yellow',
                            'confirmed'=>'badge-green',
                            'cancelled'=>'badge-red',
                            'completed'=>'badge-blue',
                            default    =>'badge-gray'
                        } }}">{{ ucfirst($appt->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-8 text-sm" style="color:var(--muted)">No appointments yet</td></tr>
                @endforelse
            </tbody>
        </table></div>
    </div>

    {{-- Recent blogs --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" style="border:1px solid var(--border)">
        <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color:var(--primary-light)">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full" style="background:var(--accent)"></div>
                <h2 class="font-bold text-sm" style="color:var(--dark)">Recent Blog Posts</h2>
            </div>
            <a href="{{ route('admin.blogs.index') }}" class="text-xs font-semibold"
               style="color:var(--accent)">View All →</a>
        </div>
        <div class="table-scroll"><table class="admin-table w-full" data-no-datatable="true">
            <thead>
                <tr><th>Title</th><th>Category</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($recentBlogs as $blog)
                <tr>
                    <td>
                        <a href="{{ route('admin.blogs.edit',$blog) }}" class="font-medium hover:underline"
                           style="color:var(--dark);text-decoration:none">{{ Str::limit($blog->title,42) }}</a>
                    </td>
                    <td><span class="badge badge-accent">{{ $blog->category }}</span></td>
                    <td>
                        <span class="badge {{ $blog->is_published ? 'badge-green' : 'badge-yellow' }}">
                            {{ $blog->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-8 text-sm" style="color:var(--muted)">No blog posts yet</td></tr>
                @endforelse
            </tbody>
        </table></div>
    </div>
</div>

@endsection
