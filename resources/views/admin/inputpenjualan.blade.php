<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-[#10261C]">Input Penjualan</h2></x-slot>
    <div class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8"><div class="mx-auto max-w-5xl">
        @if(session('success'))<div class="mb-6 border-l-4 border-[#D4AF37] bg-white p-4 text-sm font-semibold text-[#10261C]">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="mb-6 border-l-4 border-red-700 bg-white p-4 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        <div class="overflow-hidden rounded-xl border border-[#d9dfda] bg-white shadow-sm"><div class="bg-[#10261C] px-5 py-5 text-white sm:px-8"><p class="text-xs font-semibold uppercase tracking-[.18em] text-[#D4AF37]">Dealer Mobil</p><h1 class="mt-1 text-xl font-semibold sm:text-2xl">Pencatatan Transaksi</h1></div>
            <form id="formPenjualan" action="{{ route('admin.penjualan.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-5 p-5 sm:p-8 md:grid-cols-2">@csrf
                <div class="md:col-span-2"><label for="unit_mobil" class="mb-2 block text-sm font-semibold text-[#10261C]">Pilih Unit Mobil</label><select id="unit_mobil" name="mobil_id" required class="w-full rounded-lg border border-[#b9c5bd] bg-[#f8faf8] px-4 py-3 text-sm text-[#10261C] focus:border-[#D4AF37] focus:ring-[#D4AF37]/30"><option value="" data-price="">Pilih model dan varian mobil</option>@forelse($mobils as $mobil)<option value="{{ $mobil->id }}" data-price="{{ $mobil->harga_jual }}" @selected(old('mobil_id') == $mobil->id)>{{ $mobil->merk_tipe }} - Rp {{ number_format($mobil->harga_jual, 0, ',', '.') }} (Stok: {{ $mobil->stok }})</option>@empty<option value="" disabled>Stok mobil sedang kosong</option>@endforelse</select><p class="mt-2 text-xs text-gray-500">Hanya mobil dengan stok tersedia yang ditampilkan.</p></div>
                <div><label for="nama_pembeli" class="mb-2 block text-sm font-semibold text-[#10261C]">Nama Pembeli</label><input id="nama_pembeli" name="nama_pembeli" value="{{ old('nama_pembeli') }}" required class="w-full rounded-lg border border-[#b9c5bd] px-4 py-3 text-sm" placeholder="Nama lengkap pembeli"></div>
                <div><label for="harga_jual" class="mb-2 block text-sm font-semibold text-[#10261C]">Harga Kesepakatan</label><div class="flex rounded-lg border border-[#b9c5bd]"><span class="flex items-center border-r border-[#b9c5bd] bg-[#f4f6f3] px-3 text-sm font-semibold">Rp</span><input id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" type="text" inputmode="numeric" required class="w-full rounded-r-lg border-0 px-4 py-3 text-sm" placeholder="Harga dapat diedit"></div></div>
                <div><label for="metodePembayaran" class="mb-2 block text-sm font-semibold text-[#10261C]">Metode Pembayaran</label><select id="metodePembayaran" name="metode_pembayaran" required class="w-full rounded-lg border border-[#b9c5bd] bg-white px-4 py-3 text-sm"><option value="Cash">Cash</option><option value="Kredit" @selected(old('metode_pembayaran') === 'Kredit')>Kredit</option></select></div>
                <div id="wrapperDp" class="{{ old('metode_pembayaran') === 'Kredit' ? '' : 'hidden' }}"><label for="inputDp" class="mb-2 block text-sm font-semibold text-[#10261C]">Jumlah DP</label><input id="inputDp" name="jumlah_dp" value="{{ old('jumlah_dp') }}" type="number" min="0" step="1000" class="w-full rounded-lg border border-[#b9c5bd] px-4 py-3 text-sm"></div>
                <div><label for="sales_executive" class="mb-2 block text-sm font-semibold text-[#10261C]">Sales Executive</label><select id="sales_executive" name="sales_executive" required class="w-full rounded-lg border border-[#b9c5bd] bg-white px-4 py-3 text-sm"><option value="">Pilih sales aktif</option>@foreach($sales as $employee)<option value="{{ $employee->nama }}" @selected(old('sales_executive') === $employee->nama)>{{ $employee->nama }}{{ $employee->jabatan ? ' - '.$employee->jabatan->nama_jabatan : '' }}</option>@endforeach</select></div>
                <div><label for="bukti_deal" class="mb-2 block text-sm font-semibold text-[#10261C]">Bukti Deal <span class="font-normal text-gray-500">(opsional)</span></label><input id="bukti_deal" name="bukti_deal" type="file" accept="image/jpeg,image/png,image/jpg" class="w-full rounded-lg border border-[#b9c5bd] bg-white px-3 py-2.5 text-sm"></div>
                <div class="flex flex-col gap-3 border-t border-[#d9dfda] pt-5 sm:flex-row sm:justify-end md:col-span-2"><button type="reset" class="rounded-lg border border-[#10261C] px-5 py-3 text-sm font-semibold text-[#10261C]">Reset</button><button type="submit" class="rounded-lg bg-[#D4AF37] px-5 py-3 text-sm font-semibold text-[#10261C]">Simpan Transaksi</button></div>
            </form>
        </div>
        <div class="mt-6 overflow-hidden rounded-xl border border-[#d9dfda] bg-white shadow-sm">
            <div class="border-b border-[#d9dfda] p-5 sm:p-6">
                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[.18em] text-[#D4AF37]">Riwayat</p>
                        <h2 class="text-lg font-semibold text-[#10261C]">Riwayat Transaksi Penjualan</h2>
                    </div>
                    <span class="text-sm text-gray-500">{{ $penjualans->count() }} transaksi ditemukan</span>
                </div>
                <form method="GET" class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">
                    <div>
                        <label for="tanggal" class="mb-1 block text-xs font-semibold text-[#10261C]">Tanggal Spesifik</label>
                        <input id="tanggal" type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full rounded-lg border border-[#b9c5bd] px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label for="dari" class="mb-1 block text-xs font-semibold text-[#10261C]">Dari Tanggal</label>
                        <input id="dari" type="date" name="dari" value="{{ request('dari') }}" class="w-full rounded-lg border border-[#b9c5bd] px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label for="sampai" class="mb-1 block text-xs font-semibold text-[#10261C]">Sampai Tanggal</label>
                        <input id="sampai" type="date" name="sampai" value="{{ request('sampai') }}" class="w-full rounded-lg border border-[#b9c5bd] px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label for="bulan" class="mb-1 block text-xs font-semibold text-[#10261C]">Bulan</label>
                        <select id="bulan" name="bulan" class="w-full rounded-lg border border-[#b9c5bd] bg-white px-3 py-2 text-sm">
                            <option value="">Semua Bulan</option>
                            @foreach([1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'] as $number => $name)
                                <option value="{{ $number }}" @selected((string) request('bulan') === (string) $number)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 rounded-lg bg-[#10261C] px-4 py-2 text-sm font-semibold text-white">Terapkan</button>
                        <a href="{{ route('admin.inputpenjualan') }}" class="rounded-lg border border-[#10261C] px-4 py-2 text-sm font-semibold text-[#10261C]">Reset</a>
                    </div>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-[850px] w-full text-left text-sm">
                    <thead class="bg-[#10261C] text-xs uppercase tracking-wider text-white">
                        <tr><th class="px-4 py-3">Tanggal</th><th class="px-4 py-3">Pembeli</th><th class="px-4 py-3">Unit Chery</th><th class="px-4 py-3">Pembayaran</th><th class="px-4 py-3">Sales Executive</th><th class="px-4 py-3 text-right">Harga Deal</th><th class="px-4 py-3">Aksi</th></tr>
                    </thead>
                    <tbody class="divide-y divide-[#e3e8e4]">
                        @forelse($penjualans as $item)
                            <tr class="hover:bg-[#f8faf8]">
                                <td class="whitespace-nowrap px-4 py-3">{{ optional($item->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $item->nama_pembeli }}</td>
                                <td class="px-4 py-3 font-semibold text-[#10261C]">{{ $item->unit_mobil }}</td>
                                <td class="px-4 py-3">{{ $item->metode_pembayaran }}</td>
                                <td class="px-4 py-3">{{ $item->sales_executive }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-right font-semibold">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 text-gray-400">-</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada transaksi sesuai filter.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div></div>
    <script>(()=>{const u=document.getElementById('unit_mobil'),p=document.getElementById('harga_jual'),m=document.getElementById('metodePembayaran'),d=document.getElementById('wrapperDp'),i=document.getElementById('inputDp');u.addEventListener('change',()=>{p.value=u.options[u.selectedIndex].dataset.price||''});const t=()=>{const c=m.value==='Kredit';d.classList.toggle('hidden',!c);i.required=c;if(!c)i.value=''};m.addEventListener('change',t);t()})()</script>
</x-app-layout>
