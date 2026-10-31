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
        // Validasi input form
        $request->validate([
            'unit_mobil' => 'required|string',
            'nama_pembeli' => 'required|string|max:255',
            'harga_jual' => 'required|numeric',
            'metode_pembayaran' => 'required|string',
            'sales_executive' => 'required|string',
            'bukti_deal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Opsional, max 2MB
        ]);

        // Handle upload file jika ada
        $path = null;
        if ($request->hasFile('bukti_deal')) {
            $path = $request->file('bukti_deal')->store('bukti-deal', 'public');
        }

        // Simpan ke database menggunakan Model Penjualan
        Penjualan::create([
            'unit_mobil' => $request->unit_mobil,
            'nama_pembeli' => $request->nama_pembeli,
            'harga_jual' => $request->harga_jual,
            'metode_pembayaran' => $request->metode_pembayaran,
            'sales_executive' => $request->sales_executive,
            'bukti_deal' => $path,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.inputpenjualan')->with('success', 'Transaksi penjualan unit berhasil disimpan!');
    }
}