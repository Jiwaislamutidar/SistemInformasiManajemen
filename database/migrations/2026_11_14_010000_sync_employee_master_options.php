<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('divisi') || ! Schema::hasTable('jabatan')) {
            return;
        }

        $this->normalize('divisi', 'nama_divisi', [
            'Sales & Marketing' => 'Sales',
            'After-Sales & Servis' => 'Mekanik',
            'Keuangan & Akuntansi' => 'Akuntan',
            'Operasional' => 'Admin',
        ], ['karyawan', 'laporan_divisi']);

        $this->normalize('jabatan', 'nama_jabatan', [
            'Sales Executive' => 'Sales',
            'Supervisor' => 'Admin',
            'Admin Operasional' => 'Admin',
            'Teknisi' => 'Mekanik',
            'Staf Keuangan' => 'Akuntan',
        ], ['karyawan']);

        $now = now();
        foreach (['Admin', 'IT', 'Mekanik', 'Akuntan', 'Sales'] as $nama) {
            DB::table('divisi')->updateOrInsert(
                ['nama_divisi' => $nama],
                ['kepala_divisi' => '', 'updated_at' => $now, 'created_at' => $now]
            );
            DB::table('jabatan')->updateOrInsert(
                ['nama_jabatan' => $nama],
                ['updated_at' => $now, 'created_at' => $now]
            );
        }
    }

    private function normalize(string $table, string $nameColumn, array $legacyNames, array $referencingTables): void
    {
        foreach ($legacyNames as $legacy => $canonical) {
            $legacyRow = DB::table($table)->where($nameColumn, $legacy)->first();
            if (! $legacyRow) {
                continue;
            }

            $canonicalRow = DB::table($table)->where($nameColumn, $canonical)->first();
            if (! $canonicalRow || $canonicalRow->id === $legacyRow->id) {
                DB::table($table)->where('id', $legacyRow->id)->update([$nameColumn => $canonical, 'updated_at' => now()]);
                continue;
            }

            foreach ($referencingTables as $referencingTable) {
                if (Schema::hasTable($referencingTable) && Schema::hasColumn($referencingTable, $table . '_id')) {
                    DB::table($referencingTable)->where($table . '_id', $legacyRow->id)->update([$table . '_id' => $canonicalRow->id]);
                }
            }

            DB::table($table)->where('id', $legacyRow->id)->delete();
        }
    }

    public function down(): void
    {
        // Master data normalization is intentionally irreversible.
    }
};
