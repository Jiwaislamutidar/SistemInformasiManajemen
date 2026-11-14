<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-bold text-[#10261C]">Kelola Data Karyawan</h2></x-slot>

    <div x-data="employeePage()" x-on:keydown.escape.window="closeEdit()" class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            @if (session('success'))<div class="rounded-xl border-l-4 border-[#D4AF37] bg-white p-4 text-sm font-semibold text-[#10261C]">{{ session('success') }}</div>@endif
            @if ($errors->any())<div class="rounded-xl border-l-4 border-red-700 bg-white p-4 text-sm text-red-700"><ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <section class="rounded-2xl border border-[#d9dfda] bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-5"><p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#D4AF37]">Data Personalia</p><h3 class="mt-1 text-lg font-bold text-[#10261C]">Tambah Karyawan</h3></div>
                <form method="POST" action="{{ route('admin.kelolakaryawan.store') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @csrf
                    <input name="nip" value="{{ old('nip') }}" placeholder="NIP (opsional)" class="rounded-lg border-[#b9c5bd] text-sm">
                    <input name="nama" value="{{ old('nama') }}" required placeholder="Nama lengkap" class="rounded-lg border-[#b9c5bd] text-sm">
                    <input name="telepon" value="{{ old('telepon') }}" placeholder="Nomor telepon" class="rounded-lg border-[#b9c5bd] text-sm">
                    <select name="status" required class="rounded-lg border-[#b9c5bd] text-sm"><option value="aktif" @selected(old('status', 'aktif') === 'aktif')>Aktif</option><option value="nonaktif" @selected(old('status') === 'nonaktif')>Nonaktif</option></select>
                    <select name="divisi_id" required class="rounded-lg border-[#b9c5bd] text-sm"><option value="">Pilih divisi</option>@foreach($divisis as $divisi)<option value="{{ $divisi->id }}" @selected(old('divisi_id') == $divisi->id)>{{ $divisi->nama_divisi }}</option>@endforeach</select>
                    <select name="jabatan_id" required class="rounded-lg border-[#b9c5bd] text-sm"><option value="">Pilih jabatan</option>@foreach($jabatans as $jabatan)<option value="{{ $jabatan->id }}" @selected(old('jabatan_id') == $jabatan->id)>{{ $jabatan->nama_jabatan }}</option>@endforeach</select>
                    <input name="gaji_pokok" value="{{ old('gaji_pokok') }}" required type="number" min="0" step="1000" placeholder="Gaji pokok" class="rounded-lg border-[#b9c5bd] text-sm">
                    <button type="submit" class="rounded-lg bg-[#D4AF37] px-4 py-2 text-sm font-bold text-[#10261C] transition hover:bg-[#b99624]">+ Simpan Karyawan</button>
                </form>
            </section>

            <section class="overflow-hidden rounded-2xl border border-[#d9dfda] bg-white shadow-sm">
                <div class="flex flex-col gap-1 border-b border-[#d9dfda] p-5 sm:flex-row sm:items-center sm:justify-between"><div><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Data Karyawan Dealer</h3><p class="mt-1 text-xs text-gray-500">{{ $karyawans->count() }} karyawan tersimpan.</p></div></div>
                <div class="overflow-x-auto">
                    <table class="min-w-[1000px] w-full text-left text-xs">
                        <thead class="bg-[#10261C] text-white"><tr><th class="p-3">NIP</th><th class="p-3">Nama Lengkap</th><th class="p-3">Divisi</th><th class="p-3">Jabatan</th><th class="p-3">Telepon</th><th class="p-3">Gaji</th><th class="p-3">Status</th><th class="p-3 text-right">Aksi</th></tr></thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($karyawans as $karyawan)
                                <tr class="transition hover:bg-[#f7f9f7]"><td class="p-3">{{ $karyawan->nip ?: '-' }}</td><td class="p-3 font-bold text-[#10261C]">{{ $karyawan->nama }}</td><td class="p-3">{{ $karyawan->divisi?->nama_divisi ?: '-' }}</td><td class="p-3">{{ $karyawan->jabatan?->nama_jabatan ?: '-' }}</td><td class="p-3">{{ $karyawan->telepon ?: '-' }}</td><td class="p-3 whitespace-nowrap">Rp {{ number_format($karyawan->gaji ?? 0, 0, ',', '.') }}</td><td class="p-3"><span class="rounded px-2 py-1 font-bold {{ $karyawan->status === 'aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">{{ ucfirst($karyawan->status) }}</span></td><td class="p-3 text-right"><div class="flex justify-end gap-2"><a href="{{ route('admin.kelolakaryawan.show', $karyawan) }}" class="rounded-lg border border-[#b9c5bd] px-3 py-2 font-semibold text-[#10261C] hover:bg-gray-50">Detail</a><button type="button" x-on:click="openEdit({{ Js::from(['nama' => $karyawan->nama, 'nip' => $karyawan->nip, 'telepon' => $karyawan->telepon, 'divisi_id' => $karyawan->divisi_id, 'jabatan_id' => $karyawan->jabatan_id, 'gaji_pokok' => $karyawan->gaji_pokok, 'status' => $karyawan->status, 'update_url' => route('admin.kelolakaryawan.update', $karyawan)]) }})" class="rounded-lg bg-[#10261C] px-3 py-2 font-semibold text-white hover:bg-[#183A2A]">Edit</button><form method="POST" action="{{ route('admin.kelolakaryawan.destroy', $karyawan) }}" onsubmit="return confirm('Hapus data karyawan ini?')">@csrf @method('DELETE')<button type="submit" class="rounded-lg px-3 py-2 font-semibold text-red-700 hover:bg-red-50">Hapus</button></form></div></td></tr>
                            @empty
                                <tr><td colspan="8" class="p-10 text-center text-gray-500">Belum ada data karyawan. Tabel siap diisi melalui form di atas.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div x-cloak x-show="isEditOpen" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-[#07120d]/75 p-4 backdrop-blur-sm" role="dialog" aria-modal="true">
            <div x-show="isEditOpen" x-transition x-on:click.outside="closeEdit()" class="my-8 w-full max-w-2xl rounded-2xl border border-[#D4AF37]/40 bg-white shadow-2xl">
                <div class="flex items-center justify-between bg-[#10261C] px-5 py-4"><h3 class="text-lg font-bold text-white">Edit Data Karyawan</h3><button type="button" x-on:click="closeEdit()" class="rounded-full p-2 text-white hover:bg-white/10" aria-label="Tutup">✕</button></div>
                <form method="POST" x-bind:action="editFormAction" class="grid grid-cols-1 gap-4 p-5 sm:grid-cols-2 sm:p-6">@csrf @method('PUT')
                    <input name="nip" x-model="editForm.nip" placeholder="NIP (opsional)" class="rounded-lg border-[#b9c5bd] text-sm"><input name="nama" x-model="editForm.nama" required placeholder="Nama lengkap" class="rounded-lg border-[#b9c5bd] text-sm"><input name="telepon" x-model="editForm.telepon" placeholder="Nomor telepon" class="rounded-lg border-[#b9c5bd] text-sm"><select name="status" x-model="editForm.status" required class="rounded-lg border-[#b9c5bd] text-sm"><option value="aktif">Aktif</option><option value="nonaktif">Nonaktif</option></select><select name="divisi_id" x-model="editForm.divisi_id" required class="rounded-lg border-[#b9c5bd] text-sm"><option value="">Pilih divisi</option>@foreach($divisis as $divisi)<option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>@endforeach</select><select name="jabatan_id" x-model="editForm.jabatan_id" required class="rounded-lg border-[#b9c5bd] text-sm"><option value="">Pilih jabatan</option>@foreach($jabatans as $jabatan)<option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>@endforeach</select><input name="gaji_pokok" x-model="editForm.gaji_pokok" required type="number" min="0" step="1000" placeholder="Gaji pokok" class="rounded-lg border-[#b9c5bd] text-sm"><div class="flex justify-end gap-3 sm:col-span-2"><button type="button" x-on:click="closeEdit()" class="rounded-lg border border-[#b9c5bd] px-4 py-2 text-sm font-semibold text-[#10261C]">Batal</button><button type="submit" class="rounded-lg bg-[#D4AF37] px-4 py-2 text-sm font-bold text-[#10261C]">Simpan Perubahan</button></div>
                </form>
            </div>
        </div>
    </div>
    <style>[x-cloak] { display: none !important; }</style>
    <script>function employeePage(){return{isEditOpen:false,editFormAction:'',editForm:{},openEdit(employee){this.editForm={...employee};this.editFormAction=employee.update_url;this.isEditOpen=true;document.body.classList.add('overflow-hidden')},closeEdit(){this.isEditOpen=false;document.body.classList.remove('overflow-hidden')}}}</script>
</x-app-layout>
