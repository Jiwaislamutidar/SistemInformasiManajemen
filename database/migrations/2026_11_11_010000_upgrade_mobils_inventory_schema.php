<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('mobil') && ! Schema::hasTable('mobils')) {
            Schema::rename('mobil', 'mobils');
        }

        if (! Schema::hasTable('mobils')) {
            return;
        }

        Schema::table('mobils', function (Blueprint $table) {
            if (! Schema::hasColumn('mobils', 'merk_tipe')) $table->string('merk_tipe')->nullable();
            if (! Schema::hasColumn('mobils', 'tahun')) $table->unsignedSmallInteger('tahun')->default(date('Y'));
            if (! Schema::hasColumn('mobils', 'harga_jual')) $table->decimal('harga_jual', 15, 2)->default(0);
            if (! Schema::hasColumn('mobils', 'status')) $table->string('status')->default('Habis');
        });

        if (Schema::hasColumn('mobils', 'merek') && Schema::hasColumn('mobils', 'tipe')) {
            \DB::statement("UPDATE mobils SET merk_tipe = CONCAT(merek, ' ', tipe) WHERE merk_tipe IS NULL");
        }
        \DB::statement("UPDATE mobils SET status = CASE WHEN stok > 0 THEN 'Ready' ELSE 'Habis' END");
    }

    public function down(): void
    {
        // The migration is intentionally non-destructive for existing inventory data.
    }
};
