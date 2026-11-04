<?php

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface DokumenStorageInterface
{
    /** Simpan file, kembalikan path-nya. */
    public function simpan(UploadedFile $file, string $folder): string;

    public function hapus(string $path): void;

    public function ada(string $path): bool;

    public function unduh(string $path, string $namaFile): StreamedResponse;
}