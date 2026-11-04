<?php

namespace App\Http\Controllers;

use App\Exceptions\PengajuanSudahAdaException;
use App\Http\Requests\StorePengajuanRequest;
use App\Services\PengajuanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaPengajuanController extends Controller
{
    public function __construct(private readonly PengajuanService $service) {}

    public function create(Request $request): View
    {
        return view('siswa.pengajuan-pkl', [
            'pengajuan' => $this->service->pengajuanTerbaru($request->user()),
        ]);
    }

    public function store(StorePengajuanRequest $request): RedirectResponse
    {
        try {
            $this->service->ajukan(
                $request->user(),
                $request->safe()->except('dokumen'),
                $request->file('dokumen'),
            );
        } catch (PengajuanSudahAdaException $e) {
            return back()
                ->withInput()
                ->withErrors(['pengajuan' => $e->getMessage()]);
        }

        return redirect()
            ->route('siswa.pengajuan')
            ->with('success', 'Pengajuan PKL berhasil dikirim. Silakan cek statusnya secara berkala.');
    }
}