<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Mobil;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class InputPenjualanController extends Controller
{
    public function index()
    {
        return view('admin.inputpenjualan', [
            'mobils' => Mobil::where('stok', '>', 0)->orderBy('merk_tipe')->get(),
            'sales' => Karyawan::where('status', 'aktif')->orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mobil_id' => ['required', 'integer', Rule::exists('mobils', 'id')->where(fn ($query) => $query->where('stok', '>', 0))],
            'nama_pembeli' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:Cash,Kredit',
            'jumlah_dp' => 'nullable|numeric|min:0|required_if:metode_pembayaran,Kredit',
            'sales_executive' => ['required', 'string', 'max:120', Rule::exists('karyawan', 'nama')->where(fn ($query) => $query->where('status', 'aktif'))],
            'bukti_deal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        DB::transaction(function () use ($request, $data, &$path) {
            $mobil = Mobil::whereKey($data['mobil_id'])->lockForUpdate()->first();
            if (! $mobil || $mobil->stok < 1) {
                abort(422, 'Stok unit mobil sudah habis. Silakan pilih unit lain.');
            }
            if ($request->hasFile('bukti_deal')) $path = $request->file('bukti_deal')->store('bukti-deal', 'public');
            Penjualan::create([
                'mobil_id' => $mobil->id, 'unit_mobil' => $mobil->merk_tipe,
                'nama_pembeli' => $data['nama_pembeli'], 'harga_jual' => $data['harga_jual'],
                'metode_pembayaran' => $data['metode_pembayaran'],
                'jumlah_dp' => $data['metode_pembayaran'] === 'Kredit' ? ($data['jumlah_dp'] ?? null) : null,
                'sales_executive' => $data['sales_executive'], 'bukti_deal' => $path,
            ]);
            $mobil->decrement('stok');
            $mobil->update(['status' => $mobil->stok - 1 > 0 ? 'Ready' : 'Habis']);
        });

        return redirect()->route('admin.inputpenjualan')->with('success', 'Transaksi berhasil disimpan!');
    }
}
