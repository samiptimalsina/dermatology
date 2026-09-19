<?php

namespace App\Console\Commands;

use App\Models\BeforeAfter;
use App\Models\Blog;
use App\Models\GalleryImage;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScrapeAakarImages extends Command
{
    protected $signature   = 'aakar:scrape-images {--dry-run : Show what would be downloaded without saving}';
    protected $description = 'Scrape all images from aakardermatology.com and store them in the correct admin sections';

    // ─── All image URLs discovered from aakardermatology.com ─────────────────
    private array $imageMap = [

        // ── Settings: hero collage (5 slots) ──────────────────────────────────
        'settings' => [
            'hero_image_1' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/04/Dr-Rajan-770x1024.png',
                'label' => 'Doctor photo — Dr. Rajan Tajhya (hero portrait)',
                'disk'  => 'settings',
            ],
            'hero_image_2' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2025/12/About-us-1a-Copy-1024x683.jpg',
                'label' => 'Hero collage 2 — clinic/about photo',
                'disk'  => 'settings',
            ],
            'hero_image_3' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785837480852.webp',
                'label' => 'Hero collage 3 — treatment photo',
                'disk'  => 'settings',
            ],
            'hero_image_4' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785832770805.webp',
                'label' => 'Hero collage 4 — patient photo',
                'disk'  => 'settings',
            ],
            'hero_image_5' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785831484474.jpg',
                'label' => 'Hero collage 5 — equipment/procedure',
                'disk'  => 'settings',
            ],
            'doctor_photo' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/04/Dr-Rajan-770x1024.png',
                'label' => 'Doctor photo — Dr. Rajan Tajhya (portrait)',
                'disk'  => 'settings',
            ],
            'about_clinic_image' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2025/12/About-us-1a-Copy-1024x683.jpg',
                'label' => 'About — clinic photo',
                'disk'  => 'settings',
            ],
            'site_logo' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2025/10/White-aakar-logo-1-1024x702.png',
                'label' => 'Site logo — Aakar Dermatology',
                'disk'  => 'settings',
            ],
        ],

        // ── Services — images mapped to existing service slugs ──────────────
        'services' => [
            'acne-treatment' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/01/aakar-Prp-face-treatment-5.webp',
                'label' => 'Acne / skin treatment',
            ],
            'hair-transplant' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785837480852.webp',
                'label' => 'Hair transplant',
            ],
            'eyelid-surgery' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/02/eyelid-surgery-aakar-dermatology-service.webp',
                'label' => 'Eyelid surgery',
            ],
            'laser-hair-removal' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/02/Laser-hair-removal-aakar-dermatology-service.webp',
                'label' => 'Laser hair removal',
            ],
            'prp-therapy' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/01/aakar-Prp-face-treatment-5.webp',
                'label' => 'PRP therapy',
            ],
            'laser-facial' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/02/hydrafacial-aakar-dermatology-service.webp',
                'label' => 'Laser facial / Hydrafacial',
            ],
            'tattoo-removal' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/02/tattoo-removal-aakar-dermatology-service.webp',
                'label' => 'Tattoo removal',
            ],
            'skin-treatment' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/02/scar-erevision-surgery-aakar-dermatology-service.webp',
                'label' => 'Skin / scar treatment',
            ],
        ],

        // ── Before / After results ───────────────────────────────────────────
        'before_afters' => [
            [
                'title'        => 'Eyelid Surgery Result',
                'treatment'    => 'Blepharoplasty',
                'before_url'   => 'https://aakardermatology.com/wp-content/uploads/2025/12/before-after-placer-1-final-1-1-1024x683.jpg',
                'after_url'    => 'https://aakardermatology.com/wp-content/uploads/2025/12/before-after-placer-2-final-2-1-1024x683.jpg',
                'description'  => 'Precise blepharoplasty by Dr. Rajan Tajhya. Natural, refreshed appearance achieved.',
            ],
            [
                'title'        => 'Laser Skin Rejuvenation',
                'treatment'    => 'Laser Facial Treatment',
                'before_url'   => 'https://aakardermatology.com/wp-content/uploads/2026/03/Hydra-Facial-treatment-in-Kathmandu-showing-professional-skin-cleansing-and-hydration-procedure.webp',
                'after_url'    => 'https://aakardermatology.com/wp-content/uploads/2026/02/hydrafacial-aakar-dermatology-service.webp',
                'description'  => 'HydraFacial treatment at Aakar Dermatology. Improved skin tone and texture.',
            ],
            [
                'title'        => 'Laser Hair Removal',
                'treatment'    => 'Permanent Laser Hair Removal',
                'before_url'   => 'https://aakardermatology.com/wp-content/uploads/2026/03/Best-laser-hair-removal-service-in-Kathmandu-by-Dr.-Rajan-Tajhya-using-advanced-laser-technology-for-permanent-hair-reduction.webp',
                'after_url'    => 'https://aakardermatology.com/wp-content/uploads/2026/02/Laser-hair-removal-aakar-dermatology-service.webp',
                'description'  => 'Permanent laser hair removal using advanced technology. Smooth, hair-free skin.',
            ],
        ],

        // ── Gallery images ──────────────────────────────────────────────────
        'gallery' => [
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2025/09/AAKAR-05-1-scaled.png',               'category' => 'clinic',    'title' => 'Aakar Dermatology Clinic'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2025/12/About-us-1a-Copy-1024x683.jpg',        'category' => 'clinic',    'title' => 'Clinic Interior'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785837480852.webp',      'category' => 'treatment', 'title' => 'Treatment Session'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785832770805.webp',      'category' => 'treatment', 'title' => 'Patient Consultation'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785831484474.jpg',       'category' => 'treatment', 'title' => 'Skin Care Procedure'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/02/hydrafacial-aakar-dermatology-service.webp',        'category' => 'treatment', 'title' => 'HydraFacial Treatment'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/02/eyelid-surgery-aakar-dermatology-service.webp',     'category' => 'treatment', 'title' => 'Eyelid Surgery'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/02/Laser-hair-removal-aakar-dermatology-service.webp', 'category' => 'treatment', 'title' => 'Laser Hair Removal'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/01/aakar-Prp-face-treatment-5.webp',                  'category' => 'treatment', 'title' => 'PRP Face Treatment'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/02/scar-erevision-surgery-aakar-dermatology-service.webp', 'category' => 'treatment', 'title' => 'Scar Revision Surgery'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/02/tattoo-removal-aakar-dermatology-service.webp',    'category' => 'treatment', 'title' => 'Tattoo Removal'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/03/Botox-treatment-at-Aakar-Dermatology-by-Dr.-Rajan-Tajhya-for-wrinkle-and-fine-line-reduction.webp', 'category' => 'treatment', 'title' => 'Botox Treatment'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/03/Best-laser-hair-removal-service-in-Kathmandu-by-Dr.-Rajan-Tajhya-using-advanced-laser-technology-for-permanent-hair-reduction.webp', 'category' => 'treatment', 'title' => 'Advanced Laser Technology'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/03/Hydra-Facial-treatment-in-Kathmandu-showing-professional-skin-cleansing-and-hydration-procedure.webp', 'category' => 'treatment', 'title' => 'HydraFacial Kathmandu'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2025/12/before-after-placer-1-final-1-1-1024x683.jpg', 'category' => 'treatment', 'title' => 'Before Treatment'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2025/12/before-after-placer-2-final-2-1-1024x683.jpg', 'category' => 'treatment', 'title' => 'After Treatment'],
            ['url' => 'https://aakardermatology.com/wp-content/uploads/2026/04/Dr-Rajan-770x1024.png',                'category' => 'team',      'title' => 'Dr. Rajan Tajhya'],
        ],

        // ── Blog thumbnails ─────────────────────────────────────────────────
        'blogs' => [
            'laser-vs-traditional-hair-removal' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/03/Best-laser-hair-removal-service-in-Kathmandu-by-Dr.-Rajan-Tajhya-using-advanced-laser-technology-for-permanent-hair-reduction.webp',
                'label' => 'Laser Hair Removal blog thumbnail',
            ],
            'understanding-acne-causes-types-treatments' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/01/aakar-Prp-face-treatment-5.webp',
                'label' => 'Acne treatment blog thumbnail',
            ],
            'hair-transplant-what-to-expect' => [
                'url'   => 'https://aakardermatology.com/wp-content/uploads/2026/08/joined-photo-1785837480852.webp',
                'label' => 'Hair transplant blog thumbnail',
            ],
        ],
    ];

    // ─── Headers to mimic a real browser ────────────────────────────────────
    private array $headers = [
        'User-Agent'      => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0 Safari/537.36',
        'Accept'          => 'image/avif,image/webp,image/apng,image/*,*/*;q=0.8',
        'Accept-Language' => 'en-US,en;q=0.9',
        'Referer'         => 'https://aakardermatology.com/',
    ];

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        $this->info('');
        $this->line('  <fg=green;options=bold>Aakar Dermatology — Image Scraper</>');
        $this->line('  Source: <href=https://aakardermatology.com>https://aakardermatology.com</>');
        $this->line('  Mode  : ' . ($dryRun ? '<fg=yellow>DRY RUN (no files saved)</>' : '<fg=green>LIVE (files will be saved)</>'));
        $this->info('');

        $total = $saved = $skipped = $failed = 0;

        // ─── 1. Settings ────────────────────────────────────────────────────
        $this->components->twoColumnDetail('<fg=cyan;options=bold>1. Site Settings (hero, logo, doctor photo)</>');
        foreach ($this->imageMap['settings'] as $key => $item) {
            $total++;
            $existing = SiteSetting::where('key', $key)->value('value');
            if ($existing && ! $dryRun) {
                $this->line("     <fg=yellow>SKIP</> {$key} (already has image)");
                $skipped++;
                continue;
            }
            $result = $this->downloadImage($item['url'], 'settings', $key, $item['label'], $dryRun);
            if ($result) {
                if (! $dryRun) {
                    SiteSetting::updateOrCreate(['key' => $key], ['value' => $result]);
                    \Illuminate\Support\Facades\Cache::forget("setting_{$key}");
                }
                $saved++;
            } else {
                $failed++;
            }
        }

        // ─── 2. Services ────────────────────────────────────────────────────
        $this->info('');
        $this->components->twoColumnDetail('<fg=cyan;options=bold>2. Service Images</>');
        foreach ($this->imageMap['services'] as $slug => $item) {
            $total++;
            $service = Service::where('slug', $slug)->first();
            if (! $service) {
                $this->line("     <fg=red>MISS</> service slug [{$slug}] not found in DB");
                $failed++;
                continue;
            }
            if ($service->image && ! $dryRun) {
                $this->line("     <fg=yellow>SKIP</> {$slug} (already has image)");
                $skipped++;
                continue;
            }
            $result = $this->downloadImage($item['url'], 'services', $slug, $item['label'], $dryRun);
            if ($result) {
                if (! $dryRun) {
                    $service->update(['image' => $result]);
                }
                $saved++;
            } else {
                $failed++;
            }
        }

        // ─── 3. Before / After ──────────────────────────────────────────────
        $this->info('');
        $this->components->twoColumnDetail('<fg=cyan;options=bold>3. Before / After Images</>');
        foreach ($this->imageMap['before_afters'] as $idx => $item) {
            $total += 2;
            $existing = BeforeAfter::where('title', $item['title'])->first();

            $beforeResult = $this->downloadImage(
                $item['before_url'], 'before-after',
                'before-' . Str::slug($item['title']),
                $item['title'] . ' — before', $dryRun
            );
            $afterResult = $this->downloadImage(
                $item['after_url'], 'before-after',
                'after-' . Str::slug($item['title']),
                $item['title'] . ' — after', $dryRun
            );

            if ($beforeResult) $saved++; else $failed++;
            if ($afterResult)  $saved++; else $failed++;

            if (! $dryRun && $beforeResult && $afterResult) {
                BeforeAfter::updateOrCreate(
                    ['title' => $item['title']],
                    [
                        'treatment'    => $item['treatment'],
                        'before_image' => $beforeResult,
                        'after_image'  => $afterResult,
                        'description'  => $item['description'],
                        'is_active'    => true,
                        'sort_order'   => $idx + 1,
                    ]
                );
            }
        }

        // ─── 4. Gallery ─────────────────────────────────────────────────────
        $this->info('');
        $this->components->twoColumnDetail('<fg=cyan;options=bold>4. Gallery Images</>');
        foreach ($this->imageMap['gallery'] as $idx => $item) {
            $total++;
            $filename = basename(parse_url($item['url'], PHP_URL_PATH));

            // Skip if this URL is already in gallery
            if (! $dryRun) {
                $exists = GalleryImage::where('title', $item['title'])->exists();
                if ($exists) {
                    $this->line("     <fg=yellow>SKIP</> {$item['title']} (already in gallery)");
                    $skipped++;
                    continue;
                }
            }

            $result = $this->downloadImage($item['url'], 'gallery', 'gallery-' . $idx . '-' . Str::slug($item['title']), $item['title'], $dryRun);
            if ($result) {
                if (! $dryRun) {
                    GalleryImage::create([
                        'title'      => $item['title'],
                        'image'      => $result,
                        'category'   => $item['category'],
                        'is_active'  => true,
                        'sort_order' => $idx + 1,
                    ]);
                }
                $saved++;
            } else {
                $failed++;
            }
        }

        // ─── 5. Blog thumbnails ──────────────────────────────────────────────
        $this->info('');
        $this->components->twoColumnDetail('<fg=cyan;options=bold>5. Blog Thumbnails</>');
        foreach ($this->imageMap['blogs'] as $slug => $item) {
            $total++;
            $blog = Blog::where('slug', $slug)->first();
            if (! $blog) {
                $this->line("     <fg=red>MISS</> blog slug [{$slug}] not found in DB");
                $failed++;
                continue;
            }
            if ($blog->thumbnail && ! $dryRun) {
                $this->line("     <fg=yellow>SKIP</> {$slug} (already has thumbnail)");
                $skipped++;
                continue;
            }
            $result = $this->downloadImage($item['url'], 'blogs', $slug, $item['label'], $dryRun);
            if ($result) {
                if (! $dryRun) {
                    $blog->update(['thumbnail' => $result]);
                }
                $saved++;
            } else {
                $failed++;
            }
        }

        // ─── Summary ────────────────────────────────────────────────────────
        $this->info('');
        $this->line('  ───────────────────────────────────────────');
        $this->line("  Total   : <fg=white;options=bold>{$total}</>");
        $this->line("  Saved   : <fg=green;options=bold>{$saved}</>");
        $this->line("  Skipped : <fg=yellow>{$skipped}</> (already existed)");
        $this->line("  Failed  : <fg=red>{$failed}</>");
        $this->info('');

        if ($dryRun) {
            $this->warn('  DRY RUN complete — run without --dry-run to actually save files.');
        } else {
            $this->info('  ✓ All images scraped and stored in storage/app/public/');
            $this->line('  ✓ DB records updated for services, before/afters, gallery, blogs, settings.');
            $this->line('');
            $this->line('  <fg=cyan>Next:</>  php -c .php/php.ini artisan storage:link  (if not already done)');
        }

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Download one image URL, save to storage/app/public/{folder}/
    // Returns the storage-relative path on success, null on failure.
    // ─────────────────────────────────────────────────────────────────────────
    private function downloadImage(
        string $url,
        string $folder,
        string $nameHint,
        string $label,
        bool   $dryRun
    ): ?string {
        $ext      = $this->guessExtension($url);
        $filename = $folder . '/' . Str::slug($nameHint) . '.' . $ext;

        if ($dryRun) {
            $this->line("     <fg=blue>DRY </> [{$label}]");
            $this->line("          {$url}");
            $this->line("          → storage/app/public/{$filename}");
            return $filename; // pretend success in dry run
        }

        $this->line("     <fg=white>DOWN</> {$label}");

        try {
            // Use wget (curl not available as CLI tool but PHP curl ext is)
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_HTTPHEADER     => array_map(
                    fn($k, $v) => "{$k}: {$v}",
                    array_keys($this->headers),
                    $this->headers
                ),
            ]);
            $body = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err  = curl_error($ch);
            curl_close($ch);

            if ($err || $code < 200 || $code >= 400 || ! $body) {
                $this->line("          <fg=red>✗ HTTP {$code} — {$err}</>");
                return null;
            }

            // Validate it's actually an image
            $tmpFile = tempnam(sys_get_temp_dir(), 'aakar_img_');
            file_put_contents($tmpFile, $body);
            $mime = mime_content_type($tmpFile);
            if (! str_starts_with($mime, 'image/')) {
                unlink($tmpFile);
                $this->line("          <fg=red>✗ Not an image (mime: {$mime})</>");
                return null;
            }
            unlink($tmpFile);

            Storage::disk('public')->put($filename, $body);

            $kb = round(strlen($body) / 1024, 1);
            $this->line("          <fg=green>✓</> saved ({$kb} KB) → storage/app/public/{$filename}");

            return $filename;

        } catch (\Throwable $e) {
            $this->line("          <fg=red>✗ Exception: {$e->getMessage()}</>");
            return null;
        }
    }

    private function guessExtension(string $url): string
    {
        $path = parse_url($url, PHP_URL_PATH);
        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        return match($ext) {
            'jpg','jpeg','png','gif','webp','svg','avif' => $ext === 'jpeg' ? 'jpg' : $ext,
            default => 'jpg',
        };
    }
}
