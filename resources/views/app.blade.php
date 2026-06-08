<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-SAPO - Sistem Pengaduan Sampah</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#16a765',
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --app-bg: #f6f8f3;
            --app-white: #ffffff;

            --app-dark: #102018;
            --app-dark-2: #1a2f24;
            --app-text: #25362c;
            --app-muted: #6d7c72;

            --app-line: rgba(16, 32, 24, 0.10);

            --app-green: #16a765;
            --app-green-dark: #087a48;
            --app-green-soft: #def8e9;
            --app-green-soft-2: #eefbf4;

            --app-red: #ef4444;
            --app-red-soft: #fff1f2;

            --app-shadow-sm: 0 8px 22px rgba(18, 34, 25, 0.06);
            --app-shadow-md: 0 16px 42px rgba(18, 34, 25, 0.10);
            --app-shadow-lg: 0 24px 70px rgba(18, 34, 25, 0.14);

            --nav-height: 78px;
            --nav-radius: 24px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--app-text);
            background:
                radial-gradient(circle at top left, rgba(22, 167, 101, 0.10), transparent 32%),
                radial-gradient(circle at top right, rgba(232, 160, 32, 0.08), transparent 28%),
                linear-gradient(180deg, #fbfcf8 0%, var(--app-bg) 100%);
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        body.nav-open {
            overflow: hidden;
        }

        /* ============================================================
           HEADER / NAVBAR
        ============================================================ */

        .app-header {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 12px 0;
            background: rgba(246, 248, 243, 0.78);
            border-bottom: 1px solid rgba(16, 32, 24, 0.07);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .app-header::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(
                    90deg,
                    rgba(22, 167, 101, 0.08),
                    transparent 35%,
                    rgba(22, 167, 101, 0.06)
                );
            opacity: 0.75;
        }

        .app-navbar {
            width: min(1180px, calc(100% - 36px));
            min-height: var(--nav-height);
            margin-inline: auto;
            padding: 11px 13px;
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;

            border: 1px solid rgba(16, 32, 24, 0.09);
            border-radius: var(--nav-radius);
            background:
                linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0.94),
                    rgba(255, 255, 255, 0.82)
                );
            box-shadow: var(--app-shadow-sm);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .app-brand {
            min-width: 0;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--app-dark);
            text-decoration: none;
            border-radius: 18px;
            padding: 6px 8px 6px 6px;
            transition: background 0.22s ease, transform 0.22s ease;
        }

        .app-brand:hover {
            background: rgba(22, 167, 101, 0.06);
            transform: translateY(-1px);
        }

        .app-brand-icon {
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            border-radius: 18px;

            display: grid;
            place-items: center;

            background:
                radial-gradient(circle at 30% 20%, #ffffff 0%, transparent 38%),
                linear-gradient(135deg, #d8f8e7 0%, #ffffff 52%, #effbf4 100%);
            border: 1px solid rgba(22, 167, 101, 0.20);
            box-shadow:
                0 12px 25px rgba(22, 167, 101, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.90);

            font-size: 23px;
            position: relative;
        }

        .app-brand-icon::after {
            content: '';
            position: absolute;
            right: -2px;
            top: -2px;
            width: 12px;
            height: 12px;
            border-radius: 999px;
            background: var(--app-green);
            border: 3px solid #ffffff;
            box-shadow: 0 0 0 3px rgba(22, 167, 101, 0.12);
        }

        .app-brand-text {
            min-width: 0;
            display: flex;
            flex-direction: column;
            line-height: 1.08;
        }

        .app-brand-name {
            color: var(--app-green);
            font-size: 22px;
            font-weight: 950;
            letter-spacing: -0.055em;
        }

        .app-brand-subtitle {
            margin-top: 5px;
            color: var(--app-muted);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.055em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .app-nav-shell {
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }

        .app-nav {
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .app-nav-link,
        .app-nav-button,
        .app-nav-danger {
            min-height: 42px;
            padding: 0 15px;
            border-radius: 15px;
            border: 1px solid transparent;
            outline: none;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            color: var(--app-text);
            text-decoration: none;
            font-size: 13px;
            font-weight: 850;
            letter-spacing: -0.01em;
            line-height: 1;

            cursor: pointer;
            white-space: nowrap;

            transition:
                transform 0.22s ease,
                box-shadow 0.22s ease,
                background 0.22s ease,
                color 0.22s ease,
                border-color 0.22s ease;
        }

        .app-nav-link {
            background: transparent;
        }

        .app-nav-link:hover {
            color: var(--app-green-dark);
            background: var(--app-green-soft-2);
            border-color: rgba(22, 167, 101, 0.13);
            transform: translateY(-1px);
        }

        .app-nav-button {
            color: #ffffff;
            background:
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.26), transparent 36%),
                linear-gradient(135deg, var(--app-green), #0b8d54);
            box-shadow:
                0 12px 24px rgba(22, 167, 101, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.24);
        }

        .app-nav-button:hover {
            background:
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.24), transparent 36%),
                linear-gradient(135deg, #12995d, var(--app-green-dark));
            transform: translateY(-2px);
            box-shadow:
                0 16px 30px rgba(22, 167, 101, 0.30),
                inset 0 1px 0 rgba(255, 255, 255, 0.22);
        }

        .app-nav-danger {
            color: #dc2626;
            background: var(--app-red-soft);
            border-color: rgba(239, 68, 68, 0.10);
        }

        .app-nav-danger:hover {
            color: #991b1b;
            background: #ffe4e6;
            border-color: rgba(239, 68, 68, 0.18);
            transform: translateY(-1px);
        }

        .app-user-pill {
            min-height: 42px;
            max-width: 245px;
            padding: 0 14px 0 10px;
            border-radius: 999px;
            border: 1px solid rgba(22, 167, 101, 0.16);
            background:
                linear-gradient(
                    180deg,
                    rgba(222, 248, 233, 0.98),
                    rgba(239, 251, 244, 0.92)
                );
            color: var(--app-dark);

            display: inline-flex;
            align-items: center;
            gap: 9px;

            font-size: 13px;
            font-weight: 780;
            white-space: nowrap;
            min-width: 0;
        }

        .app-user-avatar {
            width: 28px;
            height: 28px;
            flex: 0 0 28px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            color: #ffffff;
            background: var(--app-green-dark);
            font-size: 11px;
            font-weight: 950;
            box-shadow: 0 6px 16px rgba(22, 167, 101, 0.22);
        }

        .app-user-pill strong {
            color: var(--app-green-dark);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .app-separator {
            width: 1px;
            height: 26px;
            background: rgba(16, 32, 24, 0.11);
            margin-inline: 2px;
        }

        .app-menu-toggle {
            width: 44px;
            height: 44px;
            border-radius: 16px;
            border: 1px solid rgba(16, 32, 24, 0.10);
            background: #ffffff;
            color: var(--app-dark);
            box-shadow: 0 10px 22px rgba(18, 34, 25, 0.06);
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.22s ease;
        }

        .app-menu-toggle:hover {
            transform: translateY(-1px);
            background: var(--app-green-soft-2);
            border-color: rgba(22, 167, 101, 0.16);
        }

        .app-menu-toggle-lines {
            width: 18px;
            height: 14px;
            position: relative;
            display: block;
        }

        .app-menu-toggle-lines span {
            position: absolute;
            left: 0;
            width: 18px;
            height: 2px;
            border-radius: 999px;
            background: var(--app-dark);
            transition: 0.24s ease;
        }

        .app-menu-toggle-lines span:nth-child(1) {
            top: 0;
        }

        .app-menu-toggle-lines span:nth-child(2) {
            top: 6px;
            width: 14px;
        }

        .app-menu-toggle-lines span:nth-child(3) {
            bottom: 0;
        }

        .app-menu-toggle.is-active .app-menu-toggle-lines span:nth-child(1) {
            top: 6px;
            transform: rotate(45deg);
        }

        .app-menu-toggle.is-active .app-menu-toggle-lines span:nth-child(2) {
            opacity: 0;
            transform: translateX(8px);
        }

        .app-menu-toggle.is-active .app-menu-toggle-lines span:nth-child(3) {
            bottom: 6px;
            transform: rotate(-45deg);
        }

        .app-mobile-backdrop {
            position: fixed;
            inset: 0;
            z-index: 80;
            background: rgba(10, 22, 14, 0.28);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.22s ease;
            display: none;
        }

        .app-mobile-backdrop.is-active {
            opacity: 1;
            pointer-events: auto;
        }

        /* ============================================================
           MAIN + FOOTER
        ============================================================ */

        .app-main {
            flex: 1;
            width: 100%;
        }

        .app-footer {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.86);
            border-top: 1px solid rgba(16, 32, 24, 0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .app-footer-inner {
            width: min(1180px, calc(100% - 36px));
            min-height: 82px;
            margin-inline: auto;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;

            color: var(--app-muted);
            font-size: 13px;
            font-weight: 650;
        }

        .app-footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--app-dark);
            font-weight: 950;
            letter-spacing: -0.03em;
        }

        .app-footer-logo {
            width: 34px;
            height: 34px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            background: var(--app-green-soft);
            border: 1px solid rgba(22, 167, 101, 0.16);
        }

        .app-footer-badge {
            min-height: 34px;
            padding: 0 13px;
            border-radius: 999px;
            background: #f0f6ef;
            border: 1px solid rgba(16, 32, 24, 0.08);
            color: var(--app-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 780;
            white-space: nowrap;
        }

        /* ============================================================
           TABLET
        ============================================================ */

        @media (max-width: 980px) {
            .app-navbar {
                width: min(100% - 28px, 1180px);
            }

            .app-brand-subtitle {
                display: none;
            }

            .app-brand-name {
                font-size: 21px;
            }

            .app-nav-link,
            .app-nav-button,
            .app-nav-danger {
                min-height: 40px;
                padding: 0 12px;
                font-size: 12.5px;
                border-radius: 14px;
            }

            .app-user-pill {
                max-width: 190px;
                min-height: 40px;
                font-size: 12.5px;
            }
        }

        /* ============================================================
           MOBILE
        ============================================================ */

        @media (max-width: 760px) {
            .app-header {
                padding: 10px 0;
            }

            .app-navbar {
                width: min(100% - 22px, 1180px);
                min-height: 66px;
                padding: 10px;
                border-radius: 22px;
                align-items: center;
            }

            .app-brand {
                gap: 10px;
                padding: 4px;
            }

            .app-brand-icon {
                width: 42px;
                height: 42px;
                flex-basis: 42px;
                border-radius: 16px;
                font-size: 21px;
            }

            .app-brand-name {
                font-size: 20px;
            }

            .app-brand-subtitle {
                display: block;
                max-width: 150px;
                overflow: hidden;
                text-overflow: ellipsis;
                font-size: 9px;
                letter-spacing: 0.04em;
            }

            .app-menu-toggle {
                display: inline-flex;
                flex: 0 0 44px;
            }

            .app-nav-shell {
                position: fixed;
                z-index: 120;
                top: 94px;
                left: 50%;
                width: min(calc(100% - 22px), 430px);
                transform: translateX(-50%) translateY(-10px) scale(0.98);

                padding: 12px;
                border-radius: 24px;
                border: 1px solid rgba(16, 32, 24, 0.10);
                background:
                    linear-gradient(
                        180deg,
                        rgba(255, 255, 255, 0.98),
                        rgba(248, 250, 246, 0.96)
                    );
                box-shadow: var(--app-shadow-lg);
                backdrop-filter: blur(18px);
                -webkit-backdrop-filter: blur(18px);

                opacity: 0;
                pointer-events: none;

                transition:
                    opacity 0.22s ease,
                    transform 0.22s ease;
            }

            .app-nav-shell.is-open {
                opacity: 1;
                pointer-events: auto;
                transform: translateX(-50%) translateY(0) scale(1);
            }

            .app-nav {
                width: 100%;
                display: grid;
                grid-template-columns: 1fr;
                gap: 9px;
            }

            .app-nav-link,
            .app-nav-button,
            .app-nav-danger {
                width: 100%;
                min-height: 46px;
                padding: 0 15px;
                border-radius: 16px;
                justify-content: center;
                font-size: 13px;
            }

            .app-nav-link {
                background: #f4f8f2;
                border-color: rgba(16, 32, 24, 0.07);
            }

            .app-user-pill {
                width: 100%;
                max-width: none;
                min-height: 46px;
                justify-content: center;
                border-radius: 16px;
                font-size: 13px;
                padding: 0 14px;
            }

            .app-separator {
                display: none;
            }

            .app-mobile-backdrop {
                display: block;
            }

            .app-footer-inner {
                width: min(100% - 22px, 1180px);
                min-height: auto;
                padding: 20px 0;
                flex-direction: column;
                text-align: center;
                gap: 11px;
                font-size: 12px;
            }

            .app-footer-badge {
                white-space: normal;
                min-height: 32px;
                text-align: center;
            }
        }

        @media (max-width: 420px) {
            .app-navbar {
                border-radius: 20px;
            }

            .app-brand-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
            }

            .app-brand-name {
                font-size: 19px;
            }

            .app-brand-subtitle {
                max-width: 130px;
            }

            .app-menu-toggle {
                width: 42px;
                height: 42px;
                border-radius: 15px;
                flex-basis: 42px;
            }

            .app-nav-shell {
                top: 88px;
                border-radius: 22px;
            }
        }

        @media (max-width: 340px) {
            .app-brand-subtitle {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <header class="app-header">
        <div class="app-navbar">
            <a
                href="{{ route('home') }}"
                class="app-brand"
                aria-label="E-SAPO Home"
            >
                <span class="app-brand-icon">🌱</span>

                <span class="app-brand-text">
                    <span class="app-brand-name">E-SAPO</span>

                    <span class="app-brand-subtitle">
                        Sistem Pengaduan Sampah
                    </span>
                </span>
            </a>

            <div class="app-nav-shell" id="nav-shell">
                <nav
                    class="app-nav"
                    id="nav-menu"
                    aria-label="Navigasi utama"
                >
                    {{-- Default navbar untuk pengunjung --}}
                    <a href="{{ route('login') }}" class="app-nav-link">
                        Masuk
                    </a>

                    <a href="{{ route('register') }}" class="app-nav-button">
                        Daftar
                    </a>
                </nav>
            </div>

            <button
                type="button"
                class="app-menu-toggle"
                id="menu-toggle"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
            >
                <span class="app-menu-toggle-lines" aria-hidden="true">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </header>

    <div class="app-mobile-backdrop" id="mobile-backdrop"></div>

    <main class="app-main">
        @yield('content')
    </main>

    <footer class="app-footer">
        <div class="app-footer-inner">
            <div class="app-footer-brand">
                <span class="app-footer-logo">🌱</span>
                <span>E-SAPO</span>
            </div>

            <div>
                &copy; {{ date('Y') }} E-SAPO. Global Institute.
                All rights reserved.
            </div>

            <div class="app-footer-badge">
                Sistem Pelaporan Lingkungan
            </div>
        </div>
    </footer>

    <script>
        function escapeHtml(value) {
            return String(value || '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function getInitial(name) {
            const cleanName = String(name || 'User').trim();

            if (!cleanName) {
                return 'U';
            }

            return cleanName.charAt(0).toUpperCase();
        }

        function removeLoginSession() {
            sessionStorage.removeItem('access_token');
            sessionStorage.removeItem('user_role');
            sessionStorage.removeItem('user_name');
        }

        function renderGuestNavbar(navMenu) {
            navMenu.innerHTML = `
                <a href="{{ route('login') }}" class="app-nav-link">
                    Masuk
                </a>

                <a href="{{ route('register') }}" class="app-nav-button">
                    Daftar
                </a>
            `;
        }

        function renderMasyarakatNavbar(navMenu, userName) {
            navMenu.innerHTML = `
                <a href="{{ route('home') }}" class="app-nav-link">
                    Beranda
                </a>

                <a href="{{ route('laporan.create') }}" class="app-nav-button">
                    + Buat Aduan
                </a>

                <span class="app-user-pill">
                    <span class="app-user-avatar">
                        ${escapeHtml(getInitial(userName))}
                    </span>

                    Halo,
                    <strong>${escapeHtml(userName)}</strong>
                </span>

                <button
                    type="button"
                    onclick="logoutAccount()"
                    class="app-nav-danger"
                >
                    Keluar
                </button>
            `;
        }

        function renderAdminNavbar(navMenu, userName) {
            navMenu.innerHTML = `
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="app-nav-button"
                >
                    Dashboard Admin
                </a>

                <span class="app-user-pill">
                    <span class="app-user-avatar">
                        ${escapeHtml(getInitial(userName))}
                    </span>

                    Admin,
                    <strong>${escapeHtml(userName)}</strong>
                </span>

                <button
                    type="button"
                    onclick="logoutAccount()"
                    class="app-nav-danger"
                >
                    Keluar
                </button>
            `;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const token = sessionStorage.getItem('access_token');
            const role = String(
                sessionStorage.getItem('user_role') || ''
            ).toLowerCase();

            const userName =
                sessionStorage.getItem('user_name') || 'Pengguna';

            const navMenu = document.getElementById('nav-menu');
            const navShell = document.getElementById('nav-shell');
            const menuToggle = document.getElementById('menu-toggle');
            const mobileBackdrop = document.getElementById('mobile-backdrop');

            /*
            |--------------------------------------------------------------------------
            | Render Navbar Berdasarkan Role
            |--------------------------------------------------------------------------
            */

            if (navMenu) {
                if (!token) {
                    renderGuestNavbar(navMenu);
                } else if (role === 'masyarakat') {
                    renderMasyarakatNavbar(navMenu, userName);
                } else if (role === 'admin') {
                    renderAdminNavbar(navMenu, userName);
                } else {
                    removeLoginSession();
                    renderGuestNavbar(navMenu);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Mobile Menu
            |--------------------------------------------------------------------------
            */

            function openMobileMenu() {
                if (!navShell || !menuToggle || !mobileBackdrop) {
                    return;
                }

                navShell.classList.add('is-open');
                menuToggle.classList.add('is-active');
                mobileBackdrop.classList.add('is-active');
                document.body.classList.add('nav-open');

                menuToggle.setAttribute('aria-expanded', 'true');
                menuToggle.setAttribute(
                    'aria-label',
                    'Tutup menu navigasi'
                );
            }

            function closeMobileMenu() {
                if (!navShell || !menuToggle || !mobileBackdrop) {
                    return;
                }

                navShell.classList.remove('is-open');
                menuToggle.classList.remove('is-active');
                mobileBackdrop.classList.remove('is-active');
                document.body.classList.remove('nav-open');

                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute(
                    'aria-label',
                    'Buka menu navigasi'
                );
            }

            function toggleMobileMenu() {
                if (!navShell) {
                    return;
                }

                if (navShell.classList.contains('is-open')) {
                    closeMobileMenu();
                } else {
                    openMobileMenu();
                }
            }

            if (menuToggle) {
                menuToggle.addEventListener(
                    'click',
                    toggleMobileMenu
                );
            }

            if (mobileBackdrop) {
                mobileBackdrop.addEventListener(
                    'click',
                    closeMobileMenu
                );
            }

            if (navMenu) {
                navMenu.addEventListener('click', function (event) {
                    const target = event.target;

                    if (target.closest('a')) {
                        closeMobileMenu();
                    }
                });
            }

            window.addEventListener('resize', function () {
                if (window.innerWidth > 760) {
                    closeMobileMenu();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeMobileMenu();
                }
            });
        });

        async function logoutAccount() {
            const confirmLogout = confirm(
                'Apakah Anda yakin ingin keluar dari sistem E-SAPO?'
            );

            if (!confirmLogout) {
                return;
            }

            const token = sessionStorage.getItem('access_token');

            try {
                if (token) {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });
                }
            } catch (error) {
                console.error('Logout Error:', error);
            } finally {
                removeLoginSession();

                alert('Anda telah berhasil keluar.');

                window.location.href = "{{ route('login') }}";
            }
        }
    </script>

    @stack('scripts')
</body>
</html>