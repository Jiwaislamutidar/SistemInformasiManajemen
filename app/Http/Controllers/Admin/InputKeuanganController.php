<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class InputKeuanganController extends Controller
{
    public function index()
    {
        return view('admin.inputkeuangan');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:expense,income'],
            'kategori' => ['required', 'string', 'max:255'],
            'nominal' => ['required', 'numeric', 'min:1'],
            'keterangan' => ['nullable', 'string', 'max:2000'],
        ]);

        Pengeluaran::create([
            ...$data,
            'tanggal' => now()->toDateString(),
        ]);

        return to_route('admin.inputkeuangan')->with('success', 'Transaksi keuangan berhasil dicatat.');
    }
}
