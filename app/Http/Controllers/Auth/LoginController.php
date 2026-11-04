<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi email dan password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Proses login
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password yang kamu masukkan salah.'
                ])
                ->onlyInput('email');
        }

        // Regenerasi session
        $request->session()->regenerate();

        // Ambil data user
        $user = Auth::user();

        // Redirect berdasarkan role
        if ($user->role->value === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role->value === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }

        // Jika role tidak dikenali
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Role akun tidak dikenali.'
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Kamu berhasil logout.');
    }
}
