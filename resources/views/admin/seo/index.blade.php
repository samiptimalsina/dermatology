@extends('layouts.admin')
@section('title','SEO Meta')
@section('content')
<p class="text-sm mb-6" style="color:var(--muted)">Manage SEO meta tags for each page. These control how your site appears in Google search results and social media shares.</p>
<div class="flex items-center justify-between gap-4 mb-4">
    <div>
        <h2 class="text-xl font-semibold" style="color:var(--text)">Pages</h2>
        <p class="text-sm mt-1" style="color:var(--muted)">Site SEO pages and custom pages are listed together.</p>
    </div>
    <a href="{{ route('admin.seo.custom-pages.create') }}" class="btn-primary whitespace-nowrap">Add Custom Page</a>
</div>
<div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
    <div class="table-scroll"><table class="admin-table w-full">
        <thead><tr><th>Page</th><th>URL</th><th>Type</th><th>Status</th><th>Meta Title</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach($pages as $page)
        <tr>
            <td>{{ ucwords(str_replace('_', ' ', $page->page)) }}</td>
            <td><code>/{{ $page->slug === 'home' ? '' : $page->slug }}</code></td>
            <td><span class="badge badge-blue">SEO Page</span></td>
            <td>@if($page->no_index)<span class="badge badge-red">No Index</span>@else<span class="badge badge-green">Indexed</span>@endif</td>
            <td style="max-width:300px;color:var(--primary)">{{ Str::limit($page->meta_title, 60) }}</td>
            <td><a href="{{ route('admin.seo.edit', $page) }}" class="badge badge-blue" style="text-decoration:none">Edit SEO</a></td>
        </tr>
        @endforeach
        @foreach($customPages as $customPage)
        <tr>
            <td>{{ $customPage->title }}</td>
            <td><code>/{{ $customPage->slug }}</code></td>
            <td><span class="badge badge-accent">Custom Page</span></td>
            <td>
                @if($customPage->is_published)<span class="badge badge-green">Published</span>@else<span class="badge badge-gray">Draft</span>@endif
                @if($customPage->no_index)<span class="badge badge-red">No Index</span>@endif
            </td>
            <td style="max-width:300px;color:var(--primary)">{{ Str::limit($customPage->meta_title ?: $customPage->title, 60) }}</td>
            <td class="flex items-center gap-2">
                <a href="{{ route('admin.seo.custom-pages.edit', $customPage) }}" class="badge badge-blue" style="text-decoration:none">Edit</a>
                @if($customPage->is_published)
                <a href="{{ route('custom-pages.show', $customPage) }}" class="badge badge-gray" style="text-decoration:none" target="_blank" rel="noopener">View</a>
                @endif
                <form action="{{ route('admin.seo.custom-pages.destroy', $customPage) }}" method="POST" onsubmit="return confirm('Delete this custom page?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table></div>
</div>
@endsection
