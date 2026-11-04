<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengajuanPkl extends Model
{
    protected $table = 'pengajuan_pkls';

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
