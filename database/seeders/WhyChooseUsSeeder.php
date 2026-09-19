<?php

namespace Database\Seeders;

use App\Models\WhyChooseUs;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title'       => 'Personalized Treatment Plans',
                'description' => 'We don\'t believe in one-size-fits-all solutions. Every treatment plan is customized to your unique skin type, concerns, lifestyle, and aesthetic goals.',
                'icon'        => 'personalized',
                'is_active'   => true,
                'sort_order'  => 1,
            ],
            [
                'title'       => 'Advanced Technology',
                'description' => 'We utilize proven, modern dermatological equipment and techniques to deliver safe, effective results you can see and feel.',
                'icon'        => 'technology',
                'is_active'   => true,
                'sort_order'  => 2,
            ],
            [
                'title'       => 'Convenient & Accessible',
                'description' => 'Say goodbye to crowded waiting rooms and rushed appointments. We\'ve created a clinic environment that respects your time while giving you the attention you deserve.',
                'icon'        => 'accessible',
                'is_active'   => true,
                'sort_order'  => 3,
            ],
            [
                'title'       => 'Proven Results',
                'description' => 'Our track record speaks for itself. Patients trust us for transformative results that look natural, feel authentic, and boost confidence from the inside out.',
                'icon'        => 'results',
                'is_active'   => true,
                'sort_order'  => 4,
            ],
        ];

        foreach ($items as $item) {
            WhyChooseUs::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
