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
    Schema::create('penggajian', function (Blueprint $table) {
        $table->id();
        $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
        $table->foreignId('diajukan_oleh')->nullable()->constrained('users')->onDelete('set null');
        $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->onDelete('set null');
        $table->string('periode');
        $table->decimal('gaji_pokok', 15, 2);
        $table->decimal('komisi', 15, 2)->default(0);
        $table->decimal('potongan', 15, 2)->default(0);
        $table->decimal('total', 15, 2);
        $table->enum('status', ['diajukan', 'disetujui', 'ditolak'])->default('diajukan');
        $table->timestamp('tanggal_disetujui')->nullable();
        $table->text('catatan_penolakan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
