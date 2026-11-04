<?php

namespace App\Interfaces;

use App\Models\User;

interface UserInterface
{
    public function buat(array $data): User;

    public function perbarui(User $user, array $data): User;
}