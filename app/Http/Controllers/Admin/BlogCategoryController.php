<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = Schema::hasTable('blog_categories')
            ? BlogCategory::orderBy('sort_order')->orderBy('name')->get()
            : collect();

        return view('admin.blog-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        if (! Schema::hasTable('blog_categories')) {
            return back()->with('error', 'Blog categories table has not been migrated yet. Run php artisan migrate first.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:blog_categories,name',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        BlogCategory::create($validated);

        return back()->with('success', 'Blog category created successfully.');
    }

    public function update(Request $request, BlogCategory $category)
    {
        if (! Schema::hasTable('blog_categories')) {
            return back()->with('error', 'Blog categories table has not been migrated yet. Run php artisan migrate first.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:blog_categories,name,' . $category->id,
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $category->update($validated);

        return back()->with('success', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $category)
    {
        if (! Schema::hasTable('blog_categories')) {
            return back()->with('error', 'Blog categories table has not been migrated yet. Run php artisan migrate first.');
        }

        $category->delete();

        return back()->with('success', 'Blog category deleted successfully.');
    }
}
