@extends('layouts.admin')
@section('title','SEO Meta')
@section('content')
<p class="text-sm mb-6" style="color:var(--muted)">Manage SEO meta tags for each page. These control how your site appears in Google search results and social media shares.</p>
<div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
    <div class="table-scroll"><table class="admin-table w-full">
        <thead><tr><th>Page</th><th>Meta Title</th><th>No Index</th><th>Action</th></tr></thead>
        <tbody>
        @foreach($pages as $page)
        <tr>
            <td><span class="badge badge-blue">{{ ucfirst($page->page) }}</span></td>
            <td style="max-width:300px;color:var(--primary)">{{ Str::limit($page->meta_title,60) }}</td>
            <td>@if($page->no_index)<span class="badge badge-red">No Index</span>@else<span class="badge badge-green">Indexed</span>@endif</td>
            <td><a href="{{ route('admin.seo.edit',$page) }}" class="badge badge-blue" style="text-decoration:none">Edit</a></td>
        </tr>
        @endforeach
        </tbody>
    </table></div>
</div>
@endsection
