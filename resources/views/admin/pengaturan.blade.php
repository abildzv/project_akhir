@extends('layouts.admin')

@section('title', 'Pengaturan | PKL Online')
@section('page-heading', 'Pengaturan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pengaturan.css') }}">
@endpush

@section('content')
{{-- container-fluid dihapus agar lebar sama dengan halaman lain --}}
<div class="pengaturan-page">

    {{-- =====================================================
         1. HEADER (banner)
         ===================================================== --}}
    <div class="pengaturan-header">
        <div>
            <span class="pengaturan-eyebrow">AKUN ADMINISTRATOR</span>
            <h1>Pengaturan</h1>
            <p>Kelola profil dan keamanan akun administrator.</p>
        </div>
        <div class="pengaturan-header-icon">
            <i class="bi bi-gear-fill"></i>
        </div>
    </div>

    {{-- =====================================================
         2. NOTIFIKASI
         ===================================================== --}}
    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle-fill"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- =====================================================
         3. KARTU PENGATURAN
         ===================================================== --}}
    <div class="pengaturan-layout">

        {{-- 3a. Profil admin --}}
        <div class="pengaturan-card">
            <div class="pengaturan-card-header">
                <div class="pengaturan-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div>
                    <h5>Profil Administrator</h5>
                    <p>Ubah informasi akun admin.</p>
                </div>
            </div>

            <form action="{{ route('admin.pengaturan.profil.update') }}"
                  method="POST">
                @csrf
                @method('PUT')

                {{-- Pratinjau avatar + nama --}}
                <div class="profil-preview">
                    <div class="profil-avatar">
                        {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <h6>{{ $admin->name ?? 'Administrator' }}</h6>
                        <span>Administrator</span>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label for="name">Nama Admin</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name', $admin->name) }}"
                           required>
                </div>

                <div class="form-group-custom">
                    <label for="email">Email Admin</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $admin->email) }}"
                           required>
                </div>

                <button type="submit" class="btn-simpan">
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>
            </form>
        </div>

        {{-- 3b. Keamanan akun --}}
        <div class="pengaturan-card">
            <div class="pengaturan-card-header">
                <div class="pengaturan-icon keamanan">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div>
                    <h5>Keamanan Akun</h5>
                    <p>Perbarui password administrator.</p>
                </div>
            </div>

            <form action="{{ route('admin.pengaturan.password.update') }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="form-group-custom">
                    <label for="password_lama">Password Lama</label>
                    <input type="password"
                           id="password_lama"
                           name="password_lama"
                           autocomplete="current-password"
                           required>
                </div>

                <div class="form-group-custom">
                    <label for="password">Password Baru</label>
                    <input type="password"
                           id="password"
                           name="password"
                           minlength="8"
                           autocomplete="new-password"
                           required>
                    <small>Minimal 8 karakter.</small>
                </div>

                <div class="form-group-custom">
                    <label for="password_confirmation">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           minlength="8"
                           autocomplete="new-password"
                           required>
                </div>

                <button type="submit" class="btn-simpan">
                    <i class="bi bi-shield-check"></i>
                    Perbarui Password
                </button>
            </form>
        </div>

        {{-- 3c. Informasi sistem --}}
        <div class="pengaturan-card info-sistem-card">
            <div class="pengaturan-card-header">
                <div class="pengaturan-icon sistem">
                    <i class="bi bi-info-circle"></i>
                </div>
                <div>
                    <h5>Informasi Sistem</h5>
                    <p>Informasi aplikasi pengajuan PKL.</p>
                </div>
            </div>

            <div class="info-sistem-row">
                <span>Nama Aplikasi</span>
                <strong>Sistem Pengajuan PKL</strong>
            </div>

            <div class="info-sistem-row">
                <span>Versi Aplikasi</span>
                <strong>1.0.0</strong>
            </div>

            <div class="info-sistem-row">
                <span>Pengguna Aktif</span>
                <strong>{{ $admin->name }}</strong>
            </div>

            <div class="info-sistem-row">
                <span>Status</span>
                <span class="status-aktif">
                    <i class="bi bi-circle-fill"></i> Aktif
                </span>
            </div>
        </div>

    </div>
</div>
@endsection