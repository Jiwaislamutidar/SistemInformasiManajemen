<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">Input Pengeluaran Operasional</h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                <form action="#" method="POST" class="space-y-4 text-xs">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-700 mb-1">Kategori Pengeluaran</label>
                            <select class="w-full rounded-xl border-gray-300 text-xs">
                                <option>Biaya Servis / Perbaikan Unit</option>
                                <option>Biaya Detailing & Salon Mobil</option>
                                <option>Operasional Kantor & Listrik</option>
                                <option>BBM & Transportasi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 mb-1">Nominal (Rp)</label>
                            <input type="number" placeholder="Contoh: 750000" class="w-full rounded-xl border-gray-300 text-xs">
                        </div>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700 mb-1">Keterangan / Deskripsi Pengeluaran</label>
                        <textarea rows="3" placeholder="Ganti oli & salon Avanza B 1234 ABC..." class="w-full rounded-xl border-gray-300 text-xs"></textarea>
                    </div>
                    <button type="submit" class="px-5 py-2.5 bg-[#10261C] text-white font-bold rounded-xl hover:bg-[#183A2A] transition shadow-md">
                        💵 Catat Pengeluaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>