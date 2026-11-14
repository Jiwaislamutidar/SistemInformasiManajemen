<?php

namespace App\Providers;

use App\Models\Karyawan;
use App\Models\LaporanDivisi;
use App\Models\Mobil;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Observers\ActivityObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $observer = ActivityObserver::class;

        Penjualan::observe($observer);
        Pengeluaran::observe($observer);
        Mobil::observe($observer);
        Karyawan::observe($observer);
        LaporanDivisi::observe($observer);
    }
}
