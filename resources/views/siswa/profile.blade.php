@extends('layouts.app')

@section('title', 'Profile Siswa')
@section('page-heading', 'Profile')

@section('content')
@php
    $profile = $profile ?? [];

    $nama = $profile['nama'] ?? ($siswa['nama'] ?? 'Siswa');
    $nisn = $profile['nisn'] ?? '-';
    $kelas = $profile['kelas'] ?? ($siswa['kelas'] ?? '-');
    $sekolah = $profile['sekolah'] ?? 'SMK Negeri 2 Trenggalek';
    $jurusan = $profile['jurusan'] ?? 'Rekayasa Perangkat Lunak (RPL)';
    $email = $profile['email'] ?? '-';
    $telepon = $profile['telepon'] ?? '-';
    $tempatLahir = $profile['tempat_lahir'] ?? '-';
    $tanggalLahir = $profile['tanggal_lahir'] ?? '-';
    $jenisKelamin = $profile['jenis_kelamin'] ?? '-';
    $alamat = $profile['alamat'] ?? '-';
    $tempatPkl = $profile['tempat_pkl'] ?? 'PT Hummatech';
    $periodePkl = $profile['periode_pkl'] ?? '1 Juli 2026 - 31 Desember 2026';
    $pembimbing = $profile['pembimbing'] ?? 'Belum ditentukan';

    $fields = [
        $nama, $nisn, $kelas, $sekolah, $jurusan,
        $email, $telepon, $tempatLahir, $tanggalLahir,
        $jenisKelamin, $alamat, $tempatPkl, $periodePkl,
        $pembimbing
    ];

    $filled = count(array_filter($fields, function ($value) {
        return $value !== '-' && $value !== '' && $value !== null;
    }));

    $completion = (int) round(($filled / count($fields)) * 100);
@endphp

<div class="profile-page">

    {{-- HEADER --}}
    <div class="profile-page-heading">
        <div>
            <span class="profile-eyebrow">
                <i class="ti ti-user-circle"></i>
                AKUN SISWA
            </span>
            <h2>Profil Saya</h2>
            <p>Kelola informasi pribadi, sekolah, dan data PKL kamu.</p>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="profile-alert success">
            <i class="ti ti-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="profile-alert error">
            <i class="ti ti-alert-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- HERO PROFILE --}}
    <section class="profile-hero">
        <div class="profile-hero-decoration decoration-one"></div>
        <div class="profile-hero-decoration decoration-two"></div>

        <div class="profile-identity">
            <div class="profile-avatar-wrap">
                @if (!empty($profile['foto']))
                    <img
                        src="{{ asset('storage/' . $profile['foto']) }}"
                        alt="Foto {{ $nama }}"
                        class="profile-avatar-image"
                    >
                @else
                    <div class="profile-avatar-placeholder">
                        <i class="ti ti-user"></i>
                    </div>
                @endif

                <span class="profile-avatar-status"></span>
            </div>

            <div class="profile-identity-info">
                <span class="profile-student-label">
                    <i class="ti ti-school"></i>
                    SISWA PKL
                </span>

                <h2>{{ $nama }}</h2>

                <span class="profile-active-badge">
                    <span></span>
                    Aktif
                </span>

                <div class="profile-meta">
                    <span>
                        <i class="ti ti-id-badge-2"></i>
                        NISN {{ $nisn }}
                    </span>

                    <span>
                        <i class="ti ti-users"></i>
                        {{ $kelas }}
                    </span>
                </div>

                <div class="profile-school">
                    <i class="ti ti-building-community"></i>
                    {{ $sekolah }}
                </div>
            </div>
        </div>

        <div class="profile-completion">
            <div class="completion-ring"
                 style="--completion: {{ $completion }}%">
                <div>
                    <strong>{{ $completion }}%</strong>
                </div>
            </div>

            <div class="completion-copy">
                <strong>Kelengkapan Profil</strong>
                <p>
                    Lengkapi data pribadi dan sekolahmu agar informasi
                    PKL lebih lengkap.
                </p>
            </div>
        </div>
    </section>

    {{-- GRID UTAMA --}}
    <div class="profile-layout">

        <div class="profile-main-column">

            {{-- INFORMASI PRIBADI --}}
            <section class="profile-card">
                <div class="profile-card-heading">
                    <div class="profile-card-title">
                        <span class="profile-section-icon">
                            <i class="ti ti-user"></i>
                        </span>

                        <div>
                            <h3>Informasi Pribadi</h3>
                            <p>Informasi dasar mengenai dirimu.</p>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="profile-edit-button"
                        data-edit-section="personal"
                    >
                        <i class="ti ti-pencil"></i>
                        Edit
                    </button>
                </div>

                <div class="profile-info-grid">
                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-user"></i> Nama Lengkap
                        </span>
                        <div class="profile-field-value">{{ $nama }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-map-pin"></i> Tempat Lahir
                        </span>
                        <div class="profile-field-value">{{ $tempatLahir }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-id"></i> NISN
                        </span>
                        <div class="profile-field-value">{{ $nisn }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-calendar"></i> Tanggal Lahir
                        </span>
                        <div class="profile-field-value">{{ $tanggalLahir }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-mail"></i> Email
                        </span>
                        <div class="profile-field-value">{{ $email }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-gender-bigender"></i> Jenis Kelamin
                        </span>
                        <div class="profile-field-value">{{ $jenisKelamin }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-phone"></i> Nomor Telepon
                        </span>
                        <div class="profile-field-value">{{ $telepon }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-home"></i> Alamat
                        </span>
                        <div class="profile-field-value">{{ $alamat }}</div>
                    </div>
                </div>
            </section>

            {{-- INFORMASI SEKOLAH DAN PKL --}}
            <section class="profile-card">
                <div class="profile-card-heading">
                    <div class="profile-card-title">
                        <span class="profile-section-icon">
                            <i class="ti ti-school"></i>
                        </span>

                        <div>
                            <h3>Informasi Sekolah dan PKL</h3>
                            <p>Data pendidikan dan praktik kerja lapangan.</p>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="profile-edit-button"
                        data-edit-section="school"
                    >
                        <i class="ti ti-pencil"></i>
                        Edit
                    </button>
                </div>

                <div class="profile-info-grid">
                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-building"></i> Nama Sekolah
                        </span>
                        <div class="profile-field-value">{{ $sekolah }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-briefcase"></i> Tempat PKL
                        </span>
                        <div class="profile-field-value">{{ $tempatPkl }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-code"></i> Jurusan
                        </span>
                        <div class="profile-field-value">{{ $jurusan }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-calendar-event"></i> Periode PKL
                        </span>
                        <div class="profile-field-value">{{ $periodePkl }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-users"></i> Kelas
                        </span>
                        <div class="profile-field-value">{{ $kelas }}</div>
                    </div>

                    <div class="profile-field">
                        <span class="profile-field-label">
                            <i class="ti ti-user-check"></i> Guru Pembimbing
                        </span>
                        <div class="profile-field-value">{{ $pembimbing }}</div>
                    </div>
                </div>
            </section>

            {{-- INFORMASI --}}
            <div class="profile-info-notice">
                <span class="notice-icon">
                    <i class="ti ti-bulb"></i>
                </span>

                <div>
                    <strong>Pastikan data profil selalu terbaru</strong>
                    <p>
                        Data yang lengkap dan benar membantu proses administrasi
                        serta pengajuan PKL.
                    </p>
                </div>
            </div>

        </div>

        {{-- SIDEBAR PROFILE --}}
        <aside class="profile-side-column">

            {{-- STATUS AKUN --}}
            <section class="profile-card account-status-card">
                <div class="profile-side-heading">
                    <span class="profile-section-icon">
                        <i class="ti ti-shield-check"></i>
                    </span>
                    <h3>Status Akun</h3>
                </div>

                <span class="profile-active-badge">
                    <span></span>
                    Aktif
                </span>

                <p>Akun kamu siap digunakan untuk mengakses layanan PKL Online.</p>
            </section>

            {{-- AKSI CEPAT --}}
            <section class="profile-card quick-actions-card">
                <div class="profile-side-heading">
                    <span class="profile-section-icon">
                        <i class="ti ti-bolt"></i>
                    </span>
                    <h3>Aksi Cepat</h3>
                </div>

                <button
                    type="button"
                    class="profile-action"
                    data-profile-action="password"
                >
                    <span class="action-icon">
                        <i class="ti ti-lock"></i>
                    </span>
                    <span>Ubah Password</span>
                    <i class="ti ti-chevron-right action-arrow"></i>
                </button>

                <button
                    type="button"
                    class="profile-action"
                    data-edit-section="personal"
                >
                    <span class="action-icon">
                        <i class="ti ti-user-edit"></i>
                    </span>
                    <span>Edit Profil</span>
                    <i class="ti ti-chevron-right action-arrow"></i>
                </button>

                <button
                    type="button"
                    class="profile-action"
                    data-profile-action="photo"
                >
                    <span class="action-icon">
                        <i class="ti ti-camera"></i>
                    </span>
                    <span>Ganti Foto Profil</span>
                    <i class="ti ti-chevron-right action-arrow"></i>
                </button>

                @if (\Illuminate\Support\Facades\Route::has('logout'))
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin keluar dari akun?')"
                    >
                        @csrf

                        <button type="submit" class="profile-action logout-action">
                            <span class="action-icon">
                                <i class="ti ti-logout"></i>
                            </span>
                            <span>Keluar Akun</span>
                            <i class="ti ti-chevron-right action-arrow"></i>
                        </button>
                    </form>
                @endif
            </section>

            {{-- FOTO PROFIL --}}
            <section class="profile-card photo-card">
                <div class="profile-side-heading">
                    <span class="profile-section-icon">
                        <i class="ti ti-camera"></i>
                    </span>
                    <h3>Foto Profil</h3>
                </div>

                <div class="photo-preview">
                    @if (!empty($profile['foto']))
                        <img
                            src="{{ asset('storage/' . $profile['foto']) }}"
                            alt="Foto {{ $nama }}"
                        >
                    @else
                        <div class="photo-placeholder">
                            <i class="ti ti-user"></i>
                        </div>
                    @endif

                    <div>
                        <strong>{{ $nama }}</strong>
                        <span>{{ $kelas }}</span>
                    </div>
                </div>

                <button
                    type="button"
                    class="photo-change-button"
                    data-profile-action="photo"
                >
                    <i class="ti ti-camera"></i>
                    Ganti Foto
                </button>

                <small class="photo-help">Format JPG atau PNG, maksimal 2 MB.</small>
            </section>

            {{-- KEAMANAN --}}
            <section class="profile-security-card">
                <span class="security-icon">
                    <i class="ti ti-shield-lock"></i>
                </span>

                <div>
                    <strong>Jaga Keamanan Akun</strong>
                    <p>
                        Jangan membagikan password kepada orang lain.
                    </p>
                </div>
            </section>

        </aside>
    </div>

    <footer class="profile-footer">
        <span>© {{ date('Y') }} PKL Online</span>
        <span>Portal Pengajuan Praktik Kerja Lapangan</span>
    </footer>

</div>

{{-- MODAL INFORMASI AKSI --}}
<div class="profile-modal-backdrop" id="profileActionModal" aria-hidden="true">
    <section
        class="profile-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="profileModalTitle"
    >
        <button
            type="button"
            class="profile-modal-close"
            id="closeProfileModal"
            aria-label="Tutup"
        >
            <i class="ti ti-x"></i>
        </button>

        <span class="profile-modal-icon">
            <i class="ti ti-info-circle" id="profileModalIcon"></i>
        </span>

        <h3 id="profileModalTitle">Informasi</h3>
        <p id="profileModalMessage"></p>

        <button type="button" class="profile-modal-button" id="confirmProfileModal">
            Mengerti
        </button>
    </section>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/profile.js') }}"></script>
@endpush