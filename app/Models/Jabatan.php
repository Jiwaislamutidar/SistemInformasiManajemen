<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    public const NAMES = ['Admin', 'IT', 'Mekanik', 'Akuntan', 'Sales'];

    protected $table = 'jabatan';
    protected $fillable = ['nama_jabatan'];

    public static function allowedNames(): array
    {
        return self::NAMES;
    }

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
