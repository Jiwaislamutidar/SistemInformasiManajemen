<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#183A2A]"></span>
                Laporan Keuangan & Arus Kas Eksekutif
            </h2>
            <div class="text-xs text-gray-500 font-medium">
                Modul Eksekutif • Dealer Mobil
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan Keuangan Laporan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan (Gross)</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 4,85 M</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Arus Masuk Terverifikasi</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-amber-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Biaya Operasional</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 1,22 M</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Gaji, Servis, & Maintenance</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Laba Bersih (Net Profit)</p>
                    <h3 class="text-lg font-extrabold text-emerald-700 mt-1">Rp 3,63 M</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Status: Sehat & Stabil</p>
                </div>
            </div>

            <!-- Tabel Rincian Transaksi Keuangan -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Rincian Transaksi Keuangan Masuk & Keluar</h3>
                    <div class="flex items-center space-x-2">
                        <select class="bg-gray-50 border border-gray-300 rounded-lg px-2.5 py-1 text-xs focus:outline-none focus:border-[#183A2A]">
                            <option>Bulan Ini (Oktober 2026)</option>
                            <option>Kuartal III 2026</option>
                        </select>
                        <button class="px-3 py-1.5 bg-[#183A2A] text-white text-xs font-semibold rounded-lg hover:bg-[#10261C] transition">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-[#10261C] text-white uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-3 rounded-l-lg">No. Referensi</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Keterangan / Unit Mobil</th>
                                <th class="p-3">Kategori</th>
                                <th class="p-3 text-right rounded-r-lg">Jumlah (IDR)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">TRX-2026-001</td>
                                <td class="p-3 text-gray-500">28 Okt 2026</td>
                                <td class="p-3 font-medium text-gray-800">Penjualan Unit Honda CR-V Prestige</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Pemasukan</span>
                                </td>
                                <td class="p-3 text-right font-extrabold text-emerald-600">+ Rp 580.000.000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">TRX-2026-002</td>
                                <td class="p-3 text-gray-500">26 Okt 2026</td>
                                <td class="p-3 font-medium text-gray-800">Pembelian Sparepart & Servis Showroom</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 text-[10px] bg-amber-100 text-amber-800 rounded font-bold">Pengeluaran</span>
                                </td>
                                <td class="p-3 text-right font-extrabold text-red-600">- Rp 45.000.000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">TRX-2026-003</td>
                                <td class="p-3 text-gray-500">24 Okt 2026</td>
                                <td class="p-3 font-medium text-gray-800">Penjualan Unit Toyota Alphard G-Type</td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Pemasukan</span>
                                </td>
                                <td class="p-3 text-right font-extrabold text-emerald-600">+ Rp 1.450.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>