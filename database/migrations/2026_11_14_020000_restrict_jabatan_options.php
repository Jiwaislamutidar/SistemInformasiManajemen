<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('jabatan') || ! Schema::hasTable('karyawan')) return;

        $now = now();
        foreach (['Kepala Divisi', 'Bukan Kepala Divisi'] as $name) {
            DB::table('jabatan')->updateOrInsert(
                ['nama_jabatan' => $name],
                ['created_at' => $now, 'updated_at' => $now]
            );
        }

        $staffId = DB::table('jabatan')->where('nama_jabatan', 'Bukan Kepala Divisi')->value('id');
        $headId = DB::table('jabatan')->where('nama_jabatan', 'Kepala Divisi')->value('id');
        DB::table('karyawan')->where('jabatan_id', '!=', $headId)->update(['jabatan_id' => $staffId, 'updated_at' => $now]);

        DB::table('jabatan')->whereNotIn('id', [$headId, $staffId])->delete();
    }

    public function down(): void
    {
        // The old job-title master data cannot be restored safely after normalization.
    }
};
