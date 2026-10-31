<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Kelola Absensi Karyawan</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Rekap Absensi Harian</h3>
                    <input type="date" class="rounded-xl border-gray-300 text-xs">
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 uppercase font-bold border-b border-gray-200">
                            <tr>
                                <th class="p-3">Nama Karyawan</th>
                                <th class="p-3">Jabatan</th>
                                <th class="p-3">Jam Masuk</th>
                                <th class="p-3">Jam Keluar</th>
                                <th class="p-3">Status Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            <tr>
                                <td class="p-3 font-bold text-gray-900">Budi Santoso</td>
                                <td class="p-3">Sales Executive</td>
                                <td class="p-3 text-emerald-700 font-semibold">07:55 WIB</td>
                                <td class="p-3">17:02 WIB</td>
                                <td class="p-3"><span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded font-bold">Hadir Tepat Waktu</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>