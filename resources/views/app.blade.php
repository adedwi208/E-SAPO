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
            --app-text: #25362c;
            --app-muted: #6d7c72;
            --app-line: rgba(16, 32, 24, 0.10);
            --app-green: #16a765;
            --app-green-dark: #087a48;
            --app-green-soft: #def8e9;
            --app-red: #ef4444;
            --app-shadow: 0 14px 38px rgba(18, 34, 25, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--app-text);
            background:
                radial-gradient(circle at top left, rgba(22, 167, 101, 0.08), transparent 30%),
                linear-gradient(180deg, #fbfcf8 0%, var(--app-bg) 100%);
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            display: flex;
            flex-direction: column;
        }

        .app-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(16, 32, 24, 0.08);
            box-shadow: 0 8px 24px rgba(18, 34, 25, 0.04);
        }

        .app-navbar {
            width: min(1160px, calc(100% - 34px));
            height: 74px;
            margin-inline: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
        }

        .app-brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            color: var(--app-dark);
            text-decoration: none;
            min-width: 0;
        }

        .app-brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #def8e9 0%, #ffffff 100%);
            border: 1px solid rgba(22, 167, 101, 0.18);
            box-shadow: 0 8px 20px rgba(22, 167, 101, 0.10);
            font-size: 22px;
            flex: 0 0 42px;
        }

        .app-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
            min-width: 0;
        }

        .app-brand-name {
            color: var(--app-green);
            font-size: 21px;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .app-brand-subtitle {
            margin-top: 4px;
            color: var(--app-muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .app-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            min-width: 0;
        }

        .app-nav-link,
        .app-nav-button,
        .app-nav-danger {
            min-height: 40px;
            padding: 0 14px;
            border-radius: 13px;
            border: none;
            outline: none;
            background: transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            color: var(--app-text);
            text-decoration: none;
            font-size: 13px;
            font-weight: 850;
            cursor: pointer;
            transition: 0.22s ease;
            white-space: nowrap;
        }

        .app-nav-link:hover {
            color: var(--app-green-dark);
            background: #f0f6ef;
        }

        .app-nav-button {
            color: #ffffff;
            background: var(--app-green);
            box-shadow: 0 10px 22px rgba(22, 167, 101, 0.20);
        }

        .app-nav-button:hover {
            background: var(--app-green-dark);
            transform: translateY(-1px);
        }

        .app-nav-danger {
            color: #dc2626;
            background: #fff1f2;
        }

        .app-nav-danger:hover {
            color: #991b1b;
            background: #ffe4e6;
        }

        .app-user-pill {
            min-height: 40px;
            max-width: 230px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid rgba(22, 167, 101, 0.16);
            background: var(--app-green-soft);
            color: var(--app-dark);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 750;
            white-space: nowrap;
            min-width: 0;
        }

        .app-user-pill strong {
            color: var(--app-green-dark);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .app-separator {
            width: 1px;
            height: 24px;
            background: rgba(16, 32, 24, 0.12);
            margin-inline: 2px;
        }

        .app-main {
            flex: 1;
            width: 100%;
        }

        .app-footer {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.88);
            border-top: 1px solid rgba(16, 32, 24, 0.08);
            backdrop-filter: blur(18px);
        }

        .app-footer-inner {
            width: min(1160px, calc(100% - 34px));
            min-height: 76px;
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
            gap: 9px;
            color: var(--app-dark);
            font-weight: 900;
        }

        .app-footer-badge {
            min-height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: #f0f6ef;
            border: 1px solid rgba(16, 32, 24, 0.08);
            color: var(--app-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 750;
        }

        @media (max-width: 760px) {
            .app-navbar {
                width: min(100% - 22px, 1160px);
                height: auto;
                min-height: 66px;
                padding: 10px 0;
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            .app-brand {
                width: 100%;
                justify-content: space-between;
            }

            .app-brand-icon {
                width: 38px;
                height: 38px;
                border-radius: 14px;
                flex-basis: 38px;
                font-size: 20px;
            }

            .app-brand-name {
                font-size: 19px;
            }

            .app-brand-subtitle {
                display: none;
            }

            .app-nav {
                width: 100%;
                justify-content: flex-start;
                gap: 8px;
                overflow-x: auto;
                padding-bottom: 2px;
                scrollbar-width: none;
            }

            .app-nav::-webkit-scrollbar {
                display: none;
            }

            .app-nav-link,
            .app-nav-button,
            .app-nav-danger {
                min-height: 38px;
                padding: 0 13px;
                font-size: 12px;
                border-radius: 12px;
            }

            .app-user-pill {
                max-width: none;
                min-height: 38px;
                font-size: 12px;
            }

            .app-separator {
                display: none;
            }

            .app-footer-inner {
                width: min(100% - 22px, 1160px);
                min-height: auto;
                padding: 18px 0;
                flex-direction: column;
                text-align: center;
                gap: 10px;
                font-size: 12px;
            }
        }

        @media (max-width: 420px) {
            .app-nav {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .app-nav-link,
            .app-nav-button,
            .app-nav-danger,
            .app-user-pill {
                width: 100%;
            }

            .app-user-pill {
                grid-column: 1 / -1;
                justify-content: center;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <header class="app-header">
        <div class="app-navbar">
            <a href="{{ route('home') }}" class="app-brand">
                <span class="app-brand-icon">🌱</span>

                <span class="app-brand-text">
                    <span class="app-brand-name">E-SAPO</span>
                    <span class="app-brand-subtitle">Sistem Pengaduan Sampah</span>
                </span>
            </a>

            <nav class="app-nav" id="nav-menu">
                <a href="{{ route('login') }}" class="app-nav-link">Masuk</a>
                <a href="{{ route('register') }}" class="app-nav-button">Daftar</a>
            </nav>
        </div>
    </header>

    <main class="app-main">
        @yield('content')
    </main>

    <footer class="app-footer">
        <div class="app-footer-inner">
            <div class="app-footer-brand">
                <span>🌱</span>
                <span>E-SAPO</span>
            </div>

            <div>
                &copy; {{ date('Y') }} E-SAPO. Global Institute. All rights reserved.
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

        document.addEventListener('DOMContentLoaded', function () {
            const token = localStorage.getItem('access_token');
            const userName = localStorage.getItem('user_name');
            const navMenu = document.getElementById('nav-menu');

            if (token && userName && navMenu) {
                navMenu.innerHTML = `
                    <a href="/create" class="app-nav-button">➕ Buat Aduan</a>

                    <span class="app-user-pill">
                        Halo, <strong>${escapeHtml(userName)}</strong>
                    </span>

                    <button type="button" onclick="logoutAccount()" class="app-nav-danger">
                        Keluar
                    </button>
                `;
            }
        });

        function logoutAccount() {
            const confirmLogout = confirm('Apakah Anda yakin ingin keluar dari sistem E-SAPO?');

            if (!confirmLogout) {
                return;
            }

            const token = localStorage.getItem('access_token');

            fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            }).finally(() => {
                localStorage.clear();
                alert('Anda telah berhasil keluar.');
                window.location.href = '/login';
            });
        }
    </script>

    @stack('scripts')
</body>
</html>