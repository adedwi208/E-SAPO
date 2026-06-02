<style>
    .admin-nav-header {
        position: sticky;
        top: 0;
        z-index: 999;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(255, 255, 255, 0.88));
        backdrop-filter: blur(18px);
        border-bottom: 1px solid rgba(16, 32, 24, 0.08);
        box-shadow: 0 10px 32px rgba(18, 34, 25, 0.06);
    }

    .admin-nav-container {
        width: min(1160px, calc(100% - 34px));
        height: 76px;
        margin-inline: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
    }

    .admin-nav-brand {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        color: #102018;
        text-decoration: none;
        min-width: 0;
        transition: 0.22s ease;
    }

    .admin-nav-brand:hover {
        transform: translateY(-1px);
    }

    .admin-nav-logo {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        background:
            radial-gradient(circle at 30% 20%, rgba(255,255,255,0.95), transparent 38%),
            linear-gradient(135deg, #def8e9 0%, #ffffff 100%);
        border: 1px solid rgba(22, 167, 101, 0.20);
        box-shadow: 0 10px 24px rgba(22, 167, 101, 0.12);
        font-size: 22px;
    }

    .admin-nav-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.1;
        min-width: 0;
    }

    .admin-nav-title {
        color: #16a765;
        font-size: 21px;
        font-weight: 950;
        letter-spacing: -0.045em;
        white-space: nowrap;
    }

    .admin-nav-subtitle {
        margin-top: 4px;
        color: #6d7c72;
        font-size: 11px;
        font-weight: 750;
        letter-spacing: 0.035em;
        white-space: nowrap;
    }

    .admin-nav-right {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .admin-nav-menu {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 9px;
        min-width: 0;
    }

    .admin-nav-link,
    .admin-nav-button,
    .admin-nav-ghost,
    .admin-nav-danger {
        min-height: 42px;
        padding: 0 14px;
        border-radius: 14px;
        border: none;
        outline: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
        transition: 0.22s ease;
        white-space: nowrap;
    }

    .admin-nav-link {
        color: #25362c;
        background: transparent;
    }

    .admin-nav-link:hover,
    .admin-nav-link.active {
        color: #087a48;
        background: #edf7ef;
    }

    .admin-nav-button {
        color: #ffffff;
        background: #16a765;
        box-shadow: 0 12px 24px rgba(22, 167, 101, 0.22);
    }

    .admin-nav-button:hover,
    .admin-nav-button.active {
        background: #087a48;
        transform: translateY(-1px);
    }

    .admin-nav-ghost {
        color: #102018;
        background: #f3f7f1;
        border: 1px solid rgba(16, 32, 24, 0.08);
    }

    .admin-nav-ghost:hover {
        color: #087a48;
        background: #eaf3e9;
        transform: translateY(-1px);
    }

    .admin-nav-danger {
        color: #dc2626;
        background: #fff1f2;
    }

    .admin-nav-danger:hover {
        color: #991b1b;
        background: #ffe4e6;
        transform: translateY(-1px);
    }

    .admin-nav-user {
        min-height: 42px;
        max-width: 235px;
        padding: 0 14px;
        border-radius: 999px;
        border: 1px solid rgba(22, 167, 101, 0.16);
        background: #def8e9;
        color: #102018;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        font-size: 13px;
        font-weight: 750;
        white-space: nowrap;
        min-width: 0;
    }

    .admin-nav-user-icon {
        width: 25px;
        height: 25px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        background: #ffffff;
        color: #087a48;
        font-size: 12px;
        font-weight: 950;
        flex: 0 0 25px;
    }

    .admin-nav-user strong {
        color: #087a48;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .admin-nav-toggle {
        width: 43px;
        height: 43px;
        border: none;
        outline: none;
        border-radius: 15px;
        background: #f1f5ee;
        color: #102018;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 20px;
        transition: 0.22s ease;
    }

    .admin-nav-toggle:hover {
        background: #e8f0e6;
    }

    @media (max-width: 980px) {
        .admin-nav-container {
            width: min(100% - 24px, 1160px);
            height: auto;
            min-height: 72px;
            padding: 12px 0;
            align-items: flex-start;
            flex-direction: column;
            gap: 12px;
        }

        .admin-nav-top-mobile {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .admin-nav-toggle {
            display: inline-flex;
            flex: 0 0 43px;
        }

        .admin-nav-right {
            width: 100%;
            display: none;
        }

        .admin-nav-right.show {
            display: block;
        }

        .admin-nav-menu {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 9px;
        }

        .admin-nav-link,
        .admin-nav-button,
        .admin-nav-ghost,
        .admin-nav-danger,
        .admin-nav-user {
            width: 100%;
            min-height: 42px;
        }

        .admin-nav-user {
            grid-column: 1 / -1;
            justify-content: center;
            max-width: none;
        }
    }

    @media (max-width: 520px) {
        .admin-nav-container {
            width: min(100% - 18px, 1160px);
        }

        .admin-nav-logo {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
            border-radius: 16px;
            font-size: 20px;
        }

        .admin-nav-title {
            font-size: 18px;
        }

        .admin-nav-subtitle {
            display: none;
        }

        .admin-nav-menu {
            grid-template-columns: 1fr;
        }
    }
</style>

<header class="admin-nav-header">
    <div class="admin-nav-container">

        <div class="admin-nav-top-mobile">
            <a href="{{ route('admin.dashboard') }}" class="admin-nav-brand">
                <span class="admin-nav-logo">🛡️</span>

                <span class="admin-nav-brand-text">
                    <span class="admin-nav-title">E-SAPO Admin</span>
                    <span class="admin-nav-subtitle">Panel Pengelolaan Laporan</span>
                </span>
            </a>

            <button type="button" class="admin-nav-toggle" id="admin-nav-toggle" aria-label="Buka menu admin">
                ☰
            </button>
        </div>

        <div class="admin-nav-right" id="admin-nav-right">
            <nav class="admin-nav-menu">
                <a href="{{ route('admin.dashboard') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    🏠 Dashboard
                </a>

                <a href="{{ route('admin.pengaduan.index') }}"
                   class="admin-nav-button {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                    📋 Kelola Pengaduan
                </a>

                <span class="admin-nav-user">
                    <span class="admin-nav-user-icon">A</span>
                    Halo, <strong id="admin-navbar-name">Admin</strong>
                </span>

                <button type="button" onclick="adminLogout()" class="admin-nav-danger">
                    Keluar
                </button>
            </nav>
        </div>

    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('admin-nav-toggle');
        const menu = document.getElementById('admin-nav-right');
        const adminName = document.getElementById('admin-navbar-name');

        const userName = localStorage.getItem('user_name');

        if (adminName && userName) {
            adminName.textContent = userName;
        }

        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                menu.classList.toggle('show');
                toggle.textContent = menu.classList.contains('show') ? '✕' : '☰';
            });
        }
    });
</script>