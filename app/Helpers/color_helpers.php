<?php

if (! function_exists('hexToRgba')) {
    /**
     * Convert a hex colour to an rgba() CSS string.
     * hexToRgba('#006E61', 0.15) → 'rgba(0,110,97,0.15)'
     */
    function hexToRgba(string $hex, float $alpha): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        return 'rgba('.hexdec(substr($hex,0,2)).','.hexdec(substr($hex,2,2)).','.hexdec(substr($hex,4,2)).','.round($alpha,3).')';
    }
}
