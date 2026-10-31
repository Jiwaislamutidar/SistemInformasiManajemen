<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Log Aktivitas Sistem</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Riwayat Aktivitas User</h3>
                    <button class="text-xs text-red-600 hover:underline font-semibold">Bersihkan Log Lama</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 uppercase font-bold border-b border-gray-200">
                            <tr>
                                <th class="p-3">Waktu</th>
                                <th class="p-3">User</th>
                                <th class="p-3">Role</th>
                                <th class="p-3">Aktivitas / Aksi</th>
                                <th class="p-3">IP Address</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            <tr>
                                <td class="p-3">30 Okt 2026, 22:15</td>
                                <td class="p-3 font-semibold text-gray-900">H. Muhammad Jiwa I.</td>
                                <td class="p-3"><span class="px-2 py-0.5 bg-amber-100 text-amber-800 rounded font-bold">Owner</span></td>
                                <td class="p-3">Mengakses halaman Laporan Keuangan Q3</td>
                                <td class="p-3 text-gray-400">127.0.0.1</td>
                            </tr>
                            <tr>
                                <td class="p-3">30 Okt 2026, 21:40</td>
                                <td class="p-3 font-semibold text-gray-900">Admin Operasional 1</td>
                                <td class="p-3"><span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded font-bold">Admin</span></td>
                                <td class="p-3">Melakukan input penjualan unit mobil baru (Avanza)</td>
                                <td class="p-3 text-gray-400">127.0.0.1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>