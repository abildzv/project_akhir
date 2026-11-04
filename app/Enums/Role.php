<?php

namespace App\Enums;

enum Role: string
{
    case Siswa = 'siswa';
    case Admin = 'admin';

    /** Nama route tujuan setelah login. */
    public function beranda(): string
    {
        return match ($this) {
            self::Siswa => 'siswa.dashboard',
            self::Admin => 'admin.dashboard',
        };
    }
}