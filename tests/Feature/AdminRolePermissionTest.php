<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminRolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_roles_have_the_expected_permission_matrix(): void
    {
        $this->seed(AdminUserSeeder::class);

        $permissions = Permission::all();
        $superAdminRole = Role::findByName('super_admin');
        $blogWriterRole = Role::findByName('blog_writer');
        $adminUser = User::where('email', 'admin@aakardermatology.com')->firstOrFail();

        $expectedBlogWriterPermissions = $permissions
            ->whereNotIn('name', ['manage users', 'manage roles'])
            ->pluck('name')
            ->all();

        $this->assertTrue($adminUser->hasRole('super_admin'));
        $this->assertEqualsCanonicalizing(
            $permissions->pluck('name')->all(),
            $superAdminRole->permissions->pluck('name')->all()
        );
        $this->assertEqualsCanonicalizing(
            $expectedBlogWriterPermissions,
            $blogWriterRole->permissions->pluck('name')->all()
        );
        $this->assertFalse($blogWriterRole->hasPermissionTo('manage users'));
        $this->assertFalse($blogWriterRole->hasPermissionTo('manage roles'));
    }

    public function test_blog_writer_can_manage_all_existing_sections_but_unassigned_users_are_denied(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $blogWriter = User::factory()->create();
        $blogWriter->assignRole('blog_writer');

        $this->actingAs($blogWriter)
            ->get(route('admin.blogs.index'))
            ->assertOk()
            ->assertSee(route('admin.settings.index'))
            ->assertDontSee(route('admin.users.index'))
            ->assertDontSee(route('admin.roles.index'));

        $this->get(route('admin.users.index'))->assertForbidden();
        $this->get(route('admin.roles.index'))->assertForbidden();

        $this->get(route('admin.settings.index'))->assertOk();

        $blogsOnlyUser = User::factory()->create();
        $blogsOnlyUser->givePermissionTo('manage blogs');

        $this->actingAs($blogsOnlyUser)
            ->get(route('admin.blogs.index'))
            ->assertOk()
            ->assertDontSee(route('admin.settings.index'));

        $unassignedUser = User::factory()->create();

        $this->actingAs($unassignedUser)
            ->get(route('admin.settings.index'))
            ->assertForbidden();
    }

    public function test_super_admin_can_manage_users_and_custom_role_permissions(): void
    {
        $this->seed(AdminUserSeeder::class);

        $adminUser = User::where('email', 'admin@aakardermatology.com')->firstOrFail();
        $blogPermission = Permission::findByName('manage blogs', 'web');

        $this->actingAs($adminUser)
            ->get(route('admin.users.index'))
            ->assertOk()
            ->assertSee(route('admin.roles.index'));

        $this->get(route('admin.roles.index'))
            ->assertOk()
            ->assertSee('Seeded system role');

        $this->post(route('admin.roles.store'), [
            'name' => 'content_editor',
            'permissions' => [$blogPermission->id],
        ])->assertRedirect(route('admin.roles.index'));

        $customRole = Role::findByName('content_editor', 'web');
        $this->assertTrue($customRole->hasPermissionTo('manage blogs', 'web'));

        $this->post(route('admin.users.store'), [
            'name' => 'Content Editor',
            'email' => 'content.editor@example.com',
            'password' => 'SecurePassword123',
            'password_confirmation' => 'SecurePassword123',
            'roles' => ['content_editor'],
        ])->assertRedirect(route('admin.users.index'));

        $createdUser = User::where('email', 'content.editor@example.com')->firstOrFail();
        $this->assertTrue($createdUser->hasRole('content_editor'));
    }
}
