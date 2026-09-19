<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function booted(): void
    {
        static::creating(function (BlogCategory $category) {
            $category->slug = $category->slug ?: Str::slug($category->name);
        });

        static::saving(function (BlogCategory $category) {
            $category->slug = $category->slug ?: Str::slug($category->name);
        });
    }
}
