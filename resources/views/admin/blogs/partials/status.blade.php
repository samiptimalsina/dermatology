<form action="{{ route('admin.blogs.toggle', $blog) }}" method="POST" class="inline">
    @csrf @method('PATCH')
    <button type="submit" class="badge {{ $blog->is_published ? 'badge-green' : 'badge-yellow' }} cursor-pointer border-0 bg-transparent p-0">
        {{ $blog->is_published ? 'Published' : 'Draft' }}
    </button>
</form>