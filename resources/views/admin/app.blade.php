<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-SAPO Admin - Sistem Pengaduan Sampah</title>

    <style>
        :root {
            --admin-bg: #f6f8f3;
            --admin-white: #ffffff;
            --admin-dark: #102018;
            --admin-text: #25362c;
            --admin-muted: #6d7c72;
            --admin-line: rgba(16, 32, 24, 0.10);
            --admin-green: #16a765;
            --admin-green-dark: #087a48;
            --admin-green-soft: #def8e9;
            --admin-red: #ef4444;
            --admin-red-soft: #fff1f2;
            --admin-shadow: 0 14px 38px rgba(18, 34, 25, 0.08);
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
            color: var(--admin-text);
            background:
                radial-gradient(circle at top left, rgba(22, 167, 101, 0.08), transparent 30%),
                linear-gradient(180deg, #fbfcf8 0%, var(--admin-bg) 100%);
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            display: flex;
            flex-direction: column;
        }

        .admin-nav-header {
            position: sticky;
            top: 0;
            z-index: 99;
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(16, 32, 24, 0.08);
            box-shadow: 0 8px 24px rgba(18, 34, 25, 0.04);
        }

        .admin-nav-container {
            width: min(1160px, calc(100% - 34px));
            height: 74px;
            margin-inline: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
        }

        .admin-nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            color: var(--admin-dark);
            text-decoration: none;
            min-width: 0;
        }

        .admin-nav-logo {
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

        .admin-nav-brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
            min-width: 0;
        }

        .admin-nav-title {
            color: var(--admin-green);
            font-size: 21px;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .admin-nav-subtitle {
            margin-top: 4px;
            color: var(--admin-muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .admin-nav-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            min-width: 0;
        }

        .admin-nav-link,
        .admin-nav-button,
        .admin-nav-danger {
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
            color: var(--admin-text);
            text-decoration: none;
            font-size: 13px;
            font-weight: 850;
            cursor: pointer;
            transition: 0.22s ease;
            white-space: nowrap;
        }

        .admin-nav-link:hover {
            color: var(--admin-green-dark);
            background: #f0f6ef;
        }

        .admin-nav-button {
            color: #ffffff;
            background: var(--admin-green);
            box-shadow: 0 10px 22px rgba(22, 167, 101, 0.20);
        }

        .admin-nav-button:hover {
            background: var(--admin-green-dark);
            transform: translateY(-1px);
        }

        .admin-nav-danger {
            color: #dc2626;
            background: var(--admin-red-soft);
        }

        .admin-nav-danger:hover {
            color: #991b1b;
            background: #ffe4e6;
        }

        .admin-nav-user {
            min-height: 40px;
            max-width: 230px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid rgba(22, 167, 101, 0.16);
            background: var(--admin-green-soft);
            color: var(--admin-dark);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 750;
            white-space: nowrap;
            min-width: 0;
        }

        .admin-nav-user strong {
            color: var(--admin-green-dark);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .admin-main {
            flex: 1;
            width: 100%;
        }

        .admin-footer {
            margin-top: auto;
            background: rgba(255, 255, 255, 0.88);
            border-top: 1px solid rgba(16, 32, 24, 0.08);
            backdrop-filter: blur(18px);
        }

        .admin-footer-inner {
            width: min(1160px, calc(100% - 34px));
            min-height: 70px;
            margin-inline: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            color: var(--admin-muted);
            font-size: 13px;
            font-weight: 650;
        }

        .admin-footer-badge {
            min-height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            background: #f0f6ef;
            border: 1px solid rgba(16, 32, 24, 0.08);
            color: var(--admin-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 750;
        }

        @media (max-width: 900px) {
            .admin-nav-container {
                width: min(100% - 22px, 1160px);
                height: auto;
                min-height: 66px;
                padding: 10px 0;
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            .admin-nav-brand {
                width: 100%;
            }

            .admin-nav-menu {
                width: 100%;
                justify-content: flex-start;
                gap: 8px;
                overflow-x: auto;
                padding-bottom: 2px;
                scrollbar-width: none;
            }

            .admin-nav-menu::-webkit-scrollbar {
                display: none;
            }

            .admin-nav-link,
            .admin-nav-button,
            .admin-nav-danger {
                min-height: 38px;
                padding: 0 13px;
                font-size: 12px;
                border-radius: 12px;
            }

            .admin-nav-user {
                max-width: none;
                min-height: 38px;
                font-size: 12px;
            }

            .admin-footer-inner {
                width: min(100% - 22px, 1160px);
                min-height: auto;
                padding: 18px 0;
                flex-direction: column;
                text-align: center;
                gap: 10px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .admin-nav-title {
                font-size: 18px;
            }

            .admin-nav-subtitle {
                display: none;
            }

            .admin-nav-menu {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .admin-nav-link,
            .admin-nav-button,
            .admin-nav-danger,
            .admin-nav-user {
                width: 100%;
            }

            .admin-nav-user {
                grid-column: 1 / -1;
                justify-content: center;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    @include('admin.navbar')

    <main class="admin-main">
        @yield('content')
    </main>

    <footer class="admin-footer">
        <div class="admin-footer-inner">
            <div>
                <strong>E-SAPO Admin</strong>
            </div>

            <div>
                &copy; {{ date('Y') }} E-SAPO. Global Institute. All rights reserved.
            </div>

            <div class="admin-footer-badge">
                Admin Panel
            </div>
        </div>
    </footer>

    <script>
        function adminEscapeHtml(value) {
            return String(value || '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }

        function clearAdminSession() {
            sessionStorage.removeItem('access_token');
            sessionStorage.removeItem('user_role');
            sessionStorage.removeItem('user_name');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const token = sessionStorage.getItem('access_token');

            const role = String(
                sessionStorage.getItem('user_role') || ''
            ).trim().toLowerCase();

            const userName = sessionStorage.getItem('user_name');

            if (!token) {
                alert('Silakan login terlebih dahulu.');
                window.location.href = "{{ route('login') }}";
                return;
            }

            if (role !== 'admin') {
                alert('Akses ditolak. Halaman ini hanya untuk admin.');
                window.location.href = "{{ route('home') }}";
                return;
            }

            const adminName = document.getElementById('admin-navbar-name');

            if (adminName) {
                adminName.innerHTML = adminEscapeHtml(
                    userName || 'Admin'
                );
            }
        });

        async function adminLogout() {
            const confirmLogout = confirm(
                'Apakah Anda yakin ingin keluar dari admin panel E-SAPO?'
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
                console.error('Admin Logout Error:', error);
            } finally {
                clearAdminSession();

                alert('Anda telah berhasil keluar.');

                window.location.href = "{{ route('login') }}";
            }
        }
    </script>

    @stack('scripts')
</body>
</html>