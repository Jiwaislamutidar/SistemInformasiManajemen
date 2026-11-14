<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\LaporanDivisi;
use App\Models\Mobil;
use App\Models\Penjualan;
use Illuminate\View\View;

class DashboardAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalStokReady' => Mobil::where('stok', '>', 0)->sum('stok'),
            'penjualanBulanIni' => Penjualan::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
            'karyawanAktif' => Karyawan::where('status', 'aktif')->count(),
            'laporanPending' => LaporanDivisi::where('status', 'dikirim_ke_owner')->count(),
            'recentSales' => Penjualan::with('mobil')->latest()->limit(8)->get(),
            'lowStockCars' => Mobil::where('stok', '<=', 2)->orderBy('stok')->orderBy('merk_tipe')->get(),
        ]);
    }
}
