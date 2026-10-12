<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
        $table->string('nama_siswa');
        $table->string('nis');
        $table->string('kelas');
        $table->string('email');
        $table->string('nama_perusahaan');
        $table->text('alamat_perusahaan');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->string('surat_pengajuan');
        $table->enum('status', [
            'menunggu',
            'disetujui',
            'ditolak',
        ])->default('menunggu');
        $table->text('catatan_admin')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
