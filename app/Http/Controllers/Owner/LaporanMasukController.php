<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\LaporanDivisi;
use Illuminate\Support\Facades\Storage;

class LaporanMasukController extends Controller
{
    public function index()
    {
        $this->ensureOwner();

        $reports = LaporanDivisi::query()->latest('created_at')->latest('id')->get();

        return view('owner.laporanmasuk', compact('reports'));
    }

    public function download(LaporanDivisi $laporan)
    {
        $this->ensureOwner();
        $filePath = $laporan->file_path ?: $laporan->lampiran;

        abort_unless($filePath && Storage::disk('public')->exists($filePath), 404);

        return Storage::disk('public')->download($filePath, basename($filePath));
    }

    private function ensureOwner(): void
    {
        abort_unless(auth()->user()?->role === 'owner', 403);
    }
}
