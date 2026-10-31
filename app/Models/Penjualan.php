<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_mobil',
        'nama_pembeli',
        'harga_jual',
        'metode_pembayaran',
        'sales_executive',
        'bukti_deal'
    ];
}