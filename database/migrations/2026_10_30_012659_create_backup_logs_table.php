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
        Schema::create('backup_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_file');
            $table->string('ukuran');
            $table->string('status');
            $table->timestamp('waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_logs');
    }
};
