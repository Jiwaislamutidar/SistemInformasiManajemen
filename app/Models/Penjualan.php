<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_mobil',
        'mobil_id',
        'nama_pembeli',
        'harga_jual',
        'metode_pembayaran',
        'jumlah_dp',
        'sales_executive',
        'bukti_deal'
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
