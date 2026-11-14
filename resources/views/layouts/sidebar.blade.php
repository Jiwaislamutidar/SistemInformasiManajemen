<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" class="fixed bottom-0 left-0 top-16 z-50 flex w-64 flex-col bg-[#10261C] text-white shadow-xl transition-all duration-300 lg:translate-x-0" :style="sidebarCollapsed ? 'width: 5rem' : ''">
    <div class="flex-1 overflow-y-auto px-3 py-4 text-xs" :class="sidebarCollapsed ? 'lg:px-2' : 'lg:px-4'">
        <div class="mb-2 px-3 text-[10px] font-bold uppercase tracking-wider text-gray-400" x-show="!sidebarCollapsed">Menu Navigasi</div>
        @if(Auth::user()->role === 'owner')
            <a title="Dashboard Owner" href="{{ route('owner.dashboard') }}" class="nav-item {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}"><span>📊</span><span x-show="!sidebarCollapsed">Dashboard Owner</span></a>
            <a title="Laporan Keuangan" href="{{ route('owner.laporankeuangan') }}" class="nav-item {{ request()->routeIs('owner.laporankeuangan') ? 'active' : '' }}"><span>📈</span><span x-show="!sidebarCollapsed">Laporan Keuangan</span></a>
            <a title="Laporan Penjualan" href="{{ route('owner.laporanpenjualan') }}" class="nav-item {{ request()->routeIs('owner.laporanpenjualan') ? 'active' : '' }}"><span>🚗</span><span x-show="!sidebarCollapsed">Laporan Penjualan</span></a>
            <a title="Laporan Masuk" href="{{ route('owner.laporanmasuk') }}" class="nav-item {{ request()->routeIs('owner.laporanmasuk*') ? 'active' : '' }}"><span>↓</span><span x-show="!sidebarCollapsed">Laporan Masuk</span></a>
            <a title="Monitoring Karyawan" href="{{ route('owner.monitoringkaryawan') }}" class="nav-item {{ request()->routeIs('owner.monitoringkaryawan') ? 'active' : '' }}"><span>👥</span><span x-show="!sidebarCollapsed">Monitoring Karyawan</span></a>
        @elseif(Auth::user()->role === 'admin')
            <a title="Dashboard Admin" href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span>🖥️</span><span x-show="!sidebarCollapsed">Dashboard Admin</span></a>
            <a title="Kirim Laporan ke Owner" href="{{ route('admin.kirimlaporan') }}" class="nav-item {{ request()->routeIs('admin.kirimlaporan') ? 'active' : '' }}"><span>📤</span><span x-show="!sidebarCollapsed">Kirim Laporan ke Owner</span></a>
            <a title="Input Penjualan" href="{{ route('admin.inputpenjualan') }}" class="nav-item {{ request()->routeIs('admin.inputpenjualan') ? 'active' : '' }}"><span>🚗</span><span x-show="!sidebarCollapsed">Input Penjualan</span></a>
            <a title="Input Keuangan" href="{{ route('admin.inputkeuangan') }}" class="nav-item {{ request()->routeIs('admin.inputkeuangan') ? 'active' : '' }}"><span>💵</span><span x-show="!sidebarCollapsed">Input Keuangan</span></a>
            <a title="Kelola Mobil & Stok" href="{{ route('admin.kelolamobil') }}" class="nav-item {{ request()->routeIs('admin.kelolamobil') ? 'active' : '' }}"><span>🚙</span><span x-show="!sidebarCollapsed">Kelola Mobil &amp; Stok</span></a>
            <a title="Kelola Data Karyawan" href="{{ route('admin.kelolakaryawan') }}" class="nav-item {{ request()->routeIs('admin.kelolakaryawan*') ? 'active' : '' }}"><span>👥</span><span x-show="!sidebarCollapsed">Kelola Data Karyawan</span></a>
            <a title="Jadwal Shift Karyawan" href="{{ route('admin.jadwalshift') }}" class="nav-item {{ request()->routeIs('admin.jadwalshift') ? 'active' : '' }}"><span>📋</span><span x-show="!sidebarCollapsed">Jadwal Shift Karyawan</span></a>
        @elseif(Auth::user()->role === 'admin_it')
            <a title="Dashboard Admin IT" href="{{ route('adminit.dashboard') }}" class="nav-item {{ request()->routeIs('adminit.dashboard') ? 'active' : '' }}"><span>⚙️</span><span x-show="!sidebarCollapsed">Dashboard Admin IT</span></a>
            <a title="Kelola Akun & Hak Akses" href="{{ route('adminit.kelolaakun') }}" class="nav-item"><span>👤</span><span x-show="!sidebarCollapsed">Kelola Akun &amp; Hak Akses</span></a>
            <a title="Data Master" href="{{ route('adminit.keloladatamaster') }}" class="nav-item"><span>🗄️</span><span x-show="!sidebarCollapsed">Data Master (Divisi/Jabatan)</span></a>
            <a title="Backup & Maintenance" href="{{ route('adminit.backupdata') }}" class="nav-item"><span>💾</span><span x-show="!sidebarCollapsed">Backup &amp; Maintenance</span></a>
            <a title="Log Aktivitas Sistem" href="{{ route('adminit.lihatlogaktivitas') }}" class="nav-item"><span>📜</span><span x-show="!sidebarCollapsed">Log Aktivitas Sistem</span></a>
        @endif
    </div>
    <div class="border-t border-white/10 bg-black/30 p-4" x-show="!sidebarCollapsed">
        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full rounded-xl border border-red-700/30 bg-red-900/40 px-3 py-2 text-center text-xs font-semibold text-red-200 transition hover:bg-red-800">Log Out Sistem</button></form>
    </div>
</aside>
