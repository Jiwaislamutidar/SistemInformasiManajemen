<?php

namespace App\Services;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Throwable;

class ActivityLogger
{
    /**
     * Menulis aktivitas tanpa pernah mengganggu proses utama aplikasi.
     */
    public static function log(string $activity, ?User $user = null): void
    {
        try {
            if (! Schema::hasTable('log_aktivitas')) {
                return;
            }

            $user ??= auth()->check() ? auth()->user() : null;

            // Seeder, queue, dan command CLI dapat berjalan tanpa user.
            if (! $user instanceof User) {
                return;
            }

            LogAktivitas::query()->create([
                'user_id' => $user->getKey(),
                'aksi' => $activity,
                'waktu' => now(),
            ]);
        } catch (Throwable) {
            // Logging tidak boleh membuat aksi bisnis gagal.
        }
    }
}
