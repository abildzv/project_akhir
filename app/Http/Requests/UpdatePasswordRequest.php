<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'password_lama' => ['required', 'string'],
            'password_baru' => ['required', 'confirmed', 'different:password_lama', Password::min(8)],
        ];
    }

    public function messages(): array
    {
        return [
            'password_lama.required'  => 'Password lama wajib diisi.',
            'password_baru.required'  => 'Password baru wajib diisi.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password_baru.different' => 'Password baru harus berbeda dari password lama.',
            'password_baru.min'       => 'Password baru minimal 8 karakter.',
        ];
    }
}