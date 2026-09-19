<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            ['title' => 'Your Skin Consultation: What to Expect', 'category' => 'Getting Started', 'description' => 'A simple guide to preparing for your first dermatology consultation.', 'duration' => '04:12', 'is_featured' => true, 'sort_order' => 1],
            ['title' => 'Daily Skin Care Routine for Healthy Skin', 'category' => 'Skin Care', 'description' => 'Build a practical routine for cleansing, hydration, and sun protection.', 'duration' => '06:48', 'is_featured' => true, 'sort_order' => 2],
            ['title' => 'Understanding Acne and Its Treatments', 'category' => 'Acne', 'description' => 'Learn what causes acne and when professional treatment can help.', 'duration' => '07:20', 'is_featured' => false, 'sort_order' => 3],
            ['title' => 'Laser Hair Removal Explained', 'category' => 'Laser Treatments', 'description' => 'How laser hair reduction works and how to prepare for a session.', 'duration' => '05:36', 'is_featured' => false, 'sort_order' => 4],
            ['title' => 'What to Know Before a Hair Transplant', 'category' => 'Hair Care', 'description' => 'A clear overview of candidacy, preparation, and recovery.', 'duration' => '08:05', 'is_featured' => false, 'sort_order' => 5],
            ['title' => 'Pigmentation: Causes and Care Options', 'category' => 'Skin Concerns', 'description' => 'Understand common pigmentation concerns and evidence-based care.', 'duration' => '05:18', 'is_featured' => false, 'sort_order' => 6],
            ['title' => 'Sun Protection That Actually Works', 'category' => 'Everyday Care', 'description' => 'Simple sunscreen habits that protect your skin every day.', 'duration' => '03:42', 'is_featured' => false, 'sort_order' => 7],
            ['title' => 'Aftercare Following a Skin Treatment', 'category' => 'Treatment Aftercare', 'description' => 'Helpful aftercare guidance to support a smooth recovery.', 'duration' => '04:55', 'is_featured' => false, 'sort_order' => 8],
        ];

        foreach ($videos as $video) {
            Video::updateOrCreate(
                ['slug' => str($video['title'])->slug()],
                array_merge($video, [
                    'video_url' => 'https://www.youtube.com/results?search_query='.urlencode('Aakar Dermatology '.$video['title']),
                    'thumbnail_url' => null,
                    'is_active' => true,
                ])
            );
        }
    }
}