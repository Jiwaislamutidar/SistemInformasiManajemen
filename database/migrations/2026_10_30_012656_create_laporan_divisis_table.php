<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_divisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('divisi_id')->constrained('divisi')->onDelete('cascade');
            $table->foreignId('diteruskan_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->string('judul');
            $table->text('ringkasan');
            $table->string('lampiran')->nullable();
            $table->string('periode');
            $table->text('catatan_admin')->nullable();
            $table->enum('status', ['menunggu', 'ditinjau', 'dikirim_ke_owner', 'dibaca'])->default('menunggu');
            $table->timestamp('tanggal_dikirim')->nullable();
            $table->timestamp('tanggal_dibaca')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_divisis');
    }
};
