@extends('layouts.app')

@section('title', 'Profile Siswa')
@section('page-heading', 'Profile')

@section('content')
@php
    $kosong = fn ($v) => ($v === null || $v === '') ? '-' : $v;

    $nama         = $user->name;
    $nisn         = $kosong($user->nisn);
    $kelas        = $kosong($user->kelas);
    $sekolah      = config('app.sekolah', 'SMK Negeri 2 Trenggalek');
    $jurusan      = $kosong($user->jurusan);
    $email        = $user->email;
    $telepon      = $kosong($user->telepon);
    $tempatLahir  = $kosong($user->tempat_lahir);
    $tanggalLahir = $user->tanggal_lahir ? $user->tanggal_lahir->translatedFormat('d F Y') : '-';
    $jenisKelamin = $kosong($user->jenis_kelamin);
    $alamat       = $kosong($user->alamat);
    $tempatPkl    = $pengajuan?->instansi ?? '-';
    $periodePkl   = '-';
    $pembimbing   = 'Belum ditentukan';

    $fields = [
        $nama, $nisn, $kelas, $jurusan, $email, $telepon, $tempatLahir,
        $tanggalLahir, $jenisKelamin, $alamat, $user->foto,
    ];
    $filled = count(array_filter($fields, fn ($v) => $v !== '-' && $v !== '' && $v !== null));
    $completion = (int) round(($filled / count($fields)) * 100);

    $daftarJurusan = \App\Http\Requests\StorePengajuanRequest::JURUSAN;

    // Modal mana yang harus terbuka lagi kalau validasi gagal
    $bukaModal = null;
    if ($errors->any()) {
        $bukaModal = old('_section') === 'personal' ? 'modalPersonal'
                   : (old('_section') === 'school' ? 'modalSchool'
                   : ($errors->has('foto') ? 'modalFoto' : 'modalPassword'));
    }
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
                @if ($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}"
                         alt="Foto {{ $nama }}" class="profile-avatar-image">
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
                    <span><i class="ti ti-id-badge-2"></i> NISN {{ $nisn }}</span>
                    <span><i class="ti ti-users"></i> {{ $kelas }}</span>
                </div>

                <div class="profile-school">
                    <i class="ti ti-building-community"></i>
                    {{ $sekolah }}
                </div>
            </div>
        </div>

        <div class="profile-completion">
            <div class="completion-ring" style="--completion: {{ $completion }}%">
                <div>
                    <strong>{{ $completion }}%</strong>
                </div>
            </div>

            <div class="completion-copy">
                <strong>Kelengkapan Profil</strong>
                <p>Lengkapi data pribadi dan sekolahmu agar informasi PKL lebih lengkap.</p>
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
                        <span class="profile-section-icon"><i class="ti ti-user"></i></span>
                        <div>
                            <h3>Informasi Pribadi</h3>
                            <p>Informasi dasar mengenai dirimu.</p>
                        </div>
                    </div>

                    <button type="button" class="profile-edit-button" data-open="modalPersonal">
                        <i class="ti ti-pencil"></i>
                        Edit
                    </button>
                </div>

                <div class="profile-info-grid">
                    @foreach ([
                        ['ti-user', 'Nama Lengkap', $nama],
                        ['ti-map-pin', 'Tempat Lahir', $tempatLahir],
                        ['ti-id', 'NISN', $nisn],
                        ['ti-calendar', 'Tanggal Lahir', $tanggalLahir],
                        ['ti-mail', 'Email', $email],
                        ['ti-gender-bigender', 'Jenis Kelamin', $jenisKelamin],
                        ['ti-phone', 'Nomor Telepon', $telepon],
                        ['ti-home', 'Alamat', $alamat],
                    ] as [$ikon, $label, $nilai])
                        <div class="profile-field">
                            <span class="profile-field-label">
                                <i class="ti {{ $ikon }}"></i> {{ $label }}
                            </span>
                            <div class="profile-field-value">{{ $nilai }}</div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- INFORMASI SEKOLAH DAN PKL --}}
            <section class="profile-card">
                <div class="profile-card-heading">
                    <div class="profile-card-title">
                        <span class="profile-section-icon"><i class="ti ti-school"></i></span>
                        <div>
                            <h3>Informasi Sekolah dan PKL</h3>
                            <p>Data pendidikan dan praktik kerja lapangan.</p>
                        </div>
                    </div>

                    <button type="button" class="profile-edit-button" data-open="modalSchool">
                        <i class="ti ti-pencil"></i>
                        Edit
                    </button>
                </div>

                <div class="profile-info-grid">
                    @foreach ([
                        ['ti-building', 'Nama Sekolah', $sekolah],
                        ['ti-briefcase', 'Tempat PKL', $tempatPkl],
                        ['ti-code', 'Jurusan', $jurusan],
                        ['ti-calendar-event', 'Periode PKL', $periodePkl],
                        ['ti-users', 'Kelas', $kelas],
                        ['ti-user-check', 'Guru Pembimbing', $pembimbing],
                    ] as [$ikon, $label, $nilai])
                        <div class="profile-field">
                            <span class="profile-field-label">
                                <i class="ti {{ $ikon }}"></i> {{ $label }}
                            </span>
                            <div class="profile-field-value">{{ $nilai }}</div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- INFORMASI --}}
            <div class="profile-info-notice">
                <span class="notice-icon"><i class="ti ti-bulb"></i></span>
                <div>
                    <strong>Pastikan data profil selalu terbaru</strong>
                    <p>Data yang lengkap dan benar membantu proses administrasi serta pengajuan PKL.</p>
                </div>
            </div>

        </div>

        {{-- SIDEBAR PROFILE --}}
        <aside class="profile-side-column">

            {{-- STATUS AKUN --}}
            <section class="profile-card account-status-card">
                <div class="profile-side-heading">
                    <span class="profile-section-icon"><i class="ti ti-shield-check"></i></span>
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
                    <span class="profile-section-icon"><i class="ti ti-bolt"></i></span>
                    <h3>Aksi Cepat</h3>
                </div>

                <button type="button" class="profile-action" data-open="modalPassword">
                    <span class="action-icon"><i class="ti ti-lock"></i></span>
                    <span>Ubah Password</span>
                    <i class="ti ti-chevron-right action-arrow"></i>
                </button>

                <button type="button" class="profile-action" data-open="modalPersonal">
                    <span class="action-icon"><i class="ti ti-user-edit"></i></span>
                    <span>Edit Profil</span>
                    <i class="ti ti-chevron-right action-arrow"></i>
                </button>

                <button type="button" class="profile-action" data-open="modalFoto">
                    <span class="action-icon"><i class="ti ti-camera"></i></span>
                    <span>Ganti Foto Profil</span>
                    <i class="ti ti-chevron-right action-arrow"></i>
                </button>

                @if (\Illuminate\Support\Facades\Route::has('logout'))
                    <form action="{{ route('logout') }}" method="POST"
                          onsubmit="return confirm('Yakin ingin keluar dari akun?')">
                        @csrf

                        <button type="submit" class="profile-action logout-action">
                            <span class="action-icon"><i class="ti ti-logout"></i></span>
                            <span>Keluar Akun</span>
                            <i class="ti ti-chevron-right action-arrow"></i>
                        </button>
                    </form>
                @endif
            </section>

            {{-- FOTO PROFIL --}}
            <section class="profile-card photo-card">
                <div class="profile-side-heading">
                    <span class="profile-section-icon"><i class="ti ti-camera"></i></span>
                    <h3>Foto Profil</h3>
                </div>

                <div class="photo-preview">
                    @if ($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto {{ $nama }}">
                    @else
                        <div class="photo-placeholder"><i class="ti ti-user"></i></div>
                    @endif

                    <div>
                        <strong>{{ $nama }}</strong>
                        <span>{{ $kelas }}</span>
                    </div>
                </div>

                <button type="button" class="photo-change-button" data-open="modalFoto">
                    <i class="ti ti-camera"></i>
                    Ganti Foto
                </button>

                <small class="photo-help">Format JPG atau PNG, maksimal 2 MB.</small>
            </section>

            {{-- KEAMANAN --}}
            <section class="profile-security-card">
                <span class="security-icon"><i class="ti ti-shield-lock"></i></span>
                <div>
                    <strong>Jaga Keamanan Akun</strong>
                    <p>Jangan membagikan password kepada orang lain.</p>
                </div>
            </section>

        </aside>
    </div>

    <footer class="profile-footer">
        <span>© {{ date('Y') }} PKL Online</span>
        <span>Portal Pengajuan Praktik Kerja Lapangan</span>
    </footer>

</div>

{{-- ============ MODAL: EDIT INFORMASI PRIBADI ============ --}}
<div class="pm-backdrop" id="modalPersonal" aria-hidden="true">
    <section class="pm-box pm-wide" role="dialog" aria-modal="true" aria-labelledby="titlePersonal">
        <button type="button" class="pm-close" data-close aria-label="Tutup"><i class="ti ti-x"></i></button>
        <h3 id="titlePersonal">Edit Informasi Pribadi</h3>

        <form action="{{ route('siswa.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="_section" value="personal">

            <div class="pm-grid">
                <div class="pm-group">
                    <label for="p_name">Nama Lengkap</label>
                    <input type="text" id="p_name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name') <small class="pm-error">{{ $message }}</small> @enderror
                </div>

                <div class="pm-group">
                    <label for="p_nisn">NISN</label>
                    <input type="text" id="p_nisn" name="nisn" value="{{ old('nisn', $user->nisn) }}">
                    @error('nisn') <small class="pm-error">{{ $message }}</small> @enderror
                </div>

                <div class="pm-group">
                    <label for="p_email">Email</label>
                    <input type="email" id="p_email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email') <small class="pm-error">{{ $message }}</small> @enderror
                </div>

                <div class="pm-group">
                    <label for="p_telepon">Nomor Telepon</label>
                    <input type="text" id="p_telepon" name="telepon" value="{{ old('telepon', $user->telepon) }}">
                    @error('telepon') <small class="pm-error">{{ $message }}</small> @enderror
                </div>

                <div class="pm-group">
                    <label for="p_tempat">Tempat Lahir</label>
                    <input type="text" id="p_tempat" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}">
                    @error('tempat_lahir') <small class="pm-error">{{ $message }}</small> @enderror
                </div>

                <div class="pm-group">
                    <label for="p_tgl">Tanggal Lahir</label>
                    <input type="date" id="p_tgl" name="tanggal_lahir"
                           value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}">
                    @error('tanggal_lahir') <small class="pm-error">{{ $message }}</small> @enderror
                </div>

                <div class="pm-group">
                    <label for="p_jk">Jenis Kelamin</label>
                    <select id="p_jk" name="jenis_kelamin">
                        <option value="">Pilih</option>
                        @foreach (['Laki-laki', 'Perempuan'] as $jk)
                            <option value="{{ $jk }}" @selected(old('jenis_kelamin', $user->jenis_kelamin) === $jk)>{{ $jk }}</option>
                        @endforeach
                    </select>
                    @error('jenis_kelamin') <small class="pm-error">{{ $message }}</small> @enderror
                </div>

                <div class="pm-group pm-full">
                    <label for="p_alamat">Alamat</label>
                    <textarea id="p_alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat') <small class="pm-error">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="pm-actions">
                <button type="button" class="pm-btn pm-btn-light" data-close>Batal</button>
                <button type="submit" class="pm-btn pm-btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>
</div>

{{-- ============ MODAL: EDIT SEKOLAH ============ --}}
<div class="pm-backdrop" id="modalSchool" aria-hidden="true">
    <section class="pm-box" role="dialog" aria-modal="true" aria-labelledby="titleSchool">
        <button type="button" class="pm-close" data-close aria-label="Tutup"><i class="ti ti-x"></i></button>
        <h3 id="titleSchool">Edit Informasi Sekolah</h3>

        <form action="{{ route('siswa.profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="_section" value="school">

            <div class="pm-group">
                <label for="s_kelas">Kelas</label>
                <input type="text" id="s_kelas" name="kelas" value="{{ old('kelas', $user->kelas) }}" placeholder="Contoh: XI RPL C">
                @error('kelas') <small class="pm-error">{{ $message }}</small> @enderror
            </div>

            <div class="pm-group">
                <label for="s_jurusan">Jurusan</label>
                <select id="s_jurusan" name="jurusan">
                    <option value="">Pilih jurusan</option>
                    @foreach ($daftarJurusan as $j)
                        <option value="{{ $j }}" @selected(old('jurusan', $user->jurusan) === $j)>{{ $j }}</option>
                    @endforeach
                </select>
                @error('jurusan') <small class="pm-error">{{ $message }}</small> @enderror
            </div>

            <p class="pm-hint">Tempat PKL, periode, dan guru pembimbing mengikuti data pengajuan dan ditentukan oleh sekolah.</p>

            <div class="pm-actions">
                <button type="button" class="pm-btn pm-btn-light" data-close>Batal</button>
                <button type="submit" class="pm-btn pm-btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </section>
</div>

{{-- ============ MODAL: UBAH PASSWORD ============ --}}
<div class="pm-backdrop" id="modalPassword" aria-hidden="true">
    <section class="pm-box" role="dialog" aria-modal="true" aria-labelledby="titlePassword">
        <button type="button" class="pm-close" data-close aria-label="Tutup"><i class="ti ti-x"></i></button>
        <h3 id="titlePassword">Ubah Password</h3>

        <form action="{{ route('siswa.profile.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="pm-group">
                <label for="pw_lama">Password Lama</label>
                <input type="password" id="pw_lama" name="password_lama" autocomplete="current-password" required>
                @error('password_lama') <small class="pm-error">{{ $message }}</small> @enderror
            </div>

            <div class="pm-group">
                <label for="pw_baru">Password Baru</label>
                <input type="password" id="pw_baru" name="password_baru" autocomplete="new-password" placeholder="Minimal 8 karakter" required>
                @error('password_baru') <small class="pm-error">{{ $message }}</small> @enderror
            </div>

            <div class="pm-group">
                <label for="pw_konfirmasi">Ulangi Password Baru</label>
                <input type="password" id="pw_konfirmasi" name="password_baru_confirmation" autocomplete="new-password" required>
            </div>

            <div class="pm-actions">
                <button type="button" class="pm-btn pm-btn-light" data-close>Batal</button>
                <button type="submit" class="pm-btn pm-btn-primary">Simpan Password</button>
            </div>
        </form>
    </section>
</div>

{{-- ============ MODAL: GANTI FOTO ============ --}}
<div class="pm-backdrop" id="modalFoto" aria-hidden="true">
    <section class="pm-box" role="dialog" aria-modal="true" aria-labelledby="titleFoto">
        <button type="button" class="pm-close" data-close aria-label="Tutup"><i class="ti ti-x"></i></button>
        <h3 id="titleFoto">Ganti Foto Profil</h3>

        <form action="{{ route('siswa.profile.foto') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="pm-group">
                <label for="f_foto">Pilih foto (JPG/PNG, maks. 2 MB)</label>
                <input type="file" id="f_foto" name="foto" accept="image/png,image/jpeg" required>
                @error('foto') <small class="pm-error">{{ $message }}</small> @enderror
                <small class="pm-error" id="fotoError" hidden></small>
            </div>

            <div class="pm-actions">
                <button type="button" class="pm-btn pm-btn-light" data-close>Batal</button>
                <button type="submit" class="pm-btn pm-btn-primary">Simpan Foto</button>
            </div>
        </form>
    </section>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<style>
    .pm-backdrop {
        position: fixed; inset: 0; z-index: 1000;
        display: none; align-items: center; justify-content: center;
        padding: 20px; background: rgba(15, 23, 42, .55);
        backdrop-filter: blur(4px);
    }
    .pm-backdrop.open { display: flex; }

    .pm-box {
        position: relative; width: 100%; max-width: 460px; max-height: 90vh;
        overflow-y: auto; padding: 28px; border-radius: 22px;
        background: #fff; color: #1e293b;
        box-shadow: 0 24px 60px rgba(15, 23, 42, .25);
    }
    .pm-box.pm-wide { max-width: 680px; }
    .pm-box h3 { margin: 0 0 20px; font-size: 20px; font-weight: 800; color: #172554; }

    .pm-close {
        position: absolute; top: 16px; right: 16px; width: 38px; height: 38px;
        display: grid; place-items: center; border: 0; border-radius: 11px;
        background: #eef3ff; color: #475569; font-size: 19px; cursor: pointer;
    }

    .pm-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
    .pm-full { grid-column: 1 / -1; }
    .pm-group { margin-bottom: 16px; }
    .pm-grid .pm-group { margin-bottom: 0; }
    .pm-group label { display: block; margin-bottom: 7px; font-size: 13px; font-weight: 700; color: #2b3a52; }

    .pm-group input, .pm-group select, .pm-group textarea {
        width: 100%; padding: 12px 14px; border: 1.5px solid #dbe4f3; border-radius: 12px;
        background: #f8faff; font: inherit; font-size: 14px; color: #1e293b; outline: none;
    }
    .pm-group input:focus, .pm-group select:focus, .pm-group textarea:focus {
        border-color: #2563eb; background: #fff; box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
    }

    .pm-error { display: block; margin-top: 6px; font-size: 12px; color: #dc2626; }
    .pm-hint { margin: 0 0 6px; font-size: 12.5px; line-height: 1.6; color: #6b7a93; }

    .pm-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 22px; }
    .pm-btn { padding: 12px 22px; border: 0; border-radius: 12px; font: inherit; font-size: 14px; font-weight: 700; cursor: pointer; }
    .pm-btn-light { background: #eef3ff; color: #475569; }
    .pm-btn-primary { color: #fff; background: linear-gradient(135deg, #3b82f6, #1d4ed8); }

    @media (max-width: 600px) {
        .pm-grid { grid-template-columns: 1fr; }
        .pm-box { padding: 22px; }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const open = (el) => { el.classList.add('open'); el.setAttribute('aria-hidden', 'false'); };
    const close = (el) => { el.classList.remove('open'); el.setAttribute('aria-hidden', 'true'); };

    document.querySelectorAll('[data-open]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const modal = document.getElementById(btn.dataset.open);
            if (modal) open(modal);
        });
    });

    document.querySelectorAll('.pm-backdrop').forEach((modal) => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal || e.target.closest('[data-close]')) close(modal);
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') document.querySelectorAll('.pm-backdrop.open').forEach(close);
    });

    // Cek ukuran/tipe foto sebelum dikirim
    const foto = document.getElementById('f_foto');
    const fotoError = document.getElementById('fotoError');
    if (foto) {
        foto.addEventListener('change', () => {
            const f = foto.files[0];
            fotoError.hidden = true;
            if (!f) return;
            if (!['image/jpeg', 'image/png'].includes(f.type)) {
                fotoError.textContent = 'Foto harus berformat JPG atau PNG.';
            } else if (f.size > 2 * 1024 * 1024) {
                fotoError.textContent = 'Ukuran foto maksimal 2 MB.';
            } else {
                return;
            }
            fotoError.hidden = false;
            foto.value = '';
        });
    }

    // Buka lagi modal yang validasinya gagal
    @if ($bukaModal)
        const reopen = document.getElementById(@json($bukaModal));
        if (reopen) open(reopen);
    @endif
});
</script>
@endpush