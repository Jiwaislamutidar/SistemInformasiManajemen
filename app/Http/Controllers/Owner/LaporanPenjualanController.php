<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Mobil;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanController extends Controller
{
    /**
     * Menampilkan halaman rekap laporan penjualan untuk Owner.
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'tanggal' => ['nullable', 'date'],
            'dari' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:dari'],
            'bulan' => ['nullable', 'integer', 'between:1,12'],
        ]);

        $query = Penjualan::query()->latest();
        if (! empty($filters['tanggal'])) {
            $query->whereDate('created_at', $filters['tanggal']);
        }
        if (! empty($filters['dari'])) {
            $query->whereDate('created_at', '>=', $filters['dari']);
        }
        if (! empty($filters['sampai'])) {
            $query->whereDate('created_at', '<=', $filters['sampai']);
        }
        if (! empty($filters['bulan'])) {
            $query->whereMonth('created_at', $filters['bulan']);
        }
        $penjualans = $query->get();

        return view('owner.laporanpenjualan', [
            'penjualans' => $penjualans,
            'totalTransaksi' => $penjualans->count(),
            'totalOmzet' => $penjualans->sum('harga_jual'),
            'rataHarga' => $penjualans->count() ? $penjualans->avg('harga_jual') : 0,
            'mobils' => Mobil::orderBy('merk_tipe')->get(),
        ]);
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        if ($penjualan->bukti_deal && Storage::disk('public')->exists($penjualan->bukti_deal)) {
            Storage::disk('public')->delete($penjualan->bukti_deal);
        }

        DB::transaction(function () use ($penjualan) {
            if ($penjualan->mobil_id && ($mobil = Mobil::lockForUpdate()->find($penjualan->mobil_id))) {
                $mobil->increment('stok');
                $mobil->update(['status' => 'Ready']);
            }
            $penjualan->delete();
        });

        return redirect()->route('owner.laporanpenjualan')->with('success', 'Data transaksi berhasil dihapus!');
    }

    public function destroyAll()
    {
        DB::transaction(function () {
            Penjualan::query()->with('mobil')->get()->each(function (Penjualan $penjualan) {
                if ($penjualan->mobil) {
                    $penjualan->mobil->increment('stok');
                    $penjualan->mobil->update(['status' => 'Ready']);
                }
            });
            Penjualan::truncate();
        });

        return redirect()->route('owner.laporanpenjualan')->with('success', 'Seluruh transaksi berhasil dihapus dan nomor transaksi direset ke 1.');
    }
}
