<?php

namespace App\Services;

use App\Interfaces\DokumenStorageInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LocalDokumenStorage implements DokumenStorageInterface
{
    // Disk 'local' = privat (tidak bisa diakses lewat URL publik).
    private const DISK = 'local';

    public function simpan(UploadedFile $file, string $folder): string
    {
        return $file->store($folder, self::DISK);
    }

    public function hapus(string $path): void
    {
        Storage::disk(self::DISK)->delete($path);
    }

    public function ada(string $path): bool
    {
        return Storage::disk(self::DISK)->exists($path);
    }

    public function unduh(string $path, string $namaFile): StreamedResponse
    {
        return Storage::disk(self::DISK)->download($path, $namaFile);
    }
}