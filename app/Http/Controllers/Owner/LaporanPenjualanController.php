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
    public function index(Request $request)
    {
        // Mengambil semua data penjualan diurutkan dari yang terbaru
        $query = Penjualan::latest();
        if ($request->filled('bulan')) {
            $query->whereBetween('created_at', [$request->bulan . '-01 00:00:00', date('Y-m-t 23:59:59', strtotime($request->bulan . '-01'))]);
        }
        $penjualans = $query->get();

        return view('owner.laporanpenjualan', [
            'penjualans' => $penjualans,
            'totalTransaksi' => $penjualans->count(),
            'totalOmzet' => $penjualans->sum('harga_jual'),
            'rataHarga' => $penjualans->count() ? $penjualans->avg('harga_jual') : 0,
        ]);
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
