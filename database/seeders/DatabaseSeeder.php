<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            SeoMetaSeeder::class,
            ServiceSeeder::class,
            TeamMemberSeeder::class,
            WhyChooseUsSeeder::class,
            TestimonialSeeder::class,
            BeforeAfterSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
            VideoSeeder::class,
        ]);
    }
}
