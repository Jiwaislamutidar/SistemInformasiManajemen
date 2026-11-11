<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pengeluaran') && ! Schema::hasColumn('pengeluaran', 'type')) {
            Schema::table('pengeluaran', function (Blueprint $table) {
                $table->string('type')->default('expense')->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengeluaran') && Schema::hasColumn('pengeluaran', 'type')) {
            Schema::table('pengeluaran', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
