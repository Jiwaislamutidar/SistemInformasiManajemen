<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Sales & Marketing', 'After-Sales & Servis', 'Keuangan & Akuntansi', 'Operasional'] as $nama) {
            Divisi::firstOrCreate(['nama_divisi' => $nama], ['kepala_divisi' => '']);
        }

        foreach (['Sales Executive', 'Supervisor', 'Admin Operasional', 'Teknisi', 'Staf Keuangan'] as $nama) {
            Jabatan::firstOrCreate(['nama_jabatan' => $nama]);
        }
    }
}
