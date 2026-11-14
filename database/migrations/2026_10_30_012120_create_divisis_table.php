<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('divisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_divisi');
            $table->string('kepala_divisi'); // Sesuai ERD: menyimpan nama kepala divisi
            $table->timestamps();
        });

        $now = now();
        DB::table('divisi')->insert(array_map(fn (string $nama) => [
            'nama_divisi' => $nama,
            'kepala_divisi' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ], ['Admin', 'IT', 'Mekanik', 'Akuntan', 'Sales']));
    }

    public function down(): void
    {
        Schema::dropIfExists('divisi');
    }
};
