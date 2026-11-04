<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProfilService
{
    public function __construct(private readonly UserInterface $users) {}

    public function perbaruiProfil(User $user, array $data): User
    {
        return $this->users->perbarui($user, $data);
    }

    public function ubahPassword(User $user, string $passwordLama, string $passwordBaru): void
    {
        if (! Hash::check($passwordLama, $user->password)) {
            throw ValidationException::withMessages([
                'password_lama' => 'Password lama tidak sesuai.',
            ]);
        }

        $this->users->perbarui($user, ['password' => Hash::make($passwordBaru)]);
    }

    public function ubahFoto(User $user, UploadedFile $foto): User
    {
        $pathBaru = $foto->store('foto-profil', 'public');
        $pathLama = $user->foto;

        $user = $this->users->perbarui($user, ['foto' => $pathBaru]);

        if ($pathLama) {
            Storage::disk('public')->delete($pathLama);
        }

        return $user;
    }
}