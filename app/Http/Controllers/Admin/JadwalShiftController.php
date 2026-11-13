<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class JadwalShiftController extends Controller
{
    public const SHIFTS = [
        'pagi' => 'Shift Pagi (08:00 - 16:00)',
        'siang' => 'Shift Siang (13:00 - 21:00)',
        'libur' => 'Libur / Off',
    ];

    public function index()
    {
        return view('admin.jadwalshift', [
            'karyawans' => Karyawan::with(['divisi', 'jabatan'])->orderBy('status')->orderBy('nama')->get(),
            'shifts' => self::SHIFTS,
        ]);
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $data = $request->validate([
            'shift' => ['required', 'string', 'in:' . implode(',', array_keys(self::SHIFTS))],
        ]);

        $karyawan->update($data);

        return redirect()->route('admin.jadwalshift')->with('success', 'Jadwal shift ' . $karyawan->nama . ' berhasil diperbarui.');
    }
}
