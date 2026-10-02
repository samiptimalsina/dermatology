<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $user = User::updateOrCreate(
            ['email' => 'admin@aakardermatology.com'],
            [
                'name' => 'Aakar Admin',
                'email' => 'admin@aakardermatology.com',
                'password' => Hash::make('Admin@2024!'),
            ]
        );

        $user->syncRoles('super_admin');

        $newAdmin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
            ]
        );

        $newAdmin->syncRoles('super_admin');

    }
}
