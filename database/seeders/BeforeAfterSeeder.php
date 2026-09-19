<?php

namespace Database\Seeders;

use App\Models\BeforeAfter;
use Illuminate\Database\Seeder;

class BeforeAfterSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title'        => 'Acne Scar Improvement',
                'treatment'    => 'Laser Resurfacing',
                'before_image' => '',
                'after_image'  => '',
                'description'  => 'Patient underwent 4 sessions of fractional laser resurfacing. Significant improvement in acne scarring and skin texture.',
                'is_active'    => true,
                'sort_order'   => 1,
            ],
            [
                'title'        => 'Eyelid Surgery Results',
                'treatment'    => 'Blepharoplasty',
                'before_image' => '',
                'after_image'  => '',
                'description'  => 'Patient had droopy upper eyelids corrected with precision blepharoplasty. Natural, refreshed look achieved.',
                'is_active'    => true,
                'sort_order'   => 2,
            ],
            [
                'title'        => 'Hair Transplant Results',
                'treatment'    => 'FUE Hair Transplant',
                'before_image' => '',
                'after_image'  => '',
                'description'  => '12-month post-op results of FUE hair transplant. Significant hair density and natural hairline restored.',
                'is_active'    => true,
                'sort_order'   => 3,
            ],
        ];

        foreach ($items as $item) {
            BeforeAfter::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
