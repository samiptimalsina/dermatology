<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionNames = [
            'view dashboard',
            'manage appointments',
            'manage services',
            'manage blogs',
            'manage videos',
            'manage gallery',
            'manage testimonials',
            'manage before-afters',
            'manage team',
            'manage seo',
            'manage why-us',
            'manage settings',
            'manage users',
            'manage roles',
        ];

        $permissionRegistrar = app(PermissionRegistrar::class);
        $permissionRegistrar->forgetCachedPermissions();

        foreach ($permissionNames as $permissionName) {
            Permission::findOrCreate($permissionName, 'web');
        }

        $superAdminRole = Role::findOrCreate('super_admin', 'web');
        $superAdminRole->syncPermissions(Permission::query()->where('guard_name', 'web')->get());

        $blogWriterRole = Role::findOrCreate('blog_writer', 'web');
        $blogWriterRole->syncPermissions(
            Permission::query()
                ->where('guard_name', 'web')
                ->whereNotIn('name', ['manage users', 'manage roles'])
                ->get()
        );

        $permissionRegistrar->forgetCachedPermissions();
    }
}
