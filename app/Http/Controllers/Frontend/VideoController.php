<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use App\Models\SiteSetting;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $seo = SeoMeta::forPage('videos');
        $settings = SiteSetting::getAll();
        $categories = Video::active()->ordered()->get()->groupBy('category');

        $selectedCategory = $request->query('category');
        if (! $selectedCategory || ! $categories->has($selectedCategory)) {
            $selectedCategory = $categories->keys()->first();
        }

        $selectedVideos = $categories->get($selectedCategory, collect());
        $featuredVideos = Video::active()->where('is_featured', true)->ordered()->take(4)->get();

        return view('frontend.videos', compact('seo', 'settings', 'categories', 'selectedCategory', 'selectedVideos', 'featuredVideos'));
    }

    public function category(string $category)
    {
        $seo = SeoMeta::forPage('videos');
        $settings = SiteSetting::getAll();
        $categories = Video::active()->ordered()->get()->groupBy('category');

        $selectedCategory = collect($categories->keys())
            ->first(fn ($name) => Str::slug($name) === $category);

        abort_if(! $selectedCategory, 404);

        $categoryVideos = $categories->get($selectedCategory, collect());

        return view('frontend.video-category', compact('seo', 'settings', 'categories', 'selectedCategory', 'categoryVideos'));
    }

    public function show(Video $video)
    {
        abort_if(! $video->is_active, 404);

        $seo = SeoMeta::forPage('videos');
        $settings = SiteSetting::getAll();
        $relatedVideos = Video::active()
            ->where('category', $video->category)
            ->whereKeyNot($video->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('frontend.video-detail', compact('seo', 'settings', 'video', 'relatedVideos'));
    }
}