<?php

namespace App\Enums;

enum StatusPengajuan: string
{
    case Menunggu  = 'menunggu';
    case Diproses  = 'diproses';
    case Disetujui = 'disetujui';
    case Ditolak   = 'ditolak';

    public function label(): string
    {
        return match ($this) {
            self::Menunggu  => 'Menunggu',
            self::Diproses  => 'Diproses',
            self::Disetujui => 'Disetujui',
            self::Ditolak   => 'Ditolak',
        };
    }

    public function warna(): string
    {
        return match ($this) {
            self::Menunggu  => 'warning',
            self::Diproses  => 'info',
            self::Disetujui => 'success',
            self::Ditolak   => 'danger',
        };
    }

    public function ikon(): string
    {
        return match ($this) {
            self::Menunggu  => 'ti-clock',
            self::Diproses  => 'ti-loader',
            self::Disetujui => 'ti-circle-check',
            self::Ditolak   => 'ti-circle-x',
        };
    }

    /** Status yang dianggap masih "berjalan" (siswa tidak boleh mengajukan lagi). */
    public static function aktif(): array
    {
        return [self::Menunggu, self::Diproses, self::Disetujui];
    }
}