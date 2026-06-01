<header class="admin-nav-header">
    <div class="admin-nav-container">

        <a href="{{ route('admin.dashboard') }}" class="admin-nav-brand">
            <span class="admin-nav-logo">🛡️</span>

            <span class="admin-nav-brand-text">
                <span class="admin-nav-title">E-SAPO Admin</span>
                <span class="admin-nav-subtitle">Panel Pengelolaan Laporan</span>
            </span>
        </a>

        <nav class="admin-nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-link">
                Dashboard
            </a>

            <a href="{{ route('admin.pengaduan.index') }}" class="admin-nav-button">
                📋 Kelola Pengaduan
            </a>

            <span class="admin-nav-user">
                Halo, <strong id="admin-navbar-name">Admin</strong>
            </span>

            <button type="button" onclick="adminLogout()" class="admin-nav-danger">
                Keluar
            </button>
        </nav>

    </div>
</header>