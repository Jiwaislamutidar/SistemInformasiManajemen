<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;

class MonitoringKaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::query()
            ->select(['karyawan.*', 'karyawan.gaji_pokok as gaji'])
            ->with(['divisi', 'jabatan'])
            ->orderBy('nama')
            ->get();

        return view('owner.monitoringkaryawan', [
            'karyawans' => $karyawans,
            'totalKaryawan' => $karyawans->count(),
            'totalDivisi' => Divisi::whereIn('nama_divisi', Divisi::allowedNames())->count(),
            'totalJabatan' => Jabatan::whereIn('nama_jabatan', Jabatan::allowedNames())->count(),
        ]);
    }
}
