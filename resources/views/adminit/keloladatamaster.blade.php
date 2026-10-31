<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Data Master (Divisi & Jabatan)</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tabel Divisi -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Daftar Divisi</h3>
                    <button class="px-3 py-1.5 bg-[#10261C] text-white text-xs font-semibold rounded-lg">+ Divisi</button>
                </div>
                <ul class="space-y-2 text-xs text-gray-700">
                    <li class="p-3 bg-gray-50 rounded-xl flex justify-between items-center">
                        <span class="font-semibold">Divisi Penjualan & Marketing</span>
                        <span class="text-gray-400">4 Karyawan</span>
                    </li>
                    <li class="p-3 bg-gray-50 rounded-xl flex justify-between items-center">
                        <span class="font-semibold">Divisi Keuangan & Akuntansi</span>
                        <span class="text-gray-400">3 Karyawan</span>
                    </li>
                    <li class="p-3 bg-gray-50 rounded-xl flex justify-between items-center">
                        <span class="font-semibold">Divisi Operasional & Bengkel</span>
                        <span class="text-gray-400">8 Karyawan</span>
                    </li>
                </ul>
            </div>

            <!-- Tabel Jabatan -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Daftar Jabatan</h3>
                    <button class="px-3 py-1.5 bg-[#D4AF37] text-gray-950 text-xs font-semibold rounded-lg">+ Jabatan</button>
                </div>
                <ul class="space-y-2 text-xs text-gray-700">
                    <li class="p-3 bg-gray-50 rounded-xl flex justify-between items-center">
                        <span class="font-semibold">Branch Manager / Owner</span>
                        <span class="px-2 py-0.5 bg-amber-100 text-amber-800 rounded">Eksekutif</span>
                    </li>
                    <li class="p-3 bg-gray-50 rounded-xl flex justify-between items-center">
                        <span class="font-semibold">Admin Operasional</span>
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded">Staff</span>
                    </li>
                    <li class="p-3 bg-gray-50 rounded-xl flex justify-between items-center">
                        <span class="font-semibold">Sales Executive</span>
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded">Staff</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>