<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasColumn('penjualans', 'jumlah_dp')) {
            Schema::table('penjualans', function (Blueprint $table) {
                $table->decimal('jumlah_dp', 15, 2)->nullable()->after('metode_pembayaran');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('penjualans', 'jumlah_dp')) {
            Schema::table('penjualans', fn (Blueprint $table) => $table->dropColumn('jumlah_dp'));
        }
    }
};
