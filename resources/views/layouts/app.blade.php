
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'PKL Online')</title>

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
                <strong>PKL</strong>
                <span>Online</span>
            </div>
        </div>

        <div class="sidebar-label">MENU UTAMA</div>

        <nav class="nav" aria-label="Navigasi utama">

            <a href="{{ route('siswa.dashboard') }}"
               class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}"
               @if(request()->routeIs('siswa.dashboard')) aria-current="page" @endif>
                <i class="ti ti-layout-dashboard"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('siswa.pengajuan') }}"
               class="{{ request()->routeIs('siswa.pengajuan') ? 'active' : '' }}"
               @if(request()->routeIs('siswa.pengajuan')) aria-current="page" @endif>
                <i class="ti ti-file-plus"></i>
                <span>Pengajuan PKL</span>
            </a>

            <a href="{{ route('siswa.laporan.index') }}"
               class="{{ request()->routeIs('siswa.laporan.*') ? 'active' : '' }}"
               @if(request()->routeIs('siswa.laporan.*')) aria-current="page" @endif>
                <i class="ti ti-cloud-upload"></i>
                <span>Upload Laporan</span>
            </a>

            <a href="{{ url('/cek-status') }}"
               class="{{ request()->is('cek-status') ? 'active' : '' }}"
               @if(request()->is('cek-status')) aria-current="page" @endif>
                <i class="ti ti-clipboard-check"></i>
                <span>Cek Status</span>
            </a>

            <a href="{{ url('/profile') }}"
               class="{{ request()->is('profile') ? 'active' : '' }}"
               @if(request()->is('profile')) aria-current="page" @endif>
                <i class="ti ti-user-circle"></i>
                <span>Profile</span>
            </a>

        </nav>

        <div class="sidebar-bottom">

            <div class="help-card">
                <div class="help-icon">
                    <i class="ti ti-headset"></i>
                </div>

                <strong>Butuh bantuan?</strong>

                <p>
                    Hubungi guru pembimbing jika mengalami kendala.
                </p>
            </div>

            {{-- Aktifkan form logout jika route logout sudah tersedia --}}
            @if(\Illuminate\Support\Facades\Route::has('logout'))
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="logout-button">
                        <i class="ti ti-logout"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            @endif

        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        {{-- NAVBAR --}}
        <header class="top">

            <div class="top-left">

                <button
                    type="button"
                    class="menu-toggle"
                    id="menuToggle"
                    aria-label="Buka menu"
                    aria-controls="sidebar"
                    aria-expanded="false"
                >
                    <i class="ti ti-menu-2"></i>
                </button>

                <div>
                    <strong>
                        @yield('page-heading', 'Dashboard')
                    </strong>

                    <p>
                        <span>PKL Online</span>
                        <i class="ti ti-chevron-right"></i>
                        <span>@yield('page-heading', 'Dashboard')</span>
                    </p>
                </div>

            </div>

            <div class="top-right">
                <div class="user">

                    <div class="avatar">
                        <i class="ti ti-user"></i>
                    </div>

                    <div class="user-info">
                        <strong>
                            {{ $siswa['nama'] ?? auth()->user()?->name ?? 'Siswa' }}
                        </strong>

                        <small>
                            {{ $siswa['kelas'] ?? 'Siswa PKL' }}
                        </small>
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

    if (!menuToggle || !sidebar || !overlay) {
        return;
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        menuToggle.setAttribute('aria-expanded', 'false');
    }

    menuToggle.addEventListener('click', function () {
        const isOpen = sidebar.classList.toggle('show');

        overlay.classList.toggle('show', isOpen);
        menuToggle.setAttribute('aria-expanded', String(isOpen));
    });

    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeSidebar();
        }
    });
});
</script>

@stack('scripts')

</body>
</html>
