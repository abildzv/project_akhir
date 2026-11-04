<?php

namespace App\Http\Requests;

use App\Http\Requests\StorePengajuanRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name'          => ['sometimes', 'required', 'string', 'max:100'],
            'email'         => ['sometimes', 'required', 'email', 'max:150',
                                Rule::unique('users', 'email')->ignore($this->user()->id)],
            'nisn'          => ['sometimes', 'nullable', 'string', 'max:20'],
            'telepon'       => ['sometimes', 'nullable', 'string', 'max:20'],
            'tempat_lahir'  => ['sometimes', 'nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['sometimes', 'nullable', 'date', 'before:today'],
            'jenis_kelamin' => ['sometimes', 'nullable', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat'        => ['sometimes', 'nullable', 'string', 'max:500'],
            'kelas'         => ['sometimes', 'nullable', 'string', 'max:50'],
            'jurusan'       => ['sometimes', 'nullable', Rule::in(StorePengajuanRequest::JURUSAN)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Nama wajib diisi.',
            'email.required'       => 'Email wajib diisi.',
            'email.email'          => 'Format email tidak valid.',
            'email.unique'         => 'Email sudah dipakai akun lain.',
            'tanggal_lahir.date'   => 'Tanggal lahir tidak valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.in'     => 'Jenis kelamin tidak valid.',
            'jurusan.in'           => 'Jurusan yang dipilih tidak valid.',
        ];
    }
}