<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Skin Care', 'description' => 'Skin health, acne, pigmentation, and daily care.', 'sort_order' => 1],
            ['name' => 'Hair Care', 'description' => 'Hair loss, hair restoration, and scalp treatments.', 'sort_order' => 2],
            ['name' => 'Laser Treatment', 'description' => 'Laser hair removal, skin resurfacing, and related treatments.', 'sort_order' => 3],
            ['name' => 'Acne', 'description' => 'Evidence-based acne care and treatment guidance.', 'sort_order' => 4],
            ['name' => 'Anti-Aging', 'description' => 'Preventive and restorative anti-aging treatments.', 'sort_order' => 5],
            ['name' => 'Medical Dermatology', 'description' => 'Diagnosis and treatment of medical skin conditions.', 'sort_order' => 6],
            ['name' => 'General Dermatology', 'description' => 'General dermatology advice and clinical care.', 'sort_order' => 7],
            ['name' => 'Before & After', 'description' => 'Treatment journeys and patient results.', 'sort_order' => 8],
        ];

        foreach ($categories as $category) {
            BlogCategory::updateOrCreate(
                ['slug' => str($category['name'])->slug()],
                array_merge($category, ['is_active' => true])
            );
        }
    }
}