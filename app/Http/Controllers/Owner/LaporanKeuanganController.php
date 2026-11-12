<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'from_date' => ['nullable', 'date'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
            'specific_date' => ['nullable', 'date'],
            'quick_filter' => ['nullable', 'in:today,last_7_days,last_30_days'],
        ]);

        [$fromDate, $toDate] = $this->resolveDateRange($validated);

        $financialQuery = Pengeluaran::query();
        $salesQuery = Penjualan::query();

        if ($fromDate && $toDate) {
            $financialQuery->whereBetween('tanggal', [$fromDate->toDateString(), $toDate->toDateString()]);
            $salesQuery->whereBetween('created_at', [$fromDate->copy()->startOfDay(), $toDate->copy()->endOfDay()]);
        }

        $financialEntries = $financialQuery->latest('tanggal')->latest('id')->get();
        $salesEntries = $salesQuery->latest()->get()->map(fn (Penjualan $sale) => [
            'reference' => 'SALE-'.$sale->id,
            'date' => $sale->created_at,
            'description' => 'Penjualan Unit '.$sale->unit_mobil.' - '.$sale->nama_pembeli,
            'category' => 'Penjualan Unit Mobil',
            'type' => 'income',
            'amount' => (float) $sale->harga_jual,
            'delete_type' => 'sale',
            'delete_id' => $sale->id,
        ]);
        $manualEntries = $financialEntries->map(fn (Pengeluaran $entry) => [
            'reference' => 'FIN-'.$entry->id,
            'date' => $entry->tanggal ?? $entry->created_at,
            'description' => $entry->keterangan ?: $entry->kategori,
            'category' => $entry->kategori,
            'type' => $entry->type,
            'amount' => (float) $entry->nominal,
            'delete_type' => 'expense',
            'delete_id' => $entry->id,
        ]);
        $entries = $salesEntries->concat($manualEntries)->sortByDesc('date')->values();
        $totalIncome = $entries->where('type', 'income')->sum('amount');
        $totalExpense = $entries->where('type', 'expense')->sum('amount');

        return view('owner.laporankeuangan', compact('entries', 'totalIncome', 'totalExpense', 'fromDate', 'toDate'))
            ->with('mobils', Mobil::orderBy('merk_tipe')->get());
    }

    public function destroy(string $type, int $id)
    {
        if ($type === 'sale') {
            $sale = Penjualan::findOrFail($id);

            if ($sale->bukti_deal && Storage::disk('public')->exists($sale->bukti_deal)) {
                Storage::disk('public')->delete($sale->bukti_deal);
            }

            DB::transaction(function () use ($sale) {
                if ($sale->mobil_id && ($mobil = Mobil::lockForUpdate()->find($sale->mobil_id))) {
                    $mobil->increment('stok');
                    $mobil->update(['status' => 'Ready']);
                }
                $sale->delete();
            });
        } elseif ($type === 'expense') {
            Pengeluaran::findOrFail($id)->delete();
        } else {
            abort(404);
        }

        return redirect()->route('owner.laporankeuangan')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function destroyAll()
    {
        DB::transaction(function () {
            Penjualan::query()->with('mobil')->get()->each(function (Penjualan $sale) {
                if ($sale->mobil) {
                    $sale->mobil->increment('stok');
                    $sale->mobil->update(['status' => 'Ready']);
                }
            });
            Penjualan::query()->delete();
            Pengeluaran::query()->delete();
        });

        return redirect()->route('owner.laporankeuangan')->with('success', 'Seluruh data laporan keuangan berhasil dihapus.');
    }

    private function resolveDateRange(array $filters): array
    {
        $fromDate = null;
        $toDate = null;

        if (! empty($filters['quick_filter'])) {
            $today = Carbon::today();
            [$fromDate, $toDate] = match ($filters['quick_filter']) {
                'today' => [$today->copy()->startOfDay(), $today->copy()->endOfDay()],
                'last_7_days' => [$today->copy()->subDays(6)->startOfDay(), $today->copy()->endOfDay()],
                'last_30_days' => [$today->copy()->subDays(29)->startOfDay(), $today->copy()->endOfDay()],
            };
        }

        if (! empty($filters['specific_date'])) {
            $specificDate = Carbon::parse($filters['specific_date']);
            $fromDate = $specificDate->copy()->startOfDay();
            $toDate = $specificDate->copy()->endOfDay();
        }

        if (! empty($filters['from_date'])) {
            $fromDate = Carbon::parse($filters['from_date'])->startOfDay();
        }

        if (! empty($filters['to_date'])) {
            $toDate = Carbon::parse($filters['to_date'])->endOfDay();
        }

        return [$fromDate, $toDate];
    }
}
