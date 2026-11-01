<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Owner Controllers
use App\Http\Controllers\Owner\ProfitController; 
use App\Http\Controllers\Owner\LaporanKeuanganController;
use App\Http\Controllers\Owner\LaporanPenjualanController;
use App\Http\Controllers\Owner\KinerjaDivisiController;
use App\Http\Controllers\Owner\MonitoringKaryawanController;
use App\Http\Controllers\Owner\DataInvestorController;

// Admin Controllers 
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KirimLaporanController;
use App\Http\Controllers\Admin\InputPenjualanController;
use App\Http\Controllers\Admin\InputPengeluaranController;
use App\Http\Controllers\Admin\KelolaMobilController;
use App\Http\Controllers\Admin\KelolaKaryawanController;
use App\Http\Controllers\Admin\KelolaAbsensiController;
use App\Http\Controllers\Admin\KelolaDataInvestorController;
use App\Http\Controllers\Admin\BuatLaporanController;

// Admin IT Controllers 
use App\Http\Controllers\AdminIt\BackupDataController;
use App\Http\Controllers\AdminIt\KelolaAkunController;
use App\Http\Controllers\AdminIt\KelolaDataMasterController;
use App\Http\Controllers\AdminIt\LihatLogAktivitasController;
use App\Http\Controllers\AdminIt\PengaturanSistemController;

// Halaman depan
Route::get('/', function () {
    return view('welcome');
});

// Group rute yang butuh login (Auth)
Route::middleware(['auth'])->group(function () {

    // Dashboard berdasarkan Role
    Route::get('/owner/dashboard', function () {
        return view('owner.dashboard');
    })->name('owner.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/adminit/dashboard', function () {
        return view('adminit.dashboard');
    })->name('adminit.dashboard');

    // Halaman Owner
    Route::get('/owner/profit', [ProfitController::class, 'index'])->name('owner.profit');
    Route::get('/owner/laporankeuangan', [LaporanKeuanganController::class, 'index'])->name('owner.laporankeuangan');
    Route::get('/owner/laporanpenjualan', [LaporanPenjualanController::class, 'index'])->name('owner.laporanpenjualan');
    Route::get('/owner/kinerjadivisi', [KinerjaDivisiController::class, 'index'])->name('owner.kinerjadivisi');
    Route::get('/owner/monitoringkaryawan', [MonitoringKaryawanController::class, 'index'])->name('owner.monitoringkaryawan');
    Route::get('/owner/datainvestor', [DataInvestorController::class, 'index'])->name('owner.datainvestor');

    // Halaman Admin 
    Route::get('/admin/kirimlaporan', [KirimLaporanController::class, 'index'])->name('admin.kirimlaporan');
    Route::get('/admin/inputpenjualan', [InputPenjualanController::class, 'index'])->name('admin.inputpenjualan');
    Route::post('/admin/inputpenjualan/store', [InputPenjualanController::class, 'store'])->name('admin.penjualan.store');
    Route::get('/admin/inputpengeluaran', [InputPengeluaranController::class, 'index'])->name('admin.inputpengeluaran');
    Route::get('/admin/kelolamobil', [KelolaMobilController::class, 'index'])->name('admin.kelolamobil');
    Route::get('/admin/kelolakaryawan', [KelolaKaryawanController::class, 'index'])->name('admin.kelolakaryawan');
    Route::get('/admin/kelolaabsensi', [KelolaAbsensiController::class, 'index'])->name('admin.kelolaabsensi');
    Route::get('/admin/kelolainvestor', [KelolaDataInvestorController::class, 'index'])->name('admin.kelolainvestor');
    Route::get('/admin/buatlaporan', [BuatLaporanController::class, 'index'])->name('admin.buatlaporan');
    Route::delete('/owner/laporanpenjualan/{id}', [LaporanPenjualanController::class, 'destroy'])->name('owner.laporanpenjualan.destroy');

    // Halaman Admin IT 
    Route::get('/adminit/backupdata', [BackupDataController::class, 'index'])->name('adminit.backupdata');
    Route::get('/adminit/kelolaakun', [KelolaAkunController::class, 'index'])->name('adminit.kelolaakun');
    Route::get('/adminit/keloladatamaster', [KelolaDataMasterController::class, 'index'])->name('adminit.keloladatamaster');
    Route::get('/adminit/lihatlogaktivitas', [LihatLogAktivitasController::class, 'index'])->name('adminit.lihatlogaktivitas');
    Route::get('/adminit/pengaturansistem', [PengaturanSistemController::class, 'index'])->name('adminit.pengaturansistem');

    // Fitur Profile bawaan Breeze 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';