<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group', 'label'];

    /**
     * Get a setting value by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $cached = Cache::get("setting_{$key}");

        // Discard stale / incomplete-class cached entries
        if ($cached !== null && ! ($cached instanceof \stdClass) && ! is_object($cached)) {
            return $cached;
        }

        $setting = static::where('key', $key)->first();
        $value   = $setting ? $setting->value : $default;

        if ($value !== null) {
            Cache::put("setting_{$key}", $value, 3600);
        }

        return $value;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget("setting_{$key}");
    }

    /**
     * Get all settings as key => value array, filtered by group.
     */
    public static function getAllByGroup(string $group): array
    {
        return static::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Get all settings as a flat key => value Collection.
     */
    public static function getAll(): \Illuminate\Support\Collection
    {
        return static::all()->pluck('value', 'key');
    }
}
