<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Kelola Mobil & Stok Dealer</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Daftar Stok Unit Mobil</h3>
                    <button class="px-4 py-2 bg-[#10261C] text-white text-xs font-semibold rounded-xl hover:bg-[#183A2A] transition">
                        + Tambah Unit Mobil
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 uppercase font-bold border-b border-gray-200">
                            <tr>
                                <th class="p-3">No. Plat</th>
                                <th class="p-3">Merk & Tipe</th>
                                <th class="p-3">Tahun</th>
                                <th class="p-3">Harga Beli</th>
                                <th class="p-3">Harga Jual Target</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            <tr>
                                <td class="p-3 font-semibold text-gray-900">B 1234 ABC</td>
                                <td class="p-3">Toyota Avanza Veloz 1.5 AT</td>
                                <td class="p-3">2022</td>
                                <td class="p-3">Rp 185.000.000</td>
                                <td class="p-3 font-bold text-emerald-700">Rp 210.000.000</td>
                                <td class="p-3"><span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded font-bold">Ready</span></td>
                                <td class="p-3 text-center space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>