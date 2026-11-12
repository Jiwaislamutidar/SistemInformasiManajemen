<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('karyawan')) {
            return;
        }

        Schema::table('karyawan', function (Blueprint $table) {
            if (! Schema::hasColumn('karyawan', 'nip')) $table->string('nip')->nullable()->unique()->after('id');
            if (! Schema::hasColumn('karyawan', 'telepon')) $table->string('telepon')->nullable()->after('nama');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('karyawan')) {
            return;
        }

        Schema::table('karyawan', function (Blueprint $table) {
            if (Schema::hasColumn('karyawan', 'nip')) $table->dropUnique(['nip']);
            if (Schema::hasColumn('karyawan', 'nip')) $table->dropColumn('nip');
            if (Schema::hasColumn('karyawan', 'telepon')) $table->dropColumn('telepon');
        });
    }
};
