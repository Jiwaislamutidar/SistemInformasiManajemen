<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Buat Laporan & Ekspor Data</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">Generator Laporan PDF / Excel</h3>
                <form action="#" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-700 mb-1">Pilih Jenis Laporan</label>
                            <select class="w-full rounded-xl border-gray-300 text-xs">
                                <option>Laporan Rekap Penjualan Unit</option>
                                <option>Laporan Rincian Pengeluaran Operasional</option>
                                <option>Laporan Stok Terjual vs Ready</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 mb-1">Format Ekspor</label>
                            <select class="w-full rounded-xl border-gray-300 text-xs">
                                <option>PDF Document (.pdf)</option>
                                <option>Microsoft Excel (.xlsx)</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-700 mb-1">Dari Tanggal</label>
                            <input type="date" class="w-full rounded-xl border-gray-300 text-xs">
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 mb-1">Sampai Tanggal</label>
                            <input type="date" class="w-full rounded-xl border-gray-300 text-xs">
                        </div>
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-[#10261C] text-white font-bold rounded-xl hover:bg-[#183A2A] transition shadow-md">
                        📊 Generate & Download Laporan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>