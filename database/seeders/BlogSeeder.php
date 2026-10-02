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
                'title' => 'Laser vs. Traditional Hair Removal: Which Is Better?',
                'slug' => 'laser-vs-traditional-hair-removal',
                'category' => 'Laser Treatment',
                'excerpt' => 'Comparing laser hair removal with waxing, threading, and shaving to help you choose the best option for smooth, lasting results.',
                'content' => '<h2>Introduction</h2><p>Hair removal is something many people deal with on a regular basis. From shaving and waxing to threading and epilating, traditional methods have been around for centuries. But in recent years, laser hair removal has emerged as a game-changing alternative. So which is actually better?</p><h2>Traditional Methods</h2><p>Traditional hair removal methods like shaving, waxing, and threading are affordable and widely accessible. However, they come with significant drawbacks—results are temporary (lasting days to weeks), they can cause ingrown hairs, irritation, and in the case of waxing, can be quite painful.</p><h2>Laser Hair Removal</h2><p>Laser hair removal uses concentrated light energy to target and destroy hair follicles at the root. The results are long-lasting and often permanent after a full course of treatment. The procedure is safe, quick, and can be performed on virtually any area of the body.</p><h2>Which Should You Choose?</h2><p>For those seeking a permanent solution with minimal ongoing maintenance, laser hair removal is the clear winner. While the upfront cost is higher, you save time and money in the long run by eliminating the need for regular traditional treatments.</p><p>At Aakar Dermatology, we offer advanced laser hair removal tailored to your skin and hair type. Book a consultation with Dr. Rajan Tajhya to find out if laser hair removal is right for you.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Laser vs Traditional Hair Removal | Aakar Dermatology',
                'meta_description' => 'Comparing laser hair removal with traditional methods. Find out which is better for permanent, smooth skin at Aakar Dermatology.',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Understanding Acne: Causes, Types & Best Treatments',
                'slug' => 'understanding-acne-causes-types-treatments',
                'category' => 'Skin Care',
                'excerpt' => 'A comprehensive guide to understanding what causes acne, the different types, and the most effective treatment options available today.',
                'content' => '<h2>What Is Acne?</h2><p>Acne is a common skin condition that occurs when hair follicles become clogged with oil and dead skin cells. It causes whiteheads, blackheads, pimples, cysts, and nodules. While acne is most common in teenagers, it can affect people of all ages.</p><h2>Causes of Acne</h2><p>The main causes include excess sebum (oil) production, bacteria (Cutibacterium acnes), hormonal changes, certain medications, and diet. Stress can also worsen existing acne.</p><h2>Types of Acne</h2><ul><li><strong>Whiteheads and Blackheads:</strong> Mildest form, clogged pores</li><li><strong>Papules and Pustules:</strong> Inflamed pimples</li><li><strong>Nodules and Cysts:</strong> Deep, painful, can cause scarring</li></ul><h2>Treatment Options</h2><p>Treatment depends on severity. Options include topical retinoids, antibiotics, benzoyl peroxide, chemical peels, laser therapy, and for severe cases, oral isotretinoin. Dr. Rajan Tajhya at Aakar Dermatology creates a customized treatment plan for each patient based on their specific acne type and skin.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Understanding Acne: Causes & Treatments | Aakar Dermatology',
                'meta_description' => 'Learn about acne causes, types, and best treatments from Dr. Rajan Tajhya at Aakar Dermatology, Lalitpur.',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(25),
            ],
            [
                'title' => 'Hair Transplant: What to Expect Before, During & After',
                'slug' => 'hair-transplant-what-to-expect',
                'category' => 'Hair Care',
                'excerpt' => 'A complete guide to the hair transplant journey—from consultation and the procedure itself to recovery and final results.',
                'content' => '<h2>Is Hair Transplant Right for You?</h2><p>Hair transplant is ideal for individuals experiencing pattern baldness, receding hairline, or hair thinning due to androgenetic alopecia. A consultation with Dr. Rajan Tajhya will determine your candidacy based on donor hair availability and the extent of hair loss.</p><h2>Before the Procedure</h2><p>You will need to avoid blood thinners, alcohol, and smoking for at least two weeks before surgery. Your scalp will be assessed and a personalized hairline design will be planned.</p><h2>The Procedure</h2><p>Under local anesthesia, hair follicles are extracted from the donor area (usually the back of the scalp) using the FUE technique. These follicles are then meticulously transplanted to the balding areas. The procedure can take 6–8 hours depending on the number of grafts.</p><h2>After the Procedure</h2><p>Mild swelling and redness are normal in the first few days. Transplanted hairs will shed around weeks 2–4 (this is normal—it is part of the growth cycle). New hair growth begins at 3–4 months, with full results visible at 12–18 months.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Hair Transplant Guide | What to Expect | Aakar Dermatology',
                'meta_description' => 'Complete guide to hair transplant before, during and after the procedure. Expert hair restoration by Dr. Rajan Tajhya at Aakar Dermatology.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(40),
            ],
            [
                'title' => 'Laser Hair Reduction: Sessions, Results and What to Expect',
                'slug' => 'laser-hair-reduction-guide',
                'category' => 'Laser Treatment',
                'thumbnail' => 'services/laser-hair-removal.webp',
                'excerpt' => 'A practical guide to how laser hair reduction targets follicles, why a course of visits is needed, and what to discuss at a consultation.',
                'content' => '<h2>Why does treatment take more than one visit?</h2><p>Hair does not grow all at once. Laser energy is most effective when a follicle is in an active growth phase, so a course of appointments is planned over time rather than relying on one session. Your clinician will recommend an interval based on the area and your response.</p><h2>What does the laser target?</h2><p>Focused light is absorbed by pigment in the hair follicle and converted to heat. This can slow subsequent growth. Skin and hair characteristics influence how a treatment is planned, which is why an individual assessment matters.</p><h2>What results should I expect?</h2><p>Laser hair reduction aims to reduce hair growth over time. It does not guarantee that every hair will be permanently removed. Some regrowth is possible, and any returning hair may be finer or lighter. Maintenance may be discussed with your clinician.</p><h2>Discuss your treatment plan</h2><p>At Aakar Dermatology, a consultation is the best place to discuss suitability, session timing, likely outcomes, and current fees. Read about our <a href="/our-services/laser-hair-reduction/">laser hair reduction service</a> or <a href="/contact">contact the clinic</a> to arrange a visit.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Laser Hair Reduction Guide | Aakar Dermatology',
                'meta_description' => 'Understand laser hair reduction sessions, how the treatment works, and realistic expectations from Aakar Dermatology.',
                'meta_keywords' => 'laser hair reduction, laser hair treatment, Lalitpur dermatology',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/eyelid-surgery-blepharoplasty-in-nepal/',
                'title' => 'Eyelid Surgery (Blepharoplasty) in Nepal and Costs',
                'category' => 'Surgical Care',
                'excerpt' => 'An overview of eyelid surgery candidacy, procedure planning, recovery, possible complications, and questions to discuss with a qualified surgeon.',
                'content' => '<h2>What is blepharoplasty?</h2><p>Blepharoplasty is surgery on the upper or lower eyelids. A consultation helps assess eyelid anatomy, health history, and the goals of treatment before deciding whether surgery is suitable.</p><h2>Planning and recovery</h2><p>The surgeon explains the proposed technique, expected healing, aftercare, and possible complications. Swelling and bruising can occur, and the final appearance takes time to settle.</p><h2>Costs and expectations</h2><p>Fees depend on the procedure and individual plan. Confirm current pricing directly with the clinic, and discuss realistic outcomes and alternatives before making a decision.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Eyelid Surgery and Costs in Nepal | Aakar Dermatology',
                'meta_description' => 'Learn about blepharoplasty assessment, recovery, risks, and costs in Nepal. Consult a qualified surgeon to discuss your options.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-09-13 09:25:00',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/laser-hair-removal-guide/',
                'title' => 'Laser Hair Removal: Benefits, Process, and Myths',
                'category' => 'Laser Treatment',
                'excerpt' => 'A guide to how laser hair reduction works, who may benefit, treatment preparation, aftercare, and common misconceptions.',
                'content' => '<h2>How does laser hair reduction work?</h2><p>Laser energy targets pigment in hair follicles and can reduce future growth. Hair grows in cycles, so a series of sessions is usually planned; results and suitability vary by person and treatment area.</p><h2>Before and after treatment</h2><p>A clinician should review your skin, hair, health history, and goals. Follow their advice about sun exposure, shaving, and aftercare, and contact the clinic if you notice a concerning reaction.</p><h2>Setting expectations</h2><p>Laser treatment is intended to reduce hair growth, not guarantee complete permanent removal. Some regrowth may occur and maintenance can be discussed during a consultation.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Laser Hair Removal Guide | Aakar Dermatology',
                'meta_description' => 'Understand laser hair reduction, treatment sessions, preparation, aftercare, and realistic results at Aakar Dermatology.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-09-16 10:36:00',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/understanding-wrinkles-causes-treatments/',
                'title' => 'Understanding Wrinkles: Causes, Treatments, and Prevention',
                'category' => 'Skin Care',
                'excerpt' => 'Explore common contributors to wrinkles and the range of care options a clinician may discuss based on skin, goals, and health history.',
                'content' => '<h2>Why do wrinkles develop?</h2><p>Skin changes with age, and factors such as sun exposure, smoking, repeated facial movement, and inherited traits can influence lines and skin firmness.</p><h2>Possible treatment options</h2><p>Depending on the concern, a clinician may discuss skin care, chemical peels, microneedling, laser procedures, injectables, or other approaches. These options have different benefits, limitations, and risks.</p><h2>Start with an assessment</h2><p>Protecting skin from excess sun can support skin health. A consultation can help identify suitable options and set realistic expectations; results vary and no treatment stops the natural aging process.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Understanding Wrinkles and Treatment Options | Aakar Dermatology',
                'meta_description' => 'Learn about factors that contribute to wrinkles and treatment options to discuss with a dermatologist at Aakar Dermatology.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-10-21 06:07:00',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/acne-scar-treatments/',
                'title' => 'Acne Scar Treatment: Types, Causes, and Solutions',
                'category' => 'Skin Care',
                'excerpt' => 'Learn how acne scars differ and why treatment planning depends on scar type, skin condition, and an individual dermatology assessment.',
                'content' => '<h2>Types of acne scars</h2><p>Acne may leave raised scars or areas of lost skin volume. Indented scars can have narrow, broad, or rolling shapes, and a person may have more than one type.</p><h2>Care and treatment</h2><p>Options can include medical acne care, chemical peels, microneedling, subcision, or laser procedures. The appropriate plan depends on the scars and active acne, and improvement rather than complete removal is generally the realistic goal.</p><h2>When to seek advice</h2><p>Early assessment of persistent acne can help discuss ways to reduce the risk of scarring. A dermatologist can explain the likely benefits, recovery, and risks of each option.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Acne Scar Types and Treatment | Aakar Dermatology',
                'meta_description' => 'Explore acne scar types and treatment approaches, and learn why a dermatologist assessment helps guide care.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-10-29 06:24:00',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/laser-hair-removal-nepal/',
                'title' => 'Laser Hair Removal in Nepal',
                'category' => 'Laser Treatment',
                'excerpt' => 'A practical look at laser hair reduction in Nepal, including treatment technology, session planning, preparation, and pricing considerations.',
                'content' => '<h2>Understanding the treatment</h2><p>Laser hair reduction uses light absorbed by pigment in hair follicles. Different devices and settings may be considered based on skin and hair characteristics, which makes a professional assessment important.</p><h2>Sessions and preparation</h2><p>Several appointments are commonly needed because hairs grow in cycles. Your clinician will advise on timing, sun exposure, shaving, and aftercare for your treatment area.</p><h2>Costs and results</h2><p>Fees depend on the area, device, and treatment plan, and should be confirmed with the clinic. Hair reduction varies; maintenance may be useful for some people and complete permanent removal is not guaranteed.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Laser Hair Removal in Nepal | Aakar Dermatology',
                'meta_description' => 'Read about laser hair reduction sessions, preparation, and pricing considerations in Nepal at Aakar Dermatology.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-10-29 08:05:00',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/laser-tattoo-removal-in-nepal/',
                'title' => 'Laser Tattoo Removal in Nepal',
                'category' => 'Laser Treatment',
                'excerpt' => 'Learn what affects laser tattoo removal, why multiple sessions may be needed, and what to discuss about safety and aftercare.',
                'content' => '<h2>How does laser tattoo removal work?</h2><p>Laser pulses target tattoo pigment so the body can gradually clear smaller pigment particles. Response varies with ink color, tattoo size and location, and individual skin characteristics.</p><h2>Sessions and aftercare</h2><p>Several treatments spaced over time may be needed. A clinician should assess the tattoo, explain expected outcomes and possible skin changes, and provide aftercare instructions.</p><h2>Choosing a treatment plan</h2><p>Complete removal cannot be guaranteed, and some ink colors or tattoos respond less predictably. Avoid home removal methods and consult a qualified provider about risks and costs.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Laser Tattoo Removal in Nepal | Aakar Dermatology',
                'meta_description' => 'Understand laser tattoo removal sessions, treatment factors, aftercare, and consultation options in Nepal.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-11-24 09:05:00',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/exosome-therapy-the-future-of-hair-and-skin-rejuvenation/',
                'title' => 'Exosome Therapy: The Future of Hair and Skin Rejuvenation in Lalitpur, Nepal',
                'category' => 'Skin Care',
                'excerpt' => 'An introduction to exosome-based hair and skin treatments, how they are described, and important questions about evidence and safety.',
                'content' => '<h2>What are exosomes?</h2><p>Exosomes are small particles involved in cell-to-cell communication. Aesthetic products and procedures using them are being explored for skin and hair concerns, but claims and evidence can vary by product and indication.</p><h2>What should patients consider?</h2><p>Ask the provider about the product source, regulatory status, evidence, procedure details, risks, and alternatives. A qualified clinician should assess whether any procedure is suitable for your circumstances.</p><h2>Evidence and expectations</h2><p>Research in this area is developing, and outcomes should not be assumed or guaranteed. Discuss established options as well as uncertainties before choosing treatment.</p>',
                'author' => 'Dr. Rajan Tajhya',
                'meta_title' => 'Exosome Therapy for Hair and Skin | Aakar Dermatology',
                'meta_description' => 'An overview of exosome-based hair and skin procedures, evidence considerations, and questions to discuss with a qualified clinician.',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2025-05-26 07:26:00',
            ],
        ];

        foreach ($blogs as $blog) {
            if (isset($blog['source_url'])) {
                $path = parse_url($blog['source_url'], PHP_URL_PATH);
                $blog['slug'] = basename(rtrim((string) $path, '/'));
                unset($blog['source_url']);
            }

            Blog::updateOrCreate(['slug' => $blog['slug']], $blog);
        }
    }
}
