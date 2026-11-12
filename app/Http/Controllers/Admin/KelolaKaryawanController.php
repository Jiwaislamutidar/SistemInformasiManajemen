<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelolaKaryawanController extends Controller
{
    public function index()
    {
        return view('admin.kelolakaryawan', [
            'karyawans' => Karyawan::with(['divisi', 'jabatan'])->latest()->get(),
            'divisis' => Divisi::orderBy('nama_divisi')->get(),
            'jabatans' => Jabatan::orderBy('nama_jabatan')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Karyawan::create($this->validated($request));

        return redirect()->route('admin.kelolakaryawan')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $karyawan->update($this->validated($request, $karyawan));

        return redirect()->route('admin.kelolakaryawan')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function show(Karyawan $karyawan)
    {
        return view('admin.kelolakaryawan-detail', ['karyawan' => $karyawan->load(['divisi', 'jabatan', 'absensi' => fn ($query) => $query->latest('tanggal')->limit(10)])]);
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('admin.kelolakaryawan')->with('success', 'Data karyawan berhasil dihapus.');
    }

    private function validated(Request $request, ?Karyawan $karyawan = null): array
    {
        return $request->validate([
            'nip' => ['nullable', 'string', 'max:50', Rule::unique('karyawan', 'nip')->ignore($karyawan)],
            'nama' => ['required', 'string', 'max:120'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'divisi_id' => ['required', 'integer', 'exists:divisi,id'],
            'jabatan_id' => ['required', 'integer', 'exists:jabatan,id'],
            'gaji_pokok' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);
    }
}
