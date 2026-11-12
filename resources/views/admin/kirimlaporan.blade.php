<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Kirim Laporan ke Owner</h2>
    </x-slot>

    <div class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            @if(session('success'))<div class="rounded-xl border-l-4 border-[#D4AF37] bg-white p-4 text-sm font-semibold text-[#10261C]">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="rounded-xl border-l-4 border-red-700 bg-white p-4 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 space-y-4">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Form Pengiriman Laporan Operasional</h3>
                <form action="{{ route('admin.kirimlaporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                    @csrf
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Judul Laporan</label>
                        <input name="judul" value="{{ old('judul') }}" required type="text" placeholder="Contoh: Laporan Rekap Penjualan & Pengeluaran Minggu IV" class="w-full rounded-xl border-gray-300 text-xs focus:ring-[#10261C] focus:border-[#10261C]">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Jenis Laporan</label>
                        <input name="jenis_laporan" value="{{ old('jenis_laporan') }}" required type="text" placeholder="Contoh: Laporan Penjualan & Rekap Stok" class="w-full rounded-xl border-gray-300 text-xs focus:ring-[#10261C] focus:border-[#10261C]">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Catatan Tambahan untuk Owner</label>
                        <textarea name="catatan" rows="4" placeholder="Tuliskan catatan penting atau kendala operasional..." class="w-full rounded-xl border-gray-300 text-xs focus:ring-[#10261C] focus:border-[#10261C]">{{ old('catatan') }}</textarea>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Lampiran File (.pdf / .xlsx)</label>
                        <input name="lampiran" required type="file" accept=".pdf,.xlsx,application/pdf,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="w-full text-xs text-gray-500 file:mr-4 file:rounded-xl file:border-0 file:bg-[#10261C] file:px-4 file:py-2 file:text-xs file:font-semibold file:text-white hover:file:bg-[#183A2A]">
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-[#D4AF37] text-gray-950 font-bold rounded-xl hover:bg-amber-500 transition shadow-md">
                        📤 Kirim Laporan Sekarang
                    </button>
                </form>
            </div>
            <section class="overflow-hidden rounded-2xl border border-[#d9dfda] bg-white shadow-sm">
                <div class="border-b border-[#d9dfda] p-6"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Riwayat Laporan Terkirim</h3></div>
                <div class="overflow-x-auto"><table class="min-w-[760px] w-full text-left text-xs">
                    <thead class="bg-[#10261C] text-white"><tr><th class="p-3">Judul Laporan</th><th class="p-3">Jenis Laporan</th><th class="p-3">Catatan</th><th class="p-3">Lampiran</th></tr></thead>
                    <tbody class="divide-y divide-gray-100">@forelse($reports as $report)<tr class="hover:bg-[#f7f9f7]"><td class="p-3 font-semibold text-[#10261C]">{{ $report->judul }}</td><td class="p-3">{{ $report->jenis_laporan }}</td><td class="max-w-sm p-3">{{ $report->catatan_admin ?: '-' }}</td><td class="p-3"><a href="{{ route('admin.kirimlaporan.download', $report) }}" class="inline-flex rounded-lg bg-[#D4AF37] px-3 py-2 font-bold text-[#10261C] hover:bg-[#b99624]">Unduh</a></td></tr>@empty<tr><td colspan="4" class="p-8 text-center text-gray-500">Belum ada laporan yang dikirim.</td></tr>@endforelse</tbody>
                </table></div>
            </section>
        </div>
    </div>
</x-app-layout>
