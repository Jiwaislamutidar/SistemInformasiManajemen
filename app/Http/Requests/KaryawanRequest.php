<?php

namespace App\Http\Requests;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KaryawanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $karyawan = $this->route('karyawan');
        $id = $karyawan instanceof Karyawan ? $karyawan->getKey() : null;

        return [
            'nip' => ['nullable', 'string', 'max:50', Rule::unique('karyawan', 'nip')->ignore($id)],
            'nama' => ['required', 'string', 'max:120'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'divisi_id' => ['required', 'integer', Rule::exists('divisi', 'id')->where(fn ($query) => $query->whereIn('nama_divisi', Divisi::allowedNames()))],
            'jabatan_id' => ['required', 'integer', Rule::exists('jabatan', 'id')->where(fn ($query) => $query->whereIn('nama_jabatan', Jabatan::allowedNames()))],
            'gaji_pokok' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) return;

            $jabatan = Jabatan::find($this->integer('jabatan_id'));
            if ($jabatan?->nama_jabatan !== Jabatan::HEAD_NAME || $this->input('status') !== 'aktif') return;

            $query = Karyawan::where('divisi_id', $this->integer('divisi_id'))
                ->where('jabatan_id', $jabatan->id)
                ->where('status', 'aktif');
            $current = $this->route('karyawan');
            if ($current instanceof Karyawan) $query->where('id', '!=', $current->getKey());

            if ($query->exists()) {
                $validator->errors()->add('jabatan_id', 'Setiap divisi hanya boleh memiliki satu Kepala Divisi aktif.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'divisi_id.required' => 'Divisi wajib dipilih.',
            'divisi_id.exists' => 'Divisi yang dipilih tidak valid.',
            'jabatan_id.required' => 'Jabatan wajib dipilih.',
            'jabatan_id.exists' => 'Jabatan yang dipilih tidak valid.',
            'gaji_pokok.required' => 'Gaji pokok wajib diisi.',
            'gaji_pokok.min' => 'Gaji pokok tidak boleh kurang dari 0.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus Aktif atau Nonaktif.',
        ];
    }
}
