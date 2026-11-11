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
        $data = $request->validate([
            'unit_mobil' => 'required|string|in:Chery Tiggo 5X Classic,Chery Tiggo 5X Summit,Chery Omoda 5 Z,Chery Omoda 5 RZ,Chery Tiggo 7 Pro Premium,Chery Tiggo 8 Pro Premium,Chery Omoda E5 Electric',
            'nama_pembeli' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:Cash,Kredit',
            'jumlah_dp' => 'nullable|numeric|min:0|required_if:metode_pembayaran,Kredit',
            'sales_executive' => 'required|in:Sukayat,Bela,Ambar,Eki,Daido,Ridho,Nella,Adi,Lena',
            'bukti_deal' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti_deal')) {
            $path = $request->file('bukti_deal')->store('bukti-deal', 'public');
        }

        Penjualan::create([
            'unit_mobil' => $data['unit_mobil'],
            'nama_pembeli' => $data['nama_pembeli'],
            'harga_jual' => $data['harga_jual'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'jumlah_dp' => $data['metode_pembayaran'] === 'Kredit' ? ($data['jumlah_dp'] ?? null) : null,
            'sales_executive' => $data['sales_executive'],
            'bukti_deal' => $path,
        ]);

        return redirect()->route('admin.inputpenjualan')->with('success', 'Transaksi berhasil disimpan!');
    }
}
