<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFotoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Services\PengajuanService;
use App\Services\ProfilService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaProfileController extends Controller
{
    public function __construct(
        private readonly ProfilService $profil,
        private readonly PengajuanService $pengajuan,
    ) {}

    public function index(Request $request): View
    {
        $user = $request->user();

        return view('siswa.profile', [
            'user'      => $user,
            'pengajuan' => $this->pengajuan->pengajuanTerbaru($user),
        ]);
    }

    public function update(UpdateProfilRequest $request): RedirectResponse
    {
        $this->profil->perbaruiProfil($request->user(), $request->validated());

        return redirect()->route('siswa.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $this->profil->ubahPassword(
            $request->user(),
            $request->validated('password_lama'),
            $request->validated('password_baru'),
        );

        return redirect()->route('siswa.profile')->with('success', 'Password berhasil diubah.');
    }

    public function updateFoto(UpdateFotoRequest $request): RedirectResponse
    {
        $this->profil->ubahFoto($request->user(), $request->file('foto'));

        return redirect()->route('siswa.profile')->with('success', 'Foto profil berhasil diperbarui.');
    }
}