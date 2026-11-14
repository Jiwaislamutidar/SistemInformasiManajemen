<?php

namespace App\Services;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;

class KaryawanService
{
    public function save(array $data, ?Karyawan $karyawan = null): Karyawan
    {
        return DB::transaction(function () use ($data, $karyawan) {
            $oldDivisiId = $karyawan?->divisi_id;
            $oldIsHead = $karyawan?->jabatan?->nama_jabatan === Jabatan::HEAD_NAME;
            $saved = $karyawan ? tap($karyawan)->update($data) : Karyawan::create($data);
            $saved->load('jabatan');

            if ($oldIsHead && $oldDivisiId && ($oldDivisiId !== $saved->divisi_id || $saved->jabatan?->nama_jabatan !== Jabatan::HEAD_NAME || $saved->status !== 'aktif')) {
                Divisi::whereKey($oldDivisiId)->where('kepala_divisi', $karyawan->nama)->update(['kepala_divisi' => '']);
            }

            if ($saved->jabatan?->nama_jabatan === Jabatan::HEAD_NAME && $saved->status === 'aktif') {
                Divisi::whereKey($saved->divisi_id)->update(['kepala_divisi' => $saved->nama]);
            }

            return $saved;
        });
    }

    public function delete(Karyawan $karyawan): void
    {
        DB::transaction(function () use ($karyawan) {
            if ($karyawan->jabatan?->nama_jabatan === Jabatan::HEAD_NAME && $karyawan->status === 'aktif') {
                Divisi::whereKey($karyawan->divisi_id)->where('kepala_divisi', $karyawan->nama)->update(['kepala_divisi' => '']);
            }
            $karyawan->delete();
        });
    }
}
