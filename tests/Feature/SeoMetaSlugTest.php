<?php

namespace Tests\Feature;

use App\Models\SeoMeta;
use App\Models\SiteSetting;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SiteSettingSeeder;
use Database\Seeders\TeamMemberSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SeoMetaSlugTest extends TestCase
{
    use RefreshDatabase;

    public function test_seo_slug_can_be_updated_in_admin(): void
    {
        $seo = $this->seoRecord('about');
        $user = $this->seoManager();

        $this->actingAs($user)
            ->get(route('admin.seo.edit', $seo))
            ->assertOk()
            ->assertSee('name="slug"', false)
            ->assertSee('value="about"', false);

        $this->put(route('admin.seo.update', $seo), [
            'slug' => 'about-the-clinic',
            'meta_title' => 'About the clinic',
            'meta_description' => 'Learn about the clinic.',
        ])->assertRedirect(route('admin.seo.index'));

        $this->assertSame('about-the-clinic', $seo->refresh()->slug);
    }

    public function test_seo_slug_must_be_unique_and_url_safe(): void
    {
        $seo = $this->seoRecord('about');
        $this->seoRecord('contact');
        $this->actingAs($this->seoManager());

        $this->put(route('admin.seo.update', $seo), [
            'slug' => 'contact',
            'meta_title' => 'About the clinic',
            'meta_description' => 'Learn about the clinic.',
        ])->assertSessionHasErrors('slug');

        $this->put(route('admin.seo.update', $seo), [
            'slug' => 'About Clinic',
            'meta_title' => 'About the clinic',
            'meta_description' => 'Learn about the clinic.',
        ])->assertSessionHasErrors('slug');
    }

    public function test_seo_slug_trims_surrounding_whitespace_before_saving(): void
    {
        $seo = $this->seoRecord('about');
        $this->actingAs($this->seoManager());

        $this->put(route('admin.seo.update', $seo), [
            'slug' => '  about-the-clinic  ',
            'meta_title' => 'About the clinic',
            'meta_description' => 'Learn about the clinic.',
        ])->assertRedirect(route('admin.seo.index'));

        $this->assertSame('about-the-clinic', $seo->refresh()->slug);
    }

    public function test_about_seo_editor_loads_and_updates_about_settings(): void
    {
        Storage::fake('public');
        $this->seed([SiteSettingSeeder::class, TeamMemberSeeder::class]);
        $seo = $this->seoRecord('about');
        $user = $this->seoManager();

        $this->actingAs($user)
            ->get(route('admin.seo.edit', $seo))
            ->assertOk()
            ->assertSee('name="about_settings[doctor_name]"', false)
            ->assertSee('value="Dr. Rajan Tajhya"', false)
            ->assertSee('name="about_settings[stat_years]"', false);

        $this->put(route('admin.seo.update', $seo), [
            'slug' => 'about',
            'meta_title' => 'About the clinic',
            'meta_description' => 'Learn about the clinic.',
            'about_settings' => [
                'doctor_name' => 'Dr. New Name',
                'doctor_title' => 'Lead Dermatologist',
                'doctor_bio' => 'Updated biography.',
                'stat_years' => '15+',
                'stat_patients' => '1200+',
            ],
            'about_images' => [
                'doctor_photo' => UploadedFile::fake()->image('doctor-photo.png'),
            ],
        ])->assertRedirect(route('admin.seo.index'));

        $this->assertDatabaseHas('site_settings', [
            'key' => 'doctor_name',
            'value' => 'Dr. New Name',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'doctor_bio',
            'value' => 'Updated biography.',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'stat_years',
            'value' => '15+',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'stat_patients',
            'value' => '1200+',
        ]);
        $doctorPhotoPath = SiteSetting::where('key', 'doctor_photo')->value('value');
        Storage::disk('public')->assertExists($doctorPhotoPath);

        $this->get('/about')
            ->assertOk()
            ->assertSee('Dr. New Name')
            ->assertSee('Lead Dermatologist')
            ->assertSee('Updated biography.')
            ->assertSee('data-count="15"', false)
            ->assertSee('data-count="1200"', false);
    }

    public function test_contact_seo_editor_loads_and_updates_contact_settings(): void
    {
        Storage::fake('public');
        $this->seed(SiteSettingSeeder::class);
        $seo = $this->seoRecord('contact');
        $user = $this->seoManager();

        $this->actingAs($user)
            ->get(route('admin.seo.edit', $seo))
            ->assertOk()
            ->assertSee('name="contact_settings[contact_phone]"', false)
            ->assertSee('value="+977 9801234567"', false)
            ->assertSee('name="contact_settings[google_maps_embed]"', false);

        $this->put(route('admin.seo.update', $seo), [
            'slug' => 'contact',
            'meta_title' => 'Contact the clinic',
            'meta_description' => 'Contact Aakar Dermatology.',
            'contact_settings' => [
                'contact_phone' => '+977 9812345678',
                'contact_phone2' => '+977 01-4444444',
                'contact_email' => 'appointments@example.com',
                'contact_address' => 'Updated Clinic Address',
                'contact_hours' => 'Sun-Fri, 9 AM-6 PM',
                'google_maps_embed' => 'https://maps.google.com/maps?q=Updated+Clinic&output=embed',
            ],
            'contact_images' => [
                'contact_map_image' => UploadedFile::fake()->image('clinic-map.jpg', 1166, 560),
            ],
        ])->assertRedirect(route('admin.seo.index'));

        $this->assertDatabaseHas('site_settings', [
            'key' => 'contact_phone',
            'value' => '+977 9812345678',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'contact_phone2',
            'value' => '+977 01-4444444',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'contact_email',
            'value' => 'appointments@example.com',
        ]);
        $this->assertDatabaseHas('site_settings', [
            'key' => 'contact_address',
            'value' => 'Updated Clinic Address',
        ]);

        $mapPath = SiteSetting::where('key', 'contact_map_image')->value('value');
        Storage::disk('public')->assertExists($mapPath);

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('+977 9812345678')
            ->assertSee('+977 01-4444444')
            ->assertSee('appointments@example.com')
            ->assertSee('Updated Clinic Address')
            ->assertSee('Sun-Fri, 9 AM-6 PM')
            ->assertSee('maps.google.com/maps?q=Updated+Clinic&amp;output=embed', false)
            ->assertSee('storage/'.$mapPath, false);
    }

    public function test_home_seo_editor_loads_and_updates_home_settings_and_brand_partners(): void
    {
        Storage::fake('public');
        $this->seed(SiteSettingSeeder::class);
        $seo = $this->seoRecord('home');
        $user = $this->seoManager();

        $this->actingAs($user)
            ->get(route('admin.seo.edit', $seo))
            ->assertOk()
            ->assertSee('name="home_settings[site_name]"', false)
            ->assertSee('name="home_settings[hero_heading]"', false)
            ->assertSee('name="home_settings[stat_years]"', false)
            ->assertSee('name="home_settings[cta_heading]"', false)
            ->assertSee('Homepage Brand Partners');

        $this->put(route('admin.seo.update', $seo), [
            'slug' => 'home',
            'meta_title' => 'Updated homepage SEO',
            'meta_description' => 'Updated homepage metadata.',
            'home_settings' => [
                'color_primary' => '#123456',
                'brand_partners_heading' => 'Selected Partners',
                'site_name' => 'Updated Clinic',
                'hero_heading' => 'A better headline',
                'stat_years' => '18+',
                'cta_heading' => 'Book a visit',
            ],
            'home_images' => [
                'site_logos' => [UploadedFile::fake()->image('clinic-logo.png', 400, 120)],
                'site_favicon' => UploadedFile::fake()->image('clinic-icon.png', 64, 64),
                'hero_image_1' => UploadedFile::fake()->image('hero.png', 800, 1000),
                'cta_bg_image' => UploadedFile::fake()->image('cta.png', 1920, 600),
            ],
            'home_brand_partners' => [
                'uploads' => [
                    ['image' => UploadedFile::fake()->image('partner.png'), 'name' => 'Partner Clinic', 'link' => 'https://example.com'],
                ],
            ],
        ])->assertRedirect(route('admin.seo.index'));

        $this->assertDatabaseHas('site_settings', ['key' => 'color_primary', 'value' => '#123456']);
        $this->assertDatabaseHas('site_settings', ['key' => 'brand_partners_heading', 'value' => 'Selected Partners']);
        $this->assertDatabaseHas('site_settings', ['key' => 'site_name', 'value' => 'Updated Clinic']);
        $this->assertDatabaseHas('site_settings', ['key' => 'hero_heading', 'value' => 'A better headline']);
        $this->assertDatabaseHas('site_settings', ['key' => 'stat_years', 'value' => '18+']);
        $this->assertDatabaseHas('site_settings', ['key' => 'cta_heading', 'value' => 'Book a visit']);

        $logoPath = SiteSetting::where('key', 'site_logo')->value('value');
        $faviconPath = SiteSetting::where('key', 'site_favicon')->value('value');
        $heroImagePath = SiteSetting::where('key', 'hero_image_1')->value('value');
        $ctaImagePath = SiteSetting::where('key', 'cta_bg_image')->value('value');
        $brandPartners = json_decode(SiteSetting::where('key', 'brand_partners')->value('value'), true);

        Storage::disk('public')->assertExists($logoPath);
        Storage::disk('public')->assertExists($faviconPath);
        Storage::disk('public')->assertExists($heroImagePath);
        Storage::disk('public')->assertExists($ctaImagePath);
        $this->assertSame('Partner Clinic', $brandPartners[0]['name']);
        $this->assertSame('https://example.com', $brandPartners[0]['link']);
        Storage::disk('public')->assertExists($brandPartners[0]['image']);
    }

    private function seoRecord(string $page): SeoMeta
    {
        return SeoMeta::create([
            'page' => $page,
            'slug' => $page,
            'meta_title' => ucfirst($page),
            'meta_description' => 'Description for '.$page,
        ]);
    }

    private function seoManager(): User
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create();
        $user->givePermissionTo('manage seo');

        return $user;
    }
}
