<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'page',
        'meta_title',
        'meta_description',
        'content',
        'menu_label',
        'menu_icon',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'no_index',
    ];

    protected $casts = [
        'no_index' => 'boolean',
    ];

    /**
     * Get SEO meta for a specific page.
     */
    public static function forPage(string $page): ?static
    {
        $cached = Cache::get("seo_{$page}");

        // Discard stale/incomplete cache entries
        if ($cached instanceof static) {
            return $cached;
        }

        $record = static::where('page', $page)->first();

        if ($record) {
            Cache::put("seo_{$page}", $record, 3600);
        }

        return $record;
    }

    /**
     * Clear the cache for a page after update.
     */
    public static function clearCache(string $page): void
    {
        Cache::forget("seo_{$page}");
    }
}
