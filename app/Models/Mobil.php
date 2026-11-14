<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mobil extends Model
{
    use HasFactory, SoftDeletes;

    public const CHERY_MODELS = [
        'Chery Tiggo 5X Classic',
        'Chery Tiggo 5X Summit',
        'Chery Omoda 5 Z',
        'Chery Omoda 5 RZ',
        'Chery Tiggo 7 Pro Premium',
        'Chery Tiggo 8 Pro Premium',
        'Chery Omoda E5 Electric',
    ];

    protected $table = 'mobils';

    protected $fillable = ['merk_tipe', 'tahun', 'harga_beli', 'harga_jual', 'stok', 'status'];

    protected $casts = ['tahun' => 'integer', 'harga_beli' => 'decimal:2', 'harga_jual' => 'decimal:2', 'stok' => 'integer'];

    public function syncStatus(): void
    {
        $this->update(['status' => $this->stok > 0 ? 'Ready' : 'Habis']);
    }
}
