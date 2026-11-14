<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\LaporanDivisi;
use App\Models\Mobil;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardOwnerController extends Controller
{
    public function index(): View
    {
        $now = now();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();
        $salesThisYear = Penjualan::query()->with('mobil:id,harga_beli')
            ->whereBetween('created_at', [$now->copy()->startOfYear(), $now->copy()->endOfYear()])->get();
        $financialThisYear = Pengeluaran::query()
            ->whereBetween('tanggal', [$now->copy()->startOfYear()->toDateString(), $now->copy()->endOfYear()->toDateString()])->get();
        $salesThisMonth = $salesThisYear->filter(fn (Penjualan $sale) => $sale->created_at?->between($monthStart, $monthEnd));
        $financialThisMonth = $financialThisYear->filter(fn (Pengeluaran $entry) => $entry->tanggal?->between($monthStart, $monthEnd));

        return view('owner.dashboard', [
            'totalPenjualan' => $salesThisMonth->sum('harga_jual'),
            'labaBersih' => $this->netProfit($salesThisMonth, $financialThisMonth),
            'unitTerjual' => $salesThisMonth->count(),
            'stokAvailable' => Mobil::query()->where('stok', '>', 0)->sum('stok'),
            'pendingApprovals' => LaporanDivisi::query()->where('status', 'dikirim_ke_owner')->count(),
            'chartData' => $this->buildChartData($salesThisYear, $financialThisYear, $now->year),
            'laporanMasuk' => LaporanDivisi::query()->whereIn('status', ['dikirim_ke_owner', 'ditinjau', 'dibaca'])
                ->latest('tanggal_dikirim')->latest('created_at')->limit(5)->get(),
            'dashboardYear' => $now->year,
        ]);
    }

    private function netProfit(Collection $sales, Collection $financialEntries): float
    {
        $vehicleProfit = $sales->sum(fn (Penjualan $sale) => (float) $sale->harga_jual - (float) ($sale->mobil?->harga_beli ?? 0));
        $otherIncome = $financialEntries->where('type', 'income')->sum('nominal');
        $expenses = $financialEntries->where('type', 'expense')->sum('nominal');

        return (float) $vehicleProfit + (float) $otherIncome - (float) $expenses;
    }

    private function buildChartData(Collection $sales, Collection $financialEntries, int $year): array
    {
        $labels = collect(range(1, 12))->map(fn (int $month) => Carbon::create($year, $month, 1)->translatedFormat('M'));
        $monthlySales = $sales->groupBy(fn (Penjualan $sale) => $sale->created_at?->month);
        $monthlyFinancials = $financialEntries->groupBy(fn (Pengeluaran $entry) => $entry->tanggal?->month);

        return [
            'labels' => $labels->values(),
            'sales' => collect(range(1, 12))->map(fn (int $month) => $monthlySales->get($month, collect())->sum('harga_jual'))->values(),
            'profit' => collect(range(1, 12))->map(fn (int $month) => $this->netProfit($monthlySales->get($month, collect()), $monthlyFinancials->get($month, collect())))->values(),
        ];
    }
}
