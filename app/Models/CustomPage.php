<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'no_index',
        'is_published',
    ];

    protected $casts = [
        'no_index' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
