<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PKL Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-page">
    <div class="auth-container">

        {{-- Bentuk lengkung putih di belakang panel kiri --}}
        <svg class="auth-shape" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <defs>
                <linearGradient id="authShapeGrad" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0" stop-color="#ffffff"/>
                    <stop offset="1" stop-color="#EAF2FF"/>
                </linearGradient>
            </defs>
            <path d="M0 0 L36 0 C40 14 57 20 57 46 C57 70 51 82 49 100 L0 100 Z"
                  fill="url(#authShapeGrad)"/>
        </svg>

        {{-- =====================================================
             PANEL KIRI: logo + ilustrasi
             ===================================================== --}}
        <section class="auth-visual">
            <div class="brand">
                <div class="brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <span>PKL <strong>Online</strong></span>
            </div>

            <div class="visual-content">
                {{-- Ilustrasi --}}
                <div class="visual-illustration">
                    <div class="illus-blob blob-back"></div>
                    <div class="illus-blob blob-front"></div>

                    <span class="bubble b1"></span>
                    <span class="bubble b2"></span>
                    <span class="bubble b3"></span>
                    <span class="bubble b4"></span>
                    <span class="bubble b5"></span>

                    <div class="illustration-card">
                        <i class="bi bi-mortarboard-fill"></i>
                        <h3>PKL</h3>
                        <span>Belajar · Berkembang · Berkarya</span>
                    </div>

                    <div class="floating-icon floating-one">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="floating-icon floating-two">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                </div>

                <h1 class="visual-caption">Mulai Langkah Menuju Masa Depan.</h1>
                <p class="visual-text">
                    Platform pengajuan Praktik Kerja Lapangan untuk siswa
                    dan admin.
                </p>
            </div>

            <div class="visual-footer">
                <span>PKL Online © {{ date('Y') }}</span>
                <span>Platform Pengajuan PKL</span>
            </div>
        </section>

        {{-- =====================================================
             PANEL KANAN: formulir login
             ===================================================== --}}
        <section class="auth-form-section">
            <div class="auth-form-wrapper">

                {{-- Logo (hanya tampil di layar kecil) --}}
                <div class="mobile-brand">
                    <div class="brand-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <span>PKL <strong>Online</strong></span>
                </div>

                <div class="form-heading">
                    <span class="form-eyebrow">SELAMAT DATANG KEMBALI</span>
                    <h2>Login</h2>
                    <p>Masuk ke akunmu untuk melanjutkan.</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div class="auth-field">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <i class="bi bi-envelope"></i>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   placeholder="Masukkan email"
                                   value="{{ old('email') }}"
                                   autocomplete="email"
                                   required autofocus>
                        </div>
                    </div>

                    <div class="auth-field">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="bi bi-lock"></i>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Masukkan password"
                                   autocomplete="current-password"
                                   required>
                            <button type="button"
                                    class="toggle-password"
                                    data-target="password"
                                    aria-label="Tampilkan password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth">
                        Masuk ke Akun
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <p class="auth-switch">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </p>

                <p class="auth-note">
                    Dengan masuk, kamu dapat mengakses fitur sesuai
                    hak akunmu.
                </p>
            </div>
        </section>

        <p class="auth-help">Ada kendala? Hubungi admin sekolah.</p>

    </div>
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(function (button) {
    button.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');

        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
});
</script>

</body>
</html>