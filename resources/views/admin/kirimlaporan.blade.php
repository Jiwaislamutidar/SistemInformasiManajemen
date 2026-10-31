<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Kirim Laporan ke Owner</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 space-y-4">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Form Pengiriman Laporan Operasional</h3>
                <form action="#" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Judul Laporan</label>
                        <input type="text" placeholder="Contoh: Laporan Rekap Penjualan & Pengeluaran Minggu IV" class="w-full rounded-xl border-gray-300 text-xs focus:ring-[#10261C] focus:border-[#10261C]">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Jenis Laporan</label>
                        <select class="w-full rounded-xl border-gray-300 text-xs focus:ring-[#10261C] focus:border-[#10261C]">
                            <option>Laporan Penjualan & Rekap Stok</option>
                            <option>Laporan Pengeluaran Operasional</option>
                            <option>Laporan Rekap Absensi & Gaji</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Catatan Tambahan untuk Owner</label>
                        <textarea rows="4" placeholder="Tuliskan catatan penting atau kendala operasional..." class="w-full rounded-xl border-gray-300 text-xs focus:ring-[#10261C] focus:border-[#10261C]"></textarea>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Lampiran File (.pdf / .xlsx)</label>
                        <input type="file" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#10261C] file:text-white hover:file:bg-[#183A2A]">
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-[#D4AF37] text-gray-950 font-bold rounded-xl hover:bg-amber-500 transition shadow-md">
                        📤 Kirim Laporan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>