<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#D4AF37]"></span>
                Dashboard Admin Operasional
            </h2>
            <div class="text-xs text-gray-500 font-medium">Dealer Management System</div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Unit Stok Ready</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">24 Mobil</h3>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Penjualan Bulan Ini</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">8 Unit</h3>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-emerald-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Karyawan Hadir Hari Ini</p>
                    <h3 class="text-lg font-extrabold text-emerald-700 mt-1">12 / 12</h3>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-amber-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Laporan Pending</p>
                    <h3 class="text-lg font-extrabold text-amber-700 mt-1">1 Draft</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-2">Ringkasan Operasional Dealer</h3>
                <p class="text-xs text-gray-500">Selamat datang di Panel Operasional. Gunakan menu sidebar di sebelah kiri untuk melakukan input penjualan, pencatatan pengeluaran, kelola stok mobil, hingga pengiriman laporan mingguan ke Owner.</p>
            </div>
        </div>
    </div>
</x-app-layout>