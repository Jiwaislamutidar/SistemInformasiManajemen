<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#183A2A]"></span>
                Evaluasi Kinerja Divisi & Departemen
            </h2>
            <div class="text-xs text-gray-500 font-medium">
                Modul Eksekutif • Dealer Mobil
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan Metrik Kinerja Keseluruhan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Rata-Rata KPI Perusahaan</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">92.4%</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Kategori: Sangat Produktif</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Divisi Performa Tertinggi</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Divisi Sales & Marketing</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Pencapaian: 115% dari target</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-amber-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Departemen Aktif</p>
                    <h3 class="text-lg font-extrabold text-gray-800 mt-1">4 Departemen</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Terintegrasi Sistem Terpusat</p>
                </div>
            </div>

            <!-- Tabel Detail Kinerja Divisi -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Laporan Capaian Kinerja per Divisi (Bulan Ini)</h3>
                    <div class="flex items-center space-x-2">
                        <select class="bg-gray-50 border border-gray-300 rounded-lg px-2.5 py-1 text-xs focus:outline-none focus:border-[#183A2A]">
                            <option>Oktober 2026</option>
                            <option>September 2026</option>
                        </select>
                        <button class="px-3 py-1.5 bg-[#183A2A] text-white text-xs font-semibold rounded-lg hover:bg-[#10261C] transition">
                            Unduh Laporan
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-[#10261C] text-white uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-3 rounded-l-lg">Nama Divisi / Departemen</th>
                                <th class="p-3">Kepala / PIC</th>
                                <th class="p-3">Fokus Utama</th>
                                <th class="p-3">Capaian KPI</th>
                                <th class="p-3 text-center rounded-r-lg">Status Evaluasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Divisi Sales & Marketing</td>
                                <td class="p-3 text-gray-700">Bpk. Hendra (Manager)</td>
                                <td class="p-3 text-gray-500">Penjualan Unit & Pameran</td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-emerald-600 h-2 rounded-full" style="width: 95%"></div>
                                        </div>
                                        <span class="font-bold text-gray-800">95%</span>
                                    </div>
                                </td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Target Terlampaui</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Divisi After-Sales & Servis</td>
                                <td class="p-3 text-gray-700">Bpk. Agus (Supervisor)</td>
                                <td class="p-3 text-gray-500">Maintenance & Suku Cadang</td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-[#D4AF37] h-2 rounded-full" style="width: 88%"></div>
                                        </div>
                                        <span class="font-bold text-gray-800">88%</span>
                                    </div>
                                </td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-amber-100 text-amber-800 rounded font-bold">Sesuai Target</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Divisi Keuangan & Akuntansi</td>
                                <td class="p-3 text-gray-700">Ibu Siska (Chief Accountant)</td>
                                <td class="p-3 text-gray-500">Arus Kas & Rekonsiliasi</td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-emerald-600 h-2 rounded-full" style="width: 96%"></div>
                                        </div>
                                        <span class="font-bold text-gray-800">96%</span>
                                    </div>
                                </td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Sangat Baik</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Departemen IT & Support</td>
                                <td class="p-3 text-gray-700">Jiwa (Lead Dev / Admin IT)</td>
                                <td class="p-3 text-gray-500">Infrastruktur SIM & Portal</td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-emerald-600 h-2 rounded-full" style="width: 90%"></div>
                                        </div>
                                        <span class="font-bold text-gray-800">90%</span>
                                    </div>
                                </td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Stabil</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>