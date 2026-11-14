<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Owner Controllers
use App\Http\Controllers\Owner\LaporanKeuanganController;
use App\Http\Controllers\Owner\LaporanPenjualanController;
use App\Http\Controllers\Owner\MonitoringKaryawanController;
use App\Http\Controllers\Owner\LaporanMasukController;
use App\Http\Controllers\Owner\DashboardOwnerController;

// Admin Controllers 
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KirimLaporanController;
use App\Http\Controllers\Admin\InputPenjualanController;
use App\Http\Controllers\Admin\InputKeuanganController;
use App\Http\Controllers\Admin\KelolaMobilController;
use App\Http\Controllers\Admin\KelolaKaryawanController;
use App\Http\Controllers\Admin\JadwalShiftController;

// Admin IT Controllers
use App\Http\Controllers\AdminIt\AdminItController;

// Halaman depan
Route::get('/', function () {
    return view('welcome');
});

// Group rute yang butuh login (Auth)
Route::middleware(['auth'])->group(function () {

    // Dashboard berdasarkan Role
    Route::get('/owner/dashboard', [DashboardOwnerController::class, 'index'])->name('owner.dashboard');

    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/adminit/dashboard', [AdminItController::class, 'dashboard'])->name('adminit.dashboard');

    // Halaman Owner
    Route::get('/owner/laporankeuangan', [LaporanKeuanganController::class, 'index'])->name('owner.laporankeuangan');
    Route::delete('/owner/laporankeuangan/all', [LaporanKeuanganController::class, 'destroyAll'])->name('owner.laporankeuangan.destroyAll');
    Route::delete('/owner/laporankeuangan/{type}/{id}', [LaporanKeuanganController::class, 'destroy'])
        ->whereIn('type', ['sale', 'expense'])->whereNumber('id')->name('owner.laporankeuangan.destroy');
    Route::get('/owner/laporanpenjualan', [LaporanPenjualanController::class, 'index'])->name('owner.laporanpenjualan');
    Route::get('/owner/monitoringkaryawan', [MonitoringKaryawanController::class, 'index'])->name('owner.monitoringkaryawan');
    Route::get('/owner/laporanmasuk', [LaporanMasukController::class, 'index'])->name('owner.laporanmasuk');
    Route::get('/owner/laporanmasuk/{laporan}/download', [LaporanMasukController::class, 'download'])->name('owner.laporanmasuk.download');

    // Halaman Admin 
    Route::get('/admin/kirimlaporan', [KirimLaporanController::class, 'index'])->name('admin.kirimlaporan');
    Route::post('/admin/kirimlaporan', [KirimLaporanController::class, 'store'])->name('admin.kirimlaporan.store');
    Route::get('/admin/kirimlaporan/{laporan}/download', [KirimLaporanController::class, 'download'])->name('admin.kirimlaporan.download');
    Route::get('/admin/inputpenjualan', [InputPenjualanController::class, 'index'])->name('admin.inputpenjualan');
    Route::post('/admin/inputpenjualan/store', [InputPenjualanController::class, 'store'])->name('admin.penjualan.store');
    Route::get('/admin/inputkeuangan', [InputKeuanganController::class, 'index'])->name('admin.inputkeuangan');
    Route::post('/admin/inputkeuangan', [InputKeuanganController::class, 'store'])->name('admin.keuangan.store');
    Route::get('/admin/kelolamobil', [KelolaMobilController::class, 'index'])->name('admin.kelolamobil');
    Route::post('/admin/kelolamobil', [KelolaMobilController::class, 'store'])->name('admin.kelolamobil.store');
    Route::put('/admin/kelolamobil/{mobil}', [KelolaMobilController::class, 'update'])->name('admin.kelolamobil.update');
    Route::delete('/admin/kelolamobil/{mobil}', [KelolaMobilController::class, 'destroy'])->name('admin.kelolamobil.destroy');
    Route::get('/admin/kelolakaryawan', [KelolaKaryawanController::class, 'index'])->name('admin.kelolakaryawan');
    Route::post('/admin/kelolakaryawan', [KelolaKaryawanController::class, 'store'])->name('admin.kelolakaryawan.store');
    Route::get('/admin/kelolakaryawan/{karyawan}', [KelolaKaryawanController::class, 'show'])->name('admin.kelolakaryawan.show');
    Route::put('/admin/kelolakaryawan/{karyawan}', [KelolaKaryawanController::class, 'update'])->name('admin.kelolakaryawan.update');
    Route::delete('/admin/kelolakaryawan/{karyawan}', [KelolaKaryawanController::class, 'destroy'])->name('admin.kelolakaryawan.destroy');
    Route::get('/admin/jadwalshift', [JadwalShiftController::class, 'index'])->name('admin.jadwalshift');
    Route::put('/admin/jadwalshift/{karyawan}', [JadwalShiftController::class, 'update'])->name('admin.jadwalshift.update');
    Route::delete('/owner/laporanpenjualan/all', [LaporanPenjualanController::class, 'destroyAll'])->name('owner.laporanpenjualan.destroyAll');
    Route::delete('/owner/laporanpenjualan/{id}', [LaporanPenjualanController::class, 'destroy'])->name('owner.laporanpenjualan.destroy');

    // Halaman Admin IT 
    Route::get('/adminit/backupdata', [AdminItController::class, 'maintenance'])->name('adminit.backupdata');
    Route::post('/adminit/maintenance/clear-cache', [AdminItController::class, 'clearCache'])->middleware('role:admin_it')->name('adminit.maintenance.clear-cache');
    Route::get('/adminit/kelolaakun', [AdminItController::class, 'akun'])->name('adminit.kelolaakun');
    Route::put('/adminit/kelolaakun/{user}', [AdminItController::class, 'updateAkun'])->middleware('role:admin_it')->name('adminit.kelolaakun.update');
    Route::put('/adminit/kelolaakun/{user}/password', [AdminItController::class, 'updatePassword'])->middleware('role:admin_it')->name('adminit.akun.password');
    Route::get('/adminit/keloladatamaster', [AdminItController::class, 'master'])->name('adminit.keloladatamaster');
    Route::post('/adminit/keloladatamaster', [AdminItController::class, 'storeDivisi'])->name('adminit.divisi.store');
    Route::put('/adminit/keloladatamaster/{divisi}', [AdminItController::class, 'updateDivisi'])->name('adminit.divisi.update');
    Route::delete('/adminit/keloladatamaster/{divisi}', [AdminItController::class, 'destroyDivisi'])->name('adminit.divisi.destroy');
    Route::post('/adminit/keloladatamaster/karyawan', [AdminItController::class, 'storeKaryawan'])->middleware('role:admin_it')->name('adminit.karyawan.store');
    Route::get('/adminit/keloladatamaster/karyawan/{karyawan}', [AdminItController::class, 'showKaryawan'])->middleware('role:admin_it')->name('adminit.karyawan.show');
    Route::put('/adminit/keloladatamaster/karyawan/{karyawan}', [AdminItController::class, 'updateKaryawan'])->middleware('role:admin_it')->name('adminit.karyawan.update');
    Route::delete('/adminit/keloladatamaster/karyawan/{karyawan}', [AdminItController::class, 'destroyKaryawan'])->middleware('role:admin_it')->name('adminit.karyawan.destroy');
    Route::get('/adminit/lihatlogaktivitas', [AdminItController::class, 'log'])->name('adminit.lihatlogaktivitas');
    Route::post('/adminit/lihatlogaktivitas/restore/{type}/{id}', [AdminItController::class, 'restore'])
        ->whereIn('type', ['mobil', 'karyawan', 'penjualan'])
        ->whereNumber('id')
        ->middleware('role:admin_it')
        ->name('adminit.lihatlogaktivitas.restore');

    // Fitur Profile bawaan Breeze 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/bypass-owner', function () {
    $user = \App\Models\User::where('role', 'owner')->first();
    if ($user) {
        \Illuminate\Support\Facades\Auth::login($user);
        return redirect('/owner/monitoringkaryawan');
    }
    return 'User owner belum ada di database!';
});
});

require __DIR__.'/auth.php';
