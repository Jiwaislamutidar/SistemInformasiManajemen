<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@dealer.com'],
            [
                'nama' => 'Admin Operasional',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Akun Owner
        User::updateOrCreate(
            ['email' => 'owner@dealer.com'],
            [
                'nama' => 'Owner Showroom',
                'password' => Hash::make('password123'),
            ]
        );

        // 3. Akun Admin IT
        User::updateOrCreate(
            ['email' => 'adminit@dealer.com'],
            [
                'nama' => 'Admin IT',
                'password' => Hash::make('password123'),
            ]
        );
    }
}