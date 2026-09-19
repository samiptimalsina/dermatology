<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'             => 'Acne Treatment',
                'slug'              => 'acne-treatment',
                'category'          => 'skin',
                'icon'              => 'acne',
                'short_description' => 'Comprehensive acne management using advanced medical therapies tailored to your skin type and severity.',
                'full_description'  => '<p>Acne is one of the most common skin conditions affecting people of all ages. At Aakar Dermatology, we provide personalized acne treatment plans that address the root cause of your breakouts—whether hormonal, bacterial, or lifestyle-related.</p><p>Our treatments include topical therapies, oral medications, chemical peels, laser therapy, and comedone extraction. We also offer scar revision treatments to restore smooth, even skin after acne resolves.</p>',
                'meta_title'        => 'Acne Treatment in Lalitpur | Aakar Dermatology',
                'meta_description'  => 'Expert acne treatment at Aakar Dermatology. Personalized plans including medications, peels, laser & scar revision. Book your consultation today.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 1,
            ],
            [
                'title'             => 'Hair Transplant',
                'slug'              => 'hair-transplant',
                'category'          => 'hair',
                'icon'              => 'hair',
                'short_description' => 'Advanced FUE and FUT hair transplant techniques for natural-looking, permanent hair restoration results.',
                'full_description'  => '<p>Hair loss can deeply affect your confidence and self-image. Dr. Rajan Tajhya is an expert in hair transplant surgery using the latest Follicular Unit Extraction (FUE) and Follicular Unit Transplantation (FUT) methods.</p><p>The procedure involves harvesting healthy hair follicles from the donor area and transplanting them to areas of thinning or baldness. Results are natural-looking, permanent, and life-changing.</p>',
                'meta_title'        => 'Hair Transplant in Lalitpur | Aakar Dermatology',
                'meta_description'  => 'Expert FUE & FUT hair transplant surgery by Dr. Rajan Tajhya at Aakar Dermatology, Lalitpur. Natural, permanent results.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 2,
            ],
            [
                'title'             => 'Eyelid Surgery (Blepharoplasty)',
                'slug'              => 'eyelid-surgery',
                'category'          => 'surgical',
                'icon'              => 'eye',
                'short_description' => 'Precise eyelid surgery to correct droopy eyelids, under-eye bags, and restore a youthful, refreshed appearance.',
                'full_description'  => '<p>Blepharoplasty, or eyelid surgery, is a delicate procedure that removes excess skin, fat, and muscle from the upper or lower eyelids. Dr. Rajan Tajhya\'s precise surgical technique ensures natural results that open up your eyes and refresh your appearance.</p><p>Whether for cosmetic improvement or to correct functional issues like impaired vision from drooping eyelids, our blepharoplasty procedures are performed with utmost care and precision.</p>',
                'meta_title'        => 'Eyelid Surgery Lalitpur | Blepharoplasty | Aakar Dermatology',
                'meta_description'  => 'Expert blepharoplasty (eyelid surgery) by Dr. Rajan Tajhya at Aakar Dermatology. Refresh your look with precise, natural eyelid correction.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 3,
            ],
            [
                'title'             => 'Laser Hair Removal',
                'slug'              => 'laser-hair-removal',
                'category'          => 'laser',
                'icon'              => 'laser',
                'short_description' => 'Safe and effective laser hair removal for smooth, hair-free skin on face, underarms, legs, and body.',
                'full_description'  => '<p>Tired of shaving, waxing, or threading? Laser hair removal at Aakar Dermatology offers a long-lasting solution for unwanted body hair. Using state-of-the-art laser technology, we target hair follicles precisely while protecting the surrounding skin.</p><p>Suitable for all skin types, our laser hair removal sessions are quick, virtually painless, and deliver permanent hair reduction with each session.</p>',
                'meta_title'        => 'Laser Hair Removal Lalitpur | Aakar Dermatology',
                'meta_description'  => 'Permanent laser hair removal at Aakar Dermatology, Lalitpur. Safe, effective & suitable for all skin types. Book today.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 4,
            ],
            [
                'title'             => 'Plasma-Rich Platelet (PRP) Therapy',
                'slug'              => 'prp-therapy',
                'category'          => 'hair',
                'icon'              => 'prp',
                'short_description' => 'Natural hair regrowth and skin rejuvenation using your own platelet-rich plasma for remarkable results.',
                'full_description'  => '<p>PRP (Platelet-Rich Plasma) therapy harnesses your body\'s natural healing powers to stimulate hair regrowth and rejuvenate the skin. A small amount of your blood is processed to concentrate the growth factors, which are then injected into the treatment area.</p><p>PRP is highly effective for treating androgenetic alopecia (pattern baldness), thinning hair, and can also be used for facial rejuvenation, reducing fine lines and improving skin texture.</p>',
                'meta_title'        => 'PRP Therapy Lalitpur | Hair & Skin Rejuvenation | Aakar Dermatology',
                'meta_description'  => 'PRP therapy for hair regrowth and skin rejuvenation at Aakar Dermatology. Natural, safe treatment using your own growth factors.',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 5,
            ],
            [
                'title'             => 'Laser Facial Treatment',
                'slug'              => 'laser-facial',
                'category'          => 'laser',
                'icon'              => 'laser-face',
                'short_description' => 'Rejuvenate your skin with targeted laser facial treatments that reduce pigmentation, fine lines, and improve overall tone.',
                'full_description'  => '<p>Laser facial treatments at Aakar Dermatology address a wide range of skin concerns including hyperpigmentation, sun damage, acne scars, fine lines, and uneven skin tone. Our advanced laser systems deliver precise energy to targeted areas, stimulating collagen production and skin renewal.</p><p>The result is brighter, smoother, and more youthful-looking skin with minimal downtime.</p>',
                'meta_title'        => 'Laser Facial Treatment Lalitpur | Skin Rejuvenation | Aakar Dermatology',
                'meta_description'  => 'Advanced laser facial treatments for pigmentation, acne scars & skin rejuvenation at Aakar Dermatology. Safe, effective & tailored for you.',
                'is_featured'       => true,
                'is_active'         => true,
                'sort_order'        => 6,
            ],
            [
                'title'             => 'Tattoo Removal',
                'slug'              => 'tattoo-removal',
                'category'          => 'laser',
                'icon'              => 'tattoo',
                'short_description' => 'Safe and effective laser tattoo removal that breaks down ink particles for gradual, complete tattoo clearance.',
                'full_description'  => '<p>Changed your mind about a tattoo? Our advanced Q-switched laser technology effectively breaks down tattoo ink particles of all colors, allowing your body to naturally eliminate them. Multiple sessions are usually required depending on the tattoo\'s size, color, and age.</p><p>The procedure is safe, minimally invasive, and performed by our expert team to minimize scarring and ensure the best possible results.</p>',
                'meta_title'        => 'Laser Tattoo Removal Lalitpur | Aakar Dermatology',
                'meta_description'  => 'Safe laser tattoo removal at Aakar Dermatology, Lalitpur. Effective removal for all colors & skin types. Book your consultation today.',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 7,
            ],
            [
                'title'             => 'Skin Treatment',
                'slug'              => 'skin-treatment',
                'category'          => 'skin',
                'icon'              => 'skin',
                'short_description' => 'Comprehensive medical skin treatments for eczema, psoriasis, pigmentation, and other dermatological conditions.',
                'full_description'  => '<p>At Aakar Dermatology, we diagnose and treat the full spectrum of skin conditions. From common concerns like eczema, psoriasis, and vitiligo to complex dermatological disorders—our evidence-based approach ensures accurate diagnosis and effective treatment.</p><p>We combine medical management with aesthetic solutions to not only treat your condition but also restore your skin\'s natural beauty and your confidence.</p>',
                'meta_title'        => 'Medical Skin Treatment Lalitpur | Aakar Dermatology',
                'meta_description'  => 'Expert medical skin treatment for eczema, psoriasis, pigmentation & more at Aakar Dermatology. Personalized, evidence-based dermatology care.',
                'is_featured'       => false,
                'is_active'         => true,
                'sort_order'        => 8,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
