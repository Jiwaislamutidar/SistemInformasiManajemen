<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Kelola Data Karyawan</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Data Karyawan Dealer</h3>
                    <button class="px-4 py-2 bg-[#10261C] text-white text-xs font-semibold rounded-xl hover:bg-[#183A2A] transition">
                        + Tambah Karyawan
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 uppercase font-bold border-b border-gray-200">
                            <tr>
                                <th class="p-3">NIP</th>
                                <th class="p-3">Nama Lengkap</th>
                                <th class="p-3">Divisi</th>
                                <th class="p-3">Jabatan</th>
                                <th class="p-3">Telepon</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            <tr>
                                <td class="p-3 font-semibold text-gray-900">EMP-001</td>
                                <td class="p-3 font-bold text-gray-900">Budi Santoso</td>
                                <td class="p-3">Penjualan & Marketing</td>
                                <td class="p-3">Sales Executive</td>
                                <td class="p-3">081234567890</td>
                                <td class="p-3 text-center space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                    <button class="text-red-600 hover:underline">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>