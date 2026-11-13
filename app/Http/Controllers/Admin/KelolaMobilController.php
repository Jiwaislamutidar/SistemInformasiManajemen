<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;

class KelolaMobilController extends Controller
{
    public function index()
    {
        return view('admin.kelolamobil', ['mobils' => Mobil::orderBy('merk_tipe')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Mobil::create($data);
        return redirect()->route('admin.kelolamobil')->with('success', 'Unit mobil berhasil ditambahkan.');
    }

    public function update(Request $request, Mobil $mobil)
    {
        $data = $this->validated($request);
        $mobil->update($data);
        return redirect()->route('admin.kelolamobil')->with('success', 'Data unit mobil berhasil diperbarui.');
    }

    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('admin.kelolamobil')->with('success', 'Unit mobil berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'merk_tipe' => 'required|string',
            'tahun' => 'required|integer',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
        ]);
        $data['status'] = $data['stok'] > 0 ? 'Ready' : 'Habis';
        return $data;
    }
}
