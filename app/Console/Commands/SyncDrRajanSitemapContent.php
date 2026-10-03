<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\CustomPage;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncDrRajanSitemapContent extends Command
{
    protected $signature = 'drrajan:sync-content {--source=https://drrajanskinclinic.com/sitemap_index.xml} {--limit=200} {--dry-run}';

    protected $description = 'Import live sitemap URLs into the local service and blog tables, including image downloads.';

    public function handle(): int
    {
        $source = $this->option('source');
        $limit = max(1, (int) $this->option('limit'));
        $dryRun = $this->option('dry-run');

        $urls = $this->collectUrls($source, $limit);

        if ($urls === []) {
            $this->warn('No URLs were found in the sitemap source.');

            return 1;
        }

        $this->info('Found '.count($urls).' public URLs to sync.');

        foreach ($urls as $entry) {
            $url = $entry['url'];
            $path = parse_url($url, PHP_URL_PATH) ?: '/';

            if ($entry['type'] === 'service' || str_contains($path, '/our-services/')) {
                $this->syncService($url, $dryRun);

                continue;
            }

            if ($entry['type'] === 'blog') {
                $this->syncBlog($url, $dryRun);

                continue;
            }

            if ($entry['type'] === 'page' && $this->isImportablePage($path)) {
                $this->syncPage($url, $dryRun);

                continue;
            }

            if ($entry['type'] === 'attachment') {
                $this->syncAttachmentImages($url, $dryRun);

                continue;
            }

            if ($entry['type'] === 'team') {
                $this->syncTeamMember($url, $dryRun);

                continue;
            }

            if ($entry['type'] === null) {
                $this->warn('Skipped URL from an unrecognized sitemap: '.$url);
            }
        }

        return 0;
    }

    private function collectUrls(string $source, int $limit): array
    {
        $queue = [[$source, $this->getSitemapType($source)]];
        $seenSitemaps = [];
        $urls = [];

        while ($queue !== [] && count($urls) < $limit) {
            [$current, $type] = array_shift($queue);
            $current = rtrim($current, '/');

            if ($current === '' || isset($seenSitemaps[$current])) {
                continue;
            }

            $seenSitemaps[$current] = true;
            $response = Http::timeout(30)->get($current);

            if ($response->failed()) {
                $this->warn('Unable to fetch sitemap: '.$current);

                continue;
            }

            $xml = simplexml_load_string($response->body());
            if ($xml === false) {
                continue;
            }

            $sitemaps = $xml->children('http://www.sitemaps.org/schemas/sitemap/0.9');

            if ($xml->getName() === 'sitemapindex') {
                foreach ($sitemaps->sitemap as $sitemap) {
                    $sitemapUrl = (string) $sitemap->loc;
                    if ($sitemapUrl !== '') {
                        $queue[] = [$sitemapUrl, $this->getSitemapType($sitemapUrl)];
                    }
                }

                continue;
            }

            if ($xml->getName() !== 'urlset') {
                continue;
            }

            foreach ($sitemaps->url as $entry) {
                $url = rtrim((string) $entry->loc, '/');
                if ($url === '' || $this->isMediaUrl($url)) {
                    continue;
                }

                $urls[$url] ??= ['url' => $url, 'type' => $type];
            }
        }

        return array_values($urls);
    }

    private function getSitemapType(string $url): ?string
    {
        $filename = Str::lower(basename(parse_url($url, PHP_URL_PATH) ?: ''));

        if (preg_match('/^services?-sitemap\d*\.xml$/', $filename) === 1) {
            return 'service';
        }

        if (preg_match('/^posts?-sitemap\d*\.xml$/', $filename) === 1) {
            return 'blog';
        }

        if (preg_match('/^pages?-sitemap\d*\.xml$/', $filename) === 1) {
            return 'page';
        }

        if (preg_match('/^attachment-sitemap\d*\.xml$/', $filename) === 1) {
            return 'attachment';
        }

        if (preg_match('/^team-sitemap\d*\.xml$/', $filename) === 1) {
            return 'team';
        }

        return null;
    }

    private function isMediaUrl(string $url): bool
    {
        $extension = Str::lower(pathinfo(parse_url($url, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION));

        return in_array($extension, ['avif', 'gif', 'jpeg', 'jpg', 'pdf', 'png', 'svg', 'webp'], true);
    }

    private function isImportablePage(string $path): bool
    {
        $normalizedPath = '/'.trim($path, '/');
        $segments = array_filter(explode('/', trim($normalizedPath, '/')));

        return count($segments) === 1 && ! $this->isReservedFrontendRoute($normalizedPath);
    }

    private function isReservedFrontendRoute(string $path): bool
    {
        $reserved = [
            '/',
            '/about',
            '/about-us',
            '/blog',
            '/contact-us',
            '/contact',
            '/gallery',
            '/videos',
            '/appointment',
            '/book-appointment',
            '/privacy-policy',
            '/terms-and-conditions',
            '/our-services',
            '/services',
            '/team',
            '/robots.txt',
        ];

        return in_array('/'.trim($path, '/'), $reserved, true)
            || str_starts_with($path, '/category/')
            || str_starts_with($path, '/tag/')
            || str_starts_with($path, '/author/')
            || str_starts_with($path, '/wp-content/');
    }

    private function syncPage(string $url, bool $dryRun): void
    {
        $html = $this->fetchHtml($url);
        if ($html === null) {
            return;
        }

        $title = $this->extractTitle($html) ?: $this->slugToTitle($url);
        $slug = $this->extractSlugFromUrl($url);
        $description = $this->extractMetaDescription($html) ?: $this->extractTextSnippet($html, 180);
        $content = $this->extractMainContent($html) ?: '<p>'.e($description).'</p>';
        [$content] = $this->storeContentImages($content, $url, 'pages', $slug, $dryRun);

        if ($dryRun) {
            $this->info('DRY-RUN: would sync page '.$title);

            return;
        }

        CustomPage::updateOrCreate(['slug' => $slug], [
            'title' => $title,
            'content' => $content,
            'meta_title' => $title,
            'meta_description' => $description,
            'is_published' => true,
            'no_index' => false,
        ]);
        $this->info('Synced page: '.$title);
    }

    private function syncAttachmentImages(string $url, bool $dryRun): void
    {
        $html = $this->fetchHtml($url);
        if ($html === null) {
            return;
        }

        $content = $this->extractMainContent($html) ?? $html;
        $slug = $this->extractSlugFromUrl($url);
        [$content, $image] = $this->storeContentImages($content, $url, 'attachments', $slug, $dryRun);

        if ($image !== null) {
            $this->info(($dryRun ? 'DRY-RUN: would store attachment image ' : 'Stored attachment image ').$image);
        } else {
            $this->warn('No downloadable images found in attachment page: '.$url);
        }
    }

    private function syncTeamMember(string $url, bool $dryRun): void
    {
        $html = $this->fetchHtml($url);
        if ($html === null) {
            return;
        }

        $name = $this->extractPrimaryHeading($html) ?: $this->extractTitle($html) ?: $this->slugToTitle($url);
        $slug = $this->extractSlugFromUrl($url);
        $content = $this->extractMainContent($html) ?: '<p>'.e($name).'</p>';
        [$content, $photo] = $this->storeContentImages($content, $url, 'team', $slug, $dryRun);

        if ($dryRun) {
            $this->info('DRY-RUN: would sync team member '.$name);

            return;
        }

        TeamMember::updateOrCreate(['name' => $name], [
            'designation' => 'Team Member',
            'photo' => $photo,
            'bio' => $content,
            'sort_order' => TeamMember::query()->max('sort_order') + 1,
            'is_active' => true,
        ]);
        $this->info('Synced team member: '.$name);
    }

    private function syncService(string $url, bool $dryRun): void
    {
        $html = $this->fetchHtml($url);
        if ($html === null) {
            return;
        }

        $title = $this->extractTitle($html) ?: $this->slugToTitle($url);
        $slug = $this->extractSlugFromUrl($url);
        $description = $this->extractMetaDescription($html) ?: $this->extractTextSnippet($html, 180);
        $content = $this->extractMainContent($html) ?: '<p>'.e($description).'</p>';
        [$content, $storedImage] = $this->storeContentImages($content, $url, 'services', $slug, $dryRun);

        $payload = [
            'title' => $title,
            'slug' => $slug,
            'category' => $this->detectCategory($title),
            'icon' => $this->detectCategory($title),
            'image' => $storedImage,
            'short_description' => Str::limit(strip_tags($description), 180),
            'full_description' => $content,
            'meta_title' => $title.' | Dr. Rajan Tajhya Skin Clinic',
            'meta_description' => $description,
            'is_active' => true,
            'is_featured' => false,
            'sort_order' => Service::query()->max('sort_order') + 1,
        ];

        if ($dryRun) {
            $this->info('DRY-RUN: would sync service '.$title);

            return;
        }

        Service::updateOrCreate(['slug' => $slug], $payload);
        $this->info('Synced service: '.$title);
    }

    private function syncBlog(string $url, bool $dryRun): void
    {
        $html = $this->fetchHtml($url);
        if ($html === null) {
            return;
        }

        $title = $this->extractTitle($html) ?: $this->slugToTitle($url);
        $slug = $this->extractSlugFromUrl($url);
        $description = $this->extractMetaDescription($html) ?: $this->extractTextSnippet($html, 180);
        $content = $this->extractMainContent($html) ?: '<p>'.e($description).'</p>';
        [$content, $storedImage] = $this->storeContentImages($content, $url, 'blogs', $slug, $dryRun);

        $payload = [
            'title' => $title,
            'slug' => $slug,
            'category' => $this->detectCategory($title),
            'thumbnail' => $storedImage,
            'excerpt' => Str::limit(strip_tags($description), 180),
            'content' => $content,
            'author' => 'Dr. Rajan Tajhya',
            'meta_title' => $title.' | Dr. Rajan Tajhya',
            'meta_description' => $description,
            'is_featured' => false,
            'is_published' => true,
            'published_at' => now(),
        ];

        if ($dryRun) {
            $this->info('DRY-RUN: would sync blog '.$title);

            return;
        }

        Blog::updateOrCreate(['slug' => $slug], $payload);
        $this->info('Synced blog: '.$title);
    }

    private function fetchHtml(string $url): ?string
    {
        $response = Http::timeout(30)->get($url);

        if ($response->failed()) {
            $this->warn('Unable to fetch: '.$url);

            return null;
        }

        return $response->body();
    }

    private function extractTitle(string $html): ?string
    {
        preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $titleMatch);
        if (! isset($titleMatch[1])) {
            return null;
        }

        return trim(strip_tags($titleMatch[1]));
    }

    private function extractPrimaryHeading(string $html): ?string
    {
        $document = new \DOMDocument;
        libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8">'.$html);
        libxml_clear_errors();

        $heading = (new \DOMXPath($document))->query('//main//h1|//article//h1|//h1')->item(0);

        return $heading ? trim($heading->textContent) : null;
    }

    private function extractMetaDescription(string $html): ?string
    {
        preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\']([^"\']+)["\']/is', $html, $metaMatch);
        if (isset($metaMatch[1])) {
            return trim($metaMatch[1]);
        }

        preg_match('/<meta[^>]+property=["\']og:description["\'][^>]+content=["\']([^"\']+)["\']/is', $html, $metaMatch);

        return isset($metaMatch[1]) ? trim($metaMatch[1]) : null;
    }

    private function extractMainContent(string $html): ?string
    {
        $doc = new \DOMDocument;
        libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="UTF-8">'.$html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($doc);
        $nodes = $xpath->query('//main|//article|//div[contains(@class, "entry-content")]|//div[contains(@id, "content")]');

        if ($nodes && $nodes->length > 0) {
            foreach ($nodes as $node) {
                return $this->sanitizeImportedContent($doc->saveHTML($node));
            }
        }

        preg_match('/<body[^>]*>(.*)<\/body>/is', $html, $bodyMatch);

        if (! isset($bodyMatch[1])) {
            return null;
        }

        $body = strip_tags($bodyMatch[1], '<p><br><h1><h2><h3><ul><ol><li><strong><em><a><img>');

        return $body !== '' ? $this->sanitizeImportedContent('<div>'.$body.'</div>') : null;
    }

    private function sanitizeImportedContent(string $html): string
    {
        $document = new \DOMDocument;
        libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8"><div id="imported-content">'.$html.'</div>');
        libxml_clear_errors();

        $xpath = new \DOMXPath($document);
        $unsafeNodes = $xpath->query('//script|//style|//iframe|//object|//embed|//form|//input|//button|//textarea|//select|//svg|//link|//meta');
        if ($unsafeNodes) {
            foreach ($unsafeNodes as $unsafeNode) {
                $unsafeNode->parentNode?->removeChild($unsafeNode);
            }
        }

        $allowedAttributes = ['alt', 'colspan', 'data-lazy-src', 'data-src', 'height', 'href', 'loading', 'rowspan', 'src', 'srcset', 'title', 'width'];
        $elements = $xpath->query('//*[@id="imported-content"]//*');
        if ($elements) {
            foreach ($elements as $element) {
                if (! $element instanceof \DOMElement) {
                    continue;
                }

                foreach (iterator_to_array($element->attributes) as $attribute) {
                    $name = Str::lower($attribute->name);
                    $value = trim($attribute->value);

                    if (! in_array($name, $allowedAttributes, true) || $name === 'srcset' && ! $this->hasSafeSrcset($value)) {
                        $element->removeAttribute($attribute->name);

                        continue;
                    }

                    if (in_array($name, ['src', 'data-src', 'data-lazy-src'], true) && ! $this->hasSafeUrlScheme($value, ['http', 'https'])) {
                        $element->removeAttribute($attribute->name);
                    }

                    if ($name === 'href' && ! $this->hasSafeUrlScheme($value, ['http', 'https', 'mailto', 'tel'])) {
                        $element->removeAttribute($attribute->name);
                    }
                }
            }
        }

        $container = $document->getElementById('imported-content');
        $sanitized = '';
        if ($container) {
            foreach ($container->childNodes as $child) {
                $sanitized .= $document->saveHTML($child);
            }
        }

        return $sanitized;
    }

    private function hasSafeSrcset(string $srcset): bool
    {
        foreach (preg_split('/\s*,\s*/', $srcset) ?: [] as $candidate) {
            $url = preg_split('/\s+/', trim($candidate), 2)[0] ?? '';
            if ($url !== '' && ! $this->hasSafeUrlScheme($url, ['http', 'https'])) {
                return false;
            }
        }

        return true;
    }

    private function hasSafeUrlScheme(string $url, array $allowedSchemes): bool
    {
        $scheme = parse_url($url, PHP_URL_SCHEME);

        return $scheme === null || in_array(Str::lower($scheme), $allowedSchemes, true);
    }

    private function extractTextSnippet(string $html, int $length): string
    {
        $text = trim(strip_tags($html));
        $text = preg_replace('/\s+/', ' ', $text) ?? $text;

        return Str::limit($text, $length, '');
    }

    private function storeContentImages(string $content, string $pageUrl, string $folder, string $slug, bool $dryRun): array
    {
        $document = new \DOMDocument;
        libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8"><html><body>'.$content.'</body></html>');
        libxml_clear_errors();

        $xpath = new \DOMXPath($document);
        $nodes = $xpath->query('//img[@src or @data-src or @data-lazy-src or @srcset]|//source[@srcset]');
        $firstImage = null;

        if ($nodes) {
            foreach ($nodes as $node) {
                foreach (['src', 'data-src', 'data-lazy-src'] as $attribute) {
                    if (! $node->hasAttribute($attribute)) {
                        continue;
                    }

                    $remoteUrl = trim($node->getAttribute($attribute));
                    if ($remoteUrl === '' || str_starts_with($remoteUrl, 'data:')) {
                        continue;
                    }

                    $imagePath = $this->storeRemoteImage($this->resolveRemoteUrl($remoteUrl, $pageUrl), $folder, $slug, $dryRun);
                    if ($imagePath !== null) {
                        $node->setAttribute($attribute, asset('storage/'.$imagePath));
                        $firstImage ??= $imagePath;
                    }
                }

                if ($node->hasAttribute('srcset')) {
                    $sources = [];
                    foreach (preg_split('/\s*,\s*/', $node->getAttribute('srcset')) ?: [] as $candidate) {
                        $parts = preg_split('/\s+/', trim($candidate), 2);
                        $remoteUrl = $parts[0] ?? '';
                        if ($remoteUrl === '' || str_starts_with($remoteUrl, 'data:')) {
                            continue;
                        }

                        $imagePath = $this->storeRemoteImage($this->resolveRemoteUrl($remoteUrl, $pageUrl), $folder, $slug, $dryRun);
                        if ($imagePath !== null) {
                            $firstImage ??= $imagePath;
                            $sources[] = asset('storage/'.$imagePath).(isset($parts[1]) ? ' '.$parts[1] : '');
                        }
                    }

                    if ($sources !== []) {
                        $node->setAttribute('srcset', implode(', ', $sources));
                    }
                }
            }
        }

        $body = $document->getElementsByTagName('body')->item(0);
        $localizedContent = '';
        if ($body) {
            foreach ($body->childNodes as $child) {
                $localizedContent .= $document->saveHTML($child);
            }
        }

        return [$localizedContent, $firstImage];
    }

    private function storeRemoteImage(string $url, string $folder, string $slug, bool $dryRun): ?string
    {
        if ($dryRun || $url === '') {
            return null;
        }

        if (! in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https'], true)) {
            return null;
        }

        $extension = Str::lower(pathinfo(parse_url($url, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION));
        if (! in_array($extension, ['avif', 'gif', 'jpeg', 'jpg', 'png', 'svg', 'webp'], true)) {
            $extension = 'jpg';
        }

        $filename = Str::slug($slug).'-'.substr(hash('sha256', $url), 0, 16).'.'.$extension;
        $path = $folder.'/'.$filename;
        if (Storage::disk('public')->exists($path)) {
            return $path;
        }

        $response = Http::timeout(30)->get($url);
        if ($response->failed()) {
            $this->warn('Unable to download image: '.$url);

            return null;
        }

        Storage::disk('public')->put($path, $response->body());

        return $path;
    }

    private function resolveRemoteUrl(string $url, string $pageUrl): string
    {
        if (parse_url($url, PHP_URL_SCHEME) !== null) {
            return $url;
        }

        $page = parse_url($pageUrl);
        $origin = ($page['scheme'] ?? 'https').'://'.($page['host'] ?? '');

        if (str_starts_with($url, '//')) {
            return ($page['scheme'] ?? 'https').':'.$url;
        }

        if (str_starts_with($url, '/')) {
            return $origin.$url;
        }

        return $origin.'/'.trim(dirname($page['path'] ?? '/'), '/').'/'.$url;
    }

    private function extractSlugFromUrl(string $url): string
    {
        $path = trim(parse_url($url, PHP_URL_PATH) ?: '/', '/');

        return $path === '' ? 'home' : last(explode('/', $path));
    }

    private function slugToTitle(string $url): string
    {
        $slug = $this->extractSlugFromUrl($url);

        return Str::of($slug)->replace(['-', '_'], ' ')->title()->toString();
    }

    private function detectCategory(string $title): string
    {
        $lower = Str::lower($title);

        foreach (['laser', 'hair', 'skin', 'scar', 'botox', 'surgical'] as $keyword) {
            if (str_contains($lower, $keyword)) {
                return $keyword === 'surgical' ? 'surgical' : ($keyword === 'hair' ? 'hair' : 'skin');
            }
        }

        return 'skin';
    }
}
