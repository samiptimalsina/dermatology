<?php

namespace Tests\Feature;

use App\Models\Service;
use Database\Seeders\BlogSeeder;
use Database\Seeders\ClinicServicesImportSeeder;
use Database\Seeders\ServiceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaserHairReductionPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_source_service_urls_blog_and_sitemap_are_available(): void
    {
        $this->seed(ServiceSeeder::class);
        $this->seed(ClinicServicesImportSeeder::class);
        $this->seed(BlogSeeder::class);

        $sourceSlugs = [
            'skin-and-dermatology-consultation',
            'laser-hair-reduction',
            'laser-tattoo-removal',
            'acne-and-acne-scar-removal',
            'wrinkle-reduction',
            'hydra-facial',
            'scar-revision-surgery',
            'asian-eyelid-surgery-or-blepharoplasty',
            'skin-problems',
            'botox-injection',
            'chemical-peeling',
            'black-doll-laser',
            'diode-laser-hair-removal',
            'ultherapy-facelift',
            'hair-transplant',
            'prp-therapy',
        ];

        $this->assertSame(16, Service::query()->whereIn('slug', $sourceSlugs)->count());
        $this->assertDatabaseMissing('services', ['slug' => 'laser-hair-removal']);

        foreach ($sourceSlugs as $slug) {
            $this->get('/our-services/'.$slug.'/')->assertOk();
        }

        $this->get('/our-services/')
            ->assertOk()
            ->assertSee('Our Services')
            ->assertSee(
                'href="'.route('our-services.index').'/"',
                false
            );

        $this->get('/our-services/laser-hair-reduction/')
            ->assertOk()
            ->assertSee('Laser Hair Reduction')
            ->assertSee(
                'href="'.route('our-services.show', 'laser-hair-reduction').'/"',
                false
            );

        $this->assertDatabaseHas('blogs', [
            'slug' => 'laser-hair-reduction-guide',
            'thumbnail' => 'services/laser-hair-removal.webp',
        ]);

        $this->get('/blog/laser-hair-reduction-guide')
            ->assertOk()
            ->assertSee('Laser Hair Reduction: Sessions, Results and What to Expect');

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee(route('our-services.index').'/', false)
            ->assertSee(route('our-services.show', 'laser-hair-reduction'), false)
            ->assertDontSee(route('services.show', 'laser-hair-removal'), false);
    }

    public function test_sitemap_index_and_public_pages_are_included_for_seo(): void
    {
        $this->seed(ClinicServicesImportSeeder::class);
        $this->seed(BlogSeeder::class);

        $this->get('/sitemap_index.xml')
            ->assertOk()
            ->assertSee('/sitemap.xml', false);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee(route('home'), false)
            ->assertSee(route('about'), false)
            ->assertSee(route('gallery'), false)
            ->assertSee(route('videos'), false)
            ->assertSee(route('contact'), false)
            ->assertSee(route('privacy-policy'), false)
            ->assertSee(route('terms-and-conditions'), false)
            ->assertSee(route('our-services.index').'/', false)
            ->assertSee(route('blog'), false)
            ->assertSee(route('our-services.show', 'laser-hair-reduction'), false)
            ->assertSee(route('blog.show', 'laser-hair-reduction-guide'), false);
    }
}
