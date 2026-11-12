<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('penjualans', 'mobil_id')) {
            Schema::table('penjualans', function (Blueprint $table) {
                $table->foreignId('mobil_id')->nullable()->after('id')->constrained('mobils')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('penjualans', 'mobil_id')) {
            Schema::table('penjualans', function (Blueprint $table) { $table->dropConstrainedForeignId('mobil_id'); });
        }
    }
};
