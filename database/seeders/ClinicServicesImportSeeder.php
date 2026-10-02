<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ClinicServicesImportSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/skin-and-dermatology-consultation/',
                'title' => 'Skin & Dermatology Consultation',
                'category' => 'skin',
                'image' => null,
                'short_description' => 'Consult with a dermatologist about skin, hair, nail, and cosmetic concerns and discuss suitable next steps.',
                'full_description' => '<p>A dermatology consultation is a chance to discuss your concerns, relevant health history, and treatment goals with a clinician. Examination and assessment help determine whether a concern needs monitoring, medical treatment, a procedure, or further testing.</p><h2>Concerns we can assess</h2><p>Consultations may cover acne, pigmentation, moles, warts, skin tags, infections, rashes, hair loss, nail changes, and selected cosmetic concerns. The right approach depends on the diagnosis and your individual circumstances.</p><h2>Assessment before treatment</h2><p>Some lesions require examination or biopsy before treatment can be considered. A clinician will explain the options, expected outcomes, risks, and follow-up appropriate to your case.</p>',
                'meta_description' => 'Discuss skin, hair, nail, and cosmetic concerns with a dermatologist at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/laser-hair-reduction/',
                'title' => 'Laser Hair Reduction',
                'category' => 'laser',
                'image' => 'services/laser-hair-removal.webp',
                'short_description' => 'A clinician-led treatment that uses focused light energy to reduce unwanted hair over a course of sessions.',
                'full_description' => '<p>Laser hair reduction uses focused light energy to target pigment in hair follicles. The follicle absorbs light and converts it to heat, which can slow future hair growth. It is a reduction treatment rather than a guarantee of permanent hair removal; suitability and likely results vary with the treatment area and individual hair and skin characteristics.</p><h2>How does laser hair reduction work?</h2><p>The laser targets melanin in hair that is in an active growth phase. Because follicles cycle through different growth phases, several appointments are usually needed to treat hairs at the right stage. A clinician assesses the area and selects an appropriate treatment plan.</p><h2>How often are sessions scheduled?</h2><p>Sessions are commonly spaced around four to six weeks apart. The interval and total number of sessions depend on the area being treated and your response, so follow the schedule recommended during your consultation.</p><h2>Will hair grow back?</h2><p>Some regrowth can occur after a course of treatment. When it does, hair may be finer or lighter, and occasional maintenance sessions may be recommended. Results differ from person to person.</p><h2>Treatment cost</h2><p>The clinic has published a price range of NPR 3,500 to NPR 46,000 depending on the area treated. Please confirm current fees with the clinic before booking.</p>',
                'meta_description' => 'Learn how laser hair reduction works, how sessions are spaced, and what to expect at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/laser-tattoo-removal/',
                'title' => 'Laser Tattoo Removal',
                'category' => 'laser',
                'image' => 'services/tattoo-removal.webp',
                'short_description' => 'Laser treatment can break tattoo pigment into smaller particles that the body gradually clears.',
                'full_description' => '<p>Laser tattoo removal uses short pulses of light to target tattoo pigment. The energy breaks pigment into smaller particles, which the body gradually clears. The number of sessions and response vary with ink color, tattoo size, location, depth, and skin characteristics.</p><h2>Assessment and treatment</h2><p>A clinician will assess the tattoo and discuss likely treatment options, spacing between visits, aftercare, and possible skin changes. Complete removal cannot be guaranteed, and some tattoos leave residual pigment or a shadow.</p><h2>Pricing</h2><p>The source clinic lists prices starting around NPR 2,500, with fees varying by tattoo size and other factors. Contact the clinic to confirm current pricing.</p>',
                'meta_description' => 'Explore laser tattoo removal, treatment factors, and consultation options at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/acne-and-acne-scar-removal/',
                'title' => 'Acne & Acne Scar Removal',
                'category' => 'skin',
                'image' => 'services/acne-and-acne-scar-removal.png',
                'short_description' => 'Assessment and treatment options for active acne and the marks or scars it may leave behind.',
                'full_description' => '<p>Acne develops when hair follicles become blocked with oil and dead skin cells, sometimes leading to inflammation. It can affect people at different ages and may leave discoloration or textural scars.</p><h2>Different acne scars need different approaches</h2><p>Raised scars and indented scars such as boxcar, ice-pick, and rolling scars have different features. Many people have a combination, so assessment helps determine which treatments may be appropriate.</p><h2>Treatment options</h2><p>Depending on the condition, options may include medical acne care, microneedling, chemical peels, subcision, TCA CROSS, radiofrequency microneedling, or laser procedures. Results vary and scar treatments generally aim to improve appearance rather than erase every mark.</p><p>A consultation can help set realistic expectations and identify a plan suited to your skin.</p>',
                'meta_description' => 'Learn about acne, acne scar types, and treatment options at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/wrinkle-reduction/',
                'title' => 'Wrinkle Reduction',
                'category' => 'skin',
                'image' => 'services/wrinkle-reduction.png',
                'short_description' => 'Explore clinician-guided options for wrinkles, fine lines, and changes in skin firmness.',
                'full_description' => '<p>Wrinkle reduction can involve different approaches depending on the area, skin condition, and your goals. A consultation helps identify which options may be suitable and what results are realistic.</p><h2>Treatment options</h2><p>Options discussed at the clinic include botulinum toxin, ultrasound-based treatments such as HIFU, radiofrequency skin tightening, dermal fillers, and PRP with microneedling. These treatments work in different ways and are not appropriate for everyone.</p><h2>Personalized planning</h2><p>Your provider can explain expected timing, duration, possible side effects, and aftercare for the recommended procedure. Published prices vary by treatment and area; confirm current fees during your consultation.</p>',
                'meta_description' => 'Review treatment options for wrinkles and fine lines with a clinician at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/hydra-facial/',
                'title' => 'Hydra Facial',
                'category' => 'skin',
                'image' => 'services/hydra-facial.png',
                'short_description' => 'A multi-step facial treatment combining cleansing, exfoliation, extraction, and hydration.',
                'full_description' => '<p>HydraFacial is a non-invasive facial treatment that combines cleansing, exfoliation, extraction, and hydration. The steps and products can be adapted to the skin and the concerns being addressed.</p><h2>What happens during a session?</h2><p>A visit may include cleansing and exfoliation, gentle suction-assisted extraction, and infusion of hydrating products. Additional steps such as a mask or light-based treatment may be offered depending on the plan.</p><h2>Session length and course</h2><p>The source clinic describes sessions lasting around 45 minutes when additional steps are included. A single session may be enough for some goals, while a series spaced over several weeks may be recommended for others. Your provider can advise after assessing your skin.</p><h2>Pricing</h2><p>Published options range from approximately NPR 2,500 to NPR 7,000 depending on the selected facial and add-ons. Confirm current pricing before booking.</p>',
                'meta_description' => 'Learn about Hydra Facial steps, session timing, and options at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/scar-revision-surgery/',
                'title' => 'Scar Revision Surgery',
                'category' => 'surgical',
                'image' => 'services/scar-revision-surgery.png',
                'short_description' => 'A clinician assesses scar size, depth, and location to discuss suitable revision options.',
                'full_description' => '<p>Scar revision is a procedure intended to improve the appearance or function of a scar. The appropriate approach depends on the scar’s size, depth, location, and the way it has healed.</p><h2>Assessment and planning</h2><p>A dermatologist or surgeon will examine the scar and discuss expected improvement, healing, possible risks, and aftercare. Larger or more complex scars may need a more involved plan, and complete scar removal cannot be promised.</p><h2>Pricing</h2><p>The source clinic lists fees that vary by scar size and depth, with published estimates around NPR 6,000 to NPR 10,000 per centimeter for some cases. Confirm current fees after an assessment.</p>',
                'meta_description' => 'Discuss scar revision options, assessment, and recovery with a clinician at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/asian-eyelid-surgery-or-blepharoplasty/',
                'title' => 'Asian Eyelid Surgery or Blepharoplasty',
                'category' => 'surgical',
                'image' => 'services/asian-eyelid-surgery.png',
                'short_description' => 'A surgical consultation for people considering an eyelid crease procedure and its potential risks.',
                'full_description' => '<p>Asian blepharoplasty is an eyelid procedure that creates or adjusts an upper eyelid crease. Suitability depends on eyelid anatomy, health history, and personal goals.</p><h2>Consultation and procedure</h2><p>The clinic describes the procedure as taking about an hour. A surgeon should explain the technique, healing period, expected appearance, risks, and alternatives before any decision is made.</p><h2>Published price</h2><p>The source clinic lists an estimated fee of NPR 50,000. Confirm current pricing and whether it includes follow-up care during your consultation.</p>',
                'meta_description' => 'Learn about Asian blepharoplasty consultation, procedure planning, and published pricing at Aakar Dermatology.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/skin-problems/',
                'title' => 'Skin Problems',
                'category' => 'skin',
                'image' => 'services/skin-treatment.webp',
                'short_description' => 'Dermatology assessment for common skin concerns, lesions, infections, and changes that need diagnosis.',
                'full_description' => '<p>Skin concerns can have many causes, so diagnosis is an important first step. A dermatologist can assess acne, pigmentation, moles, freckles, warts, skin tags, corns, fungal infections, allergies, and other changes.</p><h2>When a lesion needs investigation</h2><p>Some growths or persistent changes may need examination or biopsy before treatment. The clinician will explain findings and discuss whether medication, a procedure, monitoring, or referral is appropriate.</p><h2>Personalized care</h2><p>Treatment varies with the diagnosis and your health history. Avoid attempting to remove or treat an unexplained skin growth at home; arrange an assessment if it is changing, bleeding, painful, or not healing.</p>',
                'meta_description' => 'Get a dermatology assessment for skin conditions and lesions at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/botox-injection/',
                'title' => 'Botox Injection',
                'category' => 'skin',
                'image' => null,
                'short_description' => 'A consultation-led injectable treatment that temporarily relaxes selected muscles contributing to expression lines.',
                'full_description' => '<p>Botulinum toxin injections are used to temporarily reduce the activity of selected muscles, which may soften certain expression lines. Results are not immediate and commonly develop over several days.</p><h2>Before treatment</h2><p>Your provider should review your goals, medical history, medications, and relevant precautions before deciding whether treatment is appropriate. Tell the clinician if you are pregnant, breastfeeding, or taking medicines that may affect bruising.</p><h2>Aftercare and risks</h2><p>Temporary injection marks, discomfort, or bruising can occur. Follow the clinician’s aftercare instructions and contact the clinic if you have a concerning reaction. The source clinic lists a price of around NPR 500 per unit; confirm current fees and the planned dose before treatment.</p>',
                'meta_description' => 'Discuss botulinum toxin treatment, suitability, aftercare, and current pricing at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/chemical-peeling/',
                'title' => 'Chemical Peeling',
                'category' => 'skin',
                'image' => 'services/chemical-peeling.png',
                'short_description' => 'A clinician-selected peel can exfoliate the skin to address concerns such as uneven tone or texture.',
                'full_description' => '<p>A chemical peel applies a selected solution to the skin to exfoliate its outer layers. Peel depth and ingredients depend on the concern being treated and the clinician’s assessment.</p><h2>What to expect</h2><p>Depending on the peel, skin may become temporarily dry, sensitive, or visibly peel over several days. New skin is more sensitive to sunlight, so follow the recommended aftercare and sun protection instructions.</p><h2>Choosing a peel</h2><p>Superficial, medium, and deeper peels are not interchangeable. A consultation helps determine whether a peel is appropriate and explains possible risks, recovery, and expected results. The source clinic lists a starting estimate around NPR 4,000 per session; confirm current pricing.</p>',
                'meta_description' => 'Learn how chemical peels are selected, what recovery may involve, and how to arrange an assessment at Aakar Dermatology.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/black-doll-laser/',
                'title' => 'Black Doll Laser',
                'category' => 'laser',
                'image' => 'services/black-doll-laser.png',
                'short_description' => 'A carbon-assisted laser facial offered for selected concerns involving pores, uneven tone, and texture.',
                'full_description' => '<p>Black Doll Laser, also called a carbon laser facial, combines a carbon lotion with laser treatment. The carbon particles absorb energy and are removed during treatment, providing exfoliation for selected skin concerns.</p><h2>Consultation and session planning</h2><p>Your skin type, health history, and medications should be reviewed before treatment. The clinic describes a typical course of four to six sessions, although the plan depends on the concern and response.</p><h2>Aftercare and pricing</h2><p>Temporary redness can occur. Follow your provider’s aftercare advice, including guidance on makeup and sun exposure. The source clinic lists a price range of approximately NPR 5,000 to NPR 6,000 per treatment; confirm current fees.</p>',
                'meta_description' => 'Explore carbon laser facial treatment, session planning, and aftercare at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/diode-laser-hair-removal/',
                'title' => 'Diode Laser Hair Removal',
                'category' => 'laser',
                'image' => 'services/diode-laser-hair-removal.png',
                'short_description' => 'Diode laser treatment targets pigmented hair follicles to reduce hair growth over multiple visits.',
                'full_description' => '<p>Diode laser hair reduction uses light energy absorbed by pigment in hair follicles. Several sessions are usually needed because hair grows in cycles; the source clinic describes a course of around five to seven visits, often spaced four to six weeks apart.</p><h2>Treatment areas and expectations</h2><p>Commonly treated areas include the face, arms, legs, underarms, chest, and bikini area. Hair reduction varies between individuals, and maintenance may be appropriate. A clinician should assess your skin and hair before treatment.</p><h2>Safety and pricing</h2><p>Temporary irritation is possible and inappropriate settings can cause burns or blisters, so treatment should be performed by appropriately trained staff. The source page publishes different prices by area and package; confirm current fees directly with the clinic.</p>',
                'meta_description' => 'Learn about diode laser hair reduction sessions, treatment areas, and safety assessment at Aakar Dermatology.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/ultherapy-facelift/',
                'title' => 'Ultherapy Facelift',
                'category' => 'skin',
                'image' => null,
                'short_description' => 'Focused ultrasound treatment may support gradual skin tightening for selected patients.',
                'full_description' => '<p>Ultherapy or HIFU uses focused ultrasound energy to target deeper tissue and encourage collagen remodeling. It is a non-surgical option for selected people seeking improvement in skin firmness.</p><h2>Results and assessment</h2><p>Changes develop gradually; the source clinic describes visible results over approximately three to six months. Outcomes vary, and this treatment may not be suitable for every person or concern.</p><h2>Published price</h2><p>The source clinic lists an estimated range of NPR 5,000 to NPR 25,000 for a session of about one hour. Confirm the treatment area, current cost, risks, and alternatives with a clinician.</p>',
                'meta_description' => 'Learn how focused ultrasound treatment is assessed and what results timeline to discuss at Aakar Dermatology.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/hair-transplant/',
                'title' => 'Hair Transplant',
                'category' => 'hair',
                'image' => 'services/hair-transplant.webp',
                'short_description' => 'Surgical hair restoration moves follicles from a donor area to areas affected by hair loss.',
                'full_description' => '<p>Hair transplantation moves follicles from a donor area to areas with thinning or hair loss. A consultation assesses the pattern and cause of hair loss, donor hair availability, health factors, and likely goals before surgery is considered.</p><h2>Procedure and recovery</h2><p>The source clinic describes FUE, FUT, and direct-transplant techniques, with procedures lasting several hours depending on the plan. Recovery and growth timelines vary; visible growth takes months, and a fuller result may take about a year.</p><h2>Planning your treatment</h2><p>Your surgeon should discuss risks, aftercare, expected density, and the possibility of ongoing hair loss before proceeding. Individual outcomes cannot be guaranteed.</p>',
                'meta_description' => 'Learn about hair transplant assessment, techniques, and recovery at Aakar Dermatology in Lalitpur.',
            ],
            [
                'source_url' => 'https://drrajanskinclinic.com/our-services/prp-therapy/',
                'title' => 'PRP Therapy',
                'category' => 'hair',
                'image' => 'services/prp-therapy.webp',
                'short_description' => 'Platelet-rich plasma is prepared from a blood sample and used in selected hair and skin treatments.',
                'full_description' => '<p>Platelet-rich plasma (PRP) is prepared by drawing a small blood sample and separating its components in a centrifuge. The platelet-rich portion may then be used in selected hair or skin procedures, sometimes alongside microneedling.</p><h2>Course and response</h2><p>The source clinic describes an initial series of approximately three sessions, with timing based on the concern and clinician’s plan. Results are gradual and vary; PRP is not a guaranteed or permanent solution for hair loss.</p><h2>Assessment and aftercare</h2><p>Your provider will review your health history and explain the procedure, discomfort, risks, and aftercare. The source clinic lists an estimated fee of NPR 6,000 for PRP microneedling; confirm current pricing.</p>',
                'meta_description' => 'Learn about PRP preparation, treatment planning, and aftercare at Aakar Dermatology in Lalitpur.',
            ],
        ];

        foreach ($services as $index => $service) {
            $path = parse_url($service['source_url'], PHP_URL_PATH);
            $slug = Str::afterLast(trim((string) $path, '/'), '/');

            $record = $this->findExistingService($slug, $service['title'], $service['image']);
            $record ??= new Service;
            $record->fill([
                'slug' => $slug,
                'title' => $service['title'],
                'category' => $service['category'],
                'icon' => $service['category'],
                'image' => $service['image'],
                'short_description' => $service['short_description'],
                'full_description' => $service['full_description'],
                'meta_title' => $service['title'].' | Aakar Dermatology',
                'meta_description' => $service['meta_description'],
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => $index + 1,
            ])->save();
        }
    }

    private function findExistingService(string $slug, string $title, ?string $image): ?Service
    {
        $record = Service::query()->where('slug', $slug)->first();

        if ($record || ! $image) {
            return $record;
        }

        $record = Service::query()->where('image', $image)->first();

        if ($record) {
            return $record;
        }

        $tokens = $this->meaningfulTitleTokens($title);
        $matches = Service::query()->get()->map(function (Service $candidate) use ($tokens) {
            $candidateTokens = $this->meaningfulTitleTokens($candidate->title);
            $intersection = $tokens->intersect($candidateTokens)->count();
            $union = $tokens->merge($candidateTokens)->unique()->count();

            return [
                'service' => $candidate,
                'score' => $union > 0 ? $intersection / $union : 0,
            ];
        })->filter(fn (array $match): bool => $match['score'] >= 0.5)->sortByDesc('score')->values();

        if (! $matches->isEmpty() && ($matches->count() === 1 || $matches[0]['score'] > $matches[1]['score'])) {
            return $matches[0]['service'];
        }

        return null;
    }

    private function meaningfulTitleTokens(string $title): Collection
    {
        return collect(preg_split('/[^a-z0-9]+/i', Str::lower($title)))
            ->filter(fn (string $token): bool => strlen($token) > 3 && ! in_array($token, [
                'facial', 'hair', 'laser', 'reduction', 'skin', 'removal', 'treatment', 'therapy', 'service', 'surgery',
            ], true))
            ->values();
    }
}
