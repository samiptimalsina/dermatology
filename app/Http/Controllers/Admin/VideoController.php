<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::ordered()->paginate(20);

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        $categories = Video::query()->whereNotNull('category')->where('category', '!=', '')
            ->distinct()->orderBy('category')->pluck('category');

        return view('admin.videos.form', ['video' => new Video, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        Video::create($this->validated($request));

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video created successfully.');
    }

    public function edit(Video $video)
    {
        $categories = Video::query()->whereNotNull('category')->where('category', '!=', '')
            ->distinct()->orderBy('category')->pluck('category');

        return view('admin.videos.form', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $video->update($this->validated($request));

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Video deleted.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'new_category' => 'nullable|string|max:100|required_if:category,__new__',
            'description' => 'nullable|string',
            'video_url' => 'required|url|max:2048',
            'thumbnail_url' => 'nullable|url|max:2048',
            'duration' => 'nullable|string|max:20',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        if ($validated['category'] === '__new__') {
            $validated['category'] = $validated['new_category'];
        }
        unset($validated['new_category']);
        $validated['thumbnail_url'] = $validated['thumbnail_url']
            ?: Video::youtubeThumbnailFromUrl($validated['video_url']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
