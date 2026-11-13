<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-bold text-[#10261C]">Jadwal Shift Karyawan</h2></x-slot>

    <div class="min-h-screen bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            @if(session('success'))<div class="rounded-xl border-l-4 border-[#D4AF37] bg-white p-4 text-sm font-semibold text-[#10261C]">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="rounded-xl border-l-4 border-red-700 bg-white p-4 text-sm text-red-700"><ul class="list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

            <section class="rounded-2xl border border-[#d9dfda] bg-white p-5 shadow-sm sm:p-6">
                <div class="mb-5"><p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#D4AF37]">Operasional Showroom</p><h3 class="mt-1 text-lg font-bold text-[#10261C]">Pengaturan Jadwal Shift</h3><p class="mt-1 text-sm text-gray-500">Atur jadwal kerja setiap karyawan dari data Kelola Data Karyawan.</p></div>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                    @foreach($shifts as $key => $label)
                        <div class="rounded-xl border border-[#d9dfda] bg-[#f8faf8] p-4"><p class="text-sm font-bold text-[#10261C]">{{ $label }}</p><p class="mt-1 text-xs text-gray-500">{{ $key === 'libur' ? 'Tidak dijadwalkan bekerja' : 'Jadwal operasional showroom' }}</p></div>
                    @endforeach
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl border border-[#d9dfda] bg-white shadow-sm">
                <div class="flex flex-col gap-1 border-b border-[#d9dfda] p-5 sm:flex-row sm:items-center sm:justify-between"><div><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Daftar Jadwal Karyawan</h3><p class="mt-1 text-xs text-gray-500">{{ $karyawans->count() }} karyawan tersinkron.</p></div><span class="text-xs text-gray-500">Perubahan tersimpan langsung</span></div>
                <div class="overflow-x-auto">
                    <table class="min-w-[820px] w-full text-left text-xs">
                        <thead class="bg-[#10261C] text-[10px] uppercase tracking-wider text-white"><tr><th class="p-3">Nama Karyawan</th><th class="p-3">Divisi</th><th class="p-3">Jabatan</th><th class="p-3">Status Operasional</th><th class="p-3">Jadwal Shift</th><th class="p-3 text-right">Aksi</th></tr></thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($karyawans as $karyawan)
                                <tr class="transition hover:bg-[#f7f9f7]">
                                    <td class="p-3 font-bold text-[#10261C]">{{ $karyawan->nama }}</td>
                                    <td class="p-3">{{ $karyawan->divisi?->nama_divisi ?: '-' }}</td>
                                    <td class="p-3">{{ $karyawan->jabatan?->nama_jabatan ?: '-' }}</td>
                                    <td class="p-3"><span class="rounded px-2 py-1 font-bold {{ $karyawan->status === 'aktif' ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">{{ ucfirst($karyawan->status) }}</span></td>
                                    <td class="p-3"><form id="shift-form-{{ $karyawan->id }}" method="POST" action="{{ route('admin.jadwalshift.update', $karyawan) }}">@csrf @method('PUT')<select name="shift" onchange="this.form.submit()" class="w-full rounded-lg border-[#b9c5bd] bg-white px-3 py-2 text-xs text-[#10261C] focus:border-[#D4AF37] focus:ring-[#D4AF37]/30">@foreach($shifts as $key => $label)<option value="{{ $key }}" @selected($karyawan->shift === $key)>{{ $label }}</option>@endforeach</select></form></td>
                                    <td class="p-3 text-right"><button type="submit" form="shift-form-{{ $karyawan->id }}" class="rounded-lg bg-[#D4AF37] px-3 py-2 font-bold text-[#10261C] hover:bg-[#b99624]">Simpan</button></td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="p-10 text-center text-gray-500">Belum ada data karyawan. Tambahkan karyawan melalui Kelola Data Karyawan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
