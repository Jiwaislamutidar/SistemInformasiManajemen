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
        User::updateorCreate([
            'nama' => 'Bpk. Owner Eksekutif',
            'email' => 'owner@dealer.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
            'status' => 'aktif',
        ]);

        // 2. Akun Admin (Pengelola Operasional & Divisi)
        User::updateorCreate([
            'nama' => 'Admin Operasional',
            'email' => 'admin@dealer.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        // 3. Akun Admin IT (Teknis & Pengelola Sistem)
        User::updateorCreate([
            'nama' => 'Jiwa Admin IT',
            'email' => 'adminit@dealer.com',
            'password' => Hash::make('password123'),
            'role' => 'admin_it',
            'status' => 'aktif',
        ]);
    }
}