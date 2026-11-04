<?php

namespace App\Services;

use App\Enums\StatusPengajuan;
use App\Exceptions\PengajuanSudahAdaException;
use App\Interfaces\DokumenStorageInterface;
use App\Interfaces\PengajuanInterface;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class PengajuanService
{
    public function __construct(
        private readonly PengajuanInterface $pengajuan,
        private readonly DokumenStorageInterface $storage,
    ) {}

    /**
     * @throws PengajuanSudahAdaException
     */
    public function ajukan(User $user, array $data, UploadedFile $dokumen): Pengajuan
    {
        if ($this->pengajuan->punyaPengajuanAktif($user->id)) {
            throw new PengajuanSudahAdaException();
        }

        $path = $this->storage->simpan($dokumen, 'pengajuan');

        try {
            return $this->pengajuan->buat([
                ...$data,
                'user_id'      => $user->id,
                'dokumen_path' => $path,
                'dokumen_nama' => $dokumen->getClientOriginalName(),
                'status'       => StatusPengajuan::Menunggu->value,
            ]);
        } catch (Throwable $e) {
            // Kalau gagal simpan ke DB, jangan tinggalkan file yatim di storage.
            $this->storage->hapus($path);
            throw $e;
        }
    }

    public function pengajuanTerbaru(User $user): ?Pengajuan
    {
        return $this->pengajuan->terbaruMilikUser($user->id);
    }

    public function riwayat(User $user): Collection
    {
        return $this->pengajuan->riwayatMilikUser($user->id);
    }

    /**
     * Linimasa 3 langkah untuk halaman Cek Status.
     * Tiap item: label, ikon, state (done|current|failed|todo).
     */
    public function linimasa(?Pengajuan $pengajuan): array
    {
        $langkah = [
            ['label' => 'Pengajuan Dikirim', 'ikon' => 'ti-send'],
            ['label' => 'Diproses Sekolah',  'ikon' => 'ti-loader'],
            ['label' => 'Keputusan Akhir',   'ikon' => 'ti-flag'],
        ];

        $state = match ($pengajuan?->status) {
            StatusPengajuan::Menunggu  => ['current', 'todo', 'todo'],
            StatusPengajuan::Diproses  => ['done', 'current', 'todo'],
            StatusPengajuan::Disetujui => ['done', 'done', 'done'],
            StatusPengajuan::Ditolak   => ['done', 'done', 'failed'],
            default                    => ['todo', 'todo', 'todo'],
        };

        foreach ($langkah as $i => $item) {
            $langkah[$i]['state'] = $state[$i];
        }

        return $langkah;
    }

    /**
     * @throws NotFoundHttpException jika bukan milik user atau file hilang
     */
    public function unduhDokumen(User $user, int $id): StreamedResponse
    {
        $pengajuan = $this->pengajuan->cariMilikUser($id, $user->id)
            ?? throw new NotFoundHttpException();

        if (! $this->storage->ada($pengajuan->dokumen_path)) {
            throw new NotFoundHttpException('Dokumen tidak ditemukan.');
        }

        return $this->storage->unduh($pengajuan->dokumen_path, $pengajuan->dokumen_nama);
    }
    /**
 * Data untuk tabel Cek Status, dalam bentuk yang dibaca blade.
 */
public function daftarCekStatus(User $user): array
{
    return $this->pengajuan->riwayatMilikUser($user->id)
        ->map(fn (Pengajuan $p) => [
            'id'         => $p->id,
            'instansi'   => $p->instansi,
            'periode'    => 'Belum ditentukan',
            'tanggal'    => $p->created_at->translatedFormat('d F Y'),
            'status'     => $p->status->label(),
            'pembimbing' => 'Belum ditentukan',
            'catatan'    => $p->catatan ?: 'Belum ada catatan dari pembimbing.',
        ])
        ->values()
        ->all();
}

public function statistikCekStatus(User $user): array
{
    $riwayat = $this->pengajuan->riwayatMilikUser($user->id);

    $hitung = fn (StatusPengajuan ...$status) => $riwayat
        ->filter(fn (Pengajuan $p) => in_array($p->status, $status, true))
        ->count();

    return [
        'total'     => $riwayat->count(),
        // "Menunggu" di kartu = menunggu + sedang diproses
        'menunggu'  => $hitung(StatusPengajuan::Menunggu, StatusPengajuan::Diproses),
        'disetujui' => $hitung(StatusPengajuan::Disetujui),
        'ditolak'   => $hitung(StatusPengajuan::Ditolak),
    ];
}
}