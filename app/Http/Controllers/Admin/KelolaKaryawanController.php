<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Karyawan;
use App\Http\Requests\KaryawanRequest;
use App\Models\Jabatan;
use App\Services\KaryawanService;

class KelolaKaryawanController extends Controller
{
    public function index()
    {
        return view('admin.kelolakaryawan', [
            'karyawans' => Karyawan::query()
                ->select(['karyawan.*', 'karyawan.gaji_pokok as gaji'])
                ->with(['divisi', 'jabatan'])
                ->latest()
                ->get(),
            'divisis' => Divisi::whereIn('nama_divisi', Divisi::allowedNames())->orderBy('nama_divisi')->get(),
            'jabatans' => Jabatan::whereIn('nama_jabatan', Jabatan::allowedNames())->orderBy('nama_jabatan')->get(),
        ]);
    }

    public function store(KaryawanRequest $request, KaryawanService $service)
    {
        $service->save($request->validated());

        return redirect()->route('admin.kelolakaryawan')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function update(KaryawanRequest $request, Karyawan $karyawan, KaryawanService $service)
    {
        $service->save($request->validated(), $karyawan);

        return redirect()->route('admin.kelolakaryawan')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function show(Karyawan $karyawan)
    {
        return view('admin.kelolakaryawan-detail', ['karyawan' => $karyawan->load(['divisi', 'jabatan', 'absensi' => fn ($query) => $query->latest('tanggal')->limit(10)])]);
    }

    public function destroy(Karyawan $karyawan, KaryawanService $service)
    {
        $service->delete($karyawan);

        return redirect()->route('admin.kelolakaryawan')->with('success', 'Data karyawan berhasil dihapus.');
    }

}
