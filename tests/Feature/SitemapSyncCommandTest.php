<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\CustomPage;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SitemapSyncCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_service_and_blog_content_from_live_sitemap_urls_with_images(): void
    {
        Storage::fake('public');

        Http::fake([
            'https://drrajanskinclinic.com/sitemap_index.xml' => Http::response(
                <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>https://drrajanskinclinic.com/post-sitemap.xml</loc>
    </sitemap>
    <sitemap>
        <loc>https://drrajanskinclinic.com/service-sitemap.xml</loc>
    </sitemap>
    <sitemap>
        <loc>https://drrajanskinclinic.com/page-sitemap.xml</loc>
    </sitemap>
    <sitemap>
        <loc>https://drrajanskinclinic.com/post_tag-sitemap.xml</loc>
    </sitemap>
    <sitemap>
        <loc>https://drrajanskinclinic.com/attachment-sitemap.xml</loc>
    </sitemap>
    <sitemap>
        <loc>https://drrajanskinclinic.com/team-sitemap.xml</loc>
    </sitemap>
</sitemapindex>
XML
            ),
            'https://drrajanskinclinic.com/post-sitemap.xml' => Http::response(
                <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://drrajanskinclinic.com/laser-hair-removal-nepal/</loc>
    </url>
</urlset>
XML
            ),
            'https://drrajanskinclinic.com/page-sitemap.xml' => Http::response(
                <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://drrajanskinclinic.com/clinic-hours/</loc>
    </url>
    <url>
        <loc>https://drrajanskinclinic.com/wp-content/uploads/2024/01/doctor.jpg</loc>
    </url>
</urlset>
XML
            ),
            'https://drrajanskinclinic.com/post_tag-sitemap.xml' => Http::response(
                <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://drrajanskinclinic.com/laser-hair-removal-tag/</loc>
    </url>
</urlset>
XML
            ),
            'https://drrajanskinclinic.com/attachment-sitemap.xml' => Http::response(
                <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://drrajanskinclinic.com/?attachment_id=25</loc>
    </url>
    <url>
        <loc>https://drrajanskinclinic.com/our-services/laser-hair-reduction/laser-hair-reduction-1/</loc>
    </url>
</urlset>
XML
            ),
            'https://drrajanskinclinic.com/team-sitemap.xml' => Http::response(
                <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://drrajanskinclinic.com/team/member-1/</loc>
    </url>
</urlset>
XML
            ),
            'https://drrajanskinclinic.com/service-sitemap.xml' => Http::response(
                <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://drrajanskinclinic.com/our-services/laser-hair-reduction/</loc>
    </url>
</urlset>
XML
            ),
            'https://drrajanskinclinic.com/laser-hair-removal-nepal/' => Http::response(
                <<<'HTML'
<!doctype html>
<html><head>
<title>Laser Hair Removal in Nepal</title>
<meta name="description" content="Laser hair reduction in Nepal for smooth skin." />
</head><body>
<main>
    <h1>Laser Hair Removal in Nepal</h1>
    <p onclick="alert('xss')">Laser hair removal is a non-invasive cosmetic procedure for unwanted hair.</p>
    <script>alert('xss')</script>
    <img src="https://drrajanskinclinic.com/wp-content/uploads/2024/01/blog-thumb.jpg" alt="Laser hair removal in Nepal" />
    <img src="https://drrajanskinclinic.com/wp-content/uploads/2024/01/blog-detail.jpg" alt="Treatment detail" />
</main>
</body></html>
HTML,
                200,
                ['Content-Type' => 'text/html']
            ),
            'https://drrajanskinclinic.com/our-services/laser-hair-reduction/' => Http::response(
                <<<'HTML'
<!doctype html>
<html><head>
<title>Laser Hair Reduction</title>
<meta name="description" content="A safe laser hair reduction treatment by experts." />
</head><body>
<main>
    <h1>Laser Hair Reduction</h1>
    <p>Effective reduction of unwanted hair using advanced laser technology.</p>
    <img src="https://drrajanskinclinic.com/wp-content/uploads/2024/01/service-thumb.jpg" alt="Laser Hair Reduction" />
</main>
</body></html>
HTML,
                200,
                ['Content-Type' => 'text/html']
            ),
            'https://drrajanskinclinic.com/clinic-hours*' => Http::response(
                <<<'HTML'
<!doctype html>
<html><head>
<title>Clinic Hours</title>
<meta name="description" content="Opening hours for the clinic." />
</head><body>
<main><h1>Clinic Hours</h1><p>Open Monday through Friday.</p>
<img src="https://drrajanskinclinic.com/wp-content/uploads/2024/01/clinic.jpg" alt="Clinic" />
</main>
</body></html>
HTML,
                200,
                ['Content-Type' => 'text/html']
            ),
            'https://drrajanskinclinic.com/laser-hair-removal-tag*' => Http::response(
                '<html><head><title>Laser Hair Removal Tag Archives</title></head><body><main>Tag archive</main></body></html>',
                200,
                ['Content-Type' => 'text/html']
            ),
            'https://drrajanskinclinic.com/?attachment_id=25' => Http::response(
                '<html><body><main><img src="https://drrajanskinclinic.com/wp-content/uploads/2024/01/attachment.jpg" alt="Attachment" /></main></body></html>',
                200,
                ['Content-Type' => 'text/html']
            ),
            'https://drrajanskinclinic.com/our-services/laser-hair-reduction/laser-hair-reduction-1*' => Http::response(
                '<html><body><main><img src="https://drrajanskinclinic.com/wp-content/uploads/2024/01/attachment-extra.jpg" alt="Attachment" /></main></body></html>',
                200,
                ['Content-Type' => 'text/html']
            ),
            'https://drrajanskinclinic.com/team/member-1*' => Http::response(
                '<html><head><title>Member 1</title></head><body><main><h1>Member 1</h1><p>Post 1</p><img src="https://drrajanskinclinic.com/wp-content/uploads/2024/01/member.jpg" alt="Member 1" /></main></body></html>',
                200,
                ['Content-Type' => 'text/html']
            ),
            'https://drrajanskinclinic.com/wp-content/uploads/2024/01/blog-thumb.jpg' => Http::response('blog-image-content', 200, ['Content-Type' => 'image/jpeg']),
            'https://drrajanskinclinic.com/wp-content/uploads/2024/01/blog-detail.jpg' => Http::response('blog-detail-image-content', 200, ['Content-Type' => 'image/jpeg']),
            'https://drrajanskinclinic.com/wp-content/uploads/2024/01/service-thumb.jpg' => Http::response('service-image-content', 200, ['Content-Type' => 'image/jpeg']),
            'https://drrajanskinclinic.com/wp-content/uploads/2024/01/clinic.jpg' => Http::response('clinic-image-content', 200, ['Content-Type' => 'image/jpeg']),
            'https://drrajanskinclinic.com/wp-content/uploads/2024/01/attachment.jpg' => Http::response('attachment-image-content', 200, ['Content-Type' => 'image/jpeg']),
            'https://drrajanskinclinic.com/wp-content/uploads/2024/01/attachment-extra.jpg' => Http::response('attachment-extra-image-content', 200, ['Content-Type' => 'image/jpeg']),
            'https://drrajanskinclinic.com/wp-content/uploads/2024/01/member.jpg' => Http::response('member-image-content', 200, ['Content-Type' => 'image/jpeg']),
        ]);

        $this->artisan('drrajan:sync-content', ['--source' => 'https://drrajanskinclinic.com/sitemap_index.xml'])
            ->expectsOutputToContain('Found 7 public URLs to sync.')
            ->expectsOutputToContain('attachment image')
            ->assertSuccessful();

        Http::assertSent(fn ($request) => str_contains($request->url(), 'clinic-hours'));
        Http::assertNotSent(fn ($request) => str_contains($request->url(), 'laser-hair-removal-tag'));
        Http::assertSent(fn ($request) => str_contains($request->url(), 'attachment_id=25'));
        Http::assertSent(fn ($request) => str_contains($request->url(), 'laser-hair-reduction-1'));
        Http::assertSent(fn ($request) => str_contains($request->url(), 'team/member-1'));

        $this->assertDatabaseHas('services', ['slug' => 'laser-hair-reduction']);
        $this->assertDatabaseHas('blogs', ['slug' => 'laser-hair-removal-nepal']);
        $this->assertDatabaseCount('services', 1);
        $this->assertDatabaseCount('blogs', 1);
        $this->assertDatabaseHas('custom_pages', ['slug' => 'clinic-hours']);
        $this->assertDatabaseCount('custom_pages', 1);
        $this->assertDatabaseCount('team_members', 1);
        $this->assertDatabaseHas('team_members', ['name' => 'Member 1']);

        $service = Service::query()->where('slug', 'laser-hair-reduction')->firstOrFail();
        $blog = Blog::query()->where('slug', 'laser-hair-removal-nepal')->firstOrFail();
        $page = CustomPage::query()->where('slug', 'clinic-hours')->firstOrFail();

        $this->assertNotEmpty($service->image);
        $this->assertNotEmpty($blog->thumbnail);
        $this->assertTrue(Storage::disk('public')->exists($service->image));
        $this->assertTrue(Storage::disk('public')->exists($blog->thumbnail));
        $this->assertStringContainsString('/storage/blogs/', $blog->content);
        $this->assertStringNotContainsString('<script', $blog->content);
        $this->assertStringNotContainsString('onclick=', $blog->content);
        $this->assertStringContainsString('/storage/services/', $service->full_description);
        $this->assertStringContainsString('/storage/pages/', $page->content);
        $this->assertSame(2, count(Storage::disk('public')->allFiles('blogs')));
        $this->assertSame(1, count(Storage::disk('public')->allFiles('services')));
        $this->assertSame(1, count(Storage::disk('public')->allFiles('pages')));
        $this->assertSame(2, count(Storage::disk('public')->allFiles('attachments')));
        $this->assertSame(1, count(Storage::disk('public')->allFiles('team')));
    }
}
