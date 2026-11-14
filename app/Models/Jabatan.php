<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    public const HEAD_NAME = 'Kepala Divisi';
    public const STAFF_NAME = 'Bukan Kepala Divisi';
    public const NAMES = [self::HEAD_NAME, self::STAFF_NAME];

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
