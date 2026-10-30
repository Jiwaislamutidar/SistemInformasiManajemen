<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#D4AF37]"></span>
                Executive Dashboard Owner
            </h2>
            <div class="text-xs text-gray-500 font-medium">
                Periode: <span class="font-semibold text-gray-800">{{ date('F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <!-- Include Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 1. RINGKASAN KPI METRICS (Padat Data - Grid 5 Kolom) -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Penjualan</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 1,450 M</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">↑ 12% vs bulan lalu</p>
                </div>

                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Laba Bersih</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 320 Jt</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">↑ 8% dari target</p>
                </div>

                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#2F5D50] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Unit Terjual</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">18 Unit</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Target: 20 Unit</p>
                </div>

                <div class="bg-white p-4 rounded-2xl border-l-4 border-gray-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Stok Available</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">24 Unit</h3>
                    <p class="text-[10px] text-amber-600 font-semibold mt-1">4 Unit Butuh Restock</p>
                </div>

                <div class="bg-white p-4 rounded-2xl border-l-4 border-red-800 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Beban Gaji</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 85 Jt</h3>
                    <span class="inline-block px-2 py-0.5 text-[9px] bg-amber-100 text-amber-800 rounded font-bold mt-1">Menunggu Review</span>
                </div>
            </div>

            <!-- 2. GRID KONTEN UTAMA (GRAFIK KURVA & LAPORAN DIVISI) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Grafik Tren Penjualan (2 Kolom) dengan Chart.js -->
                <div class="lg:col-span-2 bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Tren Penjualan & Profit Bulanan</h3>
                        <span class="text-xs text-[#183A2A] font-semibold bg-emerald-50 px-2.5 py-1 rounded-lg">Tahun 2026</span>
                    </div>
                    <!-- Canvas Chart.js -->
                    <div class="relative h-72 w-full">
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>

                <!-- Laporan Kinerja Divisi Terbaru (1 Kolom Padat Data) -->
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                    <div class="flex items-center justify-between mb-3 border-b border-gray-100 pb-3">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Laporan Divisi</h3>
                        <a href="#" class="text-xs text-[#D4AF37] font-semibold hover:underline">Lihat Semua</a>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-[#10261C]/30 transition">
                            <div class="flex items-center justify-between text-xs font-bold text-gray-900">
                                <span>Divisi Penjualan</span>
                                <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded">Baru</span>
                            </div>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-1">Pencapaian Target Penjualan Q3 dan Proyeksi Unit SUV</p>
                            <span class="text-[10px] text-gray-400 mt-2 block">Diteruskan oleh Admin • 2 jam lalu</span>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 hover:border-[#10261C]/30 transition">
                            <div class="flex items-center justify-between text-xs font-bold text-gray-900">
                                <span>Divisi Keuangan</span>
                                <span class="px-2 py-0.5 text-[10px] bg-gray-200 text-gray-700 rounded">Dibaca</span>
                            </div>
                            <p class="text-xs text-gray-600 mt-1 line-clamp-1">Laporan Arus Kas dan Pengeluaran Operasional Bengkel</p>
                            <span class="text-[10px] text-gray-400 mt-2 block">Diteruskan oleh Admin • Kemarin</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Script Inisialisasi Chart.js Kurva Penjualan -->
    <script>
        const ctx = document.getElementById('salesTrendChart').getContext('2d');
        const salesTrendChart = new Chart(ctx, {
            type: 'line', // Membuat grafik berbentuk kurva garis
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Penjualan (Juta Rp)',
                        data: [850, 920, 1100, 1050, 1250, 1400, 1350, 1450, 1500, 1450, 1600, 1750],
                        borderColor: '#10261C', // Forest Green
                        backgroundColor: 'rgba(16, 38, 28, 0.1)',
                        borderWidth: 2.5,
                        tension: 0.35, // Membuat garis melengkung halus (kurva)
                        fill: true
                    },
                    {
                        label: 'Laba Bersih (Juta Rp)',
                        data: [180, 200, 240, 220, 270, 300, 290, 320, 340, 320, 360, 400],
                        borderColor: '#D4AF37', // Gold
                        backgroundColor: 'rgba(212, 175, 55, 0.05)',
                        borderWidth: 2.5,
                        tension: 0.35,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>