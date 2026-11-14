<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-bold text-[#10261C]">Dashboard Admin IT</h2></x-slot>
    <div class="min-h-full bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8"><div class="mx-auto max-w-7xl space-y-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ([['Total Pengguna', $totalUsers, 'Akun terdaftar'], ['Pengguna Aktif', $activeUsers, 'Status aktif'], ['Tabel Aktif', $activeTables, 'Tabel database'], ['Versi PHP', $phpVersion, "Laravel {$laravelVersion}"]] as [$label, $value, $caption])
                <div class="rounded-2xl border border-gray-200 border-l-4 border-l-[#D4AF37] bg-white p-5 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">{{ $label }}</p><p class="mt-2 break-words text-xl font-extrabold text-[#10261C]">{{ $value }}</p><p class="mt-1 text-xs text-gray-500">{{ $caption }}</p></div>
            @endforeach
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Pusat Kontrol Sistem</h3><p class="mt-2 text-sm text-gray-600">Kelola akun dan hak akses, data master divisi, maintenance cache, serta audit aktivitas sistem dari menu Admin IT.</p></div>
    </div></div>
</x-app-layout>
