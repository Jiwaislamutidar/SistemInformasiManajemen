<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#183A2A]"></span>
                Monitoring Kehadiran & Aktivitas Karyawan
            </h2>
            <div class="text-xs text-gray-500 font-medium">
                Modul Eksekutif • Dealer Mobil
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Ringkasan Status Karyawan -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Karyawan</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">48 Orang</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Semua Divisi Aktif</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-emerald-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Hadir Hari Ini</p>
                    <h3 class="text-lg font-extrabold text-emerald-700 mt-1">45 Orang</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Tepat Waktu</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Tugas Luar / Visit</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">2 Orang</h3>
                    <p class="text-[10px] text-amber-600 font-semibold mt-1">Kunjungan Klien / Leasing</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-red-600 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Cuti / Sakit</p>
                    <h3 class="text-lg font-extrabold text-red-600 mt-1">1 Orang</h3>
                    <p class="text-[10px] text-gray-500 mt-1">Izin Resmi Disetujui</p>
                </div>
            </div>

            <!-- Tabel Monitoring Karyawan -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Log Kehadiran & Status Real-Time Karyawan</h3>
                    <div class="flex items-center space-x-2">
                        <select class="bg-gray-50 border border-gray-300 rounded-lg px-2.5 py-1 text-xs focus:outline-none focus:border-[#183A2A]">
                            <option>Hari Ini</option>
                            <option>Kemarin</option>
                        </select>
                        <button class="px-3 py-1.5 bg-[#183A2A] text-white text-xs font-semibold rounded-lg hover:bg-[#10261C] transition">
                            Unduh Log
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-[#10261C] text-white uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-3 rounded-l-lg">Nama Karyawan</th>
                                <th class="p-3">Divisi</th>
                                <th class="p-3">Jam Masuk</th>
                                <th class="p-3">Lokasi / Sinyal Absen</th>
                                <th class="p-3">Aktivitas Terakhir</th>
                                <th class="p-3 text-center rounded-r-lg">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Hendra Saputra</td>
                                <td class="p-3 text-gray-600">Sales & Marketing</td>
                                <td class="p-3 text-gray-500">07:55 WIB</td>
                                <td class="p-3 text-gray-500">Showroom Utama (Wi-Fi Dealer)</td>
                                <td class="p-3 text-gray-500">Melayani Konsumen Test Drive</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Hadir</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Agus Setiawan</td>
                                <td class="p-3 text-gray-600">After-Sales & Servis</td>
                                <td class="p-3 text-gray-500">08:12 WIB</td>
                                <td class="p-3 text-gray-500">Bengkel Resmi Dealer</td>
                                <td class="p-3 text-gray-500">Inspeksi Berkala Unit Masuk</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Hadir</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Siska Melina</td>
                                <td class="p-3 text-gray-600">Keuangan & Akuntansi</td>
                                <td class="p-3 text-gray-500">07:45 WIB</td>
                                <td class="p-3 text-gray-500">Kantor Admin Lt. 2</td>
                                <td class="p-3 text-gray-500">Rekonsiliasi Kas Harian</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-emerald-100 text-emerald-800 rounded font-bold">Hadir</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 font-semibold text-gray-900">Budi Santoso</td>
                                <td class="p-3 text-gray-600">Sales & Marketing</td>
                                <td class="p-3 text-gray-500">-</td>
                                <td class="p-3 text-gray-500">Kantor Cabang / Luar</td>
                                <td class="p-3 text-gray-500">Kunjungan Leasing Mandiri Tbk</td>
                                <td class="p-3 text-center">
                                    <span class="px-2 py-0.5 text-[10px] bg-amber-100 text-amber-800 rounded font-bold">Tugas Luar</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>