<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Kelola Data Investor & Mitra</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Daftar Pemodal / Investor Unit</h3>
                    <button class="px-4 py-2 bg-[#D4AF37] text-gray-950 text-xs font-bold rounded-xl hover:bg-amber-500 transition">
                        + Tambah Investor Baru
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-gray-700 uppercase font-bold border-b border-gray-200">
                            <tr>
                                <th class="p-3">Nama Investor</th>
                                <th class="p-3">Unit Mobil Investasi</th>
                                <th class="p-3">Nilai Modal (Rp)</th>
                                <th class="p-3">Bagi Hasil (%)</th>
                                <th class="p-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-600">
                            <tr>
                                <td class="p-3 font-bold text-gray-900">Ir. Ahmad Subarjo</td>
                                <td class="p-3">Toyota Avanza (B 1234 ABC)</td>
                                <td class="p-3 font-semibold">Rp 150.000.000</td>
                                <td class="p-3"><span class="px-2 py-0.5 bg-amber-100 text-amber-800 rounded font-bold">60% Investor / 40% Dealer</span></td>
                                <td class="p-3 text-center space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>