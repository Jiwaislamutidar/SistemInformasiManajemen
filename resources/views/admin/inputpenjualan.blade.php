<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#10261C]"></span>
                Input Transaksi Penjualan Unit
            </h2>
            <div class="text-xs text-gray-500 font-medium">Modul Kasir & Sales Dealer</div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen relative">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-600 text-emerald-800 rounded-xl text-xs font-semibold shadow-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden">
                <div class="px-6 py-4 bg-[#10261C] text-white flex justify-between items-center">
                    <h3 class="text-xs font-bold uppercase tracking-wider">Form Pencatatan Penjualan Mobil Bekas</h3>
                    <span class="text-[10px] bg-[#D4AF37] text-gray-950 font-bold px-2.5 py-1 rounded-lg">Showroom Lokal</span>
                </div>

                <form id="formPenjualan" action="{{ route('admin.penjualan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5 text-xs">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Unit Mobil -->
                        <div>
                            <label class="block font-bold text-gray-700 mb-1.5">Pilih Unit Kendaraan</label>
                            <select name="unit_mobil" required class="w-full rounded-xl border-gray-300 text-xs py-2.5 bg-gray-50/50 focus:ring-2 focus:ring-[#10261C] focus:border-[#10261C] transition">
                                <option value="" disabled selected>-- Pilih Unit yang Terjual --</option>
                                <option value="Toyota Avanza Veloz 1.5 AT (B 1234 ABC)">Toyota Avanza Veloz 1.5 AT — B 1234 ABC (Hitam)</option>
                                <option value="Honda HR-V SE 1.8 (B 5678 XYZ)">Honda HR-V SE 1.8 — B 5678 XYZ (Putih Mutiara)</option>
                                <option value="Suzuki Ertiga GX Hybrid (B 2468 DEF)">Suzuki Ertiga GX Hybrid — B 2468 DEF (Silver)</option>
                                <option value="Daihatsu Xenia R ADS (B 9876 GHI)">Daihatsu Xenia R ADS — B 9876 GHI (Abu-abu Metalik)</option>
                                <option value="Mitsubishi Xpander Ultimate (B 1357 JKL)">Mitsubishi Xpander Ultimate — B 1357 JKL (Merah Marun)</option>
                            </select>
                            <p class="text-[10px] text-gray-400 mt-1">Stok diambil dari data inventaris showroom aktif.</p>
                        </div>

                        <!-- Nama Pembeli -->
                        <div>
                            <label class="block font-bold text-gray-700 mb-1.5">Nama Lengkap Pembeli</label>
                            <input type="text" name="nama_pembeli" required placeholder="Contoh: H. Ahmad Fauzi" class="w-full rounded-xl border-gray-300 text-xs py-2.5 bg-gray-50/50 focus:ring-2 focus:ring-[#10261C]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Harga Kesepakatan -->
                        <div>
                            <label class="block font-bold text-gray-700 mb-1.5">Harga Kesepakatan (Rp)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 font-bold">Rp</span>
                                <input type="number" name="harga_jual" required placeholder="Contoh: 195000000" class="w-full pl-9 rounded-xl border-gray-300 text-xs py-2.5 bg-gray-50/50 focus:ring-2 focus:ring-[#10261C]">
                            </div>
                        </div>

                        <!-- Metode Pembayaran (Hanya Cash & Kredit) -->
                        <div>
                            <label class="block font-bold text-gray-700 mb-1.5">Metode Pembayaran</label>
                            <select id="metodePembayaran" name="metode_pembayaran" required class="w-full rounded-xl border-gray-300 text-xs py-2.5 bg-gray-50/50 focus:ring-2 focus:ring-[#10261C]">
                                <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                                <option value="Cash">Cash (Tunai / Transfer)</option>
                                <option value="Kredit">Kredit (Pembiayaan Leasing)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Field DP (Hidden secara default, muncul jika Kredit dipilih) -->
                    <div id="wrapperDp" class="hidden grid grid-cols-1 md:grid-cols-2 gap-5 p-4 bg-amber-50/60 rounded-2xl border border-amber-200">
                        <div>
                            <label class="block font-bold text-amber-900 mb-1.5">Jumlah DP / Uang Muka (Rp)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-amber-700 font-bold">Rp</span>
                                <input type="number" id="inputDp" name="jumlah_dp" placeholder="Contoh: 50000000" class="w-full pl-9 rounded-xl border-amber-300 text-xs py-2.5 bg-white focus:ring-2 focus:ring-[#10261C]">
                            </div>
                            <p class="text-[10px] text-amber-700 mt-1">Masukkan nominal uang muka yang disetorkan pembeli.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Sales Executive -->
                        <div>
                            <label class="block font-bold text-gray-700 mb-1.5">Sales Executive yang Menangani</label>
                            <select name="sales_executive" required class="w-full rounded-xl border-gray-300 text-xs py-2.5 bg-gray-50/50 focus:ring-2 focus:ring-[#10261C]">
                                <option value="" disabled selected>-- Pilih Nama Sales --</option>
                                <option value="Budi Santoso">Budi Santoso</option>
                                <option value="Siti Rahmawati">Siti Rahmawati</option>
                                <option value="Rian Pratama">Rian Pratama</option>
                            </select>
                        </div>

                        <!-- Upload Foto Bukti Deal -->
                        <div>
                            <label class="block font-bold text-gray-700 mb-1.5">Foto Bukti Deal / Serah Terima (Opsional)</label>
                            <input type="file" name="bukti_deal" accept="image/*" class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#10261C] file:text-white hover:file:bg-[#183A2A] cursor-pointer">
                            <p class="text-[10px] text-gray-400 mt-1">Format: JPG, PNG (Maks. 2MB).</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button type="reset" id="btnReset" class="px-4 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition">
                            Reset Form
                        </button>
                        <button type="button" id="btnSimpan" class="px-6 py-2.5 bg-[#10261C] hover:bg-[#183A2A] text-white font-bold rounded-xl transition shadow-md">
                            Simpan Transaksi Penjualan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Sukses -->
        <div id="modalSukses" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-2xl p-6 max-w-sm w-full mx-4 shadow-2xl border border-gray-100 text-center space-y-4">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-2xl font-bold">
                    ✓
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider">Transaksi Berhasil Disimpan!</h3>
                    <p class="text-xs text-gray-500 mt-1">Data penjualan unit mobil telah tercatat ke dalam sistem operasional dealer.</p>
                </div>
                <button type="button" id="btnCloseModal" class="w-full py-2.5 bg-[#10261C] text-white font-bold text-xs rounded-xl hover:bg-[#183A2A] transition">
                    OK / Lanjutkan
                </button>
            </div>
        </div>
    </div>

    <!-- Script Interaktif & Modal -->
    <script>
        const selectMetode = document.getElementById('metodePembayaran');
        const wrapperDp = document.getElementById('wrapperDp');
        const inputDp = document.getElementById('inputDp');
        const btnReset = document.getElementById('btnReset');

        // Toggle tampil/sembunyi field DP berdasarkan metode pembayaran
        selectMetode.addEventListener('change', function() {
            if (this.value === 'Kredit') {
                wrapperDp.classList.remove('hidden');
                inputDp.setAttribute('required', 'required');
            } else {
                wrapperDp.classList.add('hidden');
                inputDp.removeAttribute('required');
                inputDp.value = '';
            }
        });

        // Reset form handler
        btnReset.addEventListener('click', function() {
            wrapperDp.classList.add('hidden');
            inputDp.removeAttribute('required');
        });

        // Modal Handler
        const btnSimpan = document.getElementById('btnSimpan');
        const modalSukses = document.getElementById('modalSukses');
        const btnCloseModal = document.getElementById('btnCloseModal');
        const formPenjualan = document.getElementById('formPenjualan');

        btnSimpan.addEventListener('click', function() {
            if (formPenjualan.checkValidity()) {
                modalSukses.classList.remove('hidden');
            } else {
                formPenjualan.reportValidity();
            }
        });

        btnCloseModal.addEventListener('click', function() {
            formPenjualan.submit();
        });
    </script>
</x-app-layout>