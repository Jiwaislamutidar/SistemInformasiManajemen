<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-bold text-[#10261C]">Log Aktivitas Sistem</h2>
            <form method="POST" action="{{ route('adminit.maintenance.clear-cache') }}">
                @csrf
                <button type="submit" class="w-full rounded-xl bg-[#10261C] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#183A2A] sm:w-auto">Bersihkan Cache Aplikasi</button>
            </form>
        </div>
    </x-slot>

    <div class="min-h-full bg-[#f4f6f3] px-4 py-6 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-6">
            @include('adminit.partials.feedback')
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">100 Aktivitas Terakhir</h3></div>
                <div class="overflow-x-auto"><table class="w-full min-w-[650px] text-left text-sm">
                    <thead class="bg-[#10261C] text-xs uppercase tracking-wider text-white"><tr><th class="px-5 py-3">Waktu</th><th class="px-5 py-3">User</th><th class="px-5 py-3">Role</th><th class="px-5 py-3">Aktivitas</th></tr></thead>
                    <tbody class="divide-y divide-gray-100">@forelse ($logs as $log)<tr class="transition hover:bg-[#f7f9f7]"><td class="whitespace-nowrap px-5 py-4 text-gray-600">{{ \Carbon\Carbon::parse($log->waktu)->format('d M Y, H:i') }}</td><td class="px-5 py-4 font-semibold text-gray-900">{{ $log->nama ?? 'User terhapus' }}</td><td class="px-5 py-4 capitalize text-gray-600">{{ str_replace('_', ' ', $log->role ?? '-') }}</td><td class="px-5 py-4 text-gray-600">{{ $log->aksi }}</td></tr>@empty<tr><td colspan="4" class="px-5 py-8 text-center text-gray-500">Belum ada log aktivitas.</td></tr>@endforelse</tbody>
                </table></div>
            </section>
            <section class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4"><h3 class="text-sm font-bold uppercase tracking-wider text-[#10261C]">Riwayat Penghapusan Data &amp; Pemulihan (Trash / Deleted Records)</h3><p class="mt-1 text-xs text-gray-500">Data kritis yang dihapus tersimpan sementara dan dapat dipulihkan oleh Admin IT.</p></div>
                <div class="overflow-x-auto"><table class="w-full min-w-[720px] text-left text-sm">
                    <thead class="bg-[#183A2A] text-xs uppercase tracking-wider text-white"><tr><th class="px-5 py-3">Waktu Hapus</th><th class="px-5 py-3">Jenis Data</th><th class="px-5 py-3">Data</th><th class="px-5 py-3 text-right">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-gray-100">@forelse ($deletedRecords as $record)<tr class="transition hover:bg-[#f7f9f7]"><td class="whitespace-nowrap px-5 py-4 text-gray-600">{{ $record['deleted_at']?->format('d M Y, H:i') }}</td><td class="px-5 py-4 font-semibold text-[#10261C]">{{ $record['detail'] }}</td><td class="px-5 py-4 text-gray-600">{{ $record['label'] }} <span class="text-xs text-gray-400">(#{{ $record['id'] }})</span></td><td class="px-5 py-4 text-right"><form method="POST" action="{{ route('adminit.lihatlogaktivitas.restore', [$record['type'], $record['id']]) }}">@csrf<button type="submit" class="rounded-lg border border-[#D4AF37] px-3 py-2 text-xs font-bold text-[#10261C] transition hover:bg-[#D4AF37]">Pulihkan</button></form></td></tr>@empty<tr><td colspan="4" class="px-5 py-8 text-center text-gray-500">Belum ada data yang dapat dipulihkan.</td></tr>@endforelse</tbody>
                </table></div>
            </section>
        </div>
    </div>
</x-app-layout>
