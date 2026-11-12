<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="flex items-center gap-2 text-xl font-bold text-[#10261C]"><span class="h-3 w-3 rounded-full bg-[#183A2A]"></span>Laporan Keuangan & Arus Kas</h2>
            <div class="text-xs font-medium text-gray-500">Dealer Mobil &bull; Data tersimpan</div>
        </div>
    </x-slot>

    @php($netBalance = $totalIncome - $totalExpense)
    <div class="min-h-screen bg-gray-100 py-6">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="rounded-2xl border-l-4 border-[#10261C] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Pendapatan</p><h3 class="mt-1 text-lg font-extrabold text-gray-900">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3><p class="mt-1 text-[10px] font-semibold text-emerald-600">Arus masuk</p></div>
                <div class="rounded-2xl border-l-4 border-amber-700 bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Pengeluaran</p><h3 class="mt-1 text-lg font-extrabold text-gray-900">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3><p class="mt-1 text-[10px] text-gray-500">Biaya operasional</p></div>
                <div class="rounded-2xl border-l-4 border-[#D4AF37] bg-white p-4 shadow-sm"><p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Saldo Bersih</p><h3 class="mt-1 text-lg font-extrabold {{ $netBalance >= 0 ? 'text-emerald-700' : 'text-red-700' }}">Rp {{ number_format($netBalance, 0, ',', '.') }}</h3><p class="mt-1 text-[10px] font-semibold {{ $netBalance >= 0 ? 'text-emerald-600' : 'text-red-600' }}">{{ $netBalance >= 0 ? 'Surplus' : 'Defisit' }}</p></div>
            </div>

            <section class="rounded-2xl border border-gray-200/80 bg-white p-4 shadow-sm sm:p-5">
                <div class="mb-4 border-b border-gray-100 pb-4">
                    <form id="financial-report-filter" method="GET" action="{{ route('owner.laporankeuangan') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <label class="text-xs font-semibold text-[#10261C]">Dari tanggal<input type="date" name="from_date" value="{{ request('from_date') }}" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                        <label class="text-xs font-semibold text-[#10261C]">Sampai tanggal<input type="date" name="to_date" value="{{ request('to_date') }}" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                        <label class="text-xs font-semibold text-[#10261C]">Filter cepat<select name="quick_filter" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"><option value="">Semua tanggal</option><option value="today" @selected(request('quick_filter') === 'today')>Hari Ini</option><option value="last_7_days" @selected(request('quick_filter') === 'last_7_days')>1 Minggu Terakhir</option><option value="last_30_days" @selected(request('quick_filter') === 'last_30_days')>1 Bulan Terakhir</option></select></label>
                        <label class="text-xs font-semibold text-[#10261C]">Tanggal spesifik<input type="date" name="specific_date" value="{{ request('specific_date') }}" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                    </form>
                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <button type="submit" form="financial-report-filter" class="w-full rounded-lg bg-[#10261C] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#183A2A] sm:w-auto">Terapkan</button>
                        <form method="POST" action="{{ route('owner.laporankeuangan.destroyAll') }}" onsubmit="return confirm('PERINGATAN: seluruh data pendapatan dan pengeluaran akan dihapus permanen. Data tidak dapat dipulihkan. Lanjutkan?')" class="w-full sm:w-auto">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full whitespace-nowrap rounded-lg bg-red-700 px-4 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto">Hapus Keseluruhan</button>
                        </form>
                    </div>
                </div>
                <p class="text-xs text-gray-500">Gunakan rentang tanggal, filter cepat, atau kalender tanggal spesifik untuk memperbarui ringkasan dan daftar transaksi.</p>
            </section>

            <section class="rounded-2xl border border-gray-200/80 bg-white p-4 shadow-sm sm:p-5">
                <div class="mb-4 border-b border-gray-100 pb-3"><h3 class="text-sm font-bold uppercase tracking-wider text-gray-800">Rincian Transaksi Keuangan</h3><p class="mt-1 text-xs text-gray-500">Penjualan dan pencatatan Input Keuangan tampil otomatis di sini.</p></div>
                <div class="overflow-x-auto"><table class="w-full min-w-[850px] text-left text-xs text-gray-600"><thead class="bg-[#10261C] text-[10px] uppercase tracking-wider text-white"><tr><th class="rounded-l-lg p-3">Referensi</th><th class="p-3">Tanggal</th><th class="p-3">Keterangan</th><th class="p-3">Kategori</th><th class="p-3 text-right">Jumlah (IDR)</th><th class="rounded-r-lg p-3 text-center">Aksi</th></tr></thead><tbody class="divide-y divide-gray-100">
                    @forelse($entries as $entry)
                        <tr class="hover:bg-gray-50"><td class="p-3 font-semibold text-gray-900">{{ $entry['reference'] }}</td><td class="whitespace-nowrap p-3 text-gray-500">{{ \Illuminate\Support\Carbon::parse($entry['date'])->format('d M Y') }}</td><td class="p-3 font-medium text-gray-800">{{ $entry['description'] }}</td><td class="p-3"><span class="rounded px-2 py-0.5 text-[10px] font-bold {{ $entry['type'] === 'income' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">{{ $entry['type'] === 'income' ? 'Pendapatan' : 'Pengeluaran' }}</span><span class="ml-1">{{ $entry['category'] }}</span></td><td class="whitespace-nowrap p-3 text-right font-extrabold {{ $entry['type'] === 'income' ? 'text-emerald-600' : 'text-red-600' }}">{{ $entry['type'] === 'income' ? '+' : '-' }} Rp {{ number_format($entry['amount'], 0, ',', '.') }}</td><td class="p-3 text-center"><form method="POST" action="{{ route('owner.laporankeuangan.destroy', [$entry['delete_type'], $entry['delete_id']]) }}" onsubmit="return confirm('Hapus transaksi ini?')">@csrf @method('DELETE')<button type="submit" class="font-semibold text-red-700 underline hover:text-red-900">Hapus</button></form></td></tr>
                    @empty
                        <tr><td colspan="6" class="p-8 text-center text-sm text-gray-500">Belum ada transaksi keuangan.</td></tr>
                    @endforelse
                </tbody></table></div>
            </section>
            <section class="rounded-2xl border border-gray-200/80 bg-white p-4 shadow-sm sm:p-5"><div class="mb-4 border-b border-gray-100 pb-3"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Inventori Dealer Saat Ini</h3><p class="mt-1 text-xs text-gray-500">Stok live seluruh mobil dealer untuk transparansi eksekutif.</p></div><div class="overflow-x-auto"><table class="w-full min-w-[700px] text-left text-xs text-gray-600"><thead class="bg-[#10261C] text-[10px] uppercase tracking-wider text-white"><tr><th class="p-3">Merk & Tipe</th><th class="p-3">Tahun</th><th class="p-3">Stok Aktif</th><th class="p-3">Status</th></tr></thead><tbody class="divide-y divide-gray-100">@forelse($mobils as $mobil)<tr><td class="p-3 font-semibold text-gray-900">{{ $mobil->merk_tipe }}</td><td class="p-3">{{ $mobil->tahun }}</td><td class="p-3 font-bold">{{ $mobil->stok }}</td><td class="p-3"><span class="rounded px-2 py-1 text-[10px] font-bold {{ $mobil->status === 'Ready' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">{{ $mobil->status }}</span></td></tr>@empty<tr><td colspan="4" class="p-6 text-center text-gray-500">Belum ada inventori.</td></tr>@endforelse</tbody></table></div></section>
        </div>
    </div>
</x-app-layout>
