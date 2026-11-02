@extends('layouts.app')

@section('title', 'Cek Status Pengajuan PKL')
@section('page-heading', 'Cek Status Pengajuan PKL')

@section('content')
<div class="cek-status-page">

    {{-- HERO SECTION --}}
    <section class="hero-section reveal">
        <div class="hero-copy">
            <span class="eyebrow">
                <i class="ti ti-clipboard-check"></i>
                INFORMASI PENGAJUAN
            </span>

            <h2>Pantau Perjalanan Pengajuan PKL-mu</h2>

            <p>
                Lihat perkembangan pengajuan PKL, periksa status persetujuan,
                dan temukan informasi pengajuanmu dengan mudah.
            </p>

            <a href="{{ url('/pengajuan-pkl') }}" class="hero-button">
                <i class="ti ti-file-plus"></i>
                Buat Pengajuan
                <i class="ti ti-arrow-up-right"></i>
            </a>
        </div>

        <div class="hero-illustration" aria-hidden="true">
            <div class="orbit orbit-one"></div>
            <div class="orbit orbit-two"></div>

            <div class="floating-card floating-card-one">
                <i class="ti ti-file-check"></i>
            </div>

            <div class="floating-card floating-card-two">
                <i class="ti ti-circle-check"></i>
            </div>

            <div class="hero-document">
                <i class="ti ti-file-description"></i>
                <span></span>
                <span></span>
                <span></span>

                <div class="document-check">
                    <i class="ti ti-check"></i>
                </div>
            </div>
        </div>
    </section>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="alert alert-success">
            <i class="ti ti-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error">
            <i class="ti ti-alert-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- STATISTIK --}}
    <section class="stats-grid">

        <article class="stat-card stat-total reveal">
            <div class="stat-top">
                <span class="stat-icon">
                    <i class="ti ti-files"></i>
                </span>
                <span class="stat-caption">Keseluruhan</span>
            </div>

            <span class="stat-label">Total Pengajuan</span>
            <strong class="stat-number">
                {{ $statistik['total'] ?? 0 }}
            </strong>
            <span class="stat-description">Pengajuan yang tercatat</span>
            <div class="stat-decoration"></div>
        </article>

        <article class="stat-card stat-waiting reveal">
            <div class="stat-top">
                <span class="stat-icon">
                    <i class="ti ti-clock-hour-4"></i>
                </span>
                <span class="stat-caption">Dalam proses</span>
            </div>

            <span class="stat-label">Menunggu</span>
            <strong class="stat-number">
                {{ $statistik['menunggu'] ?? 0 }}
            </strong>
            <span class="stat-description">Menanti pemeriksaan</span>
            <div class="stat-decoration"></div>
        </article>

        <article class="stat-card stat-approved reveal">
            <div class="stat-top">
                <span class="stat-icon">
                    <i class="ti ti-circle-check"></i>
                </span>
                <span class="stat-caption">Berhasil</span>
            </div>

            <span class="stat-label">Disetujui</span>
            <strong class="stat-number">
                {{ $statistik['disetujui'] ?? 0 }}
            </strong>
            <span class="stat-description">Pengajuan diterima</span>
            <div class="stat-decoration"></div>
        </article>

        <article class="stat-card stat-rejected reveal">
            <div class="stat-top">
                <span class="stat-icon">
                    <i class="ti ti-circle-x"></i>
                </span>
                <span class="stat-caption">Perlu diperiksa</span>
            </div>

            <span class="stat-label">Ditolak</span>
            <strong class="stat-number">
                {{ $statistik['ditolak'] ?? 0 }}
            </strong>
            <span class="stat-description">Perlu tindak lanjut</span>
            <div class="stat-decoration"></div>
        </article>

    </section>

    {{-- RIWAYAT PENGAJUAN --}}
    <section class="history-panel reveal">

        <div class="panel-heading">
            <div>
                <span class="section-label">RIWAYAT PENGAJUAN</span>
                <h2>Daftar Pengajuan PKL</h2>
                <p>Periksa status terbaru dari setiap pengajuanmu.</p>
            </div>

            <label class="search-box">
                <i class="ti ti-search"></i>
                <input
                    type="search"
                    id="searchInput"
                    placeholder="Cari nama instansi..."
                    aria-label="Cari nama instansi"
                >
            </label>
        </div>

        {{-- FILTER STATUS --}}
        <div class="filter-bar">
            <button type="button" class="filter-button active" data-filter="Semua">
                Semua
            </button>

            <button type="button" class="filter-button" data-filter="Menunggu">
                Menunggu
            </button>

            <button type="button" class="filter-button" data-filter="Disetujui">
                Disetujui
            </button>

            <button type="button" class="filter-button" data-filter="Ditolak">
                Ditolak
            </button>
        </div>

        {{-- TABEL --}}
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Instansi</th>
                        <th>Periode PKL</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="applicationTable">
                    @forelse ($pengajuan as $index => $item)

                        @php
                            $status = $item['status'] ?? 'Menunggu';

                            $statusClass = match ($status) {
                                'Disetujui' => 'approved',
                                'Ditolak' => 'rejected',
                                default => 'waiting',
                            };
                        @endphp

                        <tr
                            class="application-row"
                            data-status="{{ $status }}"
                            data-search="{{ strtolower(($item['instansi'] ?? '') . ' ' . ($item['periode'] ?? '')) }}"
                        >
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <div class="company-cell">
                                    <span class="company-icon">
                                        <i class="ti ti-building"></i>
                                    </span>

                                    <div>
                                        <strong>
                                            {{ $item['instansi'] ?? 'Nama Instansi' }}
                                        </strong>
                                        <small>Tempat Praktik Kerja Lapangan</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                {{ $item['periode'] ?? 'Belum ditentukan' }}
                            </td>

                            <td>
                                {{ $item['tanggal'] ?? '—' }}
                            </td>

                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    <span class="status-dot"></span>
                                    {{ $status }}
                                </span>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="detail-button"
                                    data-instansi="{{ $item['instansi'] ?? '—' }}"
                                    data-periode="{{ $item['periode'] ?? '—' }}"
                                    data-tanggal="{{ $item['tanggal'] ?? '—' }}"
                                    data-status="{{ $status }}"
                                    data-pembimbing="{{ $item['pembimbing'] ?? 'Belum ditentukan' }}"
                                    data-catatan="{{ $item['catatan'] ?? 'Belum ada catatan dari pembimbing.' }}"
                                >
                                    Detail
                                    <i class="ti ti-arrow-up-right"></i>
                                </button>
                            </td>
                        </tr>

                    @empty

                        <tr class="empty-row">
                            <td colspan="6">
                                <div class="empty-state">
                                    <span class="empty-icon">
                                        <i class="ti ti-folder-search"></i>
                                    </span>

                                    <strong>Belum ada pengajuan PKL</strong>

                                    <p>
                                        Pengajuan yang kamu buat akan muncul
                                        di halaman ini.
                                    </p>

                                    <a
                                        href="{{ url('/pengajuan-pkl') }}"
                                        class="empty-button"
                                    >
                                        Buat Pengajuan
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span>
                <i class="ti ti-shield-check"></i>
                Informasi pengajuan ditampilkan sesuai data yang tersedia.
            </span>

            <span id="resultCount">
                {{ count($pengajuan) }} pengajuan
            </span>
        </div>

        <div class="no-results" id="noResults" hidden>
            <i class="ti ti-search-off"></i>
            <span>Pengajuan tidak ditemukan.</span>
        </div>

    </section>

    {{-- INFORMASI STATUS --}}
    <section class="notice-card reveal">
        <span class="notice-icon">
            <i class="ti ti-info-circle"></i>
        </span>

        <div>
            <strong>Informasi status pengajuan</strong>

            <p>
                Jika pengajuan masih menunggu, silakan tunggu proses pemeriksaan.
                Untuk status ditolak atau jika membutuhkan informasi lebih lanjut,
                hubungi guru pembimbing.
            </p>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="page-footer">
        <span>© {{ date('Y') }} PKL Online</span>
        <span>Portal Pengajuan Praktik Kerja Lapangan</span>
    </footer>

</div>

{{-- MODAL DETAIL PENGAJUAN --}}
<div class="modal-backdrop" id="detailModal" aria-hidden="true">
    <section
        class="detail-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modalTitle"
    >
        <div class="modal-heading">
            <div>
                <span class="section-label">INFORMASI PENGAJUAN</span>
                <h2 id="modalTitle">Detail Pengajuan</h2>
            </div>

            <button
                type="button"
                class="modal-close"
                id="closeModal"
                aria-label="Tutup detail"
            >
                <i class="ti ti-x"></i>
            </button>
        </div>

        <div class="modal-company">
            <span class="company-icon modal-company-icon">
                <i class="ti ti-building"></i>
            </span>

            <div>
                <small>Nama Instansi</small>
                <strong id="modalInstansi">—</strong>
            </div>
        </div>

        <div class="detail-list">
            <div>
                <span>Periode PKL</span>
                <strong id="modalPeriode">—</strong>
            </div>

            <div>
                <span>Tanggal Pengajuan</span>
                <strong id="modalTanggal">—</strong>
            </div>

            <div>
                <span>Guru Pembimbing</span>
                <strong id="modalPembimbing">—</strong>
            </div>

            <div>
                <span>Status Pengajuan</span>
                <strong id="modalStatus">—</strong>
            </div>
        </div>

        <div class="modal-note">
            <i class="ti ti-message-circle"></i>

            <div>
                <strong>Catatan Pembimbing</strong>
                <p id="modalCatatan">—</p>
            </div>
        </div>

        <button type="button" class="modal-done" id="doneModal">
            Tutup Detail
        </button>
    </section>
</div>
@endsection

{{-- CSS HALAMAN CEK STATUS --}}
@push('styles')
<link rel="stylesheet" href="{{ asset('css/cek-status.css') }}">
@endpush

{{-- JAVASCRIPT HALAMAN CEK STATUS --}}
@push('scripts')
<script src="{{ asset('js/cek-status.js') }}"></script>
@endpush