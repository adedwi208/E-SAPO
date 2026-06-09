@extends('admin.app')

@section('content')

<style>
    :root {
        --ad-bg: #f6f8f3;
        --ad-card: #ffffff;
        --ad-dark: #102018;
        --ad-text: #24352b;
        --ad-muted: #6d7c72;
        --ad-line: rgba(16, 32, 24, 0.10);
        --ad-green: #16a765;
        --ad-green-dark: #087a48;
        --ad-green-soft: #def8e9;
        --ad-orange: #f2994a;
        --ad-blue: #2f80ed;
        --ad-red: #ef4444;
        --ad-yellow: #f4cf70;
        --ad-shadow: 0 18px 48px rgba(18, 34, 25, 0.08);
        --ad-shadow-hover: 0 24px 64px rgba(18, 34, 25, 0.13);
    }

    * {
        box-sizing: border-box;
    }

    .admin-page {
        width: 100%;
        min-height: calc(100vh - 120px);
        margin-top: -24px;
        padding: 34px 0 82px;
        position: relative;
        overflow: hidden;
        color: var(--ad-text);
        background:
            radial-gradient(circle at 8% 10%, rgba(22, 167, 101, 0.10), transparent 27%),
            radial-gradient(circle at 92% 6%, rgba(244, 207, 112, 0.16), transparent 22%),
            linear-gradient(180deg, #fbfcf8 0%, var(--ad-bg) 48%, #eef5ee 100%);
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .admin-page::before,
    .admin-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        filter: blur(70px);
        pointer-events: none;
        z-index: 0;
    }

    .admin-page::before {
        width: 300px;
        height: 300px;
        left: -110px;
        top: 220px;
        background: rgba(22, 167, 101, 0.10);
    }

    .admin-page::after {
        width: 280px;
        height: 280px;
        right: -110px;
        bottom: 180px;
        background: rgba(244, 207, 112, 0.13);
    }

    .admin-container {
        width: min(1160px, calc(100% - 34px));
        margin-inline: auto;
        position: relative;
        z-index: 2;
    }

    .admin-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 340px;
        gap: 18px;
        align-items: stretch;
    }

    .admin-hero-card,
    .admin-profile-card,
    .admin-stat-card,
    .admin-table-card,
    .admin-action-card {
        background: var(--ad-card);
        border: 1px solid var(--ad-line);
        box-shadow: var(--ad-shadow);
    }

    .admin-hero-card {
        min-height: 320px;
        border-radius: 34px;
        padding: 36px;
        position: relative;
        overflow: hidden;
    }

    .admin-hero-card::before {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        right: -105px;
        top: -110px;
        border-radius: 999px;
        background: rgba(22, 167, 101, 0.08);
    }

    .admin-hero-card::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        right: 110px;
        bottom: -95px;
        border-radius: 999px;
        background: rgba(244, 207, 112, 0.14);
    }

    .admin-eyebrow {
        width: fit-content;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: var(--ad-green-soft);
        color: var(--ad-green-dark);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
    }

    .admin-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--ad-green);
        box-shadow: 0 0 0 5px rgba(22, 167, 101, 0.12);
    }

    .admin-title {
        max-width: 720px;
        margin: 18px 0 0;
        color: var(--ad-dark);
        font-size: clamp(34px, 4vw, 58px);
        line-height: 0.98;
        font-weight: 950;
        letter-spacing: -0.07em;
        position: relative;
        z-index: 2;
    }

    .admin-title span {
        color: var(--ad-green);
    }

    .admin-desc {
        max-width: 650px;
        margin: 16px 0 0;
        color: var(--ad-muted);
        font-size: 14px;
        line-height: 1.8;
        font-weight: 600;
        position: relative;
        z-index: 2;
    }

    .admin-actions {
        margin-top: 26px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        position: relative;
        z-index: 2;
    }

    .admin-btn-primary {
        min-height: 52px;
        padding: 0 18px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: 0.24s ease;
        white-space: nowrap;
        color: #ffffff;
        background: var(--ad-dark);
        box-shadow: 0 14px 28px rgba(16, 32, 24, 0.16);
    }

    .admin-btn-primary:hover {
        transform: translateY(-2px);
    }

    .admin-profile-card {
        border-radius: 34px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background:
            radial-gradient(circle at top right, rgba(22, 167, 101, 0.13), transparent 36%),
            #ffffff;
    }

    .admin-profile-icon {
        width: 60px;
        height: 60px;
        border-radius: 22px;
        display: grid;
        place-items: center;
        background: var(--ad-green-soft);
        color: var(--ad-green-dark);
        font-size: 28px;
    }

    .admin-profile-card h3 {
        margin: 22px 0 0;
        color: var(--ad-dark);
        font-size: 24px;
        line-height: 1.1;
        font-weight: 950;
        letter-spacing: -0.05em;
    }

    .admin-profile-card p {
        margin: 10px 0 0;
        color: var(--ad-muted);
        font-size: 13px;
        line-height: 1.7;
        font-weight: 600;
    }

    .admin-admin-name {
        margin-top: 20px;
        padding: 13px 14px;
        border-radius: 18px;
        background: #f6f8f3;
        border: 1px solid rgba(16, 32, 24, 0.08);
        color: var(--ad-dark);
        font-size: 13px;
        font-weight: 850;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .admin-stats {
        margin-top: 22px;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .admin-stat-card {
        min-height: 132px;
        border-radius: 26px;
        padding: 22px;
        position: relative;
        overflow: hidden;
        transition: 0.24s ease;
    }

    .admin-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--ad-shadow-hover);
    }

    .admin-stat-card::after {
        content: "";
        position: absolute;
        width: 92px;
        height: 92px;
        right: -30px;
        top: -30px;
        border-radius: 999px;
        background: rgba(22, 167, 101, 0.08);
    }

    .admin-stat-card.pending::after {
        background: rgba(242, 153, 74, 0.12);
    }

    .admin-stat-card.proses::after {
        background: rgba(47, 128, 237, 0.11);
    }

    .admin-stat-card.selesai::after {
        background: rgba(22, 167, 101, 0.12);
    }

    .admin-stat-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7c8a82;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
    }

    .admin-stat-dot {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #94a3b8;
    }

    .admin-stat-dot.pending {
        background: var(--ad-orange);
    }

    .admin-stat-dot.proses {
        background: var(--ad-blue);
    }

    .admin-stat-dot.selesai {
        background: var(--ad-green);
    }

    .admin-stat-number {
        display: block;
        margin-top: 16px;
        color: var(--ad-dark);
        font-size: 42px;
        line-height: 1;
        font-weight: 950;
        letter-spacing: -0.08em;
        position: relative;
        z-index: 2;
    }

    .admin-stat-text {
        display: block;
        margin-top: 8px;
        color: var(--ad-muted);
        font-size: 12px;
        font-weight: 650;
        position: relative;
        z-index: 2;
    }

    .admin-action-grid {
        margin-top: 22px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .admin-action-card {
        border-radius: 26px;
        padding: 22px;
        min-height: 150px;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: 0.24s ease;
    }

    .admin-action-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--ad-shadow-hover);
    }

    .admin-action-icon {
        width: 46px;
        height: 46px;
        border-radius: 17px;
        display: grid;
        place-items: center;
        background: #f1f5ee;
        color: var(--ad-dark);
        font-size: 20px;
    }

    .admin-action-card strong {
        display: block;
        margin-top: 18px;
        color: var(--ad-dark);
        font-size: 18px;
        line-height: 1.2;
        font-weight: 950;
        letter-spacing: -0.04em;
    }

    .admin-action-card span {
        display: block;
        margin-top: 7px;
        color: var(--ad-muted);
        font-size: 12px;
        line-height: 1.6;
        font-weight: 600;
    }

    .admin-section {
        margin-top: 38px;
    }

    .admin-section-head {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 18px;
    }

    .admin-section-title {
        margin: 0;
        color: var(--ad-dark);
        font-size: 28px;
        line-height: 1.1;
        font-weight: 950;
        letter-spacing: -0.05em;
    }

    .admin-section-note {
        margin: 7px 0 0;
        color: var(--ad-muted);
        font-size: 13px;
        font-weight: 600;
    }

    .admin-table-card {
        border-radius: 30px;
        overflow: hidden;
    }

    .admin-table-wrap {
        overflow-x: auto;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .admin-table th {
        padding: 16px 18px;
        background: #f7faf6;
        color: #7c8a82;
        text-align: left;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        border-bottom: 1px solid var(--ad-line);
    }

    .admin-table td {
        padding: 16px 18px;
        border-bottom: 1px solid rgba(16, 32, 24, 0.07);
        color: var(--ad-text);
        font-size: 13px;
        font-weight: 650;
        vertical-align: middle;
    }

    .admin-table tr:last-child td {
        border-bottom: none;
    }

    .admin-status {
        min-height: 30px;
        padding: 0 11px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.11em;
        text-transform: uppercase;
    }

    .admin-status.pending {
        color: #7b4d08;
        background: #fef3c7;
    }

    .admin-status.proses {
        color: #0b5a8d;
        background: #e0f2fe;
    }

    .admin-status.selesai {
        color: #047857;
        background: #dcfce7;
    }

    .admin-mini-link {
        min-height: 36px;
        padding: 0 12px;
        border-radius: 12px;
        background: #f1f5ee;
        color: var(--ad-dark);
        border: 1px solid rgba(16, 32, 24, 0.08);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 900;
        transition: 0.22s ease;
        white-space: nowrap;
    }

    .admin-mini-link:hover {
        background: #e9efe6;
        transform: translateY(-1px);
    }

    .admin-photo-link {
        min-height: 34px;
        padding: 0 11px;
        border-radius: 11px;
        background: var(--ad-green-soft);
        color: var(--ad-green-dark);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 900;
        white-space: nowrap;
    }

    .admin-empty {
        padding: 34px 20px;
        text-align: center;
        color: var(--ad-muted);
        font-size: 13px;
        font-weight: 650;
    }

    .admin-loading {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .admin-loading::before {
        content: "";
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--ad-green);
        animation: adminPulse 1.1s infinite ease-in-out;
    }

    @keyframes adminPulse {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(0.75);
        }
    }

    @media (max-width: 980px) {
        .admin-hero {
            grid-template-columns: 1fr;
        }

        .admin-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .admin-action-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .admin-page {
            margin-top: -18px;
            padding: 24px 0 64px;
        }

        .admin-container {
            width: min(100% - 22px, 1160px);
        }

        .admin-hero-card,
        .admin-profile-card,
        .admin-table-card,
        .admin-action-card {
            border-radius: 26px;
        }

        .admin-hero-card {
            min-height: auto;
            padding: 26px 22px;
        }

        .admin-title {
            font-size: 32px;
        }

        .admin-actions {
            flex-direction: column;
        }

        .admin-btn-primary {
            width: 100%;
        }

        .admin-stats {
            grid-template-columns: 1fr;
        }

        .admin-section-head {
            align-items: stretch;
            flex-direction: column;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-container">

        <section class="admin-hero">
            <div class="admin-hero-card">
                <div class="admin-eyebrow">Admin Dashboard</div>

                <h1 class="admin-title">
                    Pusat Kontrol <span>E-SAPO</span>
                </h1>

                <p class="admin-desc">
                    Pantau seluruh pengaduan masyarakat, cek statistik laporan, dan kelola status
                    penanganan sampah liar secara cepat dari satu halaman admin.
                </p>

                <div class="admin-actions">
                    <a href="{{ route('admin.pengaduan.index') }}" class="admin-btn-primary">
                        Kelola Pengaduan →
                    </a>
                </div>
            </div>

            <aside class="admin-profile-card">
                <div>
                    <div class="admin-profile-icon">🛡️</div>

                    <h3>Mode Admin Aktif</h3>

                    <p>
                        Anda sedang masuk sebagai admin. Gunakan akses ini untuk memantau dan
                        mengelola laporan masyarakat.
                    </p>
                </div>

                <div id="admin-name" class="admin-admin-name">
                    Admin E-SAPO
                </div>
            </aside>
        </section>

        <section class="admin-stats">
            <div class="admin-stat-card">
                <span class="admin-stat-label">
                    <span class="admin-stat-dot"></span>
                    Total
                </span>

                <span id="stat-total" class="admin-stat-number">0</span>
                <span class="admin-stat-text">Semua laporan</span>
            </div>

            <div class="admin-stat-card pending">
                <span class="admin-stat-label">
                    <span class="admin-stat-dot pending"></span>
                    Pending
                </span>

                <span id="stat-pending" class="admin-stat-number">0</span>
                <span class="admin-stat-text">Menunggu verifikasi</span>
            </div>

            <div class="admin-stat-card proses">
                <span class="admin-stat-label">
                    <span class="admin-stat-dot proses"></span>
                    Proses
                </span>

                <span id="stat-proses" class="admin-stat-number">0</span>
                <span class="admin-stat-text">Sedang ditangani</span>
            </div>

            <div class="admin-stat-card selesai">
                <span class="admin-stat-label">
                    <span class="admin-stat-dot selesai"></span>
                    Selesai
                </span>

                <span id="stat-selesai" class="admin-stat-number">0</span>
                <span class="admin-stat-text">Sudah tuntas</span>
            </div>
        </section>

        <section class="admin-action-grid">
            <a href="{{ route('admin.pengaduan.index') }}" class="admin-action-card">
                <div>
                    <div class="admin-action-icon">📋</div>

                    <strong>Kelola Data Laporan</strong>

                    <span>
                        Lihat seluruh data laporan yang dikirimkan oleh masyarakat.
                    </span>
                </div>
            </a>

            <a href="{{ route('admin.pengaduan.index') }}" class="admin-action-card">
                <div>
                    <div class="admin-action-icon">🔄</div>

                    <strong>Kelola Status Laporan</strong>

                    <span>
                        Ubah status laporan menjadi pending, proses, atau selesai.
                    </span>
                </div>
            </a>
        </section>

        <section class="admin-section">
            <div class="admin-section-head">
                <div>
                    <h2 class="admin-section-title">Laporan Terbaru</h2>

                    <p class="admin-section-note">
                        Menampilkan 5 pengaduan terbaru dari masyarakat.
                    </p>
                </div>

                <a href="{{ route('admin.pengaduan.index') }}" class="admin-mini-link">
                    Lihat Semua →
                </a>
            </div>

            <div class="admin-table-card">
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Pelapor</th>
                                <th>Desa</th>
                                <th>Lokasi Detail</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="latest-body">
                            <tr>
                                <td colspan="7" class="admin-empty">
                                    <span class="admin-loading">
                                        Memuat data laporan...
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toleransi pembacaan key alternatif (juga cek jika key dibungkus tanpa user_)
        const token = sessionStorage.getItem('access_token') || sessionStorage.getItem('token');
        const rawRole = sessionStorage.getItem('user_role') || sessionStorage.getItem('role') || '';
        const role = String(rawRole).trim().toLowerCase(); // Amankan ke string huruf kecil semua
        const userName = sessionStorage.getItem('user_name') || sessionStorage.getItem('name');

        const clearSessionAndRedirect = function (message) {
            sessionStorage.removeItem('access_token');
            sessionStorage.removeItem('token');
            sessionStorage.removeItem('user_role');
            sessionStorage.removeItem('role');
            sessionStorage.removeItem('user_name');
            sessionStorage.removeItem('name');

            if (message) {
                alert(message);
            }

            window.location.href = "{{ route('login') }}";
        };

        // Kunci Validasi Utama Halaman Dashboard
        if (!token) {
            clearSessionAndRedirect('Silakan login terlebih dahulu.');
            return;
        }

        if (role !== 'admin') {
            clearSessionAndRedirect('Akses ditolak. Halaman ini hanya untuk admin. (Role terbaca: ' + (role || 'kosong') + ')');
            return;
        }

        const adminName = document.getElementById('admin-name');

        if (adminName) {
            adminName.textContent = `Admin: ${userName || 'E-SAPO'}`;
        }

        const statTotal = document.getElementById('stat-total');
        const statPending = document.getElementById('stat-pending');
        const statProses = document.getElementById('stat-proses');
        const statSelesai = document.getElementById('stat-selesai');
        const latestBody = document.getElementById('latest-body');

        const safeText = function (value, fallback = '-') {
            if (value === null || value === undefined || value === '') {
                return fallback;
            }

            return String(value);
        };

        const escapeHtml = function (value) {
            return safeText(value, '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        };

        const normalizeStatus = function (status) {
            const value = safeText(status, 'pending').toLowerCase();

            if (
                value === 'proses' ||
                value === 'diproses' ||
                value === 'process'
            ) {
                return 'proses';
            }

            if (
                value === 'selesai' ||
                value === 'done' ||
                value === 'completed'
            ) {
                return 'selesai';
            }

            return 'pending';
        };

        const statusLabel = function (status) {
            if (status === 'proses') {
                return 'Proses';
            }

            if (status === 'selesai') {
                return 'Selesai';
            }

            return 'Pending';
        };

        const resetStats = function () {
            statTotal.innerText = 0;
            statPending.innerText = 0;
            statProses.innerText = 0;
            statSelesai.innerText = 0;
        };

        const setStatsFromList = function (data) {
            const total = data.length;

            const pending = data.filter(function (item) {
                return normalizeStatus(item.status) === 'pending';
            }).length;

            const proses = data.filter(function (item) {
                return normalizeStatus(item.status) === 'proses';
            }).length;

            const selesai = data.filter(function (item) {
                return normalizeStatus(item.status) === 'selesai';
            }).length;

            statTotal.innerText = total;
            statPending.innerText = pending;
            statProses.innerText = proses;
            statSelesai.innerText = selesai;
        };

        const renderLatest = function (data) {
            if (!Array.isArray(data) || data.length === 0) {
                latestBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="admin-empty">
                            Belum ada laporan masuk.
                        </td>
                    </tr>
                `;

                return;
            }

            const latest = data.slice(0, 5);

            latestBody.innerHTML = latest.map(function (item) {
                const status = normalizeStatus(item.status);

                const pelapor = item.user
                    ? safeText(item.user.name, 'Masyarakat')
                    : 'Masyarakat';

                const desa = item.desa
                    ? safeText(
                        item.desa.nama_desa || item.desa.name,
                        'Desa tidak tersedia'
                    )
                    : 'Desa tidak tersedia';

                const lokasi = safeText(
                    item.lokasi_spesifik,
                    'Lokasi belum tersedia'
                );

                const deskripsiFull = safeText(item.deskripsi, '-');

                const deskripsi = deskripsiFull.length > 55
                    ? deskripsiFull.substring(0, 55) + '...'
                    : deskripsiFull;

                const fotoUrl = item.foto_url
                    ? item.foto_url
                    : (item.foto ? `/storage/${item.foto}` : null);

                const fotoHtml = fotoUrl
                    ? `
                        <a
                            href="${escapeHtml(fotoUrl)}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="admin-photo-link"
                        >
                            Lihat Foto
                        </a>
                    `
                    : '-';

                return `
                    <tr>
                        <td>${escapeHtml(pelapor)}</td>
                        <td>${escapeHtml(desa)}</td>
                        <td>${escapeHtml(lokasi)}</td>
                        <td>${escapeHtml(deskripsi)}</td>
                        <td>${fotoHtml}</td>

                        <td>
                            <span class="admin-status ${status}">
                                ${statusLabel(status)}
                            </span>
                        </td>

                        <td>
                            <a
                                href="{{ route('admin.pengaduan.index') }}"
                                class="admin-mini-link btn-kelola-nav"
                            >
                                Kelola
                            </a>
                        </td>
                    </tr>
                `;
            }).join('');
        };

        // Interseptor Navigasi Pindah Halaman
        document.body.addEventListener('click', function (e) {
            const targetLink = e.target.closest('.admin-btn-primary, .admin-action-card, .admin-mini-link, .btn-kelola-nav');
            
            if (targetLink && targetLink.getAttribute('href') === "{{ route('admin.pengaduan.index') }}") {
                e.preventDefault(); 

                const currentToken = sessionStorage.getItem('access_token') || sessionStorage.getItem('token');
                const currentRawRole = sessionStorage.getItem('user_role') || sessionStorage.getItem('role') || '';
                const currentRole = String(currentRawRole).trim().toLowerCase();

                if (!currentToken || currentRole !== 'admin') {
                    clearSessionAndRedirect('Sesi Anda tidak valid. Silakan login kembali.');
                    return;
                }

                window.location.href = "{{ route('admin.pengaduan.index') }}";
            }
        });

        fetch('/api/admin/pengaduan', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(async function (response) {
            let data;

            try {
                data = await response.json();
            } catch (error) {
                throw new Error('Respons API tidak valid.');
            }

            if (response.status === 401 || response.status === 403) {
                clearSessionAndRedirect(
                    'Sesi login admin tidak valid. Silakan login kembali.'
                );

                return;
            }

            if (!response.ok) {
                throw new Error(
                    data.message ||
                    'Gagal mengambil data pengaduan.'
                );
            }

            return data;
        })
        .then(function (data) {
            if (!data) {
                return;
            }

            if (!Array.isArray(data)) {
                resetStats();

                latestBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="admin-empty">
                            Respons API pengaduan tidak valid.
                        </td>
                    </tr>
                `;

                return;
            }

            setStatsFromList(data);
            renderLatest(data);
        })
        .catch(function (error) {
            console.error('Error ambil data pengaduan:', error);

            resetStats();

            latestBody.innerHTML = `
                <tr>
                    <td colspan="7" class="admin-empty">
                        ${escapeHtml(
                            error.message ||
                            'Gagal memuat data laporan.'
                        )}
                    </td>
                </tr>
            `;
        });
    });
</script>
@endpush