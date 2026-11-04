<?php

namespace App\Services;

use App\Enums\StatusPengajuan;
use App\Interfaces\PengajuanInterface;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Collection;

class SiswaDashboardService
{
    public function __construct(private readonly PengajuanInterface $pengajuan) {}

    public function data(User $user): array
    {
        $riwayat = $this->pengajuan->riwayatMilikUser($user->id);
        $terbaru = $riwayat->first();

        return [
            'siswa'      => $this->siswa($user, $terbaru),
            'statistik'  => $this->statistik($riwayat),
            'pkl'        => $this->pkl($terbaru),
            'aktivitas'  => $this->aktivitas($riwayat),
            'pengumuman' => [],
            'grafik'     => $this->grafik($riwayat),
        ];
    }

    private function siswa(User $user, ?Pengajuan $terbaru): array
    {
        return [
            'nama'    => $terbaru->nama ?? $user->name,
            'nis'     => $terbaru->nis ?? '-',
            'kelas'   => $terbaru->kelas ?? '-',
            'sekolah' => config('app.sekolah', '-'),
        ];
    }

    private function hitung(Collection $riwayat, StatusPengajuan $status): int
    {
        return $riwayat->filter(fn (Pengajuan $p) => $p->status === $status)->count();
    }

    private function statistik(Collection $riwayat): array
    {
        return [
            ['label' => 'Total Pengajuan', 'nilai' => $riwayat->count(), 'ikon' => 'ti-file-text', 'warna' => 'blue', 'keterangan' => 'Semua pengajuan yang pernah dikirim'],
            ['label' => 'Menunggu', 'nilai' => $this->hitung($riwayat, StatusPengajuan::Menunggu), 'ikon' => 'ti-clock', 'warna' => 'orange', 'keterangan' => 'Belum diperiksa sekolah'],
            ['label' => 'Disetujui', 'nilai' => $this->hitung($riwayat, StatusPengajuan::Disetujui), 'ikon' => 'ti-circle-check', 'warna' => 'green', 'keterangan' => 'Pengajuan yang diterima'],
            ['label' => 'Ditolak', 'nilai' => $this->hitung($riwayat, StatusPengajuan::Ditolak), 'ikon' => 'ti-circle-x', 'warna' => 'red', 'keterangan' => 'Perlu diajukan ulang'],
        ];
    }

    private function pkl(?Pengajuan $terbaru): array
    {
        if (! $terbaru) {
            return [
                'status' => 'Belum mengajukan', 'perusahaan' => '-', 'alamat' => '-',
                'progress' => 0, 'tanggal_mulai' => '-', 'tanggal_selesai' => '-', 'pembimbing' => '-',
            ];
        }

        return [
            'status'          => $terbaru->status->label(),
            'perusahaan'      => $terbaru->instansi,
            'alamat'          => '-',
            'progress'        => match ($terbaru->status) {
                StatusPengajuan::Menunggu  => 33,
                StatusPengajuan::Diproses  => 66,
                StatusPengajuan::Disetujui => 100,
                StatusPengajuan::Ditolak   => 66,
            },
            'tanggal_mulai'   => '-',
            'tanggal_selesai' => '-',
            'pembimbing'      => '-',
        ];
    }

    private function aktivitas(Collection $riwayat): array
    {
        return $riwayat->take(5)->map(fn (Pengajuan $p) => [
            'ikon'    => $p->status->ikon(),
            'judul'   => 'Pengajuan PKL di ' . $p->instansi,
            'tanggal' => $p->created_at->translatedFormat('d M Y, H:i'),
            'status'  => $p->status->label(),
        ])->all();
    }

    private function grafik(Collection $riwayat): array
    {
        $semua = StatusPengajuan::cases();

        return [
            'labels' => array_map(fn (StatusPengajuan $s) => $s->label(), $semua),
            'data'   => array_map(fn (StatusPengajuan $s) => $this->hitung($riwayat, $s), $semua),
        ];
    }
}