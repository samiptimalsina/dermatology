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
}
