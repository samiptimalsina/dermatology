<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            return DataTables::eloquent(Blog::query()->latest())
                ->addColumn('image', fn (Blog $blog) => '<img src="'.e($blog->thumbnail_url).'" alt="" class="w-12 h-12 rounded-lg object-cover">')
                ->addColumn('actions', function (Blog $blog) {
                    return view('admin.blogs.partials.actions', compact('blog'))->render();
                })
                ->editColumn('title', fn (Blog $blog) => e(Str::limit($blog->title, 50)))
                ->editColumn('category', fn (Blog $blog) => '<span class="badge badge-gray">'.e($blog->category).'</span>')
                ->editColumn('author', fn (Blog $blog) => '<span class="text-xs" style="color:var(--muted)">'.e($blog->author).'</span>')
                ->editColumn('published_at', fn (Blog $blog) => '<span class="text-xs" style="color:var(--muted)">'.e($blog->published_at?->format('M d, Y') ?? '—').'</span>')
                ->addColumn('status', function (Blog $blog) {
                    return view('admin.blogs.partials.status', compact('blog'))->render();
                })
                ->rawColumns(['image', 'category', 'author', 'published_at', 'status', 'actions'])
                ->toJson();
        }

        return view('admin.blogs.index', ['totalBlogs' => Blog::count()]);
    }

    public function create()
    {
        $categories = $this->getActiveCategories();
        return view('admin.blogs.form', ['blog' => new Blog, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateBlog($request);
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = $this->getActiveCategories();
        return view('admin.blogs.form', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $this->validateBlog($request, $blog->id);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        if ($validated['is_published'] && ! $blog->published_at) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted.');
    }

    public function togglePublished(Blog $blog)
    {
        $data = ['is_published' => ! $blog->is_published];
        if ($data['is_published'] && ! $blog->published_at) {
            $data['published_at'] = now();
        }
        $blog->update($data);
        return back()->with('success', 'Blog publish status updated.');
    }

    private function getActiveCategories(): array
    {
        if (! Schema::hasTable('blog_categories')) {
            return [
                (object) ['name' => 'Skin Care', 'is_active' => true],
                (object) ['name' => 'Hair Care', 'is_active' => true],
                (object) ['name' => 'Laser Treatment', 'is_active' => true],
                (object) ['name' => 'Acne', 'is_active' => true],
                (object) ['name' => 'Anti-Aging', 'is_active' => true],
                (object) ['name' => 'Medical Dermatology', 'is_active' => true],
                (object) ['name' => 'General Dermatology', 'is_active' => true],
                (object) ['name' => 'Before & After', 'is_active' => true],
            ];
        }

        return BlogCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->all();
    }

    private function validateBlog(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'            => 'required|string|max:300',
            'category'         => 'required|string|max:100',
            'excerpt'          => 'required|string|max:500',
            'content'          => 'required|string',
            'author'           => 'required|string|max:100',
            'thumbnail'        => 'nullable|image|max:2048',
            'meta_title'       => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:300',
            'is_featured'      => 'boolean',
            'is_published'     => 'boolean',
        ]);
    }
}
