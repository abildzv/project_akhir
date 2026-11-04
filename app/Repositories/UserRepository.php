<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function buat(array $data): User
    {
        return User::create($data);
    }

    public function perbarui(User $user, array $data): User
    {
        $user->update($data);

        return $user->refresh();
    }
}