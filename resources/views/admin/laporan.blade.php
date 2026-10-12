@extends('layouts.admin')

@section('title', 'Laporan PKL | PKL Online')
@section('page-heading', 'Verifikasi Laporan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
@endpush

@section('content')
{{-- container-fluid dihapus agar lebar sama dengan halaman lain --}}
<div class="laporan-page">

    {{-- =====================================================
         1. HEADER (banner)
         ===================================================== --}}
    <div class="laporan-header">
        <div>
            <span class="laporan-eyebrow">REKAPITULASI PKL</span>
            <h1>Laporan PKL</h1>
            <p>Rekapitulasi data pengajuan PKL siswa.</p>
        </div>

        <button type="button" class="btn-cetak" onclick="window.print()">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>
    </div>

    {{-- =====================================================
         2. RINGKASAN STATISTIK (4 kartu)
         ===================================================== --}}
    <div class="laporan-stats">

        {{-- 2a. Total Pengajuan --}}
        <div class="laporan-card">
            <div class="stat-icon total">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <p>Total Pengajuan</p>
                <h3>{{ $totalPengajuan }}</h3>
            </div>
        </div>

        {{-- 2b. Menunggu --}}
        <div class="laporan-card">
            <div class="stat-icon menunggu">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <p>Menunggu</p>
                <h3>{{ $menunggu }}</h3>
            </div>
        </div>

        {{-- 2c. Disetujui --}}
        <div class="laporan-card">
            <div class="stat-icon disetujui">
                <i class="bi bi-check-circle"></i>
            </div>
            <div>
                <p>Disetujui</p>
                <h3>{{ $disetujui }}</h3>
            </div>
        </div>

        {{-- 2d. Ditolak --}}
        <div class="laporan-card">
            <div class="stat-icon ditolak">
                <i class="bi bi-x-circle"></i>
            </div>
            <div>
                <p>Ditolak</p>
                <h3>{{ $ditolak }}</h3>
            </div>
        </div>

    </div>

    {{-- =====================================================
         3. TABEL LAPORAN
         ===================================================== --}}
    <div class="laporan-table-card">

        {{-- 3a. Judul kartu --}}
        <div class="laporan-table-header">
            <div>
                <h5>Data Laporan Pengajuan</h5>
                <p>Daftar seluruh pengajuan PKL siswa.</p>
            </div>
        </div>

        {{-- 3b. Pencarian dan filter --}}
        <form action="{{ route('admin.laporan.index') }}"
              method="GET"
              class="laporan-filter">

            <div class="search-box">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama, NIS, atau perusahaan..."
                    value="{{ request('search') }}">
            </div>

            <select name="status" class="filter-status">
                <option value="">Semua Status</option>
                <option value="menunggu"
                    {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                    Menunggu
                </option>
                <option value="disetujui"
                    {{ request('status') == 'disetujui' ? 'selected' : '' }}>
                    Disetujui
                </option>
                <option value="ditolak"
                    {{ request('status') == 'ditolak' ? 'selected' : '' }}>
                    Ditolak
                </option>
            </select>

            <button type="submit" class="btn-filter">Filter</button>

            <a href="{{ route('admin.laporan.index') }}" class="btn-reset">
                Reset
            </a>
        </form>

        {{-- 3c. Tabel data --}}
        <div class="table-responsive">
            <table class="table laporan-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Tempat PKL</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ $laporan->firstItem() + $loop->index }}</td>
                            <td class="nama-siswa">{{ $item->nama_siswa }}</td>
                            <td>{{ $item->nis }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->nama_perusahaan }}</td>
                            <td>
                                {{ $item->tanggal_mulai
                                    ? \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y')
                                    : '-' }}
                            </td>
                            <td>
                                {{ $item->tanggal_selesai
                                    ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y')
                                    : '-' }}
                            </td>
                            <td>
                                {{-- Badge status: menunggu / disetujui / ditolak --}}
                                <span class="status-badge status-{{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        {{-- Tampilan jika data kosong --}}
                        <tr>
                            <td colspan="8" class="empty-data">
                                <i class="bi bi-inbox"></i>
                                <p>Belum ada data pengajuan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 3d. Pagination --}}
        <div class="laporan-pagination">
            {{ $laporan->links() }}
        </div>

    </div>

</div>
@endsection