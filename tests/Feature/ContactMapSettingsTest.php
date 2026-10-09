<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactMapSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_manager_can_upload_and_display_the_contact_map_image(): void
    {
        Storage::fake('public');
        $this->seed([RolePermissionSeeder::class, SiteSettingSeeder::class]);
        $user = User::factory()->create();
        $user->givePermissionTo('manage settings');

        $this->actingAs($user)
            ->get(route('admin.settings.index'))
            ->assertOk()
            ->assertSee('setting_contact_map_image')
            ->assertSee('Clinic Map Image');

        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('images/contact-map.svg', false);

        $this->actingAs($user)
            ->post(route('admin.settings.update'), [
                'settings' => ['contact_address' => 'Pulchowk Damkal Chowk, Lalitpur'],
                'images' => [
                    'contact_map_image' => UploadedFile::fake()->image('clinic-map.jpg', 1166, 560),
                ],
            ])
            ->assertRedirect(route('admin.settings.index'));

        $mapPath = SiteSetting::query()->where('key', 'contact_map_image')->value('value');

        $this->assertNotEmpty($mapPath);
        Storage::disk('public')->assertExists($mapPath);
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('storage/'.$mapPath, false)
            ->assertSee('Aakar Dermatology location map');
    }

    public function test_contact_map_upload_rejects_non_image_files(): void
    {
        Storage::fake('public');
        $this->seed([RolePermissionSeeder::class, SiteSettingSeeder::class]);
        $user = User::factory()->create();
        $user->givePermissionTo('manage settings');

        $this->actingAs($user)
            ->from(route('admin.settings.index'))
            ->post(route('admin.settings.update'), [
                'settings' => ['contact_address' => 'Pulchowk Damkal Chowk, Lalitpur'],
                'images' => [
                    'contact_map_image' => UploadedFile::fake()->create('not-an-image.jpg', 20, 'text/plain'),
                ],
            ])
            ->assertSessionHasErrors('images.contact_map_image');

        $this->assertSame('', SiteSetting::query()->where('key', 'contact_map_image')->value('value'));
        $this->assertSame([], Storage::disk('public')->allFiles('settings/contact-map'));
    }

    public function test_new_logo_upload_becomes_active_and_favicon_is_rendered_and_replaced(): void
    {
        Storage::fake('public');
        $this->seed([RolePermissionSeeder::class, SiteSettingSeeder::class]);
        $user = User::factory()->create();
        $user->givePermissionTo('manage settings');

        $this->actingAs($user)
            ->post(route('admin.settings.update'), [
                'settings' => ['contact_address' => 'Pulchowk, Lalitpur'],
                'images' => [
                    'site_logos' => [UploadedFile::fake()->image('old-logo.png', 400, 120)],
                    'site_favicon' => UploadedFile::fake()->image('old-icon.png', 64, 64),
                ],
            ])
            ->assertRedirect(route('admin.settings.index'));

        $oldLogo = json_decode(SiteSetting::query()->where('key', 'site_logos')->value('value'), true)[0];
        $oldFavicon = SiteSetting::query()->where('key', 'site_favicon')->value('value');
        Storage::disk('public')->assertExists($oldLogo);
        Storage::disk('public')->assertExists($oldFavicon);

        $this->actingAs($user)
            ->post(route('admin.settings.update'), [
                'settings' => ['contact_address' => 'Pulchowk, Lalitpur'],
                'images' => [
                    'site_logos' => [UploadedFile::fake()->image('new-logo.png', 400, 120)],
                    'site_favicon' => UploadedFile::fake()->image('new-icon.png', 64, 64),
                ],
            ])
            ->assertRedirect(route('admin.settings.index'));

        $logos = json_decode(SiteSetting::query()->where('key', 'site_logos')->value('value'), true);
        $activeLogo = SiteSetting::query()->where('key', 'site_logo')->value('value');
        $newFavicon = SiteSetting::query()->where('key', 'site_favicon')->value('value');

        $this->assertCount(2, $logos);
        $this->assertSame($logos[0], $activeLogo);
        $this->assertNotSame($oldLogo, $activeLogo);
        Storage::disk('public')->assertExists($oldLogo);
        Storage::disk('public')->assertMissing($oldFavicon);
        Storage::disk('public')->assertExists($newFavicon);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('storage/'.$activeLogo, false)
            ->assertSee('<link rel="icon" href="'.asset('storage/'.$newFavicon).'">', false);

        $this->actingAs($user)
            ->post(route('admin.settings.update'), [
                'settings' => [
                    'contact_address' => 'Pulchowk, Lalitpur',
                    'site_logo' => $oldLogo,
                ],
            ])
            ->assertRedirect(route('admin.settings.index'));

        $this->assertSame($oldLogo, SiteSetting::query()->where('key', 'site_logo')->value('value'));
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('storage/'.$oldLogo, false);
    }

    public function test_settings_manager_can_upload_link_and_remove_a_homepage_brand_partner(): void
    {
        Storage::fake('public');
        $this->seed([RolePermissionSeeder::class, SiteSettingSeeder::class]);
        $user = User::factory()->create();
        $user->givePermissionTo('manage settings');

        $this->actingAs($user)
            ->get(route('admin.settings.index'))
            ->assertSee('Brand & Partners')
            ->assertSee('Homepage Brand Partners')
            ->assertSee('add-brand-partner', false)
            ->assertSee('name="settings[brand_partners_eyebrow]"', false)
            ->assertSee('name="settings[brand_partners_heading]"', false)
            ->assertDontSee('name="settings[brand_partners]"', false);

        $this->actingAs($user)
            ->post(route('admin.settings.update'), [
                'settings' => [
                    'contact_address' => 'Pulchowk, Lalitpur',
                    'brand_partners_eyebrow' => 'Brands we work with',
                    'brand_partners_heading' => 'Trusted by our partners',
                ],
                'brand_partners' => [
                    'uploads' => [[
                        'image' => UploadedFile::fake()->image('partner.png', 640, 320),
                        'name' => 'Partner Brand',
                        'link' => 'https://partner.example.com',
                    ]],
                ],
            ])
            ->assertRedirect(route('admin.settings.index'));

        $brandPartners = json_decode(SiteSetting::query()->where('key', 'brand_partners')->value('value'), true);
        $imagePath = $brandPartners[0]['image'];

        $this->assertSame('Partner Brand', $brandPartners[0]['name']);
        $this->assertSame('https://partner.example.com', $brandPartners[0]['link']);
        Storage::disk('public')->assertExists($imagePath);

        SiteSetting::query()->where('key', 'hero_video')->update(['value' => null]);

        $this->get(route('home'))
            ->assertSee('Brands we work with')
            ->assertSee('Trusted by our partners')
            ->assertSee('href="https://partner.example.com"', false)
            ->assertSee('storage/'.$imagePath, false)
            ->assertSee('alt="Partner Brand"', false);

        $this->actingAs($user)
            ->post(route('admin.settings.update'), [
                'settings' => ['contact_address' => 'Pulchowk, Lalitpur'],
                'brand_partners' => [
                    'existing' => [0 => [
                        'name' => 'Partner Brand',
                        'link' => 'https://partner.example.com',
                    ]],
                    'remove' => [0],
                ],
            ])
            ->assertRedirect(route('admin.settings.index'));

        $this->assertSame([], json_decode(SiteSetting::query()->where('key', 'brand_partners')->value('value'), true));
        Storage::disk('public')->assertMissing($imagePath);
    }

    public function test_brand_partner_upload_rejects_non_http_destinations(): void
    {
        Storage::fake('public');
        $this->seed([RolePermissionSeeder::class, SiteSettingSeeder::class]);
        $user = User::factory()->create();
        $user->givePermissionTo('manage settings');

        $this->actingAs($user)
            ->from(route('admin.settings.index'))
            ->post(route('admin.settings.update'), [
                'settings' => ['contact_address' => 'Pulchowk, Lalitpur'],
                'brand_partners' => [
                    'uploads' => [[
                        'image' => UploadedFile::fake()->image('partner.png'),
                        'name' => 'Partner Brand',
                        'link' => 'javascript:alert(1)',
                    ]],
                ],
            ])
            ->assertSessionHasErrors('brand_partners.uploads.0.link');

        $this->assertDatabaseMissing('site_settings', ['key' => 'brand_partners']);
        $this->assertSame([], Storage::disk('public')->allFiles('brand-partners'));
    }

    public function test_generic_settings_input_cannot_overwrite_brand_partners(): void
    {
        Storage::fake('public');
        $this->seed([RolePermissionSeeder::class, SiteSettingSeeder::class]);
        $user = User::factory()->create();
        $user->givePermissionTo('manage settings');
        $imagePath = 'brand-partners/kept.png';
        Storage::disk('public')->put($imagePath, 'image');

        SiteSetting::updateOrCreate(
            ['key' => 'brand_partners'],
            [
                'value' => json_encode([[
                    'name' => 'Kept Partner',
                    'image' => $imagePath,
                    'link' => 'https://partner.example.com',
                ]]),
                'type' => 'textarea',
                'group' => 'brand',
                'label' => 'Homepage Brand Partners',
            ]
        );

        $this->actingAs($user)
            ->post(route('admin.settings.update'), [
                'settings' => [
                    'contact_address' => 'Pulchowk, Lalitpur',
                    'brand_partners' => json_encode([[
                        'name' => 'Injected Partner',
                        'image' => 'brand-partners/injected.png',
                        'link' => 'https://injected.example.com',
                    ]]),
                ],
            ])
            ->assertRedirect(route('admin.settings.index'));

        $brandPartners = json_decode(SiteSetting::query()->where('key', 'brand_partners')->value('value'), true);

        $this->assertSame('Kept Partner', $brandPartners[0]['name']);
        $this->assertSame($imagePath, $brandPartners[0]['image']);
        $this->assertSame('https://partner.example.com', $brandPartners[0]['link']);
    }
}
