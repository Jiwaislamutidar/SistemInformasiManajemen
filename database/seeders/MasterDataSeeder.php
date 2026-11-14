<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Divisi::allowedNames() as $nama) {
            Divisi::firstOrCreate(['nama_divisi' => $nama], ['kepala_divisi' => '']);
        }

        foreach (Jabatan::allowedNames() as $nama) {
            Jabatan::firstOrCreate(['nama_jabatan' => $nama]);
        }
    }
}
