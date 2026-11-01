<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use Illuminate\Support\Facades\Storage;

class LaporanPenjualanController extends Controller
{
    /**
     * Menampilkan halaman rekap laporan penjualan untuk Owner.
     */
    public function index()
    {
        // Mengambil semua data penjualan diurutkan dari yang terbaru
        $penjualans = Penjualan::latest()->get();

        return view('owner.laporanpenjualan', compact('penjualans'));
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        if ($penjualan->bukti_deal && Storage::disk('public')->exists($penjualan->bukti_deal)) {
            Storage::disk('public')->delete($penjualan->bukti_deal);
        }

        $penjualan->delete();

        return redirect()->route('owner.laporanpenjualan')->with('success', 'Data transaksi berhasil dihapus!');
    }
}