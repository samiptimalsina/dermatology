<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'video_url',
        'thumbnail_url',
        'duration',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Video $video) {
            $video->slug = $video->slug ?: Str::slug($video->title);
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    public function getThumbnailAttribute(): string
    {
        return $this->thumbnail_url ?: (self::youtubeThumbnailFromUrl($this->video_url) ?: asset('images/placeholder-gallery.jpg'));
    }

    public static function youtubeThumbnailFromUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $videoId = null;
        $host = parse_url($url, PHP_URL_HOST);

        if (in_array($host, ['youtu.be', 'www.youtu.be'], true)) {
            $videoId = trim((string) parse_url($url, PHP_URL_PATH), '/');
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com'], true)) {
            $path = trim((string) parse_url($url, PHP_URL_PATH), '/');
            parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;

            if (in_array(strtok($path, '/'), ['embed', 'shorts', 'live'], true)) {
                $videoId = explode('/', $path)[1] ?? null;
            }
        }

        return $videoId && preg_match('/^[A-Za-z0-9_-]{6,}$/', $videoId)
            ? 'https://img.youtube.com/vi/'.$videoId.'/hqdefault.jpg'
            : null;
    }
}