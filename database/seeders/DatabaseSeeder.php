<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Owner (Pemilik Dealer)
        User::updateOrCreate(
            ['email' => 'owner@dealer.com'],
            [
                'nama' => 'Bpk. Owner Eksekutif',
                'password' => Hash::make('owner123'),
                'role' => 'owner',
                'status' => 'aktif',
            ]
        );

        // 2. Akun Admin (Pengelola Operasional)
        User::updateOrCreate(
            ['email' => 'admin@dealer.com'],
            [
                'nama' => 'Admin Operasional',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'aktif',
            ]
        );

        // 3. Akun Admin IT
        User::updateOrCreate(
            ['email' => 'adminit@dealer.com'],
            [
                'nama' => 'Jiwa Admin IT',
                'password' => Hash::make('adminit123'),
                'role' => 'admin_it',
                'status' => 'aktif',
            ]
        );
    }
}