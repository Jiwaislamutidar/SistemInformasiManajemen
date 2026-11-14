<?php

namespace App\Observers;

use App\Models\Karyawan;
use App\Models\LaporanDivisi;
use App\Models\Mobil;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Services\ActivityLogger;

class ActivityObserver
{
    private const MODEL_LABELS = [
        Penjualan::class => 'penjualan',
        Pengeluaran::class => 'keuangan',
        Mobil::class => 'stok mobil',
        Karyawan::class => 'karyawan',
        LaporanDivisi::class => 'laporan divisi',
    ];

    public function created(object $model): void
    {
        $label = self::MODEL_LABELS[$model::class] ?? 'data';
        $prefix = $model instanceof LaporanDivisi && $model->status === 'dikirim_ke_owner'
            ? 'Mengirim laporan divisi ke Owner'
            : "Menambahkan data {$label} baru";

        ActivityLogger::log($prefix);
    }

    public function updated(object $model): void
    {
        $label = self::MODEL_LABELS[$model::class] ?? 'data';
        if ($model instanceof LaporanDivisi && $model->status === 'dibaca') {
            $prefix = 'Menyetujui / menandai laporan masuk sebagai dibaca';
        } elseif ($model instanceof LaporanDivisi && $model->status === 'ditinjau') {
            $prefix = 'Meninjau laporan divisi yang masuk';
        } else {
            $prefix = $model instanceof LaporanDivisi
                ? 'Memperbarui status atau data laporan divisi'
                : "Memperbarui data {$label}";
        }

        ActivityLogger::log($prefix);
    }

    public function deleted(object $model): void
    {
        $label = self::MODEL_LABELS[$model::class] ?? 'data';

        ActivityLogger::log("Menghapus data {$label}");
    }
}
