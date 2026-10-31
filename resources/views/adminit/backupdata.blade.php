<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Backup & Maintenance Database</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-2">Backup Database</h3>
                <p class="text-xs text-gray-500 mb-4">Amankan seluruh data transaksi penjualan, data karyawan, dan laporan dengan melakukan backup database secara berkala.</p>
                <button class="px-4 py-2.5 bg-[#10261C] hover:bg-[#183A2A] text-white text-xs font-semibold rounded-xl transition shadow-md">
                    📥 Download Backup Database (.SQL)
                </button>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-2">System Maintenance Mode</h3>
                <p class="text-xs text-gray-500 mb-4">Aktifkan mode pemeliharaan jika sedang melakukan update struktur database besar-besaran.</p>
                <div class="flex items-center gap-4">
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg">Status: Normal (Live)</span>
                    <button class="px-4 py-2 bg-red-800 hover:bg-red-900 text-white text-xs font-semibold rounded-xl transition">
                        Aktifkan Maintenance Mode
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>