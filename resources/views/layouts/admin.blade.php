<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin PKL Online')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

    <div class="admin-wrapper">

        {{-- =====================================================
             SIDEBAR
             Class "active" otomatis menyala sesuai URL halaman.
             Tanda * membuat menu tetap aktif di halaman turunan
             (contoh: /admin/pengajuan/5).
             ===================================================== --}}
        <aside class="admin-sidebar">

            {{-- Logo --}}
            <a href="{{ url('/admin/dashboard') }}" class="brand">
                <span class="brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </span>
                <span>PKL Online</span>
            </a>

            {{-- Grup: MENU UTAMA --}}
            <div class="sidebar-label">MENU UTAMA</div>

            <a href="{{ url('/admin/dashboard') }}"
               class="sidebar-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/admin/pengajuan') }}"
               class="sidebar-link {{ request()->is('admin/pengajuan*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check"></i>
                <span>Data Pengajuan</span>
            </a>

            <a href="{{ url('/admin/laporan') }}"
               class="sidebar-link {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-check"></i>
                <span>Verifikasi Laporan</span>
            </a>

            <a href="{{ url('/admin/siswa') }}"
               class="sidebar-link {{ request()->is('admin/siswa*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Data Siswa</span>
            </a>

            {{-- Grup: PREFERENSI --}}
            <div class="sidebar-label mt-4">PREFERENSI</div>

            <a href="{{ url('/admin/pengaturan') }}"
               class="sidebar-link {{ request()->is('admin/pengaturan*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>

            <a href="{{ url('/login') }}" class="sidebar-link">
                <i class="bi bi-box-arrow-left"></i>
                <span>Keluar</span>
            </a>

            {{-- Kartu admin di bawah sidebar --}}
            <div class="sidebar-footer">
                <div class="admin-avatar">A</div>
                <div>
                    <div class="admin-name">Administrator</div>
                    <div class="admin-role">Pengelola PKL</div>
                </div>
            </div>
        </aside>

        {{-- =====================================================
             AREA KONTEN
             ===================================================== --}}
        <main class="admin-main">

            {{-- Topbar --}}
            <header class="topbar">
                <div>
                    <div class="topbar-caption">Sistem Informasi PKL</div>
                    <div class="topbar-heading">@yield('page-heading', 'Dashboard')</div>
                </div>

                <div class="topbar-right">
                    <span class="online-dot"></span>
                    <span class="topbar-admin">Admin</span>
                    <i class="bi bi-person-circle fs-4"></i>
                </div>
            </header>

            {{-- Isi halaman --}}
            <section class="page-content">
                @yield('content')
            </section>

            {{-- Footer --}}
            <footer class="admin-footer">
                &copy; {{ date('Y') }} PKL Online. Sistem Pengajuan dan Laporan PKL.
            </footer>
        </main>
    </div>

</body>
</html>