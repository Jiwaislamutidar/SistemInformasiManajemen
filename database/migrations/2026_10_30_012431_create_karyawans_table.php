<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel divisi dan jabatan
            $table->foreignId('divisi_id')->constrained('divisi')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade');
            $table->string('nama');
            $table->decimal('gaji_pokok', 15, 2);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
