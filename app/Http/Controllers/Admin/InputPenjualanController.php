<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;

class InputPenjualanController extends Controller
{
    public function index()
    {
        return view('admin.inputpenjualan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_mobil' => 'required|string',
            'nama_pembeli' => 'required|string',
            'harga_jual' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'jumlah_dp' => 'nullable|numeric',
            'sales_executive' => 'required|string',
            'bukti_deal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_deal')) {
            $path = $request->file('bukti_deal')->store('bukti-deal', 'public');
        }

        Penjualan::create([
            'unit_mobil' => $request->unit_mobil,
            'nama_pembeli' => $request->nama_pembeli,
            'harga_jual' => $request->harga_jual,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_dp' => $request->metode_pembayaran == 'Kredit' ? $request->jumlah_dp : null,
            'sales_executive' => $request->sales_executive,
            'bukti_deal' => $path,
        ]);

        return redirect()->route('admin.inputpenjualan')->with('success', 'Transaksi berhasil disimpan!');
    }
}