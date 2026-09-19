@extends('layouts.admin')
@section('title','Blog Categories')
@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm" style="color:var(--muted)">Manage blog categories used in article listings and filters.</p>
        </div>
        <a href="{{ route('admin.blogs.index') }}" class="btn-outline">Back to Blogs</a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[1.2fr_0.8fr] gap-6">
        <div class="bg-white rounded-2xl shadow-sm overflow-x-auto border" style="border-color:var(--border)">
            <div class="px-5 py-4 border-b" style="border-color:var(--border); background:var(--primary-light)">
                <h2 class="font-bold text-lg" style="color:var(--dark)">Category List</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="admin-table w-full min-w-[560px]">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="font-medium" style="color:var(--primary)">{{ $category->name }}</td>
                                <td class="text-xs" style="color:var(--muted)">{{ $category->slug }}</td>
                                <td>
                                    <span class="badge {{ $category->is_active ? 'badge-green' : 'badge-red' }}">
                                        {{ $category->is_active ? 'Active' : 'Hidden' }}
                                    </span>
                                </td>
                                <td class="text-xs" style="color:var(--muted)">{{ $category->sort_order }}</td>
                                <td>
                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" class="badge badge-blue border-0 cursor-pointer" onclick="fillCategoryForm({{ $category->toJson() }})">Edit</button>
                                        <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12" style="color:var(--muted)">No categories yet. Add one from the form.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-5" style="border-color:var(--border)">
            <h2 class="font-bold text-lg mb-4" style="color:var(--dark)" id="category-form-title">Add Category</h2>

            <form id="category-form" method="POST" action="{{ route('admin.blog-categories.store') }}">
                @csrf
                <input type="hidden" name="_method" id="category-method" value="POST">
                <input type="hidden" name="category_id" id="category-id" value="">

                <div class="space-y-4">
                    <div>
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" id="category-name" class="form-input" placeholder="Example: Skin Care" required>
                    </div>

                    <div>
                        <label class="form-label">Description</label>
                        <textarea name="description" id="category-description" rows="3" class="form-input resize-none" placeholder="Short description (optional)"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" id="category-sort" class="form-input" min="0" value="0">
                        </div>
                        <div class="flex items-center pt-7">
                            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="category-active" value="1" checked>
                                Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 mt-5">
                    <button type="submit" class="btn-primary" id="category-submit-btn">Save Category</button>
                    <button type="button" class="btn-outline" id="category-reset-btn">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function fillCategoryForm(category) {
        const form = document.getElementById('category-form');
        const title = document.getElementById('category-form-title');
        const method = document.getElementById('category-method');
        const id = document.getElementById('category-id');
        const submitBtn = document.getElementById('category-submit-btn');

        form.action = '/admin/blog-categories/' + category.id;
        method.value = 'PUT';
        id.value = category.id;
        document.getElementById('category-name').value = category.name || '';
        document.getElementById('category-description').value = category.description || '';
        document.getElementById('category-sort').value = category.sort_order || 0;
        document.getElementById('category-active').checked = category.is_active === 1 || category.is_active === true;
        title.textContent = 'Edit Category';
        submitBtn.textContent = 'Update Category';
    }

    document.getElementById('category-reset-btn')?.addEventListener('click', function () {
        const form = document.getElementById('category-form');
        form.action = '{{ route('admin.blog-categories.store') }}';
        document.getElementById('category-method').value = 'POST';
        document.getElementById('category-id').value = '';
        document.getElementById('category-name').value = '';
        document.getElementById('category-description').value = '';
        document.getElementById('category-sort').value = 0;
        document.getElementById('category-active').checked = true;
        document.getElementById('category-form-title').textContent = 'Add Category';
        document.getElementById('category-submit-btn').textContent = 'Save Category';
    });
</script>
@endsection
