@extends('layouts.admin')

@section('title', 'Data Siswa | PKL Online')
@section('page-heading', 'Data Siswa')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/siswa.css') }}">
@endpush

@section('content')
{{-- container-fluid dihapus agar lebar sama dengan halaman lain --}}
<div class="siswa-page">

    {{-- =====================================================
         1. HEADER (banner)
         ===================================================== --}}
    <div class="siswa-header">
        <div>
            <span class="siswa-eyebrow">MANAJEMEN SISWA</span>
            <h1>Data Siswa</h1>
            <p>Kelola dan lihat daftar siswa yang terdaftar.</p>
        </div>

        {{-- Ikon di kanan banner --}}
        <div class="siswa-header-icon">
            <i class="bi bi-person-vcard-fill"></i>
        </div>
    </div>

    {{-- =====================================================
         2. KARTU RINGKASAN (total siswa)
         ===================================================== --}}
    <div class="siswa-summary">
        <div class="siswa-summary-icon">
            <i class="bi bi-people-fill"></i>
        </div>

        <div>
            <p>Total Siswa</p>
            <h2>{{ $totalSiswa }}</h2>
        </div>
    </div>

    {{-- =====================================================
         3. TABEL SISWA
         ===================================================== --}}
    <div class="siswa-table-card">

        {{-- 3a. Judul kartu --}}
        <div class="siswa-table-heading">
            <div>
                <h5>Daftar Siswa</h5>
                <p>Informasi akun siswa yang terdaftar dalam sistem.</p>
            </div>
        </div>

        {{-- 3b. Pencarian --}}
        <form action="{{ route('admin.siswa.index') }}"
              method="GET"
              class="siswa-search">

            <div class="siswa-search-input">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama atau email siswa..."
                    value="{{ request('search') }}">
            </div>

            <button type="submit">Cari</button>

            <a href="{{ route('admin.siswa.index') }}">Reset</a>
        </form>

        {{-- 3c. Tabel data --}}
        <div class="table-responsive">
            <table class="table siswa-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>Email</th>
                        <th>Tanggal Terdaftar</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($siswa as $item)
                        <tr>
                            <td>{{ $siswa->firstItem() + $loop->index }}</td>

                            {{-- Kolom nama + avatar inisial --}}
                            <td>
                                <div class="siswa-name">
                                    <div class="siswa-avatar">
                                        {{ strtoupper(substr($item->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $item->name }}</span>
                                </div>
                            </td>

                            <td>{{ $item->email }}</td>

                            <td>
                                {{ $item->created_at
                                    ? $item->created_at->format('d/m/Y')
                                    : '-' }}
                            </td>
                        </tr>
                    @empty
                        {{-- Tampilan jika data kosong --}}
                        <tr>
                            <td colspan="4" class="siswa-empty">
                                <i class="bi bi-person-x"></i>
                                <p>Data siswa belum tersedia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 3d. Pagination --}}
        <div class="siswa-pagination">
            {{ $siswa->links() }}
        </div>

    </div>
</div>
@endsection