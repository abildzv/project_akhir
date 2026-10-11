
@extends('layouts.admin')

@section('title', 'Data Pengajuan PKL')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pengajuan.css') }}">
@endpush

@section('content')
<div class="pengajuan-page">

    {{-- HEADER HALAMAN --}}
    <div class="pengajuan-header">
        <div>
            <span class="pengajuan-eyebrow">MANAJEMEN PKL</span>
            <h1>Data Pengajuan PKL</h1>
            <p>Kelola dan pantau seluruh pengajuan PKL siswa.</p>
        </div>

        <div class="pengajuan-header-icon">
            <i class="bi bi-clipboard2-check"></i>
        </div>
    </div>

    {{-- RINGKASAN --}}
    <div class="pengajuan-stats">

        <div class="pengajuan-stat-card">
            <div class="pengajuan-stat-icon stat-blue">
                <i class="bi bi-files"></i>
            </div>
            <div>
                <p>Total Pengajuan</p>
                <h3>{{ $totalPengajuan ?? 0 }}</h3>
            </div>
        </div>

        <div class="pengajuan-stat-card">
            <div class="pengajuan-stat-icon stat-orange">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <p>Menunggu</p>
                <h3>{{ $menungguVerifikasi ?? 0 }}</h3>
            </div>
        </div>

        <div class="pengajuan-stat-card">
            <div class="pengajuan-stat-icon stat-green">
                <i class="bi bi-check-circle"></i>
            </div>
            <div>
                <p>Disetujui</p>
                <h3>{{ $disetujui ?? 0 }}</h3>
            </div>
        </div>

        <div class="pengajuan-stat-card">
            <div class="pengajuan-stat-icon stat-red">
                <i class="bi bi-x-circle"></i>
            </div>
            <div>
                <p>Ditolak</p>
                <h3>{{ $ditolak ?? 0 }}</h3>
            </div>
        </div>

    </div>

    {{-- TABEL PENGAJUAN --}}
    <div class="pengajuan-panel">

        <div class="pengajuan-panel-header">
            <div>
                <h2>Daftar Pengajuan</h2>
                <p>Informasi pengajuan PKL yang dikirimkan siswa.</p>
            </div>

            <span class="pengajuan-total">
                {{ isset($pengajuan) ? $pengajuan->total() : 0 }} data
            </span>
        </div>

        {{-- PENCARIAN DAN FILTER --}}
        <form action="{{ url('/admin/pengajuan') }}"
              method="GET"
              class="pengajuan-filter">

            <div class="pengajuan-search">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama siswa atau NIS..."
                    aria-label="Cari nama siswa atau NIS">
            </div>

            <div class="pengajuan-filter-status">
                <i class="bi bi-funnel"></i>
                <select name="status" aria-label="Filter status">
                    <option value="">Semua Status</option>
                    <option value="menunggu"
                        {{ request('status') === 'menunggu' ? 'selected' : '' }}>
                        Menunggu
                    </option>
                    <option value="disetujui"
                        {{ request('status') === 'disetujui' ? 'selected' : '' }}>
                        Disetujui
                    </option>
                    <option value="ditolak"
                        {{ request('status') === 'ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </select>
            </div>

            <button type="submit" class="btn-filter">
                <i class="bi bi-search"></i>
                Cari
            </button>

            <a href="{{ url('/admin/pengajuan') }}" class="btn-reset">
                Reset
            </a>
        </form>

        {{-- TABEL --}}
        <div class="pengajuan-table-wrapper">
            <table class="pengajuan-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Tempat PKL</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pengajuan ?? [] as $item)
                        @php
                            $status = strtolower($item->status ?? 'menunggu');

                            $nama = $item->user->name
                                ?? $item->nama_siswa
                                ?? '-';

                            $nis = $item->nis
                                ?? $item->user->nis
                                ?? '-';

                            $kelas = $item->kelas
                                ?? $item->user->kelas
                                ?? '-';

                            $tempat = $item->nama_perusahaan
                                ?? $item->tempat_pkl
                                ?? '-';

                            $statusClass = in_array($status, [
                                'disetujui', 'approved'
                            ]) ? 'badge-disetujui' : (
                                in_array($status, [
                                    'ditolak', 'rejected'
                                ]) ? 'badge-ditolak' : 'badge-menunggu'
                            );
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration + (($pengajuan->currentPage() ?? 1) - 1) * ($pengajuan->perPage() ?? 10) }}</td>

                            <td>
                                <div class="pengajuan-student">
                                    <div class="pengajuan-avatar">
                                        {{ strtoupper(substr($nama, 0, 1)) }}
                                    </div>
                                    <strong>{{ $nama }}</strong>
                                </div>
                            </td>

                            <td>{{ $nis }}</td>
                            <td>{{ $kelas }}</td>
                            <td>{{ $tempat }}</td>

                            <td>
                                {{ $item->created_at
                                    ? $item->created_at->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                <span class="pengajuan-badge {{ $statusClass }}">
                                    <span></span>
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>
                                <a
                                    href="{{ url('/admin/pengajuan/' . $item->id) }}"
                                    class="btn-detail"
                                    title="Lihat detail">
                                    <i class="bi bi-eye"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="pengajuan-empty">
                                    <i class="bi bi-inbox"></i>
                                    <h3>Belum ada pengajuan</h3>
                                    <p>Data pengajuan siswa akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if(isset($pengajuan) && method_exists($pengajuan, 'links'))
            <div class="pengajuan-pagination">
                {{ $pengajuan->withQueryString()->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
