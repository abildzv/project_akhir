<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('nama', 100);
            $table->string('nis', 20);
            $table->string('kelas', 50)->nullable();
            $table->string('jurusan', 100);
            $table->string('instansi', 150);

            $table->string('dokumen_path');
            $table->string('dokumen_nama');

            $table->string('status', 20)->default('menunggu');
            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};