<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="flex items-center gap-2 text-xl font-bold leading-tight text-gray-800"><span class="h-3 w-3 rounded-full bg-[#D4AF37]"></span>Dashboard Admin Operasional</h2>
            <div class="text-xs font-medium text-gray-500">Dealer Management System</div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#f4f6f3] py-6">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-2xl border-l-4 border-[#10261C] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Unit Stok Ready</p><h3 class="mt-1 text-2xl font-extrabold text-[#10261C]">{{ number_format($totalStokReady) }} <span class="text-sm font-semibold text-gray-500">Unit</span></h3></div>
                <div class="rounded-2xl border-l-4 border-[#D4AF37] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Penjualan Bulan Ini</p><h3 class="mt-1 text-2xl font-extrabold text-[#10261C]">{{ number_format($penjualanBulanIni) }} <span class="text-sm font-semibold text-gray-500">Transaksi</span></h3></div>
                <div class="rounded-2xl border-l-4 border-emerald-700 bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Karyawan Aktif</p><h3 class="mt-1 text-2xl font-extrabold text-emerald-700">{{ number_format($karyawanAktif) }} <span class="text-sm font-semibold text-gray-500">Orang</span></h3></div>
                <div class="rounded-2xl border-l-4 border-amber-700 bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Laporan Pending</p><h3 class="mt-1 text-2xl font-extrabold text-amber-700">{{ number_format($laporanPending) }} <span class="text-sm font-semibold text-gray-500">Laporan</span></h3></div>
            </div>

            <div class="rounded-2xl bg-[#10261C] p-5 text-white shadow-sm sm:p-6">
                <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center"><div><h3 class="text-sm font-bold uppercase tracking-wider text-[#D4AF37]">Quick Actions</h3><p class="mt-1 text-xs text-gray-300">Akses cepat ke aktivitas operasional utama.</p></div><div class="grid grid-cols-1 gap-2 sm:grid-cols-3"><a href="{{ route('admin.inputpenjualan') }}" class="rounded-lg bg-[#D4AF37] px-4 py-2.5 text-center text-sm font-bold text-[#10261C] transition hover:bg-[#e4c85a]">Input Penjualan</a><a href="{{ route('admin.kelolamobil') }}" class="rounded-lg border border-white/30 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-white/10">Kelola Stok</a><a href="{{ route('admin.kirimlaporan') }}" class="rounded-lg border border-white/30 px-4 py-2.5 text-center text-sm font-semibold text-white transition hover:bg-white/10">Kirim Laporan</a></div></div>
            </div>

            @if ($lowStockCars->isNotEmpty())
                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm"><h3 class="text-sm font-bold uppercase tracking-wider text-amber-900">Peringatan Stok Rendah</h3><div class="mt-3 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-4">@foreach ($lowStockCars as $car)<div class="flex items-center justify-between rounded-lg bg-white px-3 py-2 text-sm"><span class="font-semibold text-[#10261C]">{{ $car->merk_tipe }}</span><span class="ml-2 whitespace-nowrap font-bold {{ $car->stok === 0 ? 'text-red-600' : 'text-amber-700' }}">{{ $car->stok }} unit</span></div>@endforeach</div></div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"><div class="border-b border-gray-100 p-5 sm:p-6"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Aktivitas Penjualan Terbaru</h3></div><div class="overflow-x-auto"><table class="w-full min-w-[680px] text-left text-sm"><thead class="bg-[#183A2A] text-xs uppercase tracking-wider text-white"><tr><th class="px-5 py-3">Tanggal</th><th class="px-5 py-3">Mobil</th><th class="px-5 py-3">Pembeli</th><th class="px-5 py-3">Sales</th><th class="px-5 py-3 text-right">Harga</th></tr></thead><tbody class="divide-y divide-gray-100">@forelse ($recentSales as $sale)<tr class="transition hover:bg-[#f7f9f7]"><td class="whitespace-nowrap px-5 py-3 text-gray-500">{{ $sale->created_at?->format('d/m/Y H:i') ?? '-' }}</td><td class="px-5 py-3 font-semibold text-[#10261C]">{{ $sale->unit_mobil }}</td><td class="px-5 py-3">{{ $sale->nama_pembeli }}</td><td class="px-5 py-3">{{ $sale->sales_executive }}</td><td class="whitespace-nowrap px-5 py-3 text-right font-semibold">Rp {{ number_format($sale->harga_jual, 0, ',', '.') }}</td></tr>@empty<tr><td colspan="5" class="px-5 py-8 text-center text-gray-500">Belum ada transaksi penjualan.</td></tr>@endforelse</tbody></table></div></div>

            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Ringkasan Operasional Dealer</h3><p class="mt-2 text-xs text-gray-500">Selamat datang di Panel Operasional. Gunakan menu di sebelah kiri untuk mengelola penjualan, stok mobil, karyawan, dan laporan ke Owner.</p></div>
        </div>
    </div>
</x-app-layout>
