<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use Illuminate\Validation\Rule;

class KelolaMobilController extends Controller
{
    public function index()
    {
        return view('admin.kelolamobil', ['mobils' => Mobil::whereIn('merk_tipe', Mobil::CHERY_MODELS)->orderBy('merk_tipe')->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Mobil::create($data);
        return redirect()->route('admin.kelolamobil')->with('success', 'Unit mobil berhasil ditambahkan.');
    }

    public function update(Request $request, Mobil $mobil)
    {
        $data = $this->validated($request, $mobil);
        $mobil->update($data);
        return redirect()->route('admin.kelolamobil')->with('success', 'Data unit mobil berhasil diperbarui.');
    }

    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('admin.kelolamobil')->with('success', 'Unit mobil berhasil dihapus.');
    }

    private function validated(Request $request, ?Mobil $mobil = null): array
    {
        $data = $request->validate([
            'merk_tipe' => ['required', 'string', Rule::in(Mobil::CHERY_MODELS)],
            'tahun' => ['required', 'integer', 'min:2000', 'max:'.(date('Y') + 1)],
            'harga_beli' => ['required', 'numeric', 'min:0'],
            'harga_jual' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);
        $data['status'] = $data['stok'] > 0 ? 'Ready' : 'Habis';
        return $data;
    }
}
