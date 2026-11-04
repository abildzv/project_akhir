<?php

namespace App\Repositories;

use App\Enums\StatusPengajuan;
use App\Interfaces\PengajuanInterface;
use App\Models\Pengajuan;
use Illuminate\Support\Collection;

class PengajuanRepository implements PengajuanInterface
{
    public function buat(array $data): Pengajuan
    {
        return Pengajuan::create($data);
    }

    public function punyaPengajuanAktif(int $userId): bool
    {
        $statusAktif = array_map(
            fn (StatusPengajuan $status) => $status->value,
            StatusPengajuan::aktif()
        );

        return Pengajuan::where('user_id', $userId)
            ->whereIn('status', $statusAktif)
            ->exists();
    }

    public function terbaruMilikUser(int $userId): ?Pengajuan
    {
        return Pengajuan::where('user_id', $userId)->latest()->first();
    }

    public function riwayatMilikUser(int $userId): Collection
    {
        return Pengajuan::where('user_id', $userId)->latest()->get();
    }

    public function cariMilikUser(int $id, int $userId): ?Pengajuan
    {
        return Pengajuan::where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }
}