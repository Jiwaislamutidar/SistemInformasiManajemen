<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="flex items-center gap-2 text-xl font-bold leading-tight text-[#10261C]"><span class="h-3 w-3 rounded-full bg-[#D4AF37]"></span>Executive Dashboard Owner</h2>
            <div class="text-xs font-medium text-gray-500">Periode: <span class="font-semibold text-gray-800">{{ now()->translatedFormat('F Y') }}</span></div>
        </div>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-2xl border-l-4 border-[#10261C] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Penjualan</p><h3 class="mt-1 text-lg font-extrabold text-gray-900">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h3><p class="mt-1 text-[10px] font-semibold text-gray-500">Bulan berjalan</p></div>
                <div class="rounded-2xl border-l-4 border-[#D4AF37] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Laba Bersih</p><h3 class="mt-1 text-lg font-extrabold text-gray-900">Rp {{ number_format($labaBersih, 0, ',', '.') }}</h3><p class="mt-1 text-[10px] font-semibold text-gray-500">Bulan berjalan</p></div>
                <div class="rounded-2xl border-l-4 border-[#2F5D50] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Unit Terjual</p><h3 class="mt-1 text-lg font-extrabold text-gray-900">{{ number_format($unitTerjual) }} <span class="text-sm font-semibold text-gray-500">Unit</span></h3><p class="mt-1 text-[10px] text-gray-500">Bulan berjalan</p></div>
                <div class="rounded-2xl border-l-4 border-gray-700 bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Stok Available</p><h3 class="mt-1 text-lg font-extrabold text-gray-900">{{ number_format($stokAvailable) }} <span class="text-sm font-semibold text-gray-500">Unit</span></h3><p class="mt-1 text-[10px] text-gray-500">Stok siap dijual</p></div>
                <div class="rounded-2xl border-l-4 border-red-800 bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Approval Pending</p><h3 class="mt-1 text-lg font-extrabold text-gray-900">{{ number_format($pendingApprovals) }} <span class="text-sm font-semibold text-gray-500">Laporan</span></h3><p class="mt-1 text-[10px] font-semibold text-amber-600">Menunggu review owner</p></div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="rounded-2xl border border-gray-200/80 bg-white p-5 shadow-sm lg:col-span-2">
                    <div class="mb-4 flex items-center justify-between"><h3 class="text-sm font-bold uppercase tracking-wider text-gray-800">Tren Penjualan &amp; Profit Bulanan</h3><span class="rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-[#183A2A]">Tahun {{ $dashboardYear }}</span></div>
                    <div class="relative h-72 w-full"><canvas id="salesTrendChart"></canvas></div>
                </div>

                <div class="rounded-2xl border border-gray-200/80 bg-white p-5 shadow-sm">
                    <div class="mb-3 flex items-center justify-between border-b border-gray-100 pb-3"><h3 class="text-sm font-bold uppercase tracking-wider text-gray-800">Laporan Masuk</h3><a href="{{ route('owner.laporanmasuk') }}" class="text-xs font-semibold text-[#D4AF37] hover:underline">Lihat Semua</a></div>
                    <div class="space-y-3">
                        @forelse ($laporanMasuk as $report)
                            <div class="rounded-xl border border-gray-100 bg-gray-50 p-3 transition hover:border-[#10261C]/30">
                                <div class="flex items-center justify-between gap-2 text-xs font-bold text-gray-900"><span class="line-clamp-1">{{ $report->judul_laporan ?: $report->judul }}</span><span class="shrink-0 rounded bg-emerald-100 px-2 py-0.5 text-[10px] text-emerald-800">{{ $report->status === 'dikirim_ke_owner' ? 'Baru' : ucfirst($report->status) }}</span></div>
                                <p class="mt-1 line-clamp-2 text-xs text-gray-600">{{ $report->catatan ?: $report->catatan_admin ?: $report->ringkasan ?: 'Tidak ada ringkasan.' }}</p>
                                <span class="mt-2 block text-[10px] text-gray-400">{{ optional($report->tanggal_dikirim ?: $report->created_at)->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="py-8 text-center text-xs text-gray-500">Belum ada laporan masuk.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chartData = @json($chartData);
        const ctx = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: { labels: chartData.labels, datasets: [
                { label: 'Penjualan (Rp)', data: chartData.sales, borderColor: '#10261C', backgroundColor: 'rgba(16, 38, 28, 0.1)', borderWidth: 2.5, tension: 0.35, fill: true },
                { label: 'Laba Bersih (Rp)', data: chartData.profit, borderColor: '#D4AF37', backgroundColor: 'rgba(212, 175, 55, 0.05)', borderWidth: 2.5, tension: 0.35, fill: true }
            ]},
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } }, tooltip: { callbacks: { label: (context) => `${context.dataset.label}: Rp ${new Intl.NumberFormat('id-ID').format(context.parsed.y)}` } } }, scales: { y: { beginAtZero: true, ticks: { callback: value => `Rp ${new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(value)}` }, grid: { color: 'rgba(0, 0, 0, 0.05)' } }, x: { grid: { display: false } } } }
        });
    </script>
</x-app-layout>
