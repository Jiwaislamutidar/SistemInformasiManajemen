<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-bold text-[#10261C]">Kelola Akun &amp; Hak Akses</h2></x-slot>
    <div class="min-h-full bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8"><div class="mx-auto max-w-7xl space-y-4">
        @include('adminit.partials.feedback')
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm"><div class="border-b border-gray-100 px-5 py-4"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Daftar Pengguna Sistem</h3></div><div class="overflow-x-auto"><table class="w-full min-w-[680px] text-left text-sm">
            <thead class="bg-[#10261C] text-xs uppercase tracking-wider text-white"><tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Email</th><th class="px-5 py-3">Role</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Aksi</th></tr></thead><tbody class="divide-y divide-gray-100">
            @forelse ($users as $user)<tr class="align-top"><td class="px-5 py-4 font-semibold text-gray-900">{{ $user->nama }}</td><td class="px-5 py-4 text-gray-600">{{ $user->email }}</td><form method="POST" action="{{ route('adminit.kelolaakun.update', $user) }}"><td class="px-5 py-4"><select name="role" class="w-36 rounded-lg border-gray-300 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]">@foreach (['owner', 'admin', 'admin_it'] as $role)<option value="{{ $role }}" @selected($user->role === $role)>{{ str_replace('_', ' ', ucfirst($role)) }}</option>@endforeach</select></td><td class="px-5 py-4"><select name="status" class="w-32 rounded-lg border-gray-300 text-sm focus:border-[#D4AF37] focus:ring-[#D4AF37]"><option value="aktif" @selected($user->status === 'aktif')>Aktif</option><option value="nonaktif" @selected($user->status === 'nonaktif')>Nonaktif</option></select></td><td class="px-5 py-4">@csrf @method('PUT')<button class="rounded-lg bg-[#D4AF37] px-3 py-2 text-xs font-bold text-gray-950 hover:bg-amber-400">Simpan</button></td></form></tr>
            @empty<tr><td colspan="5" class="px-5 py-8 text-center text-gray-500">Belum ada pengguna.</td></tr>@endforelse
            </tbody></table></div></div>
    </div></div>
</x-app-layout>
