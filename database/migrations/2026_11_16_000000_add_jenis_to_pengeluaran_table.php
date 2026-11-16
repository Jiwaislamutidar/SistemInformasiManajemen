<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('pengeluaran')) {
            return;
        }

        if (! Schema::hasColumn('pengeluaran', 'jenis')) {
            Schema::table('pengeluaran', function (Blueprint $table) {
                $table->string('jenis')->default('Pengeluaran')->after('type');
            });
        }

        if (Schema::hasColumn('pengeluaran', 'type')) {
            DB::table('pengeluaran')->where('type', 'income')->update(['jenis' => 'Pendapatan']);
            DB::table('pengeluaran')->where('type', 'expense')->update(['jenis' => 'Pengeluaran']);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengeluaran') && Schema::hasColumn('pengeluaran', 'jenis')) {
            Schema::table('pengeluaran', function (Blueprint $table) {
                $table->dropColumn('jenis');
            });
        }
    }
};
