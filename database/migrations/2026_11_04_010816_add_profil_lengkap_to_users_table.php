<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $kolom = [
        'nisn' => 20, 'kelas' => 50, 'jurusan' => 100, 'telepon' => 20,
        'tempat_lahir' => 100, 'jenis_kelamin' => 20, 'foto' => 255,
    ];

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            foreach ($this->kolom as $nama => $panjang) {
                if (! Schema::hasColumn('users', $nama)) {
                    $table->string($nama, $panjang)->nullable();
                }
            }
            if (! Schema::hasColumn('users', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable();
            }
            if (! Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([...array_keys($this->kolom), 'tanggal_lahir', 'alamat']);
        });
    }
};