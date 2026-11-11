<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = ['type', 'kategori', 'nominal', 'tanggal', 'keterangan'];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal' => 'date',
    ];
}
