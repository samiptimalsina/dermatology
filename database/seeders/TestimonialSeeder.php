<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'patient_name' => 'Sita Sharma',
                'treatment'    => 'Acne Treatment',
                'review'       => 'I struggled with acne for years and tried countless products with no success. Dr. Rajan\'s personalized treatment plan cleared my skin within 3 months. I finally feel confident in my own skin. The clinic is clean, professional, and the staff is incredibly kind.',
                'rating'       => 5,
                'source'       => 'google',
                'is_featured'  => true,
                'is_active'    => true,
                'sort_order'   => 1,
            ],
            [
                'patient_name' => 'Ramesh Adhikari',
                'treatment'    => 'Hair Transplant',
                'review'       => 'I was going bald at 32 and it really affected my confidence. Dr. Rajan performed my hair transplant and the results are incredible—so natural looking! I\'m 6 months post-op and very happy with the outcome. Highly recommend Aakar Dermatology for hair restoration.',
                'rating'       => 5,
                'source'       => 'google',
                'is_featured'  => true,
                'is_active'    => true,
                'sort_order'   => 2,
            ],
            [
                'patient_name' => 'Priya Maharjan',
                'treatment'    => 'Laser Facial',
                'review'       => 'The laser facial treatment at Aakar completely transformed my skin. My dark spots have faded significantly and my skin tone is so much more even. Dr. Rajan explained every step of the process and made me feel comfortable throughout.',
                'rating'       => 5,
                'source'       => 'google',
                'is_featured'  => true,
                'is_active'    => true,
                'sort_order'   => 3,
            ],
            [
                'patient_name' => 'Binod Karki',
                'treatment'    => 'PRP Therapy',
                'review'       => 'After noticing significant hair thinning, I consulted Dr. Rajan and he recommended PRP therapy. After 4 sessions, I can see new hair growth and my existing hair is much thicker. The doctor is very knowledgeable and explains everything clearly.',
                'rating'       => 5,
                'source'       => 'facebook',
                'is_featured'  => true,
                'is_active'    => true,
                'sort_order'   => 4,
            ],
            [
                'patient_name' => 'Anita Thapa',
                'treatment'    => 'Eyelid Surgery',
                'review'       => 'I had heavy drooping eyelids that made me look tired all the time. Dr. Rajan\'s blepharoplasty completely changed my appearance. The recovery was smooth and the results are absolutely natural. I look more refreshed and awake. Thank you!',
                'rating'       => 5,
                'source'       => 'google',
                'is_featured'  => false,
                'is_active'    => true,
                'sort_order'   => 5,
            ],
            [
                'patient_name' => 'Sunil Bajracharya',
                'treatment'    => 'Laser Hair Removal',
                'review'       => 'Best decision I ever made! Laser hair removal at Aakar was painless and the results are permanent. I\'ve completed 6 sessions and my skin is completely smooth. The staff is very professional and the clinic maintains high hygiene standards.',
                'rating'       => 5,
                'source'       => 'google',
                'is_featured'  => false,
                'is_active'    => true,
                'sort_order'   => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['patient_name' => $testimonial['patient_name']],
                $testimonial
            );
        }
    }
}
