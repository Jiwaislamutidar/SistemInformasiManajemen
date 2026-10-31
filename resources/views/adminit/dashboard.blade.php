<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#D4AF37]"></span>
                Dashboard Control System & IT
            </h2>
            <div class="text-xs text-gray-500 font-medium">Modul System Control • Dealer Mobil</div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Kartu Statistik Sistem -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Akun Aktif</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">15 User</h3>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Kapasitas Database</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">42.5 MB</h3>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-emerald-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status Backup Terakhir</p>
                    <h3 class="text-lg font-extrabold text-emerald-700 mt-1">Aman (Hari Ini)</h3>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-amber-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Log Error Hari Ini</p>
                    <h3 class="text-lg font-extrabold text-amber-700 mt-1">0 Log</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200/80">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-2">Pusat Kontrol Sistem</h3>
                <p class="text-xs text-gray-500">Gunakan menu di sidebar untuk mengelola hak akses akun, data master divisi/jabatan, pemeliharaan database, hingga audit log aktivitas sistem.</p>
            </div>
        </div>
    </div>
</x-app-layout>