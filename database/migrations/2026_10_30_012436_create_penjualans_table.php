<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('unit_mobil');
            $table->string('nama_pembeli');
            $table->decimal('harga_jual', 15, 2);
            $table->string('metode_pembayaran');
            $table->string('sales_executive');
            $table->string('bukti_deal')->nullable(); // Opsional jika tidak upload foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
