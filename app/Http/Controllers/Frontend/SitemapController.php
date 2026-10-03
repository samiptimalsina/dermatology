<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CustomPage;
use App\Models\Service;
use App\Models\Video;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();
        $seenUrls = [];

        $addUrl = function (string $url, float $priority, string $changeFrequency, ?\DateTimeInterface $lastModified = null) use (&$seenUrls, $sitemap) {
            $normalized = rtrim($url, '/');
            if ($normalized === '' || in_array($normalized, $seenUrls, true)) {
                return;
            }

            $seenUrls[] = $normalized;

            $tag = Url::create($url)
                ->setPriority($priority)
                ->setChangeFrequency($changeFrequency);

            if ($lastModified) {
                $tag->setLastModificationDate($lastModified);
            }

            $sitemap->add($tag);
        };

        // Static pages
        $addUrl(route('home'), 1.0, 'weekly');
        $addUrl(route('about'), 0.8, 'monthly');
        $addUrl(route('our-services.index').'/', 0.9, 'weekly');
        $addUrl(route('blog'), 0.8, 'daily');
        $addUrl(route('gallery'), 0.7, 'monthly');
        $addUrl(route('videos'), 0.7, 'weekly');
        $addUrl(route('contact'), 0.7, 'monthly');
        $addUrl(route('privacy-policy'), 0.5, 'yearly');
        $addUrl(route('terms-and-conditions'), 0.5, 'yearly');

        Service::active()->ordered()->get()->each(function (Service $service) use ($addUrl) {
            $addUrl(route('our-services.show', $service).'/', 0.8, 'monthly', $service->updated_at);
        });

        Blog::published()->latest()->get()->each(function (Blog $blog) use ($addUrl) {
            $addUrl(route('blog.show', $blog), 0.7, 'monthly', $blog->updated_at);
        });

        Video::active()->ordered()->get()->each(function (Video $video) use ($addUrl) {
            $addUrl(route('videos.show', $video), 0.6, 'monthly', $video->updated_at);
        });

        CustomPage::query()
            ->where('is_published', true)
            ->where('no_index', false)
            ->get()
            ->each(function (CustomPage $customPage) use ($addUrl) {
                $addUrl(route('custom-pages.show', $customPage), 0.6, 'monthly', $customPage->updated_at);
            });

        return $sitemap->toResponse(request());
    }

    public function indexPage()
    {
        $sitemapIndex = SitemapIndex::create();
        $sitemapIndex->add(route('sitemap'));

        return $sitemapIndex->toResponse(request());
    }
}
