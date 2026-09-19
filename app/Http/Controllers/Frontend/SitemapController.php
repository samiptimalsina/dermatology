<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Service;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Static pages
        $sitemap->add(Url::create(route('home'))->setPriority(1.0)->setChangeFrequency('weekly'));
        $sitemap->add(Url::create(route('services'))->setPriority(0.9)->setChangeFrequency('weekly'));
        $sitemap->add(Url::create(route('about'))->setPriority(0.8)->setChangeFrequency('monthly'));
        $sitemap->add(Url::create(route('blog'))->setPriority(0.8)->setChangeFrequency('daily'));
        $sitemap->add(Url::create(route('contact'))->setPriority(0.7)->setChangeFrequency('monthly'));

        // Services
        Service::active()->get()->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create(route('services.show', $service))
                    ->setPriority(0.8)
                    ->setChangeFrequency('monthly')
                    ->setLastModificationDate($service->updated_at)
            );
        });

        // Blogs
        Blog::published()->get()->each(function (Blog $blog) use ($sitemap) {
            $sitemap->add(
                Url::create(route('blog.show', $blog))
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
                    ->setLastModificationDate($blog->updated_at)
            );
        });

        return $sitemap->toResponse(request());
    }
}
