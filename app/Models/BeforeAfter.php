<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeforeAfter extends Model
{
    protected $fillable = [
        'title',
        'treatment',
        'before_image',
        'after_image',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getBeforeImageUrlAttribute(): string
    {
        return $this->before_image
            ? asset('storage/' . $this->before_image)
            : asset('images/placeholder-before.jpg');
    }

    public function getAfterImageUrlAttribute(): string
    {
        return $this->after_image
            ? asset('storage/' . $this->after_image)
            : asset('images/placeholder-after.jpg');
    }
}
