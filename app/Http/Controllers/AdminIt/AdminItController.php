<?php

namespace App\Http\Controllers\AdminIt;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Throwable;

class AdminItController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless($request->user()?->role === 'admin_it', 403);

            return $next($request);
        });
    }

    public function dashboard()
    {
        try {
            $tableCount = count(Schema::getTables());
        } catch (Throwable) {
            $tableCount = 0;
        }

        return view('adminit.dashboard', [
            'totalUsers' => User::count(),
            'activeUsers' => User::where('status', 'aktif')->count(),
            'activeTables' => $tableCount,
            'phpVersion' => PHP_VERSION,
            'laravelVersion' => app()->version(),
        ]);
    }

    public function akun()
    {
        return view('adminit.kelolaakun', [
            'users' => User::query()->orderBy('nama')->get(),
        ]);
    }

    public function updateAkun(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in(['owner', 'admin', 'admin_it'])],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        $user->update($validated);

        return back()->with('success', "Akun {$user->nama} berhasil diperbarui.");
    }

    public function master()
    {
        return view('adminit.keloladatamaster', [
            'divisis' => Divisi::query()->withCount('karyawans')->orderBy('nama_divisi')->get(),
        ]);
    }

    public function storeDivisi(Request $request)
    {
        $validated = $request->validate([
            'nama_divisi' => ['required', 'string', 'max:255'],
            'kepala_divisi' => ['nullable', 'string', 'max:255'],
        ]);

        Divisi::create($validated);

        return back()->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function updateDivisi(Request $request, Divisi $divisi)
    {
        $validated = $request->validate([
            'nama_divisi' => ['required', 'string', 'max:255'],
            'kepala_divisi' => ['nullable', 'string', 'max:255'],
        ]);

        $divisi->update($validated);

        return back()->with('success', 'Divisi berhasil diperbarui.');
    }

    public function destroyDivisi(Divisi $divisi)
    {
        abort_if($divisi->karyawans()->exists(), 422, 'Divisi masih digunakan oleh karyawan.');
        $divisi->delete();

        return back()->with('success', 'Divisi berhasil dihapus.');
    }

    public function maintenance()
    {
        return view('adminit.backupdata');
    }

    public function clearCache()
    {
        Artisan::call('optimize:clear');

        return back()->with('success', 'Cache aplikasi berhasil dibersihkan.');
    }

    public function log()
    {
        $logs = DB::table('log_aktivitas')
            ->leftJoin('users', 'users.id', '=', 'log_aktivitas.user_id')
            ->select('log_aktivitas.id', 'log_aktivitas.aksi', 'log_aktivitas.waktu', 'users.nama', 'users.role')
            ->latest('log_aktivitas.waktu')
            ->limit(100)
            ->get();

        return view('adminit.lihatlogaktivitas', compact('logs'));
    }
}
