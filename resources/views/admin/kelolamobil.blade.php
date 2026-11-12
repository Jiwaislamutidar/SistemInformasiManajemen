<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-[#10261C]">Kelola Mobil &amp; Stok Dealer</h2>
    </x-slot>

    <div x-data="carStockPage()" x-on:keydown.escape.window="closeEdit()" class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            @if (session('success'))
                <div class="rounded-xl border-l-4 border-[#D4AF37] bg-white p-4 text-sm font-semibold text-[#10261C]">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border-l-4 border-red-700 bg-white p-4 text-sm text-red-700">
                    <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <section class="rounded-2xl border border-[#d9dfda] bg-white p-5 shadow-sm sm:p-6">
                <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-[#10261C]">Tambah Unit Mobil</h3>
                <form method="POST" action="{{ route('admin.kelolamobil.store') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6">
                    @csrf
                    <input name="merk_tipe" required placeholder="Contoh: Chery Omoda 5 Z" class="rounded-lg border-[#b9c5bd] text-sm lg:col-span-2">
                    <input name="tahun" required type="number" min="2000" max="{{ date('Y') + 1 }}" placeholder="Tahun" class="rounded-lg border-[#b9c5bd] text-sm">
                    <input name="harga_beli" required type="number" min="0" step="1000" placeholder="Harga beli" class="rounded-lg border-[#b9c5bd] text-sm">
                    <input name="harga_jual" required type="number" min="0" step="1000" placeholder="Harga jual" class="rounded-lg border-[#b9c5bd] text-sm">
                    <input name="stok" required type="number" min="0" placeholder="Stok unit" class="rounded-lg border-[#b9c5bd] text-sm">
                    <button type="submit" class="rounded-lg bg-[#D4AF37] px-4 py-2 text-sm font-bold text-[#10261C] transition hover:bg-[#b99624] sm:col-span-2 lg:col-span-6 lg:justify-self-end">+ Simpan Unit</button>
                </form>
            </section>

            <section class="overflow-hidden rounded-2xl border border-[#d9dfda] bg-white shadow-sm">
                <div class="border-b border-[#d9dfda] p-5"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Daftar Stok Unit</h3></div>
                <div class="overflow-x-auto">
                    <table class="min-w-[820px] w-full text-left text-xs">
                        <thead class="bg-[#10261C] text-white"><tr>
                            <th class="p-3">Merk &amp; Tipe</th><th class="p-3">Tahun</th><th class="p-3">Harga Beli</th><th class="p-3">Harga Jual</th><th class="p-3">Stok</th><th class="p-3">Status</th><th class="p-3 text-right">Aksi</th>
                        </tr></thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($mobils as $mobil)
                                <tr class="transition hover:bg-[#f7f9f7]">
                                    <td class="p-3 font-semibold text-[#10261C]">{{ $mobil->merk_tipe }}</td><td class="p-3">{{ $mobil->tahun }}</td><td class="p-3">Rp {{ number_format($mobil->harga_beli, 0, ',', '.') }}</td><td class="p-3 font-bold text-emerald-700">Rp {{ number_format($mobil->harga_jual, 0, ',', '.') }}</td><td class="p-3 font-bold">{{ $mobil->stok }}</td>
                                    <td class="p-3"><span class="rounded px-2 py-1 font-bold {{ $mobil->status === 'Ready' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">{{ $mobil->status }}</span></td>
                                    <td class="p-3 text-right">
                                        <button type="button" x-on:click="openEdit({{ Js::from(['id' => $mobil->id, 'merk_tipe' => $mobil->merk_tipe, 'tahun' => $mobil->tahun, 'harga_beli' => $mobil->harga_beli, 'harga_jual' => $mobil->harga_jual, 'stok' => $mobil->stok, 'update_url' => route('admin.kelolamobil.update', $mobil), 'delete_url' => route('admin.kelolamobil.destroy', $mobil)]) }})" class="rounded-lg bg-[#10261C] px-3 py-2 font-semibold text-white transition hover:bg-[#183A2A]">Edit</button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="p-8 text-center text-gray-500">Belum ada data mobil.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div x-cloak x-show="isEditOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-[#07120d]/75 p-4 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="edit-modal-title">
            <div x-show="isEditOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="translate-y-4 scale-95 opacity-0" x-transition:enter-end="translate-y-0 scale-100 opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-y-0 scale-100 opacity-100" x-transition:leave-end="translate-y-4 scale-95 opacity-0" x-on:click.outside="closeEdit()" class="my-8 w-full max-w-xl rounded-2xl border border-[#D4AF37]/40 bg-white shadow-2xl">
                <div class="flex items-center justify-between border-b border-[#e5e9e5] bg-[#10261C] px-5 py-4 sm:px-6">
                    <div><p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#D4AF37]">Manajemen Stok</p><h3 id="edit-modal-title" class="mt-1 text-lg font-bold text-white">Edit Data Mobil</h3></div>
                    <button type="button" x-on:click="closeEdit()" class="rounded-full p-2 text-white transition hover:bg-white/10" aria-label="Tutup modal"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" /></svg></button>
                </div>

                <form method="POST" x-bind:action="editFormAction" class="space-y-5 p-5 sm:p-6">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="sm:col-span-2"><span class="mb-1.5 block text-sm font-semibold text-[#10261C]">Merk &amp; Tipe</span><input name="merk_tipe" x-model="editForm.merk_tipe" required class="w-full rounded-lg border-[#b9c5bd] text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                        <label><span class="mb-1.5 block text-sm font-semibold text-[#10261C]">Tahun</span><input name="tahun" x-model="editForm.tahun" required type="number" min="2000" max="{{ date('Y') + 1 }}" class="w-full rounded-lg border-[#b9c5bd] text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                        <label><span class="mb-1.5 block text-sm font-semibold text-[#10261C]">Stok</span><input name="stok" x-model="editForm.stok" required type="number" min="0" class="w-full rounded-lg border-[#b9c5bd] text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                        <label><span class="mb-1.5 block text-sm font-semibold text-[#10261C]">Harga Beli</span><input name="harga_beli" x-model="editForm.harga_beli" required type="number" min="0" step="1000" class="w-full rounded-lg border-[#b9c5bd] text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                        <label><span class="mb-1.5 block text-sm font-semibold text-[#10261C]">Harga Jual</span><input name="harga_jual" x-model="editForm.harga_jual" required type="number" min="0" step="1000" class="w-full rounded-lg border-[#b9c5bd] text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"></label>
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-[#e5e9e5] pt-5 sm:flex-row sm:items-center sm:justify-between">
                        <button type="button" x-on:click="deleteUnit()" class="w-full rounded-lg px-3 py-2 text-sm font-semibold text-red-700 transition hover:bg-red-50 sm:w-auto">Hapus Unit</button>
                        <div class="flex flex-col gap-3 sm:flex-row"><button type="button" x-on:click="closeEdit()" class="rounded-lg border border-[#b9c5bd] px-4 py-2 text-sm font-semibold text-[#10261C] transition hover:bg-gray-50">Batal</button><button type="submit" class="rounded-lg bg-[#D4AF37] px-4 py-2 text-sm font-bold text-[#10261C] transition hover:bg-[#b99624]">Simpan Perubahan</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>[x-cloak] { display: none !important; }</style>
    <script>
        function carStockPage() {
            return {
                isEditOpen: false, editFormAction: '', deleteFormAction: '',
                editForm: { merk_tipe: '', tahun: '', harga_beli: '', harga_jual: '', stok: '' },
                openEdit(car) {
                    this.editForm = { merk_tipe: car.merk_tipe, tahun: car.tahun, harga_beli: car.harga_beli, harga_jual: car.harga_jual, stok: car.stok };
                    this.editFormAction = car.update_url; this.deleteFormAction = car.delete_url; this.isEditOpen = true; document.body.classList.add('overflow-hidden');
                },
                closeEdit() { this.isEditOpen = false; document.body.classList.remove('overflow-hidden'); },
                deleteUnit() {
                    if (!confirm('Hapus unit ini?')) return;
                    const form = document.createElement('form'); form.method = 'POST'; form.action = this.deleteFormAction;
                    form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
                    document.body.appendChild(form); form.submit();
                },
            };
        }
    </script>
</x-app-layout>
