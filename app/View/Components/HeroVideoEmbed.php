<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Converts a raw YouTube / Vimeo URL into a privacy-friendly embed URL.
 * Used in both the admin settings preview and the public hero section.
 */
class HeroVideoEmbed extends Component
{
    public string $embedUrl;
    public string $rawUrl;

    public function __construct(string $url = '')
    {
        $this->rawUrl  = $url;
        $this->embedUrl = static::embedUrl($url);
    }

    /**
     * Static helper so Blade templates and controllers can call it directly
     * without instantiating the component.
     */
    public static function embedUrl(string $url): string
    {
        if (! $url) {
            return '';
        }

        // YouTube: youtu.be/ID  |  youtube.com/watch?v=ID  |  youtube.com/shorts/ID  |  youtube.com/embed/ID
        if (preg_match(
            '/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|shorts\/|embed\/))([A-Za-z0-9_\-]{11})/',
            $url,
            $m
        )) {
            return 'https://www.youtube.com/embed/' . $m[1]
                . '?rel=0&modestbranding=1&playsinline=1';
        }

        // Vimeo: vimeo.com/ID  or  player.vimeo.com/video/ID
        if (preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $url, $m)) {
            return 'https://player.vimeo.com/video/' . $m[1]
                . '?dnt=1&playsinline=1';
        }

        return '';
    }

    /** Whether the raw URL is a recognised embeddable source. */
    public static function isEmbeddable(string $url): bool
    {
        return static::embedUrl($url) !== '';
    }

    public function render()
    {
        // This component is used as a static helper only —
        // no Blade component template needed.
        return '';
    }
}
