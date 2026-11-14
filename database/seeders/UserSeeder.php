<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Owner (Pemilik Dealer)
        User::updateOrCreate(
            ['email' => 'owner@dealer.com'], // Kunci pencarian unik
            [
                'nama' => 'Bpk. Owner Eksekutif',
                'password' => Hash::make('owner123'),
                'role' => 'owner',
                'status' => 'aktif',
            ]
        );

        // 2. Akun Admin (Pengelola Operasional & Divisi)
        User::updateOrCreate(
            ['email' => 'admin@dealer.com'], // Kunci pencarian unik
            [
                'nama' => 'Admin Operasional',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'aktif',
            ]
        );

        // 3. Akun Admin IT (Teknis & Pengelola Sistem)
        User::updateOrCreate(
            ['email' => 'adminit@dealer.com'], // Kunci pencarian unik
            [
                'nama' => 'Jiwa Admin IT',
                'password' => Hash::make('adminit123'),
                'role' => 'admin_it',
                'status' => 'aktif',
            ]
        );
    }
}