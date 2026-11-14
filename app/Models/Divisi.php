<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    public const NAMES = ['Admin', 'IT', 'Mekanik', 'Akuntan', 'Sales'];

    protected $table = 'divisi';
    protected $fillable = ['nama_divisi', 'kepala_divisi'];

    public static function allowedNames(): array
    {
        return self::NAMES;
    }

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
