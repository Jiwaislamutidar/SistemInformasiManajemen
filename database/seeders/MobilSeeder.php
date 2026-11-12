<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            ['merk_tipe' => 'Chery Tiggo 5X Classic', 'tahun' => 2025, 'harga_beli' => 224100000, 'harga_jual' => 249000000, 'stok' => 3],
            ['merk_tipe' => 'Chery Tiggo 5X Summit', 'tahun' => 2025, 'harga_beli' => 251100000, 'harga_jual' => 279000000, 'stok' => 3],
            ['merk_tipe' => 'Chery Omoda 5 Z', 'tahun' => 2025, 'harga_beli' => 301320000, 'harga_jual' => 334800000, 'stok' => 4],
            ['merk_tipe' => 'Chery Omoda 5 RZ', 'tahun' => 2025, 'harga_beli' => 364320000, 'harga_jual' => 404800000, 'stok' => 3],
            ['merk_tipe' => 'Chery Tiggo 7 Pro Premium', 'tahun' => 2025, 'harga_beli' => 331650000, 'harga_jual' => 368500000, 'stok' => 2],
            ['merk_tipe' => 'Chery Tiggo 8 Pro Premium', 'tahun' => 2025, 'harga_beli' => 475650000, 'harga_jual' => 528500000, 'stok' => 2],
            ['merk_tipe' => 'Chery Omoda E5 Electric', 'tahun' => 2025, 'harga_beli' => 439920000, 'harga_jual' => 488800000, 'stok' => 3],
        ];

        Mobil::whereNotIn('merk_tipe', array_column($vehicles, 'merk_tipe'))->delete();

        foreach ($vehicles as $vehicle) {
            if (Schema::hasColumn('mobils', 'merek')) $vehicle['merek'] = 'Chery';
            if (Schema::hasColumn('mobils', 'tipe')) $vehicle['tipe'] = str_replace('Chery ', '', $vehicle['merk_tipe']);
            Mobil::updateOrCreate(
                ['merk_tipe' => $vehicle['merk_tipe']],
                [...$vehicle, 'status' => $vehicle['stok'] > 0 ? 'Ready' : 'Habis']
            );
        }
    }
}
