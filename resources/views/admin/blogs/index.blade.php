@extends('layouts.admin')
@section('title','Blog Posts')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm" style="color:var(--muted)">{{ $totalBlogs }} posts total</p>
    <a href="{{ route('admin.blogs.create') }}" class="btn-primary">+ New Post</a>
</div>
<div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
    <table id="blogs-table" class="admin-table w-full" data-server-side="true">
        <thead><tr><th>Image</th><th>Title</th><th>Category</th><th>Author</th><th>Published</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = Array.from(document.querySelectorAll('#blogs-table')).find(function (element) {
            return element.getClientRects().length > 0;
        });
        if (!table) return;

        if (window.DataTable && DataTable.isDataTable && DataTable.isDataTable(table)) return;

        new DataTable(table, {
            processing: true,
            serverSide: true,
            ajax: @json(route('admin.blogs.index')),
            pageLength: 15,
            lengthMenu: [10, 15, 25, 50],
            order: [[4, 'desc']],
            columns: [
                { data: 'image', name: 'thumbnail', orderable: false, searchable: false },
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'author', name: 'author' },
                { data: 'published_at', name: 'published_at' },
                { data: 'status', name: 'is_published', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });
    });
    document.addEventListener('admin:content-synced', function () {
        if (window.innerWidth < 1024) document.dispatchEvent(new Event('DOMContentLoaded'));
    });
</script>
@endpush
