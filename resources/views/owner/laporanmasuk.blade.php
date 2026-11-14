<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#D4AF37]">Executive System</p>
                <h2 class="mt-1 text-xl font-bold leading-tight text-[#10261C]">Laporan Masuk</h2>
            </div>
            <span class="rounded-full bg-[#10261C] px-3 py-1.5 text-xs font-bold text-white">{{ $reports->count() }} laporan</span>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            <div class="rounded-2xl bg-gradient-to-r from-[#10261C] to-[#183A2A] p-6 text-white shadow-lg sm:p-8">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#D4AF37]">Laporan Operasional</p>
                <h1 class="mt-2 text-2xl font-bold sm:text-3xl">Laporan dari Tim Admin</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/70">Pantau laporan operasional yang dikirimkan oleh Admin dan unduh lampirannya untuk ditinjau.</p>
            </div>

            <section class="overflow-hidden rounded-2xl border border-[#d9dfda] bg-white shadow-sm">
                <div class="border-b border-[#d9dfda] p-5 sm:p-6"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Daftar Laporan Terkirim</h3></div>
                <div class="overflow-x-auto">
                    <table class="min-w-[850px] w-full text-left text-sm">
                        <thead class="bg-[#10261C] text-xs uppercase tracking-wider text-white"><tr><th class="px-4 py-3">Tanggal Pengiriman</th><th class="px-4 py-3">Judul Laporan</th><th class="px-4 py-3">Jenis Laporan</th><th class="px-4 py-3">Catatan dari Admin</th><th class="px-4 py-3 text-center">Aksi</th></tr></thead>
                        <tbody class="divide-y divide-[#e3e8e4]">
                            @forelse($reports as $report)
                                <tr class="align-top transition hover:bg-[#f7f9f7]"><td class="whitespace-nowrap px-4 py-4 text-gray-600">{{ optional($report->created_at)->format('d M Y, H:i') }}</td><td class="max-w-xs px-4 py-4 font-semibold text-[#10261C]">{{ $report->judul_laporan ?: $report->judul }}</td><td class="px-4 py-4"><span class="inline-flex rounded-full bg-[#eaf1ec] px-2.5 py-1 text-xs font-semibold text-[#183A2A]">{{ $report->jenis_laporan }}</span></td><td class="max-w-sm whitespace-normal px-4 py-4 leading-6 text-gray-600">{{ $report->catatan ?: $report->catatan_admin ?: '-' }}</td><td class="px-4 py-4 text-center">@if($report->file_path || $report->lampiran)<a href="{{ route('owner.laporanmasuk.download', $report) }}" class="inline-flex items-center justify-center rounded-lg bg-[#D4AF37] px-3 py-2 text-xs font-bold text-[#10261C] shadow-sm transition hover:bg-[#b99624] focus:outline-none focus:ring-2 focus:ring-[#D4AF37] focus:ring-offset-2">Unduh File</a>@else<span class="text-xs text-gray-400">Tidak tersedia</span>@endif</td></tr>
                            @empty
                                <tr><td colspan="5" class="px-4 py-12 text-center text-gray-500">Belum ada laporan yang dikirim oleh Admin.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
