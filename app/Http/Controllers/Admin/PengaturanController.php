<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PengaturanController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        if (!$admin) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('admin.pengaturan', compact('admin'));
    }

    public function updateProfil(Request $request)
    {
        $admin = Auth::user();

        if (!$admin) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->save();

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password_lama.current_password' =>
                'Password lama yang kamu masukkan tidak sesuai.',
            'password.confirmed' =>
                'Konfirmasi password baru tidak cocok.',
            'password.min' =>
                'Password baru minimal 8 karakter.',
        ]);

        $admin = Auth::user();
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Password berhasil diganti.');
    }
}
