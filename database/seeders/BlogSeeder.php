<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title'         => 'Laser vs. Traditional Hair Removal: Which Is Better?',
                'slug'          => 'laser-vs-traditional-hair-removal',
                'category'      => 'Laser Treatment',
                'excerpt'       => 'Comparing laser hair removal with waxing, threading, and shaving to help you choose the best option for smooth, lasting results.',
                'content'       => '<h2>Introduction</h2><p>Hair removal is something many people deal with on a regular basis. From shaving and waxing to threading and epilating, traditional methods have been around for centuries. But in recent years, laser hair removal has emerged as a game-changing alternative. So which is actually better?</p><h2>Traditional Methods</h2><p>Traditional hair removal methods like shaving, waxing, and threading are affordable and widely accessible. However, they come with significant drawbacks—results are temporary (lasting days to weeks), they can cause ingrown hairs, irritation, and in the case of waxing, can be quite painful.</p><h2>Laser Hair Removal</h2><p>Laser hair removal uses concentrated light energy to target and destroy hair follicles at the root. The results are long-lasting and often permanent after a full course of treatment. The procedure is safe, quick, and can be performed on virtually any area of the body.</p><h2>Which Should You Choose?</h2><p>For those seeking a permanent solution with minimal ongoing maintenance, laser hair removal is the clear winner. While the upfront cost is higher, you save time and money in the long run by eliminating the need for regular traditional treatments.</p><p>At Aakar Dermatology, we offer advanced laser hair removal tailored to your skin and hair type. Book a consultation with Dr. Rajan Tajhya to find out if laser hair removal is right for you.</p>',
                'author'        => 'Dr. Rajan Tajhya',
                'meta_title'    => 'Laser vs Traditional Hair Removal | Aakar Dermatology',
                'meta_description' => 'Comparing laser hair removal with traditional methods. Find out which is better for permanent, smooth skin at Aakar Dermatology.',
                'is_featured'   => true,
                'is_published'  => true,
                'published_at'  => now()->subDays(10),
            ],
            [
                'title'         => 'Understanding Acne: Causes, Types & Best Treatments',
                'slug'          => 'understanding-acne-causes-types-treatments',
                'category'      => 'Skin Care',
                'excerpt'       => 'A comprehensive guide to understanding what causes acne, the different types, and the most effective treatment options available today.',
                'content'       => '<h2>What Is Acne?</h2><p>Acne is a common skin condition that occurs when hair follicles become clogged with oil and dead skin cells. It causes whiteheads, blackheads, pimples, cysts, and nodules. While acne is most common in teenagers, it can affect people of all ages.</p><h2>Causes of Acne</h2><p>The main causes include excess sebum (oil) production, bacteria (Cutibacterium acnes), hormonal changes, certain medications, and diet. Stress can also worsen existing acne.</p><h2>Types of Acne</h2><ul><li><strong>Whiteheads and Blackheads:</strong> Mildest form, clogged pores</li><li><strong>Papules and Pustules:</strong> Inflamed pimples</li><li><strong>Nodules and Cysts:</strong> Deep, painful, can cause scarring</li></ul><h2>Treatment Options</h2><p>Treatment depends on severity. Options include topical retinoids, antibiotics, benzoyl peroxide, chemical peels, laser therapy, and for severe cases, oral isotretinoin. Dr. Rajan Tajhya at Aakar Dermatology creates a customized treatment plan for each patient based on their specific acne type and skin.</p>',
                'author'        => 'Dr. Rajan Tajhya',
                'meta_title'    => 'Understanding Acne: Causes & Treatments | Aakar Dermatology',
                'meta_description' => 'Learn about acne causes, types, and best treatments from Dr. Rajan Tajhya at Aakar Dermatology, Lalitpur.',
                'is_featured'   => true,
                'is_published'  => true,
                'published_at'  => now()->subDays(25),
            ],
            [
                'title'         => 'Hair Transplant: What to Expect Before, During & After',
                'slug'          => 'hair-transplant-what-to-expect',
                'category'      => 'Hair Care',
                'excerpt'       => 'A complete guide to the hair transplant journey—from consultation and the procedure itself to recovery and final results.',
                'content'       => '<h2>Is Hair Transplant Right for You?</h2><p>Hair transplant is ideal for individuals experiencing pattern baldness, receding hairline, or hair thinning due to androgenetic alopecia. A consultation with Dr. Rajan Tajhya will determine your candidacy based on donor hair availability and the extent of hair loss.</p><h2>Before the Procedure</h2><p>You will need to avoid blood thinners, alcohol, and smoking for at least two weeks before surgery. Your scalp will be assessed and a personalized hairline design will be planned.</p><h2>The Procedure</h2><p>Under local anesthesia, hair follicles are extracted from the donor area (usually the back of the scalp) using the FUE technique. These follicles are then meticulously transplanted to the balding areas. The procedure can take 6–8 hours depending on the number of grafts.</p><h2>After the Procedure</h2><p>Mild swelling and redness are normal in the first few days. Transplanted hairs will shed around weeks 2–4 (this is normal—it is part of the growth cycle). New hair growth begins at 3–4 months, with full results visible at 12–18 months.</p>',
                'author'        => 'Dr. Rajan Tajhya',
                'meta_title'    => 'Hair Transplant Guide | What to Expect | Aakar Dermatology',
                'meta_description' => 'Complete guide to hair transplant before, during and after the procedure. Expert hair restoration by Dr. Rajan Tajhya at Aakar Dermatology.',
                'is_featured'   => false,
                'is_published'  => true,
                'published_at'  => now()->subDays(40),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(['slug' => $blog['slug']], $blog);
        }
    }
}
