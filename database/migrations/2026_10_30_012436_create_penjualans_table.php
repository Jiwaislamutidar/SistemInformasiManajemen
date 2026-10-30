<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel mobil dan karyawan (sales)
            $table->foreignId('mobil_id')->constrained('mobil')->onDelete('cascade');
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade');
            $table->string('pembeli');
            $table->date('tanggal');
            $table->decimal('harga_jual', 15, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
