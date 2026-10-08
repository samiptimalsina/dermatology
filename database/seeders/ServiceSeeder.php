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
                'title' => 'Acne Treatment',
                'slug' => 'acne-treatment',
                'category' => 'skin',
                'icon' => 'acne',
                'short_description' => 'Comprehensive acne management using advanced medical therapies tailored to your skin type and severity.',
                'full_description' => '<p>Acne is one of the most common skin conditions affecting people of all ages. At Aakar Dermatology, we provide personalized acne treatment plans that address the root cause of your breakouts—whether hormonal, bacterial, or lifestyle-related.</p><p>Our treatments include topical therapies, oral medications, chemical peels, laser therapy, and comedone extraction. We also offer scar revision treatments to restore smooth, even skin after acne resolves.</p>',
                'meta_title' => 'Acne Treatment in Lalitpur | Aakar Dermatology',
                'meta_description' => 'Expert acne treatment at Aakar Dermatology. Personalized plans including medications, peels, laser & scar revision. Book your consultation today.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Hair Transplant',
                'slug' => 'hair-transplant',
                'category' => 'hair',
                'icon' => 'hair',
                'short_description' => 'Advanced FUE and FUT hair transplant techniques for natural-looking, permanent hair restoration results.',
                'full_description' => '<p>Hair loss can deeply affect your confidence and self-image. Dr. Rajan Tajhya is an expert in hair transplant surgery using the latest Follicular Unit Extraction (FUE) and Follicular Unit Transplantation (FUT) methods.</p><p>The procedure involves harvesting healthy hair follicles from the donor area and transplanting them to areas of thinning or baldness. Results are natural-looking, permanent, and life-changing.</p>',
                'meta_title' => 'Hair Transplant in Lalitpur | Aakar Dermatology',
                'meta_description' => 'Expert FUE & FUT hair transplant surgery by Dr. Rajan Tajhya at Aakar Dermatology, Lalitpur. Natural, permanent results.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Eyelid Surgery (Blepharoplasty)',
                'slug' => 'eyelid-surgery',
                'category' => 'surgical',
                'icon' => 'eye',
                'short_description' => 'Precise eyelid surgery to correct droopy eyelids, under-eye bags, and restore a youthful, refreshed appearance.',
                'full_description' => '<p>Blepharoplasty, or eyelid surgery, is a delicate procedure that removes excess skin, fat, and muscle from the upper or lower eyelids. Dr. Rajan Tajhya\'s precise surgical technique ensures natural results that open up your eyes and refresh your appearance.</p><p>Whether for cosmetic improvement or to correct functional issues like impaired vision from drooping eyelids, our blepharoplasty procedures are performed with utmost care and precision.</p>',
                'meta_title' => 'Eyelid Surgery Lalitpur | Blepharoplasty | Aakar Dermatology',
                'meta_description' => 'Expert blepharoplasty (eyelid surgery) by Dr. Rajan Tajhya at Aakar Dermatology. Refresh your look with precise, natural eyelid correction.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Plasma-Rich Platelet (PRP) Therapy',
                'slug' => 'prp-therapy',
                'category' => 'hair',
                'icon' => 'prp',
                'short_description' => 'Natural hair regrowth and skin rejuvenation using your own platelet-rich plasma for remarkable results.',
                'full_description' => '<p>PRP (Platelet-Rich Plasma) therapy harnesses your body\'s natural healing powers to stimulate hair regrowth and rejuvenate the skin. A small amount of your blood is processed to concentrate the growth factors, which are then injected into the treatment area.</p><p>PRP is highly effective for treating androgenetic alopecia (pattern baldness), thinning hair, and can also be used for facial rejuvenation, reducing fine lines and improving skin texture.</p>',
                'meta_title' => 'PRP Therapy Lalitpur | Hair & Skin Rejuvenation | Aakar Dermatology',
                'meta_description' => 'PRP therapy for hair regrowth and skin rejuvenation at Aakar Dermatology. Natural, safe treatment using your own growth factors.',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Laser Facial Treatment',
                'slug' => 'laser-facial',
                'category' => 'laser',
                'icon' => 'laser-face',
                'short_description' => 'Rejuvenate your skin with targeted laser facial treatments that reduce pigmentation, fine lines, and improve overall tone.',
                'full_description' => '<p>Laser facial treatments at Aakar Dermatology address a wide range of skin concerns including hyperpigmentation, sun damage, acne scars, fine lines, and uneven skin tone. Our advanced laser systems deliver precise energy to targeted areas, stimulating collagen production and skin renewal.</p><p>The result is brighter, smoother, and more youthful-looking skin with minimal downtime.</p>',
                'meta_title' => 'Laser Facial Treatment Lalitpur | Skin Rejuvenation | Aakar Dermatology',
                'meta_description' => 'Advanced laser facial treatments for pigmentation, acne scars & skin rejuvenation at Aakar Dermatology. Safe, effective & tailored for you.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Tattoo Removal',
                'slug' => 'tattoo-removal',
                'category' => 'laser',
                'icon' => 'tattoo',
                'short_description' => 'Safe and effective laser tattoo removal that breaks down ink particles for gradual, complete tattoo clearance.',
                'full_description' => '<p>Changed your mind about a tattoo? Our advanced Q-switched laser technology effectively breaks down tattoo ink particles of all colors, allowing your body to naturally eliminate them. Multiple sessions are usually required depending on the tattoo\'s size, color, and age.</p><p>The procedure is safe, minimally invasive, and performed by our expert team to minimize scarring and ensure the best possible results.</p>',
                'meta_title' => 'Laser Tattoo Removal Lalitpur | Aakar Dermatology',
                'meta_description' => 'Safe laser tattoo removal at Aakar Dermatology, Lalitpur. Effective removal for all colors & skin types. Book your consultation today.',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Skin Treatment',
                'slug' => 'skin-treatment',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Comprehensive medical skin treatments for eczema, psoriasis, pigmentation, and other dermatological conditions.',
                'full_description' => '<p>At Aakar Dermatology, we diagnose and treat the full spectrum of skin conditions. From common concerns like eczema, psoriasis, and vitiligo to complex dermatological disorders—our evidence-based approach ensures accurate diagnosis and effective treatment.</p><p>We combine medical management with aesthetic solutions to not only treat your condition but also restore your skin\'s natural beauty and your confidence.</p>',
                'meta_title' => 'Medical Skin Treatment Lalitpur | Aakar Dermatology',
                'meta_description' => 'Expert medical skin treatment for eczema, psoriasis, pigmentation & more at Aakar Dermatology. Personalized, evidence-based dermatology care.',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        // Full service copy from the supplied Word documents.
        $documentServices = [
            [
                'title' => 'Acne and Acne Scar Removal',
                'slug' => 'acne-and-acne-scar-removal',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Explore acne and acne scar treatments in Nepal. At Dr. Rajan Tajhya’s clinic. Get expert advice for healthier skin!',
                'full_description' => <<<'SERVICE_CONTENT_01'
                    <p>In Nepal, we often know acne as pimples. Acne is formed when the hair pores on  the skin become plugged with oil and dead skin cells. This is the perfect place for bacteria to grow and create red bumps and pus-filled red bumps known as acne.</p>
                    <p>Acne can sometimes leave long-lasting marks called acne scars.</p>
                    <p>Scars that occur after acne is acne scar, which can range from mild hyperpigmented dark marks to deep ugly scars.</p>
                    <p>Are all acne scars the same?</p>
                    <p>All acne scars are not the same. Each type responds to treatment procedures differently.</p>
                    <p>This is why it is important to know their types and know what kind of scar you have. But most people always have mixed types of scar.</p>
                    <p>a) Raised scar</p>
                    <p>This type of scar is also called hypertrophic scars.</p>
                    <p>Unlike other kinds of acne scars that are depressed, raised hypertrophic scars are thick, lumpy formations that are raised than the normal skin surface.</p>
                    <p>Raised scars are seen more in the chest and back than on the face. They are formed by the over-production of collagen during acne healing.</p>
                    <p>b) Depressed scar</p>
                    <p>They are also called atrophic scars. They are relatively flat, thin scars. Depressed scars look sunken below the normal skin, hence creating an uneven skin surface.</p>
                    <p>Depressed scars are formed when enough collagen is not formed during acne healing.</p>
                    <p>These are the types of depressed scars:</p>
                    <p>Boxcar</p>
                    <p>Boxcar refers to scars with broad depressions and sharply defined edges. They are generally deep and U-shaped. However, the shallower (less deep) they are, the better they respond to acne scar removal treatments.</p>
                    <p>Ice pick</p>
                    <p>These are deep, narrow pitted scars. Ice picks are generally V-shaped and are the hardest to deal with because they can go deeper into the skin during formation.</p>
                    <p>Rolling</p>
                    <p>These are also depressed scars with sloping edges. They are rolling with rounded edges and irregular appearance.</p>
                    <p>Notice the small depressions caused on his cheek because of acne.</p>
                    <p>Treatment of acne during the initial days of acne eruption heals without any treatment and leaves no scar. In some cases, acne occurs time and again and when not treated well leaves a scar. Timely treatment of acne is necessary to prevent acne scars.</p>
                    <p>When the acne gets old and reoccurs frequently chances of causing scars also increase. Besides these environmental factors, psychological factors, hormonal factors, and other comorbid conditions also play a vital role.</p>
                    <p>There are numerous treatment procedures available to minimize/remove acne scars.</p>
                    <p>However, you need to understand that the basic working principle is the same for all the procedures.</p>
                    <p>Basically, all kinds of treatment focus on stimulating the production of collagen and/or elastin. Collagen and elastin are two substances that will work against acne scars. They will work on the tissue that is deformed by the acne scars and will make them almost like normal human skin.</p>
                    <p>This process is called Collagen Induction Therapy.</p>
                    <p>At Dr.Rajan Tajhya’s skin laser clinic, we have the following treatments for you:</p>
                    <p>a) PRP for acne scar treatment</p>
                    <p>b) Microneedling with disposable needles</p>
                    <p>c) Fillers</p>
                    <p>d) TCA Cross Method</p>
                    <p>e) Subcision</p>
                    <p>f) Surgery</p>
                    <p>g) Microneedling Radiofrequency</p>
                    <p>h) Co2 fractional lasers</p>
                    <p>Dr. Rajan Babu Tajhya is a board-certified dermatologist and laser specialist. He completed his M.B.B.S. from Kathmandu University and Specialized Dermatology from Tribhuwan University in the year 2010 A.D.</p>
                    <p>We offer free of cost consultation by an expert skin doctor. You can clear your queries and learn more about ways to ensure a healthier skin-life.</p>
                    <p>What is the price of Acne Scar Removal Treatment in Nepal</p>
                    <p>1) Microneedling: Rs. 4000 2) Microneedling + PRP: Rs. 6000 3) Microneedling + Subcision: Rs. 7000 4) Only Subcision: Rs. 5000 5) TCA Cross Peel: Rs. 3000 (Free in-between sessions)</p>
                    <p>Package for 8 months, 8 sessions: Rs. 42,000</p>
                    <p>*Kindly expect realistic results.</p>
                    SERVICE_CONTENT_01,
                'meta_title' => 'Acne and Acne Scar Removal | Aakar Dermatology',
                'meta_description' => 'Explore acne and acne scar treatments in Nepal. At Dr. Rajan Tajhya’s clinic. Get expert advice for healthier skin!',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Asian Eyelid Surgery or Blepharoplasty',
                'slug' => 'asian-eyelid-surgery-or-blepharoplasty',
                'category' => 'surgical',
                'icon' => 'surgical',
                'short_description' => 'Achieve fuller, bigger eyes with Asian Eyelid Surgery in Nepal. This one-hour procedure offers a permanent solution for easier eyeliner.',
                'full_description' => <<<'SERVICE_CONTENT_02'
                    <p>Most ladies use eyelid sticker to be able to put eyeliners while doing their makeup. With this one-hour procedure (Asian Eyelid Surgery), the problem will be solved permanently.</p>
                    <p>Asian eyelid surgery is one of the most common cosmetic procedures we perform in our clinic. The primary purpose is to create a space for Mongolian eyes so that they can put an eyeliner. As the name suggests, the surgery is mainly done by Mongolians or Asians to have fuller, bigger eyes.</p>
                    <p>What is the price of Asian Eye Lid Surgery in Lalitpur, Kathmandu, Nepal</p>
                    <p>The price of Asian Eye Lid Surgery in Lalitpur, Kathmandu, Nepal is Rs 50000 (1 Hour)</p>
                    SERVICE_CONTENT_02,
                'meta_title' => 'Asian Eyelid Surgery or Blepharoplasty | Aakar Dermatology',
                'meta_description' => 'Achieve fuller, bigger eyes with Asian Eyelid Surgery in Nepal. This one-hour procedure offers a permanent solution for easier eyeliner.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Black Doll Laser',
                'slug' => 'black-doll-laser',
                'category' => 'laser',
                'icon' => 'laser',
                'short_description' => 'Black Doll Laser procedure at Dr. Rajan Clinic in Nepal. This non-invasive treatment reduces signs of aging, and promotes collagen.',
                'full_description' => <<<'SERVICE_CONTENT_03'
                    <p>The technical name for the black doll laser procedure is carbon laser skin rejuvenation. The Black Doll carbon laser facial treatment is a laser treatment that smooths away imperfections from the skin’s surface and reduces signs of aging.</p>
                    <p>Your skin type, medical history, and medication will be checked during your consultation to make sure you are suitable for treatment.</p>
                    <p>We first cleanse your face and then lightly apply carbon lotion. This acts as a photo enhancer, and the light of the laser is absorbed by the black particles of carbon. These particles get blasted off and take the top layer of dead skin with them as the laser moves across your skin.</p>
                    <p>The laser also deals with enlarged pores, areas of pigmentation, and scarring – and it also plumps the skin.</p>
                    <p>The black doll laser procedure fills, shatters, and removes impurities such as dead skin cells. The procedure also promotes a gentle inflammatory response, that helps in the replenishment of collagen and elastin.</p>
                    <p>You will get immediate clarity and skin tightening. Lastly, it also promotes ongoing dermal stimulation for up to 6 months.</p>
                    <p>Wonderful results of the black doll laser procedure</p>
                    <p>a) It may gradually minimize pores</p>
                    <p>b) Could help reveal a luminous complexion</p>
                    <p>c) May help even skin tone and texture</p>
                    <p>d) It helps clear dead skin cells</p>
                    <p>e) Effective on hands, chest, and back</p>
                    <p>f) Reducing the signs of premature aging</p>
                    <p>g) Improving skin integrity and radiance</p>
                    <p>h) Reducing fine lines and wrinkles</p>
                    <p>i) Increasing skin tone and texture</p>
                    <p>j) Stimulating collagen growth for firmer, plumper skin</p>
                    <p>k) Reducing oily skin or exfoliating dry skin</p>
                    <p>l) Erasing or fading yellow/brown pigmentation</p>
                    <p>m) Shrinking scars (must be young scars of small diameter).</p>
                    <p>n) Safe and effective for all types of acne.</p>
                    <p>o) Gently clean your pores to help reduce blackheads and whiteheads</p>
                    <p>p) Eliminates the need to extract comedones</p>
                    <p>q) Simultaneously targets acne bacteria and shrinks your sebaceous glands for reduced oil production, congestion, and outbreaks</p>
                    <p>r) Decreases cyst size, papules, and nodules</p>
                    <p>Is the black doll laser procedure harmful? Does it have side effects?</p>
                    <p>Its a non-invasive procedure, which directly means the side-effects are minimal. Some patients can experience minor redness on the face after a carbon charcoal mask.</p>
                    <p>However, this usually disappears within a few hours. Lastly, we recommend you avoid makeup for a few hours after the procedure just to ensure the makeup does not interact with and/ or irritate the skin.</p>
                    <p>How many treatment sessions will I need?</p>
                    <p>It is recommended to subscribe to multiple sessions of Black Doll Laser Treatment. While 4 to 6 sessions is the typical treatment plan, it may depend on the result we want.</p>
                    <p>Black doll laser price in Lalitpur, Kathmandu, Nepal</p>
                    <p>We at Dr. Rajan Tajhya Clinic are committed to providing excellent treatment experiences to our clients. Currently, the Black Doll Laser treatment is priced at a generous rate of Rs. 5,000 to 6000 per treatment.</p>
                    SERVICE_CONTENT_03,
                'meta_title' => 'Black Doll Laser | Aakar Dermatology',
                'meta_description' => 'Black Doll Laser procedure at Dr. Rajan Clinic in Nepal. This non-invasive treatment reduces signs of aging, and promotes collagen.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Botox Injection',
                'slug' => 'botox-injection',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Discover safe and effective Botox Injection treatments at Dr. Rajan Tajhya Clinic in Kathmandu. Reduce wrinkles and fine lines.',
                'full_description' => <<<'SERVICE_CONTENT_04'
                    <p>Botox Injection treatment is one of the most popular cosmetic treatments in the world.</p>
                    <p>Botox has very few risks and side effects. It adheres to the highest standards of clinical quality. Since Botox treatment is perfected by decades of research and experiments, it is totally safe for all.</p>
                    <p>Botox treatment is done to treat wrinkles, fine lines, crow feet, and facelifts. The positive effect of the injection lasts for 6 months to 1 year. It has no side effects and is called a lunch-time procedure because of the minimum downtime.</p>
                    <p>Botox is simply a protein that researchers found useful in medical and cosmetic uses.</p>
                    <p>When we talk about Botox treatment for the skin, we should know that it is injected into the muscles. This is why it is called an injectable medicine. Botox injections prevent the release of acetylcholine, which stops muscle cells from contracting. The injected fluid reduces abnormal muscle contraction, allowing the muscles to become less stiff and contract, which would otherwise cause wrinkles.</p>
                    <p>Before the procedure</p>
                    <p>a. Do not drink alcohol for two days before the treatment to prevent bruising in the injected area.</p>
                    <p>b. Be patient. It takes three days or more to see an effect.</p>
                    <p>c. Do not do Botox Injection treatment if you are pregnant or a breastfeeding mom. You can always do the procedure later.</p>
                    <p>During Botox Injection treatment</p>
                    <p>a. Your treatment provider will study the wrinkles and muscle structure on your face.</p>
                    <p>b. S/he will determine the right spots to inject the fluid so that you don’t witness any asymmetry after Botox starts to work.</p>
                    <p>After the procedure</p>
                    <p>a. Do not exercise for a day.</p>
                    <p>b. The place where your doctor injects the Botox will have mosquito bite-like spots for some time. Do not touch that area.</p>
                    <p>c. You can wear makeup over the injected area. Just be sure not to rub hard over the spots. Be gentle when you put makeup or take it off.</p>
                    <p>d. Do not lay down for the next 4 hours.</p>
                    <p>e. Hydrate yourself enough after the procedure.</p>
                    <p>When will botox treatment for wrinkle removal show results?</p>
                    <p>In general, you can see the effects of Botox as early as 3 to 4 days after injection. Most will see results within 10 to 14 days. In 14 days, you will witness optimum results.</p>
                    <p>Keep in mind that after your first treatment, you may feel a slight ‘tight’ sensation or ‘heaviness’, which will disappear in 1-2 weeks.</p>
                    <p>If you are an impatient bird, let us tell you that noticeable results are not usually visible the next day. They were right when they said that good things take time.</p>
                    <p>At Dr. Rajan Tajhya Clinic, your Botox Injection procedure will be performed by the best hands  .</p>
                    <p>Dr. Rajan Babu Tajhya is a board-certified dermatologist and laser specialist. He completed his M.B.B.S. from Kathmandu University and Specialized Dermatology from Tribhuwan University in the year 2010 A.D.</p>
                    <p>Does Botox have any side effects? What are the possible complications of Botox treatment for wrinkle removal?</p>
                    <p>According to healthline.com, “Botox was originally FDA approved in 1989 for the treatment of blepharospasm and other eye-muscle problems.</p>
                    <p>In 2002, the FDA approved the use of Botox for cosmetic treatment for moderate to severe frown lines between the eyebrows. It was approved by the FDA for treatment of wrinkles around the corners of the eyes (crow’s feet) in 2013.”</p>
                    <p>According to a study, Botox is “a simple, safe, and effective treatment for the reduction of forehead wrinkles.”</p>
                    <p>Nevertheless, you should inform your treatment provider of any medical condition you have. Also, inform them if you are currently taking any medicine. This is especially true if you are on blood-thinning medicine like aspirin. People who take aspirin tend to witness bruising in the injected areas.</p>
                    <p>These are the after-procedure scenarios of Botox:</p>
                    <p>a. Bruising (Rare with Botox. This is actually a common problem with fillers (Fillers are a possible alternative to Botox treatment for wrinkle removal.)</p>
                    <p>b. Immediately after the Botox procedure, you will have little spots, like that of mosquito bites. But these spots will go away after about 20 minutes.</p>
                    <p>c. Most people think the procedure is going to be painful. However, some don’t even notice that the procedure is already over. It can be that easy sometimes. Nevertheless, most will experience pain that is tolerable. You just need two minutes of courage.</p>
                    <p>d. You do not have to allocate an entire day for Botox treatment. This procedure can be done during your work break, and you can apply slight makeup after the procedure.</p>
                    <p>e. Our certified professionals at Dr. Rajan Tajhya Clinic will always inform you about the issues and will do a risk assessment. If you encounter any of the problems after the treatment, immediately contact us back.</p>
                    <p>How much will Botox cost in Kathmandu? What is the usual price for Botox treatment in Nepal?</p>
                    <p>Botox treatment for wrinkle removal is certainly a costly procedure. The treatment can only be done under the supervision of an experienced professional.</p>
                    <p>However, the price of Botox treatment in Kathmandu, Nepal is nowhere near the pricing of plastic surgery or injectable fillers like Juvederm or Restylane.</p>
                    <p>Dr. Rajan Tajhya Clinic’s primary focus is to always cater to the needs of its clients, i.e. to serve you in the best way.</p>
                    <p>With your best interests in consideration, here are our prices list of BOTOX in Nepal:</p>
                    <p>Botox</p>
                    <p>Forehead (20 units)</p>
                    <p>Crows feet (15-20 units)</p>
                    <p>Rs.500 (Per Unit) Rs.10,000 Rs.7,500-10,000</p>
                    SERVICE_CONTENT_04,
                'meta_title' => 'Botox Injection | Aakar Dermatology',
                'meta_description' => 'Discover safe and effective Botox Injection treatments at Dr. Rajan Tajhya Clinic in Kathmandu. Reduce wrinkles and fine lines.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Chemical Peeling',
                'slug' => 'chemical-peeling',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Revitalize your skin with chemical peels at Dr Rajan Clinic in Nepal. Achieve smoother skin for just Rs. 2,000 per session.',
                'full_description' => <<<'SERVICE_CONTENT_05'
                    <p>A chemical peel is a procedure in which a chemical solution is applied to the skin to remove the top layers. The skin that grows back is smoother.</p>
                    <p>Chemical peels can improve the skin’s appearance. In this treatment, a chemical solution is applied to the skin, which makes it “blister” and eventually peel off. The new skin is usually smoother and less wrinkled than the old skin. Chemical peels can be done on the face, neck, or hands.</p>
                    <p>A chemical peel treatment is designed to shed dead skin cells, so your skin will peel over a few days, or a week; however, the results are worth it!</p>
                    <p>After a deep chemical peel, you’ll see a dramatic improvement in the look and feel of treated areas. Results may not be permanent. Over time, age and new sun damage can lead to new lines and skin color changes. With all peels, the new skin is temporarily more sensitive to the sun.</p>
                    <p>Popular chemicals in peeling solutions include retinoids (tretinoin dissolved in propylene glycol), alpha-hydroxy acids (lactic acid and glycolic acid), beta-hydroxy acids (salicylic acid), trichloroacetic acid, and phenol (carbolic acid).</p>
                    <p>What is the cost of Chemical peeling  in Lalitpur, Kathmandu, Nepal?</p>
                    <p>The cost of Chemical peeling  in Lalitpur, Kathmandu, Nepal Rs. 4000 per session</p>
                    <p>Depending upon the condition superficial peel, medium peel, or deep peel is done. A deep peel is for most rough and scarred skin.</p>
                    <p>A superficial peel is for minor skin pigmentations and skin rejuvenation. With proper technique and proper care, a simple chemical peel procedure can give a great result with minimum downtime.</p>
                    SERVICE_CONTENT_05,
                'meta_title' => 'Chemical Peeling | Aakar Dermatology',
                'meta_description' => 'Revitalize your skin with chemical peels at Dr Rajan Clinic in Nepal. Achieve smoother skin for just Rs. 2,000 per session.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Diode Laser Hair Removal',
                'slug' => 'diode-laser-hair-removal',
                'category' => 'laser',
                'icon' => 'laser',
                'short_description' => 'Achieve smooth, hair-free skin with Diode Laser Hair Removal at Dr Rajan Clinic in Lalitpur, Kathmandu. Affordable sessions start at Rs. 2,500',
                'full_description' => <<<'SERVICE_CONTENT_06'
                    <p>You might want to remove the unwanted body hair for a variety of reasons. It is perfectly normal. In fact, it is an act of self-care.</p>
                    <p>Waxing, threading, shaving, or even plucking are painful, less efficient options that you have. However, the problem is that these procedures are not permanent and you have to repeat the process all over again.</p>
                    <p>What if you could go through a procedure that permanently removes your body hair (or at least prolongs the treatment effectiveness time)?</p>
                    <p>Laser Hair Reduction/Removal is exactly the solution you’re looking for.</p>
                    <p>Diode Laser Hair Removal uses a mild form of the laser beam that is completely harmless to the human body. The laser beam destroys the hair follicles and prevents unwanted body hair from growing.</p>
                    <p>Laser Hair Removal can be used to remove unnecessary hair from the face, legs, arms, chest, underarm, bikini, and other body parts.</p>
                    <p>How does Diode Laser Hair Removal work?</p>
                    <p>Diode Laser Hair Removal uses a mild form of the laser beam that is completely harmless to the human body. The laser beam destroys the hair follicles and prevents unwanted body hair from growing.</p>
                    <p>Laser Hair Removal can be used to remove unnecessary hair from the face, legs, arms, chest, underarm, bikini, and other body parts. The hair growth decreases noticeably right from the very first session and the existing body hair after each session will be finer and lighter.</p>
                    <p>Is Laser Hair Removal a permanent solution?</p>
                    <p>In each session, about 10 to 25 percent of body hair is removed. Thus, it takes about 5 to 7 sessions to get the best result.</p>
                    <p>After a session, the next session will be done after four to six weeks. Thus, the entire five or seven sessions procedure might take anywhere from seven to nine weeks.</p>
                    <p>Note: The human body is a complex mechanism, and the hair follicles might regenerate even after completely destroying them. Thus, we recommend occasional maintenance sessions even after the package sessions are completed. Once or twice a year after the initial sessions are performed should be the best.</p>
                    <p>Benefits of Diode Laser Hair Removal over other procedures.</p>
                    <p>a. The diode that we use for Laser Hair Removal is FDA approved.</p>
                    <p>b. Painless, safe, and has no downtime.</p>
                    <p>c. Saves your precious time and money that you would generally spend waxing or shaving.</p>
                    <p>d. The procedure is several times more effective than conventional methods like electrolysis and depilatories.</p>
                    <p>Are there any side effects?</p>
                    <p>If done by improperly trained or careless/unprofessional staff, you might get blisters and burn.</p>
                    <p>At Dr. Rajan clinic, we have a highly trained team along with experienced skin doctors and laser specialists.</p>
                    <p>Moreover, we care about the safety of our customers. We would never approve of any procedure or technology that poses a health risk to anybody.</p>
                    <p>Also, unlike most people’s belief, Laser Hair Removal doesn’t cause cancer. Researches have proven their safety and there have been no reported cases of anyone experiencing such devastating effects.</p>
                    <p>Why use this service at Dr. Rajan Tajhya's Clinic?</p>
                    <p>1) Affordable and pocket-friendly. You can get rid of unwanted body hair without having to sell a fortune and an arm.</p>
                    <p>2) Effective and convenient. Although we have the most affordable laser hair removal procedure in Kathmandu, we don’t compromise quality for the price. We have a 100% satisfied clientele network.</p>
                    <p>3) We serve both men and women and cater to each of their specific needs.</p>
                    <p>4) We have Dr. Rajan Babu Tajhya. Dermatologist and laser specialist who is highly praised for his skills and character.</p>
                    <p>5) FDA approved Diode Laser for optimum safety and result.</p>
                    <p>6) We guarantee a painless and permanent reduction.</p>
                    <p>Laser Hair Removal Price in Lalitpur, Kathmandu, Nepal</p>
                    <p>The price list of laser hair removal is:</p>
                    <p>MILESMAN QUADRUPLE WAVELENGTH DIODE LASER</p>
                    <p>Body Part</p>
                    <p>Per Session</p>
                    <p>Package (8 Session)</p>
                    <p>Face</p>
                    <p>Rs. 5,000</p>
                    <p>Rs. 30,000</p>
                    <p>Underarms</p>
                    <p>Rs. 3,500</p>
                    <p>Rs. 21,000</p>
                    <p>Hands</p>
                    <p>Rs. 7,000</p>
                    <p>Rs. 42,000</p>
                    <p>Legs</p>
                    <p>Rs. 9,000</p>
                    <p>Rs. 54,000</p>
                    <p>Below knee</p>
                    <p>Rs. 5,000</p>
                    <p>Rs. 30,000</p>
                    <p>Chest</p>
                    <p>Rs. 7,000</p>
                    <p>Rs. 42,000</p>
                    <p>Chest + abdomen</p>
                    <p>Rs. 8,000</p>
                    <p>Rs. 48,000</p>
                    <p>Back</p>
                    <p>Rs. 6,000</p>
                    <p>Rs. 36,000</p>
                    <p>Buttock</p>
                    <p>Rs. 6,000</p>
                    <p>Rs. 36,000</p>
                    <p>Bikini</p>
                    <p>Rs. 6,000</p>
                    <p>Rs. 36,000</p>
                    <p>Whole body</p>
                    <p>Rs. 35,000 to 40,000</p>
                    <p>Rs. 2,10,000 to 2,40,000</p>
                    SERVICE_CONTENT_06,
                'meta_title' => 'Diode Laser Hair Removal | Aakar Dermatology',
                'meta_description' => 'Achieve smooth, hair-free skin with Diode Laser Hair Removal at Dr Rajan Clinic in Lalitpur, Kathmandu. Affordable sessions start at Rs. 2,500',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Hair Transplant',
                'slug' => 'hair-transplant',
                'category' => 'hair',
                'icon' => 'hair',
                'short_description' => 'Restore your hair with advanced Hair Transplant services at Dr. Rajan Tajhya Clinic in Nepal. And get the best results.',
                'full_description' => <<<'SERVICE_CONTENT_07'
                    <p>Hair transplant is a surgery that aims to restore growth on the area of the scalp &amp; body with limited growth. Not only the scalp, eye-brow transplant, and beard transplant are also gaining popularity.</p>
                    <p>The procedure is usually common in males. There are different techniques for the transplant FUE, FUT, DHT (Follicular Unit Extraction), (Follicular Unit Transplant), and (Direct Hair Transplant).</p>
                    <p>As being a very lengthy procedure depending upon the number of grafts Hair Transplant can require 4 hrs to 8 hrs in a one-day procedure.</p>
                    <p>Along with the psychological impact baldness in men has an economical burden when they opt for transplants in Nepal. So in Dr Rajan Tajhya clinic, we have tried our best to make our transplant service pocket friendly with the best results.</p>
                    <p>Brief Introduction of all Solutions for Hair Loss</p>
                    <p>Our dermatologist at Dr Rajan clinic might run a few blood tests to better diagnose the type and cause of your hair loss. Many information can be received from a blood test, like hormone levels, the effect of medication, or iron and protein levels. All these factors influence hair fall (and growth) in some way.</p>
                    <p>PRP therapy</p>
                    <p>Basically, platelets are separated from your own blood sample and injected into your scalp. Since platelets have growth-inducing properties, platelet injection will make your hair regrow with vitality and strength in no time.</p>
                    <p>Furthermore, PRP therapy has proved to be exponentially more beneficial when used with other procedures.</p>
                    <p>For example, it is not uncommon for our dermatologist at Dr Rajan clinic to do PRP injection therapy with microneedling. The benefits add up and multiply to cure your hair loss problem as effectively as possible.</p>
                    <p>Microneedling</p>
                    <p>This is done either by a device called a derma roller or another device called a derma pen.</p>
                    <p>This procedure improves blood flow in the scalp area, hence strengthening the hair. Microneedling also induces collagen production, a substance that promotes hair and skin vitality and health.</p>
                    <p>At Dr Rajan Tajhya clinic, we prefer to use derma pen over derma rollers for numerous reasons.</p>
                    <p>There are multiple reasons why microneedling is a recommended procedure for patients struggling with hair loss. The first reason is obvious: microneedling stimulates the production of collagen that keeps the hair follicles strong and better-supplied with nutrients.</p>
                    <p>The second, less obvious reason is that microneedling enhances the absorption of medications of hair loss. For instance, microneedling accelerates and enhances the absorption of Minoxidil, thus increasing its effectiveness.</p>
                    <p>Mesotherapy</p>
                    <p>Growth factors are placed near the hair follicles. This improves the strength, length, and volume of hair. Thus, problems like brittle hair, excessive hair loss can be cured with mesotherapy.</p>
                    <p>For most of our clients, PRP with microneedling, or the procedures separately has proven to be the best.</p>
                    <p>Hair Transplant in Nepal</p>
                    <p>We can always opt for a hair transplant procedure for patients who have gone bald or have very little hair on their scalp.</p>
                    <p>This is suitable for clients who have come to the clinic too late in their hair fall phase. Basically, a hair transplant is a type of surgery that moves hair you already have to fill an area with thin or no hair.</p>
                    <p>Hair transplantation is a surgical technique that removes hair follicles from one part of the body, called the ‘donor site’, to a bald or balding part of the body known as the ‘recipient site’. The technique is primarily used to treat male pattern baldness.</p>
                    <p>It takes around six months before you can see significant changes in hair growth. The complete results of the transplant will be visible after a year. In most cases, a hair transplant will last a lifetime because healthy hair follicles are transplanted into thinning or bald areas.</p>
                    <p>Hair transplants are typically more successful than over-the-counter hair restoration products. But there are some factors to consider: Anywhere from 10 to 80 percent of the transplanted hair will fully grow back in an estimated three to four months. Like regular hair, the transplanted hair will thin over time.</p>
                    <p>Furthermore, thanks to local anesthesia and post-operative pain medications, a hair transplant is not painful. While no surgery can be completely painless and some brief and likely temporary level of discomfort is possible, a hair transplant is typically a pleasant and easy experience for most hair loss sufferers.</p>
                    <p>Hair transplants can look completely natural — as long as you go to the right surgeon.</p>
                    SERVICE_CONTENT_07,
                'meta_title' => 'Hair Transplant | Aakar Dermatology',
                'meta_description' => 'Restore your hair with advanced Hair Transplant services at Dr. Rajan Tajhya Clinic in Nepal. And get the best results.',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Hydra Facial',
                'slug' => 'hydra-facial',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Revitalize your skin with HydraFacial treatment at Dr Rajan Clinic in Lalitpur. Enjoy glowing, hydrated skin, suitable for all skin types!',
                'full_description' => <<<'SERVICE_CONTENT_08'
                    <p>HydraFacial treatment is an innovative advance in non-laser skin resurfacing. It combines cleansing, exfoliation, extraction, hydration, and anti-oxidant protection at the same time to give you clearer, glowing skin.</p>
                    <p>In simpler words, HydraFacial is a serum-based treatment performed under medical guidance, with a customized solution for all skin types. Also, it minimizes fine lines and wrinkles, congested or enlarged pores, hyperpigmentation, and even dark spots.</p>
                    <p>HydraFacial treatment is non-invasive, painless, and non-irritating.</p>
                    <p>This revolutionary treatment is made for all skin types. In the simplest of words, this is only hydrating fluid water mixed with various hydrating products. It has a minimal possibility to create allergies to the skin.</p>
                    <p>While this skin treatment is suitable to people of all varieties of skin, HydraFacial is especially beneficial to those with oily skin for whom other procedures are a burden.</p>
                    <p>You can do this treatment at any age, with any skin type and skin issue with no side effects because it’s all about cleaning and infusing.</p>
                    <p>At our clinic, we do Hydrafacial treatment in the following essential steps:</p>
                    <p>Cleansing and Exfoliation</p>
                    <p>The reason your skin doesn’t look healthy is that some of the cells are dead, though you won’t notice this microscopic change. So, in the very beginning, this step removes the dead cells and uncovers the smooth healthy skin underneath them. This is done using nothing but a simple ultrasonic scrubber and warm steam.</p>
                    <p>Extractions</p>
                    <p>This is a quick and completely painless extraction of blackheads &amp; whiteheads. The gentle suction force from a special vacuum tip with water makes the step effortless.</p>
                    <p>Hydration and infusion</p>
                    <p>This is a vortex fusion technology for deep penetration of antioxidants and hyaluronic acid, which eventually hydrates the skin and makes it healthy. Special HydraFacial liquids are infused based on the skin type you have. Consequently, this process hydrates and cleanses your skin.</p>
                    <p>Bipolar Radiofrequency (skin tightening)</p>
                    <p>Radio-frequency skin tightening is an aesthetic technique that uses radiofrequency (RF) energy (harmless) to heat the skin.</p>
                    <p>This is done to stimulate the production of cutaneous collagen, elastin, and hyaluronic acid. Their production reduces the appearance of fine lines and loose skin. The technique promotes tissue remodeling and the production of new collagen and elastin. Both are enormously beneficial for skin health.</p>
                    <p>Customized Gelly-Rubber Face mask</p>
                    <p>The next process involves covering your face with a masking layer. We have different varieties of face masks customized to your skin needs and skin conditions.</p>
                    <p>These are a few examples: Rose mask, Pearl whitening mask, Seaweed, Anti-wrinkle, Green tea, Gold mask, Hyaluronic soft, Anti spot, Collagen mask, and many more.</p>
                    <p>LED Light Therapy</p>
                    <p>Light therapy provides additional benefits after the HydraFacial treatment. This photodynamic light therapy uses a specific type of light that radiates energy and stimulates your cells. As a result, your skin’s production of collagen and elastin increases.</p>
                    <p>Is the treatment suitable for my skin type?</p>
                    <p>This revolutionary treatment is made for all skin types. In the simplest of words, this is only hydrating fluid water mixed with various hydrating products. It has a minimal possibility to create allergies to the skin.</p>
                    <p>While this skin treatment is suitable to people of all varieties of skin, HydraFacial is especially beneficial to those with oily skin for whom other procedures are a burden.</p>
                    <p>How much time does a HydraFacial Treatment take?</p>
                    <p>The HydraFacial treatment is a quick and economical method. The entire process takes as little as 15 minutes.</p>
                    <p>Since we have added other beneficial steps for better results, the whole thing takes about 45 minutes in our clinic. This is only so that you get the ultimate satisfaction with the result.</p>
                    <p>How many HydraFacial treatments are required to notice results?</p>
                    <p>You will definitely attain noticeable skin refinement with each session. An individual with normal, radiant skin may just need a single treatment, and results will appear immediately. This will last a week or longer.</p>
                    <p>Anyways, a series of six treatments at intervals of 2-4 weeks is recommended to maintain the disappearance of fine lines, wrinkles, and blocked pores.</p>
                    <p>After this initial series of treatments, your results will last much longer and you will need only fewer maintenance treatments over time.</p>
                    <p>Hydrafacial Treatment Price in Lalitpur, Kathmandu, Nepal</p>
                    <p>Your skin is the first thing that speaks about you, just like the walls and the paintings hung on them tell about a room. And your skin is going to represent you for a long, long time.</p>
                    <p>Needless to say, most people spend a lot more on beauty techniques that barely give them the result they want.</p>
                    <p>Types of Facial with price</p>
                    <p>Simple HydraFacial</p>
                    <p>Rs. 2,500 (15 Mins)</p>
                    <p>HydraFacial without Mask</p>
                    <p>Rs.3,000 (30 Mins)</p>
                    <p>HydraFacial With Hydrojelly Mask</p>
                    <p>Rs.5,000 (1 Hour Plus)</p>
                    <p>HydraFacial Any Type Add Chemical Peel</p>
                    <p>Rs.1,000 (Extra)</p>
                    <p>Simple Hydra With Carbon Laser</p>
                    <p>Rs.6,000</p>
                    <p>HydraFacial With Vampire Facial</p>
                    <p>Rs.7,000</p>
                    <p>Carbon laser (Picosecond laser)</p>
                    <p>Rs.5,000</p>
                    <p>Vampire Facial (Prp Micro needling)</p>
                    <p>Rs.6,000</p>
                    <p>But because technology has come so forwards in today’s age, efficient procedures are also available at a minimal cost.</p>
                    SERVICE_CONTENT_08,
                'meta_title' => 'Hydra Facial in Nepal | Aakar Dermatology',
                'meta_description' => 'Revitalize your skin with HydraFacial treatment at Dr Rajan Clinic in Lalitpur. Enjoy glowing, hydrated skin, suitable for all skin types!',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'title' => 'Laser Hair Reduction',
                'slug' => 'laser-hair-reduction',
                'category' => 'laser',
                'icon' => 'laser',
                'short_description' => 'Laser Hair Reduction / Removal is a procedure that uses a beam of light to remove unwanted hair. Cost of laser hair removal start from 2000.',
                'full_description' => <<<'SERVICE_CONTENT_09'
                    <p>What is Laser Hair Reduction / Removal?</p>
                    <p>Laser Hair Reduction / Removal is a procedure that uses a beam of light to remove unwanted hair.</p>
                    <p>The cost of Laser Hair Removal is Nrs 3500 to 46000 (depending on area)</p>
                    <p>[caption id="" align="alignnone" width="640"]</p>
                    <p>How does Laser Hair Removal work?</p>
                    <p>Light is absorbed by the root of the hair, Specifically melanin pigment. Light energy is converted to heat energy which damages the hair follicles. This damage to the hair follicle inhibits and delays the growth.</p>
                    <p>How frequently is it done?</p>
                    <p>Multiple sessions are required. It is done once in a month or 4 to 6 weeks gap. Hair has a cycle in the anagen phase which is the most active phase. LHR seems to be the most effective.</p>
                    <p>Will my hair grow?</p>
                    <p>Periodic maintenance sessions are required once every 6 months or a year. This is a substantial reduction in hair growth, with treated areas often being nearly hair-free. Even the hair that grows back is usually fine, lighter, and less noticeable.</p>
                    SERVICE_CONTENT_09,
                'meta_title' => 'Laser Hair Reduction | Aakar Dermatology',
                'meta_description' => 'Laser Hair Reduction / Removal is a procedure that uses a beam of light to remove unwanted hair. Cost of laser hair removal start from 2000.',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'title' => 'Laser Tattoo Removal',
                'slug' => 'laser-tattoo-removal',
                'category' => 'laser',
                'icon' => 'laser',
                'short_description' => 'Laser tattoo removal is the process where ink particles break down after exposure to a beam of light. cost start from Nrs 2500.',
                'full_description' => <<<'SERVICE_CONTENT_10'
                    <p>What is Laser tattoo removal?</p>
                    <p>Laser tattoo removal is the process where ink particles break down after exposure to a beam of light. Then, with the body's metabolism, it gradually removes into smaller particles.</p>
                    <p>Which laser do we use?</p>
                    <p>We use a picosecond laser, where its ultra-short pulses break the ink into much smaller particles. It can treat a broader range of ink colors including blue and red.</p>
                    <p>What's the cost?</p>
                    <p>Price starts from the range of 2500 and its range may vary according to its size, color, and space occupied.</p>
                    <p>Does it leave a scar?</p>
                    <p>After the ink gets removed,  It leaves a shadow that may fade with time.</p>
                    SERVICE_CONTENT_10,
                'meta_title' => 'Laser Tattoo Removal | Aakar Dermatology',
                'meta_description' => 'Laser tattoo removal is the process where ink particles break down after exposure to a beam of light. cost start from Nrs 2500.',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'PRP Therapy',
                'slug' => 'prp-therapy',
                'category' => 'hair',
                'icon' => 'hair',
                'short_description' => 'Transform your beauty with PRP Therapy at Dr Rajan Clinic.\'Vampire Facial\' enhances hair growth and skin health, starting at Rs. 4,000.',
                'full_description' => <<<'SERVICE_CONTENT_11'
                    <p>In Platelets Rich Plasma Therapy, the patient’s own blood is collected and the blood plasma is separated by a centrifuge. This plasma has many growth properties and is beneficial for human cells.</p>
                    <p>PRP Therapy is helpful in treating hair fall problems and to stimulate collagen production in the skin. In simple words, collagen is a substance that is vital for skin health and beauty. Thus, PRP Therapy helps in hair regeneration and treats skin problems like acne scar, melasma, wrinkles, and dull skin.</p>
                    <p>PRP Therapy with micro-needling is the most common procedure in our clinic.</p>
                    <p>PRP therapy is also commonly known as ‘Vampire Facial’. This is because the patient’s own plasma is extracted from the blood and injected into the skin or hair follicles using Derma-roller or micro-needling. The process is completely safe, and our treatment provider at Dr. Rajan Tajhya's clinic will take the utmost care of you during the procedure.</p>
                    <p>Does Platelet-Rich Plasma Therapy have any side effects?</p>
                    <p>There have been no serious side effects of PRP treatment recorded so far. PRP is created using your body’s own regenerative blood factors, so there is no risk of an allergic reaction.</p>
                    <p>Nevertheless, your treatment provider will see if you have any problem with the anesthetic that is applied on the scalp before injecting the platelets.</p>
                    <p>After the procedure, people might feel a little bit of tightness and discomfort, but within 30 minutes it’s pretty much done.</p>
                    <p>Is PRP treatment a permanent solution to hair loss? When will Platelet-Rich Therapy bring results?</p>
                    <p>Unlike other hair-fall remedies, PRP is a simple non-surgical procedure. Its effectiveness has been recorded in numerous scientific researches.</p>
                    <p>In general, you will be given three sessions in an approximate span of a month. Then, the next series of sessions are needed for only about four to six months.</p>
                    <p>The exact schedule of your treatment plan might depend on factors like the amount of hair loss you’re dealing with, as well as your age, hormones, and genetic makeup. The simplest treatment procedure has three sessions in a span of three months.</p>
                    <p>PRP doesn’t deliver results immediately, so don’t expect to see a full head of hair the next morning. The first result that you’ll witness is decreased hair shedding, followed by early regrowth and increased hair length.</p>
                    <p>Is this procedure painful?</p>
                    <p>At Dr. Rajan Clinic, we’ve had some patients go through it and it’s quick and over. However, the scalp is a sensitive area. This is why for most of us normal people, PRP treatment might hurt a bit.</p>
                    <p>However, the bright part is that PRP treatment has little downtime, which means that after about an hour or so, you can go on with your usual routine. However, avoid hair-coloring, hair-washing, and scalp massage for the next 48 hours. After that, you are free to live your own life the way you like.</p>
                    <p>How much will PRP Treatment cost in Kathmandu? What is the usual price for Platelet-Rich Therapy (PRP Treatment) in Nepal?</p>
                    <p>Compared to other hair-fall remedies, Platelet-Rich Plasma Therapy falls in the intermediate range when it comes to pricing.</p>
                    <p>If you are looking forward to getting a PRP treatment in Kathmandu, Nepal, the entire package with PRP treatment and micro-needling costs only Rs. 6000. Meanwhile, if you only take micro-needling, it’ll cost you Rs 4000.</p>
                    <p>Dr. Rajan Tajhya's Clinic primary focus is to always cater to the needs of its clients, i.e. to serve you in the best way.</p>
                    <p>With your best interests in consideration, here are our prices:</p>
                    <p>PRP Microneedling (Vampire Facial)</p>
                    <p>Rs.6,000</p>
                    SERVICE_CONTENT_11,
                'meta_title' => 'PRP Therapy | Aakar Dermatology',
                'meta_description' => 'Transform your beauty with PRP Therapy at Dr Rajan Clinic.\'Vampire Facial\' enhances hair growth and skin health, starting at Rs. 4,000.',
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'title' => 'Scar Revision Surgery',
                'slug' => 'scar-revision-surgery',
                'category' => 'surgical',
                'icon' => 'surgical',
                'short_description' => 'Reduce scars by 80-90% at our Lalitpur clinic. Our expert dermatologist offers quick, effective scar removal starting at Rs. 3,000 per cm.',
                'full_description' => <<<'SERVICE_CONTENT_12'
                    <p>For years, scars were seen as permanent things that one carried for eternity. With all the medical advancements of the 21st century, that statement is now partially false.</p>
                    <p>At our clinic, you can mask your scars under the supervision of a skilled treatment provider. Your scar will be reduced by 80-90% of its original size. This is a very minute surgery and will be completed quickly under the skillful hands of our dermatologist.</p>
                    <p>On the other hand, bigger scars may need more attention from the treatment provider. This is why it is crucial to get your treatment only from an experienced dermatologist.</p>
                    <p>Scar Removal/ Revision Price in Lalitpur, Kathmandu, Nepal</p>
                    <p>The cost of scar reduction/ removal depends on the size and depth of the scars. Smaller scars can be removed at a generous package of Rs. 6000 to Rs. 8000 per cm. Meanwhile, removal of relatively bigger scars cost anywhere between Rs. 6000 to Rs. 10000 per cm.</p>
                    SERVICE_CONTENT_12,
                'meta_title' => 'Scar Revision Surgery | Aakar Dermatology',
                'meta_description' => 'Reduce scars by 80-90% at our Lalitpur clinic. Our expert dermatologist offers quick, effective scar removal starting at Rs. 3,000 per cm.',
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'title' => 'Skin and Dermatology Consultation',
                'slug' => 'skin-and-dermatology-consultation',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'At Dr. Rajan Tajhya\'s Skin Laser Clinic, we offer expert solutions for skin issues, including psoriasis, acne, and mole removal.',
                'full_description' => <<<'SERVICE_CONTENT_13'
                    <p>At Dr.Rajan Tajhya's skin laser clinic. We offer a complete solution to your skin problems.</p>
                    <p>We are specialized in treating even the scariest of skin issues, like psoriasis, melasma, acne, hair fall, dermatitis, warts, moles, and fungal infection.</p>
                    <p>Furthermore, the treatment providers at At  Dr.Rajan Tajhya's clinic are also specialized in diagnosing and treating various sexually transmitted diseases that show symptoms mainly in the skin.</p>
                    <p>1. Mole removal</p>
                    <p>The procedure for mole removal depends on the size of the mole and the color of the skin. If it is a bigger mole, we might have to do cosmetic surgery. Meanwhile, smaller moles can be removed by cautery laser and pen.</p>
                    <p>2. Freckles removal 3. Wart/ Skin tag/ Corn removal</p>
                    <p>Skin warts: Warts are skin growths that are caused by the human papillomavirus (HPV).</p>
                    <p>Skin tag: Skin tags are painless, noncancerous growths on the skin. They’re connected to the skin by a small, thin stalk called a peduncle. Skin tags are common in both men and women, especially after age 50. They can appear anywhere on your body, though they’re commonly found in places where your skin folds such as the neck and armpits.</p>
                    <p>Skin corn: Corns and calluses are thick, hardened layers of skin that develop when your skin tries to protect itself against friction and pressure. They most often develop on the feet and toes or hands and fingers. They are usually caused by bad shoes, uncomfortable soles, etc.</p>
                    <p>All these skin complications can be treated by an experienced dermatologist in our clinic.</p>
                    <p>4. Skin cancer surgery</p>
                    <p>Unwanted lesions in the skin can be an indication of skin cancer. In order to confirm whether the unwanted growth in your skin is cancerous (or not), we perform a detailed biopsy and send the Histology for confirmation.</p>
                    <p>The marks left by such incidences may be removed in our clinic.</p>
                    <p>5.Treatment of Genital warts and other Sexually Transmitted Diseases</p>
                    <p>Genital wart is the most common sexually transmitted disease. Genital warts are soft growths that appear on the genitals. They can cause pain, discomfort, and itching. Genital warts are caused by the human papillomavirus (HPV). In fact, HPV is so common that the Centers for Disease Control and Prevention (CDC)Trusted Source says that most sexually active people get it at some point. However, the virus doesn’t always lead to complications such as genital warts. In fact, in most cases, the virus goes away on its own without causing any health problems.</p>
                    <p>Genital warts affect both women and men, but women are more vulnerable to complications. First, we need to confirm the actual occurrence of the STD before we start with the procedure. The condition is then treated with topical wart treatments like imiquimod (Aldara), podophyllin, and podofilox (Condylox) trichloroacetic acid, or TCA.</p>
                    <p>Other sexually transmitted diseases like Syphilis, Gonorrhoea, Discharges, etc. are also treated at our clinic.</p>
                    <p>Our treatment provider is male.</p>
                    <p>6. Issues related to male sexual health and wellbeing</p>
                    <p>7. Treatment of skin conditions like fungal infections, allergies, drug reactions</p>
                    <p>8. Nail and Hair treatment</p>
                    <p>Nails: Nutritional deficiency, fungal infection, etc.</p>
                    <p>Hair: Hair fall problem (balding), removal of excess hair from the body parts.</p>
                    <p>9. Cosmetic surgery</p>
                    <p>a) Asian Eyelid Surgery</p>
                    <p>“All eyes are beautiful, let us enhance their beauty with technology.”</p>
                    <p>Most ladies use eyelid sticker to be able to put eyeliners while doing their makeup. With this one-hour procedure, the problem will be solved permanently.</p>
                    <p>Asian eyelid surgery is one of the most common cosmetic procedures we perform in our clinic. The primary purpose is to create a space for Mongolian eyes so that they can put an eyeliner. As the name suggests, the surgery is mainly done by Mongolians or Asians to have fuller, bigger eyes.</p>
                    <p>b) Hooded Eyelid Surgery</p>
                    <p>Some people experience a downwards hood in their eyes for a lot of reasons, primarily with age. We recommend Hooded Eyelid Surgery to delay the natural process.</p>
                    <p>c) Eye bag removal surgery</p>
                    <p>We know you don’t want saggy skin under your eyes. Nobody does. Shaggy deposits of fat under the eyes make them look swollen, affecting the overall cosmetic appearance.</p>
                    <p>d) Scar revision surgery</p>
                    <p>For years, scars were seen as permanent things that one carried for eternity. With all the medical advancements of the 21st century, that statement is now partially false.</p>
                    <p>At our clinic, you can mask your scars under the supervision of a skilled treatment provider. Your scar will be reduced by 80-90% of its original size.</p>
                    <p>This is a very minute surgery and will be completed quickly under the skillful hands of our dermatologist. The cost of scar reduction/ removal depends on the size and depth of the scars. Smaller scars can be removed at a generous package of Rs. 5000 to Rs. 6000 per cm. Meanwhile, removal of relatively bigger scars cost anywhere between Rs. 3000 to Rs. 4000 per cm.</p>
                    <p>e) Ear Lobe Repair</p>
                    <p>Women tend to have shaggy ears due to years of wearing heavy ear ornaments. Some men also get shaggy ears with age. Such conditions can be corrected if needed with the Ear Lobe Repair treatment procedure.</p>
                    <p>f) Dimple creation surgery</p>
                    <p>Let us all agree on one thing: people with dimples look cute. For real.</p>
                    <p>If God did not gift you with one, cosmetics and modern science will.</p>
                    <p>g) Mole removal surgery (for bigger moles)</p>
                    <p>Moles that are relatively big in size need to be removed with surgery. The procedure should be carried out in a way that leaves as little scar as possible. This is why an experienced dermatologist is of utmost importance.</p>
                    SERVICE_CONTENT_13,
                'meta_title' => 'Skin and Dermatology Consultation | Aakar Dermatology',
                'meta_description' => 'At Dr. Rajan Tajhya\'s Skin Laser Clinic, we offer expert solutions for skin issues, including psoriasis, acne, and mole removal.',
                'is_active' => true,
                'sort_order' => 13,
            ],
            [
                'title' => 'Skin Problems',
                'slug' => 'skin-problems',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Get expert solution for all skin problems, including mole removal, acne treatment, and fungal infections. Trust our experienced dermatologist.',
                'full_description' => <<<'SERVICE_CONTENT_14'
                    <p>Types of skin problems</p>
                    <p>A complete solution to all your skin problems. Acne, mole, warts, skin tags, corn, fugal infections, wrinkles, melasma, and many more</p>
                    <p>1. Mole removal</p>
                    <p>The procedure for mole removal depends on the size of the mole and the color of the skin. If it is a bigger mole, we might have to do cosmetic surgery. Meanwhile, smaller moles can be removed by cautery laser and pen.</p>
                    <p>2. Freckles removal</p>
                    <p>3. Wart/ Skin tag/ Corn removal</p>
                    <p>Skin warts:</p>
                    <p>Warts are skin growths that are caused by the human papillomavirus (HPV).</p>
                    <p>Skin tag:</p>
                    <p>Skin tags are painless, noncancerous growths on the skin. They’re connected to the skin by a small, thin stalk called a peduncle. Skin tags are common in both men and women, especially after age 50. They can appear anywhere on your body, though they’re commonly found in places where your skin folds such as the neck and armpits.</p>
                    <p>Skin corn:</p>
                    <p>Corns and calluses are thick, hardened layers of skin that develop when your skin tries to protect itself against friction and pressure. They most often develop on the feet and toes or hands and fingers. They are usually caused by bad shoes, uncomfortable soles, etc.</p>
                    <p>All these skin complications can be treated by an experienced dermatologist in our clinic.</p>
                    <p>4. Skin cancer surgery</p>
                    <p>Unwanted lesions in the skin can be an indication of skin cancer. In order to confirm whether the unwanted growth in your skin is cancerous (or not), we perform a detailed biopsy and send the Histology for confirmation.</p>
                    <p>The marks left by such incidences may be removed in our clinic.</p>
                    <p>5. Treatment of skin conditions like fungal infections, allergies, drug reactions</p>
                    SERVICE_CONTENT_14,
                'meta_title' => 'Skin Problems | Aakar Dermatology',
                'meta_description' => 'Get expert solution for all skin problems, including mole removal, acne treatment, and fungal infections. Trust our experienced dermatologist.',
                'is_active' => true,
                'sort_order' => 14,
            ],
            [
                'title' => 'Ultherapy Facelift',
                'slug' => 'ultherapy-facelift',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Revitalize your skin with a non-invasive Ultherapy facelift in Lalitpur, Kathmandu. Reduce wrinkles and enhance your jawline without surgery.',
                'full_description' => <<<'SERVICE_CONTENT_15'
                    <p>Ultherapy Facelift: Using the power of sound to treat wrinkles.</p>
                    <p>No matter how we all miss our youth, there is nothing sad about aging. We grow wiser in our decisions and thoughtful in our actions. Thus, aging is something that we all need to embrace and celebrate.</p>
                    <p>However, as the number of candles starts adding up in the birthday cake, there is more adding up of wrinkles in your forehead.</p>
                    <p>The moment when the first line of aging appear is the best time to visit a skin expert.</p>
                    <p>With current pollution levels and unhealthy diet practices, the world is a challenging place to stay young and healthy.</p>
                    <p>And our skin is the first body part to show an impact. The skin dries up, loses elasticity and wrinkles start to appear.</p>
                    <p>The best way to avoid wrinkles is to stay at the top of your health. The healthier you are, the longer will it take for wrinkles to form.</p>
                    <p>Reasons Why People Get Wrinkles and Age Quickly than Expected</p>
                    <p>1. Pessimism/ Anger/ Stress</p>
                    <p>Happy souls are simply the youngest looking people. Perpetual anger, chronic sadness, and sulking habits can form permanent wrinkles on the face.</p>
                    <p>If you are angry and in a bad mood very often, your face can actually develop wrinkles since the facial muscles have spent the most time in that scowled state.</p>
                    <p>2. Smoking and Drinking</p>
                    <p>Excessive drinking and smoke drain the necessary nutrients from our bodies. Our skin requires a definite amount of oxygen, collagen, and hydration to look youthful. But unfortunately, drinking and smoking can deprive you of these necessities and add years to your face.</p>
                    <p>3. High Exposure to Sun</p>
                    <p>It is said that 90% of aging happens due to the effects of the Sun. You will age quickly if you bask in the afternoon sun rays. The ultraviolet rays from the sun deteriorate protein from the skin and you will lose your youthful appearance. Wear sunglasses and a wide-brimmed hat whenever you get in the sun.</p>
                    <p>4. Cold and Moisture</p>
                    <p>Spending more time in cold environments leads to the development of wrinkles, thin and dry skin. Cold causes the skin’s natural oils to deplete and lose their elasticity, thus resulting in body and face aging.</p>
                    <p>5. Poor Diet</p>
                    <p>There are certain foods that cause you to age faster. A diet high in omega-6 but low in omega-3 is harmful to your body and skin. Omega-3 fats are found in soybean, walnuts, and salmon.</p>
                    <p>Similarly, trans-fats, artificial ingredients (sodium glutamate, potassium bromated), sugar, and concentrated processed foods are anti-youth friendly. Make sure to avoid them.</p>
                    <p>6. Being over or underweight</p>
                    <p>Being too slim or too hefty can add to the premature aging process.</p>
                    <p>People who are underweight have lesser natural fat that causes the skin to droop down and form wrinkles. On the other hand, overweight people lead an inactive life which is in itself a cause of aging.</p>
                    <p>7. Poor Lifestyle Choices</p>
                    <p>No physical workout, use of chemical-stuffed products on the body or face, too much television, and unhealthy diet plans can make us old right in front of our eyes.</p>
                    <p>Ultherapy/ HIFU Wrinkle and Facelift Solution</p>
                    <p>HIFU stands for High-Intensity Focused Ultrasound Device. HIFU is ideal for those looking to avoid needles and surgeries. With this method, you can rather get younger-looking skin without any pain.</p>
                    <p>This device is a fast-growing technique for a facelift. This method also makes the jawline visible by removing excess far from the chin area.</p>
                    <p>HIFU, when combined with other procedures, can eradicate serious shagging. It also eradicates neck or nape lifting issues. According to popular health information site Healthline.com, HIFU uses ultrasound energy to encourage the production of collagen, which results in firmer skin.</p>
                    <p>The visible result takes 3 months to 6 months to appear. Changes are felt by the patients themselves.</p>
                    <p>What is the cost Ultherapy Facelift in Lalitpur, Kathmandu, Nepal</p>
                    <p>The cost Ultherapy Facelift in Lalitpur, Kathmandu, Nepal Rs. 5000 to Rs.  25000(1 Hour)</p>
                    SERVICE_CONTENT_15,
                'meta_title' => 'Ultherapy Facelift | Aakar Dermatology',
                'meta_description' => 'Revitalize your skin with a non-invasive Ultherapy facelift in Lalitpur, Kathmandu. Reduce wrinkles and enhance your jawline without surgery.',
                'is_active' => true,
                'sort_order' => 15,
            ],
            [
                'title' => 'Wrinkle Reduction',
                'slug' => 'wrinkle-reduction',
                'category' => 'skin',
                'icon' => 'skin',
                'short_description' => 'Revitalize your youth at Dr. Rajan Tajhya’s clinic in Lalitpur, Kathmandu. Explore effective wrinkle treatments.',
                'full_description' => <<<'SERVICE_CONTENT_16'
                    <p>The moment when the first line of aging appear is the best time to visit a skin expert. With current pollution levels and unhealthy diet practices, the world is a challenging place to stay young and healthy.</p>
                    <p>At our clinic we use the following methods to help you regain that youth and charm:</p>
                    <p>a) Botox treatment</p>
                    <p>b) Ultherapy/ HIFU Wrinkle and Facelift Solution</p>
                    <p>c) Thermage Anti-Aging</p>
                    <p>d) Derma filler Wrinkle Removal</p>
                    <p>e) Radiofrequency Skin Tightening</p>
                    <p>f) Vampire Facial</p>
                    <p>g) Thermage/ Microneedling Radiofrequency</p>
                    <p>Get rid of Wrinkles with BOTOX</p>
                    <p>Botox cosmetic uplifts the skin of your face. This is one of the quickest solutions for wrinkles since you will see the result in about 72 hours.</p>
                    <p>Basically, you remove your wrinkles by paralyzing your facial skin. When injected in small doses, Botox weakens or contracts the muscles temporarily. Thus, the wrinkles, frown lines, and crow’s feet at the eye corners begin to disappear.</p>
                    <p>It also promotes flattening of the skin in 4-6 months. The best time to use Botox is before you start having noticeable wrinkle lines. It can also be used at the first signs of aging or the appearance of wrinkles.</p>
                    <p>Ultherapy/ HIFU Wrinkle and Facelift Solution</p>
                    <p>HIFU stands for High-Intensity Focused Ultrasound Device. HIFU is ideal for those looking to avoid needles and surgeries. With this method, you can rather get younger-looking skin without any pain.</p>
                    <p>This device is a fast-growing technique for a facelift. This method also makes the jawline visible by removing excess far from the chin area.</p>
                    <p>HIFU, when combined with other procedures, can eradicate serious shagging. It also eradicates neck or nape lifting issues. According to popular health information site Healthline.com, HIFU uses ultrasound energy to encourage the production of collagen, which results in firmer skin.</p>
                    <p>The visible result takes 3 months to 6 months to appear. Changes are usually felt by the patients.</p>
                    <p>Thermage Anti-Aging</p>
                    <p>Thermage heats the dermis layer of the skin without damaging the epidermis below it. A hand-held device delivers radiofrequency energy into dermal tissue with the help of needles. When the dermal tissue is heated, the collagen fibrils become disrupted, then contract and thicken, tightening the skin layer below the surface.</p>
                    <p>As the fibril layers heal, they are reshaped, and new collagen forms. It is comparatively a bit painful procedure. Thus, a numbing cream is applied before starting the procedure. Thermage is probably best for women in their 30s to 40s who have a few wrinkles or mild skin looseness.</p>
                    <p>Derma filler Wrinkle Removal</p>
                    <p>This injectable soft tissue filler is a cosmetic filler to restore fullness and volume in the face. The awkward smile lines in the face or the frowning facial lines in the forehead are filled in to restore a smoother appearance.</p>
                    <p>Non-Surgical Dermal fillers can be used to get plumper/fuller lips, soften facial creases, and enhance shallow contours and reduce the visibility of recessed scars and wrinkles. The youthful appearance in the face usually lasts for one to two years as it is gradually absorbed by the skin.</p>
                    <p>Radiofrequency Skin Tightening</p>
                    <p>Aging is a continuous process, and hence many people are seeking noninvasive technologies and treatments to maintain skin health and a lasting youthful appearance.</p>
                    <p>Bipolar radiofrequency skin tightening is one of the many options available in our clinic to make your face free of wrinkles and lines. Usually, 6 to 8 settings are needed, each done 2 to 3 days apart. This is a completely painless and pocket-friendly treatment.</p>
                    <p>Vampire Facial</p>
                    <p>Your own blood is used to help promote the healthy activity of your skin cells.</p>
                    <p>First, 10 to 20 ml of blood is collected and PRP (Platelet Rich Plasma) is separated by centrifuge. The PRP is then applied with the help of micro-needling in the skin. Microneedling makes microscopic injury in the skin which helps in PRP absorption. This method is famously known as celebrity facial. The growth factors present in the plasma of one’s own blood will help in collagen remodeling and get rid of fine lines and wrinkles.</p>
                    <p>There are numerous ways to get rid of wrinkles and regain your youthful appearance. Some are simple and cost-efficient while others require some extra effort. It all depends on your needs and preferences.</p>
                    <p>At Dr.Rajan Tajhya’s skin laser clinic, we offer free of cost consultation by an expert skin doctor. You can clear your queries and learn more about ways to ensure a healthier skin-life.</p>
                    <p>Wrinkle Removal Price in Lalitpur, Kathmandu, Nepal</p>
                    <p>a) Botox treatment</p>
                    <p>Rs. 500 per Unit</p>
                    <p>Forehead (20 units) Rs. 10000</p>
                    <p>Crows Feet (15-20 units) Rs. (7500 – 10000)</p>
                    <p>b) Ultherapy/ HIFU Wrinkle and Facelift Solution</p>
                    <p>Upper Face (Forehead) Rs. 2000 (10 Minutes)</p>
                    <p>Lower Face (Cheeks) Rs. 15000 (20 Minutes)</p>
                    <p>Full Neck Rs. 8000 (45 Minutes)</p>
                    <p>Full Face + Neck Rs. 25000</p>
                    <p>c) Thermage Anti-Aging</p>
                    <p>Rs. 4000</p>
                    <p>d) Derma filler Wrinkle Removal</p>
                    <p>Rs. 35,000 – Rs. 50,000</p>
                    <p>e) Radiofrequency Skin Tightening</p>
                    <p>Package for six sessions Rs. 4000</p>
                    <p>f) Vampire Facial</p>
                    <p>Rs. 6000</p>
                    <p>g) Microneedling Radiofrequency</p>
                    <p>Per session Rs. 15000</p>
                    SERVICE_CONTENT_16,
                'meta_title' => 'Wrinkle Reduction | Aakar Dermatology',
                'meta_description' => 'Revitalize your youth at Dr. Rajan Tajhya’s clinic in Lalitpur, Kathmandu. Explore effective wrinkle treatments.',
                'is_active' => true,
                'sort_order' => 16,
            ],
        ];

        $services = array_merge($services, $documentServices);

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
