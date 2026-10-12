
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Siswa PKL')</title>

   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css"
>

<link rel="stylesheet" href="{{ asset('css/dashboard-siswa.css') }}">

@stack('styles')
</head>
<body>

<div class="dashboard-wrapper">

    {{-- SIDEBAR --}}
    <aside class="side" id="sidebar">
        <div class="brand">
            <div class="brand-icon">
                <i class="ti ti-school"></i>
            </div>

            <div class="brand-light">
                <strong>PKL Siswa</strong>
                <small>Dashboard Akademik</small>
            </div>
        </div>

        <div class="sidebar-label">MENU UTAMA</div>

        <nav class="nav">
            <a href="{{ url('/dashboard-siswa') }}"
               class="{{ request()->is('dashboard-siswa') ? 'active' : '' }}">
                <i class="ti ti-layout-dashboard"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/pengajuan-pkl') }}"
               class="{{ request()->is('pengajuan-pkl') ? 'active' : '' }}">
                <i class="ti ti-file-pencil"></i>
                <span>Pengajuan PKL</span>
            </a>

            <a href="{{ url('/upload-laporan') }}"
               class="{{ request()->is('upload-laporan') ? 'active' : '' }}">
                <i class="ti ti-file-upload"></i>
                <span>Upload Laporan</span>
            </a>

            <a href="{{ url('/cek-status') }}"
               class="{{ request()->is('cek-status') ? 'active' : '' }}">
                <i class="ti ti-clipboard-check"></i>
                <span>Cek Status</span>
            </a>

            <a href="{{ url('/profile') }}"
               class="{{ request()->is('profile') ? 'active' : '' }}">
                <i class="ti ti-user-circle"></i>
                <span>Profil Saya</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="help-card">
                <div class="help-icon">
                    <i class="ti ti-help-circle"></i>
                </div>

                <strong>Butuh Bantuan?</strong>
                <p>Hubungi guru pembimbing jika mengalami kendala.</p>
            </div>

            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="ti ti-logout"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        {{-- NAVBAR --}}
        <header class="top">
            <div class="top-left">
                <button type="button"
                        class="menu-toggle"
                        id="menuToggle"
                        aria-label="Buka menu">
                    <i class="ti ti-menu-2"></i>
                </button>

                <div>
                    <strong>@yield('page-heading', 'Dashboard Siswa')</strong>
                  <p>
    <span>Dashboard</span>
    <i class="ti ti-chevron-right"></i>
    @yield('page-heading', 'Beranda')
</p>
                </div>
            </div>

            <div class="top-right">
                <div class="user">
                    <div class="avatar">
                        <i class="ti ti-user"></i>
                    </div>

                    <div class="user-info">
                        <strong>{{ $siswa['nama'] ?? auth()->user()?->name ?? 'Siswa' }}</strong>
                        <small>{{ $siswa['kelas'] ?? 'Siswa PKL' }}</small>
                    </div>
                </div>
            </div>
        </header>

        {{-- ISI HALAMAN --}}
        <div class="content">
            @yield('content')
        </div>

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    if (menuToggle && sidebar && overlay) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }
});
</script>

@stack('scripts')

</body>
</html>
