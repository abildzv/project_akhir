<?php

namespace App\Http\Controllers;

use App\Services\PengajuanService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SiswaCekStatusController extends Controller
{
    public function __construct(private readonly PengajuanService $service) {}

    public function index(Request $request): View
    {
        $user = $request->user();

        return view('siswa.cek-status', [
            'pengajuan' => $this->service->daftarCekStatus($user),
            'statistik' => $this->service->statistikCekStatus($user),
        ]);
    }

    public function dokumen(Request $request, int $id): StreamedResponse
    {
        return $this->service->unduhDokumen($request->user(), $id);
    }
}