<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\SeoMeta;
use App\Models\SiteSetting;

class BlogController extends Controller
{
    public function index()
    {
        $seo      = SeoMeta::forPage('blog');
        $settings = SiteSetting::getAll();

        $blogs = Blog::published()->latest()->paginate(9);

        return view('frontend.blog', compact('seo', 'settings', 'blogs'));
    }

    public function show(Blog $blog)
    {
        abort_if(! $blog->is_published, 404);

        $settings    = SiteSetting::getAll();
        $recentBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.blog-detail', compact('blog', 'settings', 'recentBlogs'));
    }
}
