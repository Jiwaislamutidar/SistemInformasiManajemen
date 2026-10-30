<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#D4AF37]"></span>
                Analisis Profit Perusahaan
            </h2>
            <div class="text-xs text-gray-500 font-medium">
                Modul Eksekutif • Dealer Mobil
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan Keuangan Profit -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan (Gross)</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 4,85 M</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Akumulasi Q3 2026</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-amber-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total HPP (Modal Unit)</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 3,50 M</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Harga Pokok Penjualan</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-red-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Biaya Operasional</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 1,03 M</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Gaji, Maintenance, dll</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Laba Bersih (Net Profit)</p>
                    <h3 class="text-lg font-extrabold text-emerald-700 mt-1">Rp 320 Jt</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Margin: 6.59%</p>
                </div>
            </div>

            <!-- Tabel Rincian Profit Per Periode -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Laporan Perbandingan Profit Periode Berjalan</h3>
                    <button class="px-3 py-1.5 bg-[#183A2A] text-white text-xs font-semibold rounded-lg hover:bg-[#10261C] transition">
                        Unduh Laporan (PDF)
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-[#10261C] text-white uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-3 rounded-l-lg">Periode Bulan</th>
                                <th class="p-3">Unit Terjual</th>
                                <th class="p-3">Pendapatan Kotor</th>
                                <th class="p-3">Total Pengeluaran</th>
                                <th class="p-3">Laba Bersih</th>
                                <th class="p-3 text-center rounded-r-lg">Status Target</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Oktober 2026</td>
                                <td class="p-3">18 Unit</td>
                                <td class="p-3">Rp 1.450.000.000</td>
                                <td class="p-3">Rp 1.130.000.000</td>
                                <td class="p-3 font-extrabold text-emerald-700">Rp 320.000.000</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold"> Tercapai</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">September 2026</td>
                                <td class="p-3">15 Unit</td>
                                <td class="p-3">Rp 1.200.000.000</td>
                                <td class="p-3">Rp 980.000.000</td>
                                <td class="p-3 font-extrabold text-emerald-700">Rp 220.000.000</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-amber-100 text-amber-800 rounded font-bold"> Mendekati</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>