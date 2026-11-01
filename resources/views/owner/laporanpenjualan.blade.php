<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#D4AF37]"></span>
                Laporan Penjualan Kendaraan
            </h2>
            <div class="text-xs text-gray-500 font-medium">
                Modul Eksekutif • Dealer Mobil
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-600 p-4 rounded-xl text-xs text-emerald-800 font-bold shadow-xs">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Ringkasan Statistik Penjualan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#10261C] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Unit Terjual</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">{{ $penjualans->count() }} Unit</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Data Masuk Real-Time</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-[#D4AF37] shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Omzet Penjualan</p>
                    <h3 class="text-lg font-extrabold text-gray-900 mt-1">Rp {{ number_format($penjualans->sum('harga_jual'), 0, ',', '.') }}</h3>
                    <p class="text-[10px] text-emerald-600 font-semibold mt-1">Gross Revenue Dealer</p>
                </div>
                <div class="bg-white p-4 rounded-2xl border-l-4 border-emerald-700 shadow-sm">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Rata-rata Harga / Unit</p>
                    <h3 class="text-lg font-extrabold text-emerald-700 mt-1">
                        Rp {{ $penjualans->count() > 0 ? number_format($penjualans->avg('harga_jual'), 0, ',', '.') : 0 }}
                    </h3>
                    <p class="text-[10px] text-gray-500 mt-1">Segmen Menengah - Atas</p>
                </div>
            </div>

            <!-- Tabel Data Penjualan -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-200/80">
                <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Daftar Transaksi Penjualan Mobil</h3>
                    
                    <div class="flex items-center space-x-2">
                        <select class="bg-gray-50 border border-gray-300 rounded-lg px-2.5 py-1 text-xs focus:outline-none focus:border-[#183A2A]">
                            <option>Bulan Ini (Oktober 2026)</option>
                            <option>Bulan Lalu (September 2026)</option>
                        </select>
                        <button class="px-3 py-1.5 bg-[#183A2A] text-white text-xs font-semibold rounded-lg hover:bg-[#10261C] transition">
                            Export Excel
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-600">
                        <thead class="bg-[#10261C] text-white uppercase text-[10px] tracking-wider">
                            <tr>
                                <th class="p-3 rounded-l-lg">ID Transaksi</th>
                                <th class="p-3">Tanggal</th>
                                <th class="p-3">Nama Pembeli</th>
                                <th class="p-3">Unit Mobil</th>
                                <th class="p-3">Salesperson</th>
                                <th class="p-3">Metode & DP</th>
                                <th class="p-3 text-right">Harga Deal</th>
                                <th class="p-3 text-center">Bukti Deal</th>
                                <th class="p-3 text-center rounded-r-lg">Aksi Hapus</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($penjualans as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 font-semibold text-gray-900">#{{ $item->id }}</td>
                                    <td class="p-3 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="p-3 font-medium text-gray-800">{{ $item->nama_pembeli }}</td>
                                    <td class="p-3 font-medium text-gray-800">{{ $item->unit_mobil }}</td>
                                    <td class="p-3 text-gray-500">{{ $item->sales_executive }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-0.5 text-[10px] {{ $item->metode_pembayaran == 'Cash' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }} rounded font-bold">
                                            {{ $item->metode_pembayaran }}
                                        </span>
                                        @if($item->metode_pembayaran == 'Kredit' && $item->jumlah_dp > 0)
                                            <div class="text-[10px] text-gray-500 font-semibold mt-1">
                                                DP: Rp {{ number_format($item->jumlah_dp, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-3 text-right font-extrabold text-gray-900">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                    <td class="p-3 text-center">
                                        @if($item->bukti_deal)
                                            <a href="{{ asset('storage/' . $item->bukti_deal) }}" target="_blank" class="text-blue-600 underline font-bold hover:text-blue-800">Lihat Foto</a>
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route('owner.laporanpenjualan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data transaksi atas nama {{ $item->nama_pembeli }} ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-red-100 text-red-700 hover:bg-red-600 hover:text-white text-[11px] font-bold rounded transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="p-6 text-center text-gray-400 italic">
                                        Belum ada data transaksi penjualan yang tercatat dari Admin.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>