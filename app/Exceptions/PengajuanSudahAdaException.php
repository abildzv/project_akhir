<?php

namespace App\Exceptions;

use RuntimeException;

class PengajuanSudahAdaException extends RuntimeException
{
    public function __construct()
    {
        parent:: __construct(
            'Kamu sudah memiliki pengajuan PKL yang sedang berjalan. Cek statusnya di menu Cek Status.'
        );
    }
}
