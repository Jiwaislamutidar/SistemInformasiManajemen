<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use App\Models\Penjualan;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        $financialEntries = Pengeluaran::query()->latest('tanggal')->latest('id')->get();
        $salesEntries = Penjualan::query()->latest()->get()->map(fn (Penjualan $sale) => [
            'reference' => 'SALE-'.$sale->id,
            'date' => $sale->created_at,
            'description' => 'Penjualan Unit '.$sale->unit_mobil.' - '.$sale->nama_pembeli,
            'category' => 'Penjualan Unit Mobil',
            'type' => 'income',
            'amount' => (float) $sale->harga_jual,
        ]);
        $manualEntries = $financialEntries->map(fn (Pengeluaran $entry) => [
            'reference' => 'FIN-'.$entry->id,
            'date' => $entry->tanggal ?? $entry->created_at,
            'description' => $entry->keterangan ?: $entry->kategori,
            'category' => $entry->kategori,
            'type' => $entry->type,
            'amount' => (float) $entry->nominal,
        ]);
        $entries = $salesEntries->concat($manualEntries)->sortByDesc('date')->values();
        $totalIncome = $entries->where('type', 'income')->sum('amount');
        $totalExpense = $entries->where('type', 'expense')->sum('amount');

        return view('owner.laporankeuangan', compact('entries', 'totalIncome', 'totalExpense'));
    }
}
