<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MonitoringKaryawanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->date('tanggal') ?: Carbon::today();
        $karyawans = Karyawan::with(['divisi', 'jabatan', 'absensi' => fn ($query) => $query->whereDate('tanggal', $tanggal->toDateString())])->orderBy('nama')->get();
        $statusHariIni = $karyawans->mapWithKeys(fn (Karyawan $karyawan) => [$karyawan->id => $karyawan->absensi->first()?->status]);

        return view('owner.monitoringkaryawan', [
            'karyawans' => $karyawans,
            'tanggal' => $tanggal,
            'shiftLabels' => [
                'pagi' => 'Shift Pagi (08:00 - 16:00)',
                'siang' => 'Shift Siang (13:00 - 21:00)',
                'libur' => 'Libur / Off',
            ],
            'totalKaryawan' => $karyawans->count(),
            'hadir' => $statusHariIni->filter(fn ($status) => $status === 'hadir')->count(),
            'izin' => $statusHariIni->filter(fn ($status) => in_array($status, ['izin', 'sakit'], true))->count(),
            'belumAbsen' => $statusHariIni->filter(fn ($status) => $status === null)->count(),
        ]);
    }
}
