<?php

namespace App\Models;

use App\Enums\StatusPengajuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    protected $table = 'pengajuans';

    protected $fillable = [
        'user_id', 'nama', 'nis', 'kelas', 'jurusan', 'instansi',
        'dokumen_path', 'dokumen_nama', 'status', 'catatan',
    ];

    protected $casts = [
        'status' => StatusPengajuan::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}