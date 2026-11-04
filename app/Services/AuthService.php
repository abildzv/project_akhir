<?php

namespace App\Services;

use App\Enums\Role;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(private readonly UserInterface $users) {}

    public function daftar(array $data) : user
    {
        $user = $this->users->buat([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => Role::Siswa->value,
        ]);

        Auth::login($user);

        return $user;
    }

    public function masuk(string $email, string $password, bool $ingat = false): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password], $ingat);
    }

    public function keluar(): void
    {
        Auth::logout();
    }
}