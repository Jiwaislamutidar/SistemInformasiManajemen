<?php

namespace App\Http\Controllers\AdminIt;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Mobil;
use App\Models\Penjualan;
use App\Models\User;
use App\Http\Requests\KaryawanRequest;
use App\Services\KaryawanService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

        if ($user->is(auth()->user())) {
            $validated['role'] = $user->role;
            $validated['status'] = 'aktif';
        }

        $user->update($validated);

        return back()->with('success', "Akun {$user->nama} berhasil diperbarui.");
    }

    public function updatePassword(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'same:password_confirmation'],
            'password_confirmation' => ['required', 'string'],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.same' => 'Konfirmasi password harus sama dengan password baru.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(['password_user_id' => $user->id]);
        }
        $validated = $validator->validated();

        $user->update(['password' => Hash::make($validated['password'])]);

        if (Schema::hasTable('log_aktivitas')) {
            DB::table('log_aktivitas')->insert([
                'user_id' => auth()->id(),
                'aksi' => "Mengubah password akun {$user->nama}",
                'waktu' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', "Password akun {$user->nama} berhasil diubah.");
    }

    public function master()
    {
        return view('adminit.keloladatamaster', [
            'divisis' => Divisi::query()->withCount('karyawans')->orderBy('nama_divisi')->get(),
            'karyawans' => Karyawan::with(['divisi', 'jabatan'])->latest()->get(),
            'jabatans' => Jabatan::whereIn('nama_jabatan', Jabatan::allowedNames())->orderBy('nama_jabatan')->get(),
        ]);
    }

    public function storeKaryawan(KaryawanRequest $request, KaryawanService $service)
    {
        $service->save($request->validated());

        return back()->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function updateKaryawan(KaryawanRequest $request, Karyawan $karyawan, KaryawanService $service)
    {
        $service->save($request->validated(), $karyawan);

        return back()->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function showKaryawan(Karyawan $karyawan)
    {
        return view('admin.kelolakaryawan-detail', [
            'karyawan' => $karyawan->load(['divisi', 'jabatan', 'absensi' => fn ($query) => $query->latest('tanggal')->limit(10)]),
            'backRoute' => 'adminit.keloladatamaster',
        ]);
    }

    public function destroyKaryawan(Karyawan $karyawan, KaryawanService $service)
    {
        $service->delete($karyawan);

        return back()->with('success', 'Data karyawan berhasil dihapus.');
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
        return redirect()->route('adminit.lihatlogaktivitas');
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
            ->whereIn('users.role', ['admin_it', 'admin', 'owner'])
            ->latest('log_aktivitas.waktu')
            ->latest('log_aktivitas.id')
            ->limit(100)
            ->get();

        $deletedRecords = collect()
            ->concat(Mobil::onlyTrashed()->latest('deleted_at')->get()->map(fn (Mobil $record) => ['type' => 'mobil', 'id' => $record->getKey(), 'label' => $record->merk_tipe, 'detail' => 'Stok mobil', 'deleted_at' => $record->deleted_at]))
            ->concat(Karyawan::onlyTrashed()->latest('deleted_at')->get()->map(fn (Karyawan $record) => ['type' => 'karyawan', 'id' => $record->getKey(), 'label' => $record->nama, 'detail' => 'Karyawan', 'deleted_at' => $record->deleted_at]))
            ->concat(Penjualan::onlyTrashed()->latest('deleted_at')->get()->map(fn (Penjualan $record) => ['type' => 'penjualan', 'id' => $record->getKey(), 'label' => $record->nama_pembeli, 'detail' => 'Penjualan '.$record->unit_mobil, 'deleted_at' => $record->deleted_at]))
            ->sortByDesc('deleted_at')
            ->values();

        return view('adminit.lihatlogaktivitas', compact('logs', 'deletedRecords'));
    }

    public function restore(string $type, int $id)
    {
        $models = ['mobil' => Mobil::class, 'karyawan' => Karyawan::class, 'penjualan' => Penjualan::class];
        abort_unless(isset($models[$type]), 404);
        $record = $models[$type]::onlyTrashed()->findOrFail($id);
        $record->restore();
        $labels = ['mobil' => 'stok mobil', 'karyawan' => 'karyawan', 'penjualan' => 'penjualan'];
        \App\Services\ActivityLogger::log("Memulihkan data {$labels[$type]} #{$id} dari riwayat penghapusan");

        return back()->with('success', 'Data berhasil dipulihkan dan dikembalikan ke modul asal.');
    }
}
