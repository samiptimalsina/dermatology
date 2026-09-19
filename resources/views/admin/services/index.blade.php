@extends('layouts.admin')
@section('title','Services')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm" style="color:var(--muted)">{{ $totalServices }} services total</p>
    <a href="{{ route('admin.services.create') }}" class="btn-primary">+ Add Service</a>
</div>

<div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
    <table id="services-table" class="admin-table w-full" data-server-side="true">
        <thead><tr><th>Image</th><th>Title</th><th>Category</th><th>Featured</th><th>Status</th><th>Order</th><th>Actions</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = Array.from(document.querySelectorAll('#services-table')).find(function (element) {
            return element.getClientRects().length > 0;
        });
        if (!table) return;

        if (window.DataTable && DataTable.isDataTable && DataTable.isDataTable(table)) return;

        new DataTable(table, {
            processing: true,
            serverSide: true,
            ajax: @json(route('admin.services.index')),
            pageLength: 15,
            lengthMenu: [10, 15, 25, 50],
            order: [[4, 'asc']],
            columns: [
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'is_featured', name: 'is_featured', orderable: false },
                { data: 'is_active', name: 'is_active', orderable: false, searchable: false },
                { data: 'sort_order', name: 'sort_order' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
    document.addEventListener('admin:content-synced', function () {
        if (window.innerWidth < 1024) document.dispatchEvent(new Event('DOMContentLoaded'));
    });
</script>
@endpush
