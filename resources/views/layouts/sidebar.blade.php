<aside class="w-64 bg-[#10261C] text-white flex flex-col h-screen fixed inset-y-0 left-0 z-50 shadow-xl">
    <!-- Brand / Logo Header -->
    <div class="p-5 border-b border-white/10 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#D4AF37] to-amber-600 flex items-center justify-center font-bold text-gray-950 shadow-md">
            SIM
        </div>
        <div>
            <h1 class="font-bold text-xs tracking-wider text-white">DEALER MOBIL</h1>
            <p class="text-[10px] text-amber-400 font-medium">Executive System</p>
        </div>
    </div>

    <!-- Menu Navigasi Berdasarkan Role -->
    <div class="flex-1 overflow-y-auto px-4 py-4 space-y-1 text-xs">

        <!-- ================= MENU OWNER ================= -->
        @if(Auth::user()->role === 'owner')
            <div class="text-[10px] uppercase tracking-wider text-gray-400 px-3 mb-2 font-bold">Menu Eksekutif</div>
            <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('owner.dashboard') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>📊</span> <span>Dashboard Owner</span>
            </a>
            <a href="{{ route('owner.profit') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('owner.profit') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>💰</span> <span>Profit Perusahaan</span>
            </a>
            <a href="{{ route('owner.laporankeuangan')}}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('owner.laporankeuangan') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>📈</span> <span>Laporan Keuangan</span>
            </a>
            <a href="{{ route('owner.laporanpenjualan')}}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('owner.laporanpenjualan') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>🚗</span> <span>Laporan Penjualan</span>
            </a>
            <a href="{{ route('owner.kinerjadivisi')}}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('owner.kinerjadivisi') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>📁</span> <span>Kinerja Divisi</span>
            </a>
            <a href="{{ route('owner.monitoringkaryawan')}}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('owner.monitoringkaryawan') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>👥</span> <span>Monitoring Karyawan</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white transition">
                <span>✔️</span> <span>Persetujuan Gaji</span>
            </a>
            <a href="{{ route('owner.datainvestor')}}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('owner.datainvestor') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>🤝</span> <span>Data Investor</span>
            </a>
        @endif

        <!-- ================= MENU ADMIN ================= -->
        @if(Auth::user()->role === 'admin')
            <div class="text-[10px] uppercase tracking-wider text-gray-400 px-3 mb-2 font-bold">Menu Operasional</div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>🖥️</span> <span>Dashboard Admin</span>
            </a>
            <a href="{{ route('admin.kirimlaporan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.kirimlaporan') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>📤</span> <span>Kirim Laporan ke Owner</span>
            </a>
            <a href="{{ route('admin.inputpenjualan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.inputpenjualan') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>🚗</span> <span>Input Penjualan</span>
            </a>
            <a href="{{ route('admin.inputpengeluaran') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.inputpengeluaran') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>💵</span> <span>Input Pengeluaran</span>
            </a>
            <a href="{{ route('admin.kelolamobil') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.kelolamobil') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>🚙</span> <span>Kelola Mobil & Stok</span>
            </a>
            <a href="{{ route('admin.kelolakaryawan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.kelolakaryawan') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>👥</span> <span>Kelola Data Karyawan</span>
            </a>
            <a href="{{ route('admin.kelolaabsensi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.kelolaabsensi') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>📋</span> <span>Kelola Absensi</span>
            </a>
            <a href="{{ route('admin.kelolainvestor') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.kelolainvestor') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>🤝</span> <span>Kelola Data Investor</span>
            </a>
            <a href="{{ route('admin.buatlaporan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.buatlaporan') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>📊</span> <span>Buat Laporan & Ekspor</span>
            </a>
        @endif

        <!-- ================= MENU ADMIN IT ================= -->
        @if(Auth::user()->role === 'admin_it')
            <div class="text-[10px] uppercase tracking-wider text-gray-400 px-3 mb-2 font-bold">Menu System Control</div>
            <a href="{{ route('adminit.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin-it.dashboard') ? 'bg-[#D4AF37] text-gray-950 font-bold shadow-md' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <span>⚙️</span> <span>Dashboard Admin IT</span>
            </a>
            <a href="{{ route('adminit.kelolaakun') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white transition">
                <span>👤</span> <span>Kelola Akun & Hak Akses</span>
            </a>
            <a href="{{ route('adminit.keloladatamaster')}}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white transition">
                <span>🗄️</span> <span>Data Master (Divisi/Jabatan)</span>
            </a>
            <a href="{{ route('adminit.backupdata') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white transition">
                <span>💾</span> <span>Backup & Maintenance</span>
            </a>
            <a href="{{ route('adminit.lihatlogaktivitas') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-gray-300 hover:bg-white/10 hover:text-white transition">
                <span>📜</span> <span>Log Aktivitas Sistem</span>
            </a>
        @endif

    </div>

    <!-- User Profile & Tombol Logout -->
    <div class="p-4 border-t border-white/10 bg-black/30">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 rounded-lg bg-[#2F5D50] flex items-center justify-center font-bold text-white text-xs">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <div class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</div>
                <div class="text-[10px] text-amber-300 capitalize">Role: {{ str_replace('_', ' ', Auth::user()->role) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full py-2 px-3 bg-red-900/40 hover:bg-red-800 text-red-200 text-xs rounded-xl transition text-center font-semibold border border-red-700/30">
                Log Out Sistem
            </button>
        </form>
    </div>
</aside>