<?php

namespace Tests\Feature;

use App\Models\SeoMeta;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
