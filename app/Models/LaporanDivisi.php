<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanDivisi extends Model
{
    use HasFactory;

    protected $table = 'laporan_divisi';
    protected $fillable = ['divisi_id', 'diteruskan_oleh', 'judul', 'jenis_laporan', 'ringkasan', 'lampiran', 'periode', 'catatan_admin', 'status', 'tanggal_dikirim'];
    protected $casts = ['tanggal_dikirim' => 'datetime'];
}
