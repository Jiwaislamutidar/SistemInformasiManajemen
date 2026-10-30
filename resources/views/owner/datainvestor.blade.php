<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#183A2A]"></span>
                Manajemen Data Investor & Portofolio Saham
            </h2>
            <div class="text-xs text-gray-500 font-medium">
                Modul Eksekutif • Dealer Mobil
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan Statistik Investor -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Modal Disetor</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp 15.000.000.000</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Akumulasi Seluruh Investor</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Jumlah Investor Aktif</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">6 Orang / Badan</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Portofolio Saham Terdaftar</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-emerald-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Proyeksi Dividen Q3</p>
                    <h3 class="text-lg font-extrabold text-emerald-700 mt-1">Rp 1.800.000.000</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Siap Disalurkan</p>
                </div>
            </div>

            <!-- Tabel Data Investor -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Daftar Pemegang Saham & Status Modal</h3>
                    <div class="flex items-center space-x-2">
                        <select class="bg-gray-50 border border-gray-300 rounded-lg px-2.5 py-1 text-xs focus:outline-none focus:border-[#183A2A]">
                            <option>Tahun Anggaran 2026</option>
                            <option>Tahun Anggaran 2025</option>
                        </select>
                        <button class="px-3 py-1.5 bg-[#183A2A] text-white text-xs font-semibold rounded-lg hover:bg-[#10261C] transition">
                            Tambah Investor
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-[#10261C] text-white uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-3 rounded-l-lg">ID Investor</th>
                                <th class="p-3">Nama Lengkap / Instansi</th>
                                <th class="p-3">Persentase Saham</th>
                                <th class="p-3">Total Modal Disetor</th>
                                <th class="p-3">Kontak / Keterangan</th>
                                <th class="p-3 text-center rounded-r-lg">Status Kemitraan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">INV-001</td>
                                <td class="p-3 font-medium text-gray-800">H. Muhammad Jiwa I. (Owner Utama)</td>
                                <td class="p-3 font-bold text-emerald-700">55%</td>
                                <td class="p-3 font-semibold text-gray-900">Rp 8.250.000.000</td>
                                <td class="p-3 text-gray-500">jiwa@dealer.test</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Aktif (Pengelola)</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">INV-002</td>
                                <td class="p-3 font-medium text-gray-800">PT. Capital Ventura Nusantara</td>
                                <td class="p-3 font-bold text-gray-800">25%</td>
                                <td class="p-3 font-semibold text-gray-900">Rp 3.750.000.000</td>
                                <td class="p-3 text-gray-500">info@capitalnusantara.co.id</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Aktif (Pasif)</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">INV-003</td>
                                <td class="p-3 font-medium text-gray-800">Bpk. Ir. Hartono</td>
                                <td class="p-3 font-bold text-gray-800">20%</td>
                                <td class="p-3 font-semibold text-gray-900">Rp 3.000.000.000</td>
                                <td class="p-3 text-gray-500">hartono.invest@gmail.com</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Aktif (Pasif)</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>