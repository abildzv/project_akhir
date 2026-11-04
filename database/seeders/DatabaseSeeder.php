<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@pkl.test'], [
            'name'     => 'Admin PKL',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        User::updateOrCreate(['email' => 'siswa1@pkl.test'], [
            'name'     => 'Siswa Satu',
            'password' => Hash::make('password123'),
            'role'     => 'siswa',
        ]);

        User::updateOrCreate(['email' => 'siswa2@pkl.test'], [
            'name'     => 'Siswa Dua',
            'password' => Hash::make('password123'),
            'role'     => 'siswa',
        ]);
    }
}