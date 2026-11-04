<?php

namespace App\Models;

use App\Enums\Role;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
        'nisn', 'kelas', 'jurusan', 'telepon',
        'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'role'              => Role::class,
            'tanggal_lahir'     => 'date',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }
}