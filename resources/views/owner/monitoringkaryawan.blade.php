<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-bold text-[#10261C]">Monitoring Karyawan</h2>
            <span class="text-xs font-medium text-gray-500">Direktori personalia tersinkron</span>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border-l-4 border-[#10261C] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Karyawan</p><h3 class="mt-1 text-2xl font-extrabold text-[#10261C]">{{ $totalKaryawan }}</h3></div>
                <div class="rounded-2xl border-l-4 border-[#D4AF37] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Divisi</p><h3 class="mt-1 text-2xl font-extrabold text-[#10261C]">{{ $totalDivisi }}</h3></div>
                <div class="rounded-2xl border-l-4 border-[#183A2A] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Jabatan</p><h3 class="mt-1 text-2xl font-extrabold text-[#10261C]">{{ $totalJabatan }}</h3></div>
            </div>

            <section class="overflow-hidden rounded-2xl border border-[#d9dfda] bg-white shadow-sm">
                <div class="border-b border-[#d9dfda] p-5"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Direktori Karyawan</h3><p class="mt-1 text-xs text-gray-500">Daftar karyawan berdasarkan divisi dan jabatan terbaru.</p></div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[720px] text-left text-xs">
                        <thead class="bg-[#10261C] text-[10px] uppercase tracking-wider text-white"><tr><th class="p-3">NIP</th><th class="p-3">Nama Karyawan</th><th class="p-3">Divisi</th><th class="p-3">Jabatan</th><th class="p-3">Telepon</th><th class="p-3">Status</th></tr></thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($karyawans as $karyawan)
                                <tr class="hover:bg-[#f7f9f7]"><td class="p-3">{{ $karyawan->nip ?: '-' }}</td><td class="p-3 font-semibold text-[#10261C]">{{ $karyawan->nama }}</td><td class="p-3">{{ $karyawan->divisi?->nama_divisi ?: '-' }}</td><td class="p-3">{{ $karyawan->jabatan?->nama_jabatan ?: '-' }}</td><td class="p-3">{{ $karyawan->telepon ?: '-' }}</td><td class="p-3"><span class="rounded px-2 py-1 font-bold {{ $karyawan->status === 'aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">{{ ucfirst($karyawan->status) }}</span></td></tr>
                            @empty
                                <tr><td colspan="6" class="p-10 text-center text-gray-500">Belum ada data karyawan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
