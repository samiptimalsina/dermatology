<?php

namespace Tests\Feature;

use App\Models\CustomPage;
use App\Models\SeoMeta;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomPageManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_seo_manager_can_create_and_publish_a_custom_page_by_slug(): void
    {
        SeoMeta::create([
            'page' => 'about',
            'slug' => 'about',
            'meta_title' => 'About the clinic',
            'meta_description' => 'About Aakar Dermatology.',
        ]);

        $response = $this->actingAs($this->seoManager())
            ->get(route('admin.seo.index'))
            ->assertOk()
            ->assertSee('Pages')
            ->assertSee('SEO Page')
            ->assertSee(route('admin.seo.custom-pages.create'));

        $this->assertSame(1, substr_count($response->getContent(), '<table'));

        $this->post(route('admin.seo.custom-pages.store'), [
            'title' => 'Clinic Hours',
            'slug' => '  clinic-hours  ',
            'content' => '<p>Opening hours and appointment information.</p>',
            'meta_title' => 'Clinic Hours | Aakar Dermatology',
            'meta_description' => 'Find clinic hours and appointment information.',
            'is_published' => '1',
            'no_index' => '0',
        ])->assertRedirect(route('admin.seo.index'));

        $customPage = CustomPage::query()->where('slug', 'clinic-hours')->firstOrFail();

        $this->assertDatabaseHas('custom_pages', [
            'id' => $customPage->id,
            'title' => 'Clinic Hours',
            'slug' => 'clinic-hours',
            'is_published' => true,
        ]);

        $this->get('/clinic-hours')
            ->assertOk()
            ->assertSee('Clinic Hours')
            ->assertSee('Opening hours and appointment information.');

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee(route('custom-pages.show', $customPage), false);
    }

    public function test_custom_page_slug_must_be_unique_and_not_reserved(): void
    {
        $this->actingAs($this->seoManager());

        CustomPage::create([
            'title' => 'Clinic Hours',
            'slug' => 'clinic-hours',
            'content' => '<p>Hours</p>',
        ]);

        $this->post(route('admin.seo.custom-pages.store'), [
            'title' => 'Another Page',
            'slug' => 'clinic-hours',
            'content' => '<p>Content</p>',
        ])->assertSessionHasErrors('slug');

        $this->post(route('admin.seo.custom-pages.store'), [
            'title' => 'About Page',
            'slug' => 'about',
            'content' => '<p>Content</p>',
        ])->assertSessionHasErrors('slug');

        $this->assertDatabaseCount('custom_pages', 1);
    }

    public function test_seo_manager_can_update_and_delete_a_custom_page(): void
    {
        $customPage = CustomPage::create([
            'title' => 'Clinic Hours',
            'slug' => 'clinic-hours',
            'content' => '<p>Old hours</p>',
        ]);

        $this->actingAs($this->seoManager())
            ->get(route('admin.seo.custom-pages.edit', $customPage))
            ->assertOk()
            ->assertSee('name="slug"', false)
            ->assertSee('value="clinic-hours"', false);

        $this->put(route('admin.seo.custom-pages.update', $customPage), [
            'title' => 'Updated Clinic Hours',
            'slug' => '  updated-clinic-hours  ',
            'content' => '<p>New hours</p>',
            'meta_title' => 'Updated Clinic Hours',
            'meta_description' => 'Updated opening information.',
            'is_published' => '1',
            'no_index' => '0',
        ])->assertRedirect(route('admin.seo.index'));

        $this->assertDatabaseHas('custom_pages', [
            'id' => $customPage->id,
            'slug' => 'updated-clinic-hours',
            'title' => 'Updated Clinic Hours',
        ]);

        $this->delete(route('admin.seo.custom-pages.destroy', $customPage->refresh()))
            ->assertRedirect(route('admin.seo.index'));

        $this->assertDatabaseMissing('custom_pages', ['id' => $customPage->id]);
    }

    public function test_unpublished_custom_pages_are_not_public_or_in_the_sitemap(): void
    {
        $customPage = CustomPage::create([
            'title' => 'Internal Draft',
            'slug' => 'internal-draft',
            'content' => '<p>Draft content</p>',
            'is_published' => false,
        ]);

        $this->get('/internal-draft')->assertNotFound();

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertDontSee(route('custom-pages.show', $customPage), false);
    }

    public function test_user_without_seo_permission_cannot_create_custom_pages(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.seo.custom-pages.create'))
            ->assertForbidden();
    }

    private function seoManager(): User
    {
        $this->seed(RolePermissionSeeder::class);

        $user = User::factory()->create();
        $user->givePermissionTo('manage seo');

        return $user;
    }
}
