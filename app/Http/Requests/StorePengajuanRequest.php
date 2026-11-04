<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePengajuanRequest extends FormRequest
{
    public const JURUSAN = [
        'Rekayasa Perangkat Lunak',
        'Desain Pemodelan dan Informasi Bangunan',
        'Akuntansi',
        'Kuliner',
        'Teknik Pendingin dan Tata Udara',
        'Teknik Konstruksi dan Perumahan',
        'Teknik Pengelasan',
    ];

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'nama'     => ['required', 'string', 'max:100'],
            'nis'      => ['required', 'string', 'max:20'],
            'kelas'    => ['nullable', 'string', 'max:50'],
            'jurusan'  => ['required', Rule::in(self::JURUSAN)],
            'instansi' => ['required', 'string', 'max:150'],
            'dokumen'  => ['required', 'file', 'mimes:pdf', 'max:2048'], // 2048 KB = 2 MB
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'nama.max'          => 'Nama lengkap maksimal 100 karakter.',
            'nis.required'      => 'NIS / NISN wajib diisi.',
            'nis.max'           => 'NIS / NISN maksimal 20 karakter.',
            'jurusan.required'  => 'Jurusan wajib dipilih.',
            'jurusan.in'        => 'Jurusan yang dipilih tidak valid.',
            'instansi.required' => 'Nama instansi wajib diisi.',
            'instansi.max'      => 'Nama instansi maksimal 150 karakter.',
            'dokumen.required'  => 'Dokumen wajib diunggah.',
            'dokumen.file'      => 'Dokumen harus berupa file.',
            'dokumen.mimes'     => 'File harus berformat PDF.',
            'dokumen.max'       => 'Ukuran file maksimal 2 MB.',
            'dokumen.uploaded'  => 'Upload gagal. Pastikan ukuran file maksimal 2 MB.',
        ];
    }
}