<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\LaporanDivisi;
use Illuminate\Support\Facades\Storage;

class KirimLaporanController extends Controller
{
    public function index()
    {
        return view('admin.kirimlaporan', ['reports' => LaporanDivisi::latest('tanggal_dikirim')->latest()->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'jenis_laporan' => ['required', 'string', 'max:120'],
            'catatan' => ['nullable', 'string', 'max:5000'],
            'lampiran' => ['required', 'file', 'mimes:pdf,xlsx', 'max:10240'],
        ]);

        $data['lampiran'] = $request->file('lampiran')->store('laporan-owner', 'public');
        LaporanDivisi::create([
            'divisi_id' => Divisi::query()->value('id'),
            'diteruskan_oleh' => $request->user()->id,
            'judul' => $data['judul'],
            'judul_laporan' => $data['judul'],
            'jenis_laporan' => $data['jenis_laporan'],
            'ringkasan' => $data['catatan'] ?: 'Laporan operasional dikirim ke Owner.',
            'catatan_admin' => $data['catatan'],
            'catatan' => $data['catatan'],
            'lampiran' => $data['lampiran'],
            'file_path' => $data['lampiran'],
            'periode' => now()->format('Y-m'),
            'status' => 'dikirim_ke_owner',
            'tanggal_dikirim' => now(),
        ]);

        return redirect()->route('admin.kirimlaporan')->with('success', 'Laporan berhasil dikirim ke Owner.');
    }

    public function download(LaporanDivisi $laporan)
    {
        abort_unless($laporan->lampiran && Storage::disk('public')->exists($laporan->lampiran), 404);
        return Storage::disk('public')->download($laporan->lampiran, basename($laporan->lampiran));
    }
}
