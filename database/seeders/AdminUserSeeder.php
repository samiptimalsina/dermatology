<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@aakardermatology.com'],
            [
                'name'     => 'Aakar Admin',
                'email'    => 'admin@aakardermatology.com',
                'password' => Hash::make('Admin@2024!'),
            ]
        );
    }
}
