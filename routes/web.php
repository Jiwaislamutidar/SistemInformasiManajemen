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

// Admin Controllers (Sesuai UML Baru)
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KirimLaporanController;
use App\Http\Controllers\Admin\InputPenjualanController;
use App\Http\Controllers\Admin\InputPengeluaranController;
use App\Http\Controllers\Admin\KelolaMobilController;
use App\Http\Controllers\Admin\KelolaKaryawanController;
use App\Http\Controllers\Admin\KelolaAbsensiController;
use App\Http\Controllers\Admin\KelolaDataInvestorController;
use App\Http\Controllers\Admin\BuatLaporanController;

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

    Route::get('/admin-it/dashboard', function () {
        return view('admin-it.dashboard');
    })->name('admin-it.dashboard');

    // Halaman Owner
    Route::get('/owner/profit', [ProfitController::class, 'index'])->name('owner.profit');
    Route::get('/owner/laporankeuangan', [LaporanKeuanganController::class, 'index'])->name('owner.laporankeuangan');
    Route::get('/owner/laporanpenjualan', [LaporanPenjualanController::class, 'index'])->name('owner.laporanpenjualan');
    Route::get('/owner/kinerjadivisi', [KinerjaDivisiController::class, 'index'])->name('owner.kinerjadivisi');
    Route::get('/owner/monitoringkaryawan', [MonitoringKaryawanController::class, 'index'])->name('owner.monitoringkaryawan');
    Route::get('/owner/datainvestor', [DataInvestorController::class, 'index'])->name('owner.datainvestor');

    // Halaman Admin (Sesuai Use Case UML)
    Route::get('/admin/kirimlaporan', [KirimLaporanController::class, 'index'])->name('admin.kirimlaporan');
    Route::get('/admin/inputpenjualan', [InputPenjualanController::class, 'index'])->name('admin.inputpenjualan');
    Route::get('/admin/inputpengeluaran', [InputPengeluaranController::class, 'index'])->name('admin.inputpengeluaran');
    Route::get('/admin/kelolamobil', [KelolaMobilController::class, 'index'])->name('admin.kelolamobil');
    Route::get('/admin/kelolakaryawan', [KelolaKaryawanController::class, 'index'])->name('admin.kelolakaryawan');
    Route::get('/admin/kelolaabsensi', [KelolaAbsensiController::class, 'index'])->name('admin.kelolaabsensi');
    Route::get('/admin/kelolainvestor', [KelolaDataInvestorController::class, 'index'])->name('admin.kelolainvestor');
    Route::get('/admin/buatlaporan', [BuatLaporanController::class, 'index'])->name('admin.buatlaporan');

    // Fitur Profile bawaan Breeze 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';