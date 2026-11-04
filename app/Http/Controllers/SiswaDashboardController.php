<?php

namespace App\Http\Controllers;

use App\Services\SiswaDashboardService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaDashboardController extends Controller
{
    public function __construct(private readonly SiswaDashboardService $service) {}

    public function index(Request $request): View
    {
        return view('siswa.dashboard', $this->service->data($request->user()));
    }
}