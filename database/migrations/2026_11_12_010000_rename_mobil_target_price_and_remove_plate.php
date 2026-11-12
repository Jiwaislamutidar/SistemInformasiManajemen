<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('mobils')) {
            return;
        }

        if (Schema::hasColumn('mobils', 'harga_jual_target') && ! Schema::hasColumn('mobils', 'harga_jual')) {
            Schema::table('mobils', function (Blueprint $table) {
                $table->renameColumn('harga_jual_target', 'harga_jual');
            });
        } elseif (Schema::hasColumn('mobils', 'harga_jual_target') && Schema::hasColumn('mobils', 'harga_jual')) {
            DB::statement('UPDATE mobils SET harga_jual = harga_jual_target WHERE harga_jual IS NULL OR harga_jual = 0');
            Schema::table('mobils', function (Blueprint $table) {
                $table->dropColumn('harga_jual_target');
            });
        }

        if (Schema::hasColumn('mobils', 'no_plat')) {
            Schema::table('mobils', function (Blueprint $table) {
                $table->dropUnique(['no_plat']);
                $table->dropColumn('no_plat');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('mobils')) {
            return;
        }

        if (Schema::hasColumn('mobils', 'harga_jual') && ! Schema::hasColumn('mobils', 'harga_jual_target')) {
            Schema::table('mobils', function (Blueprint $table) {
                $table->renameColumn('harga_jual', 'harga_jual_target');
            });
        }
    }
};
