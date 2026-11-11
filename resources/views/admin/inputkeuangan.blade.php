<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-[#10261C]">Input Keuangan</h2>
    </x-slot>

    <div class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            @if(session('success'))
                <div class="mb-6 rounded-xl border-l-4 border-[#D4AF37] bg-white p-4 text-sm font-semibold text-[#10261C]">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-6 rounded-xl border-l-4 border-red-700 bg-white p-4 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif

            <div class="overflow-hidden rounded-2xl border border-[#d9dfda] bg-white shadow-sm" x-data="{ type: '{{ old('type', 'expense') }}', category: '{{ old('kategori') }}' }">
                <div class="bg-[#10261C] px-5 py-6 text-white sm:px-8">
                    <p class="text-xs font-semibold uppercase tracking-[.18em] text-[#D4AF37]">Dealer Mobil</p>
                    <h1 class="mt-1 text-xl font-semibold sm:text-2xl">Catat Arus Keuangan</h1>
                    <p class="mt-2 text-sm text-white/70">Pilih jenis transaksi untuk memperbarui laporan Owner.</p>
                </div>

                <div class="border-b border-[#d9dfda] p-4 sm:p-6">
                    <div class="grid grid-cols-2 rounded-xl bg-[#eef3ef] p-1" role="tablist" aria-label="Jenis transaksi">
                        <button type="button" @click="type = 'expense'" :class="type === 'expense' ? 'bg-[#10261C] text-white shadow' : 'text-[#183A2A] hover:bg-white'" class="rounded-lg px-3 py-3 text-sm font-bold transition">Catat Pengeluaran</button>
                        <button type="button" @click="type = 'income'" :class="type === 'income' ? 'bg-[#D4AF37] text-[#10261C] shadow' : 'text-[#183A2A] hover:bg-white'" class="rounded-lg px-3 py-3 text-sm font-bold transition">Catat Pendapatan</button>
                    </div>
                </div>

                <form action="{{ route('admin.keuangan.store') }}" method="POST" class="grid grid-cols-1 gap-5 p-5 sm:p-8 md:grid-cols-2">@csrf
                    <input type="hidden" name="type" :value="type">
                    <div>
                        <label for="kategori" class="mb-2 block text-sm font-semibold text-[#10261C]" x-text="type === 'expense' ? 'Kategori Pengeluaran' : 'Kategori / Sumber Pendapatan'"></label>
                        <select x-show="type === 'expense'" x-cloak id="kategori-expense" x-model="category" class="w-full rounded-lg border border-[#b9c5bd] bg-white px-4 py-3 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]/30">
                            <option value="">Pilih kategori pengeluaran</option><option>Biaya Servis / Perbaikan Unit</option><option>Biaya Detailing & Salon Mobil</option><option>Operasional Kantor & Listrik</option><option>BBM & Transportasi</option>
                        </select>
                        <select x-show="type === 'income'" x-cloak id="kategori-income" x-model="category" class="w-full rounded-lg border border-[#b9c5bd] bg-white px-4 py-3 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]/30">
                            <option value="">Pilih sumber pendapatan</option><option>Penjualan Unit Mobil</option><option>Komisi / Fee</option><option>Pendapatan Servis</option><option>Pendapatan Lainnya</option>
                        </select>
                        <input type="hidden" name="kategori" x-model="category">
                    </div>
                    <div>
                        <label for="nominal" class="mb-2 block text-sm font-semibold text-[#10261C]">Nominal (Rp)</label>
                        <input id="nominal" name="nominal" value="{{ old('nominal') }}" type="number" min="1" step="0.01" required class="w-full rounded-lg border border-[#b9c5bd] px-4 py-3 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]/30" placeholder="Contoh: 750000">
                    </div>
                    <div class="md:col-span-2">
                        <label for="keterangan" class="mb-2 block text-sm font-semibold text-[#10261C]">Keterangan / Deskripsi</label>
                        <textarea id="keterangan" name="keterangan" rows="4" class="w-full rounded-lg border border-[#b9c5bd] px-4 py-3 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]/30" placeholder="Tambahkan detail transaksi...">{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="flex flex-col gap-3 border-t border-[#d9dfda] pt-5 sm:flex-row sm:justify-end md:col-span-2"><button type="reset" class="rounded-lg border border-[#10261C] px-5 py-3 text-sm font-semibold text-[#10261C]">Reset</button><button type="submit" class="rounded-lg bg-[#D4AF37] px-5 py-3 text-sm font-semibold text-[#10261C]">Simpan Transaksi</button></div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
