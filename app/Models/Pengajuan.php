<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuans';

    protected $fillable = [
        'nama_siswa',
        'nis',
        'kelas',
        'email',
        'nama_perusahaan',
        'alamat_perusahaan',
        'tanggal_mulai',
        'tanggal_selesai',
        'surat_pengajuan',
        'status',
        'catatan_admin',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }
}
