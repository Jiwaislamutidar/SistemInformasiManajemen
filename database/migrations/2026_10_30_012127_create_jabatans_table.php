<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->timestamps();
        });

        $now = now();
        DB::table('jabatan')->insert(array_map(fn (string $nama) => [
            'nama_jabatan' => $nama,
            'created_at' => $now,
            'updated_at' => $now,
        ], ['Admin', 'IT', 'Mekanik', 'Akuntan', 'Sales']));
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
