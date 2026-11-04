<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFotoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'foto.required' => 'Pilih foto terlebih dahulu.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.mimes'    => 'Foto harus berformat JPG atau PNG.',
            'foto.max'      => 'Ukuran foto maksimal 2 MB.',
            'foto.uploaded' => 'Upload gagal. Pastikan ukuran foto maksimal 2 MB.',
        ];
    }
}