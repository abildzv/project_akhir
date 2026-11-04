<?php

namespace App\Interfaces;

use App\Models\Pengajuan;
use Illuminate\Support\Collection;

interface PengajuanInterface
{
    public function buat(array $data): Pengajuan;

    public function punyaPengajuanAktif(int $userId): bool;

    public function terbaruMilikUser(int $userId): ?Pengajuan;

    /** @return Collection<int, Pengajuan> */
    public function riwayatMilikUser(int $userId): Collection;

    public function cariMilikUser(int $id, int $userId): ?Pengajuan;
}