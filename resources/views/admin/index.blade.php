@extends('admin.app')

@section('content')

<style>
    :root {
        --adm-bg: #f6f8f3;
        --adm-card: #ffffff;
        --adm-dark: #102018;
        --adm-text: #24352b;
        --adm-muted: #6d7c72;
        --adm-line: rgba(16, 32, 24, 0.10);
        --adm-green: #16a765;
        --adm-green-dark: #087a48;
        --adm-green-soft: #def8e9;
        --adm-orange: #f2994a;
        --adm-blue: #2f80ed;
        --adm-red: #ef4444;
        --adm-shadow: 0 18px 48px rgba(18, 34, 25, 0.08);
        --adm-shadow-hover: 0 24px 64px rgba(18, 34, 25, 0.13);
    }

    * {
        box-sizing: border-box;
    }

    .adm-page {
        width: 100%;
        min-height: calc(100vh - 120px);
        margin-top: -24px;
        padding: 34px 0 82px;
        position: relative;
        overflow: hidden;
        color: var(--adm-text);
        background:
            radial-gradient(circle at 8% 10%, rgba(22, 167, 101, 0.10), transparent 27%),
            radial-gradient(circle at 92% 6%, rgba(244, 207, 112, 0.16), transparent 22%),
            linear-gradient(180deg, #fbfcf8 0%, var(--adm-bg) 48%, #eef5ee 100%);
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .adm-page::before,
    .adm-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        filter: blur(70px);
        pointer-events: none;
        z-index: 0;
    }

    .adm-page::before {
        width: 300px;
        height: 300px;
        left: -110px;
        top: 220px;
        background: rgba(22, 167, 101, 0.10);
    }

    .adm-page::after {
        width: 280px;
        height: 280px;
        right: -110px;
        bottom: 180px;
        background: rgba(244, 207, 112, 0.13);
    }

    .adm-container {
        width: min(1160px, calc(100% - 34px));
        margin-inline: auto;
        position: relative;
        z-index: 2;
    }

    .adm-header {
        margin-bottom: 22px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 18px;
    }

    .adm-eyebrow {
        width: fit-content;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: var(--adm-green-soft);
        color: var(--adm-green-dark);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .adm-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--adm-green);
        box-shadow: 0 0 0 5px rgba(22, 167, 101, 0.12);
    }

    .adm-title {
        margin: 14px 0 0;
        color: var(--adm-dark);
        font-size: clamp(30px, 3vw, 48px);
        line-height: 1.02;
        font-weight: 950;
        letter-spacing: -0.065em;
    }

    .adm-subtitle {
        max-width: 650px;
        margin: 10px 0 0;
        color: var(--adm-muted);
        font-size: 13.5px;
        line-height: 1.75;
        font-weight: 600;
    }

    .adm-back {
        min-height: 44px;
        padding: 0 16px;
        border-radius: 15px;
        background: #ffffff;
        border: 1px solid var(--adm-line);
        box-shadow: 0 8px 20px rgba(18, 34, 25, 0.04);
        color: var(--adm-dark);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 950;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        transition: 0.22s ease;
        white-space: nowrap;
    }

    .adm-back:hover {
        transform: translateY(-2px);
        background: #f1f5ee;
    }

    .adm-summary {
        margin-bottom: 20px;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .adm-summary-card {
        min-height: 118px;
        padding: 20px;
        border-radius: 26px;
        background: #ffffff;
        border: 1px solid var(--adm-line);
        box-shadow: var(--adm-shadow);
        position: relative;
        overflow: hidden;
    }

    .adm-summary-card::after {
        content: "";
        position: absolute;
        width: 88px;
        height: 88px;
        right: -30px;
        top: -30px;
        border-radius: 999px;
        background: rgba(22, 167, 101, 0.08);
    }

    .adm-summary-card.pending::after {
        background: rgba(242, 153, 74, 0.13);
    }

    .adm-summary-card.proses::after {
        background: rgba(47, 128, 237, 0.12);
    }

    .adm-summary-card.selesai::after {
        background: rgba(22, 167, 101, 0.12);
    }

    .adm-summary-label {
        color: #7c8a82;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        position: relative;
        z-index: 2;
    }

    .adm-summary-dot {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: #94a3b8;
    }

    .adm-summary-dot.pending {
        background: var(--adm-orange);
    }

    .adm-summary-dot.proses {
        background: var(--adm-blue);
    }

    .adm-summary-dot.selesai {
        background: var(--adm-green);
    }

    .adm-summary-value {
        display: block;
        margin-top: 15px;
        color: var(--adm-dark);
        font-size: 38px;
        line-height: 1;
        font-weight: 950;
        letter-spacing: -0.08em;
        position: relative;
        z-index: 2;
    }

    .adm-toolbar {
        margin-bottom: 20px;
        padding: 14px;
        border-radius: 26px;
        background: #ffffff;
        border: 1px solid var(--adm-line);
        box-shadow: var(--adm-shadow);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .adm-search {
        min-height: 46px;
        min-width: min(440px, 100%);
        flex: 1;
        border: 1px solid rgba(16, 32, 24, 0.12);
        outline: none;
        border-radius: 16px;
        background: #f8faf6;
        color: var(--adm-dark);
        padding: 0 16px;
        font-size: 13px;
        font-weight: 650;
    }

    .adm-search:focus {
        background: #ffffff;
        border-color: var(--adm-green);
        box-shadow: 0 0 0 4px rgba(22, 167, 101, 0.12);
    }

    .adm-filter {
        min-height: 46px;
        border: 1px solid rgba(16, 32, 24, 0.12);
        outline: none;
        border-radius: 16px;
        background: #f8faf6;
        color: var(--adm-dark);
        padding: 0 14px;
        font-size: 13px;
        font-weight: 750;
        cursor: pointer;
    }

    .adm-refresh {
        min-height: 46px;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 0 16px;
        border-radius: 16px;
        background: var(--adm-dark);
        color: #ffffff;
        font-size: 11px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: 0.22s ease;
    }

    .adm-refresh:hover {
        transform: translateY(-2px);
        background: #1a2d22;
    }

    .adm-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .adm-card {
        min-width: 0;
        border-radius: 30px;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid rgba(16, 32, 24, 0.08);
        box-shadow: var(--adm-shadow);
        display: flex;
        flex-direction: column;
        transition: 0.26s ease;
    }

    .adm-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--adm-shadow-hover);
    }

    .adm-image {
        position: relative;
        height: 205px;
        overflow: hidden;
        background: #e8eee8;
    }

    .adm-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: 0.75s ease;
    }

    .adm-card:hover .adm-image img {
        transform: scale(1.08);
    }

    .adm-status {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 2;
        min-height: 32px;
        padding: 0 12px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.13em;
        text-transform: uppercase;
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.34);
    }

    .adm-status.pending {
        background: rgba(254, 243, 199, 0.94);
        color: #7b4d08;
    }

    .adm-status.proses {
        background: rgba(224, 246, 255, 0.94);
        color: #0b5a8d;
    }

    .adm-status.selesai {
        background: rgba(220, 252, 231, 0.95);
        color: #047857;
    }

    .adm-location {
        position: absolute;
        left: 14px;
        right: 14px;
        bottom: 14px;
        z-index: 2;
        min-width: 0;
        padding: 10px 12px;
        border-radius: 16px;
        background: rgba(0,0,0,0.30);
        backdrop-filter: blur(12px);
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 850;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .adm-location span:last-child {
        min-width: 0;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .adm-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .adm-card-title {
        margin: 0;
        color: var(--adm-dark);
        font-size: 17px;
        line-height: 1.34;
        font-weight: 950;
        letter-spacing: -0.04em;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .adm-card-desc {
        margin: 10px 0 0;
        color: var(--adm-muted);
        font-size: 12.5px;
        line-height: 1.75;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .adm-meta {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid rgba(16, 32, 24, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .adm-user {
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .adm-avatar {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        background: #eef5ef;
        color: var(--adm-dark);
        border: 1px solid rgba(16, 32, 24, 0.08);
        font-size: 12px;
        font-weight: 950;
    }

    .adm-user-label {
        display: block;
        color: #9aa59e;
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        line-height: 1;
    }

    .adm-user-name {
        display: block;
        margin-top: 5px;
        color: #33443a;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px;
    }

    .adm-actions {
        margin-top: 16px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 9px;
    }

    .adm-select {
        grid-column: 1 / -1;
        width: 100%;
        height: 44px;
        border: 1px solid rgba(16, 32, 24, 0.12);
        outline: none;
        border-radius: 15px;
        background: #f8faf6;
        color: var(--adm-dark);
        padding: 0 12px;
        font-size: 13px;
        font-weight: 750;
        cursor: pointer;
    }

    .adm-btn {
        min-height: 42px;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 950;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        transition: 0.22s ease;
    }

    .adm-btn:hover {
        transform: translateY(-2px);
    }

    .adm-btn.update {
        color: #ffffff;
        background: var(--adm-dark);
    }

    .adm-btn.delete {
        color: #991b1b;
        background: #fee2e2;
    }

    .adm-empty {
        grid-column: 1 / -1;
        min-height: 320px;
        border-radius: 32px;
        background: #ffffff;
        border: 1px solid rgba(16, 32, 24, 0.08);
        box-shadow: var(--adm-shadow);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--adm-muted);
        padding: 36px 20px;
        font-size: 13px;
        font-weight: 650;
    }

    .adm-loading {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .adm-loading::before {
        content: "";
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: var(--adm-green);
        animation: admPulse 1.1s infinite ease-in-out;
    }

    @keyframes admPulse {
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
        .adm-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .adm-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .adm-page {
            margin-top: -18px;
            padding: 24px 0 64px;
        }

        .adm-container {
            width: min(100% - 22px, 1160px);
        }

        .adm-header {
            align-items: stretch;
            flex-direction: column;
        }

        .adm-back {
            width: 100%;
        }

        .adm-summary {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .adm-toolbar {
            border-radius: 22px;
        }

        .adm-search,
        .adm-filter,
        .adm-refresh {
            width: 100%;
        }

        .adm-grid {
            grid-template-columns: 1fr;
        }

        .adm-card {
            border-radius: 26px;
        }

        .adm-title {
            font-size: 30px;
        }
    }
</style>

<div class="adm-page">
    <div class="adm-container">

        <div class="adm-header">
            <div>
                <div class="adm-eyebrow">Kelola Pengaduan</div>

                <h1 class="adm-title">
                    Data Pengaduan Masyarakat
                </h1>

                <p class="adm-subtitle">
                    Admin dapat melihat semua laporan, mencari data, mengubah status penanganan,
                    dan menghapus pengaduan yang sudah tidak diperlukan.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="adm-back">
                ← Dashboard
            </a>
        </div>

        <div class="adm-summary">
            <div class="adm-summary-card">
                <span class="adm-summary-label">
                    <span class="adm-summary-dot"></span>
                    Total
                </span>
                <span id="sum-total" class="adm-summary-value">0</span>
            </div>

            <div class="adm-summary-card pending">
                <span class="adm-summary-label">
                    <span class="adm-summary-dot pending"></span>
                    Pending
                </span>
                <span id="sum-pending" class="adm-summary-value">0</span>
            </div>

            <div class="adm-summary-card proses">
                <span class="adm-summary-label">
                    <span class="adm-summary-dot proses"></span>
                    Proses
                </span>
                <span id="sum-proses" class="adm-summary-value">0</span>
            </div>

            <div class="adm-summary-card selesai">
                <span class="adm-summary-label">
                    <span class="adm-summary-dot selesai"></span>
                    Selesai
                </span>
                <span id="sum-selesai" class="adm-summary-value">0</span>
            </div>
        </div>

        <div class="adm-toolbar">
            <input
                type="text"
                id="search-input"
                class="adm-search"
                placeholder="Cari pelapor, desa, lokasi, atau deskripsi..."
            >

            <select id="status-filter" class="adm-filter">
                <option value="all">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
            </select>

            <button type="button" id="refresh-btn" class="adm-refresh">
                Refresh
            </button>
        </div>

        <div id="pengaduan-grid" class="adm-grid">
            <div class="adm-empty">
                <span class="adm-loading">Memuat data pengaduan...</span>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const token = localStorage.getItem('access_token');
        const role = localStorage.getItem('user_role');

        if (!token || role !== 'admin') {
            alert('Akses ditolak. Halaman ini hanya untuk admin.');
            window.location.href = '/login';
            return;
        }

        const grid = document.getElementById('pengaduan-grid');
        const searchInput = document.getElementById('search-input');
        const statusFilter = document.getElementById('status-filter');
        const refreshBtn = document.getElementById('refresh-btn');

        const sumTotal = document.getElementById('sum-total');
        const sumPending = document.getElementById('sum-pending');
        const sumProses = document.getElementById('sum-proses');
        const sumSelesai = document.getElementById('sum-selesai');

        let allPengaduan = [];

        const safeText = (value, fallback = '-') => {
            if (value === null || value === undefined || value === '') return fallback;
            return String(value);
        };

        const escapeHtml = (value) => {
            return safeText(value, '')
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        };

        const normalizeStatus = (status) => {
            const value = safeText(status, 'pending').toLowerCase();

            if (value === 'proses' || value === 'diproses' || value === 'process') {
                return 'proses';
            }

            if (value === 'selesai' || value === 'done' || value === 'completed') {
                return 'selesai';
            }

            return 'pending';
        };

        const statusLabel = (status) => {
            if (status === 'proses') return 'Proses';
            if (status === 'selesai') return 'Selesai';
            return 'Pending';
        };

        const setSummary = () => {
            sumTotal.innerText = allPengaduan.length;
            sumPending.innerText = allPengaduan.filter(item => normalizeStatus(item.status) === 'pending').length;
            sumProses.innerText = allPengaduan.filter(item => normalizeStatus(item.status) === 'proses').length;
            sumSelesai.innerText = allPengaduan.filter(item => normalizeStatus(item.status) === 'selesai').length;
        };

        const renderData = () => {
            const keyword = searchInput.value.toLowerCase();
            const filter = statusFilter.value;

            const filtered = allPengaduan.filter(item => {
                const status = normalizeStatus(item.status);

                const userName = item.user ? safeText(item.user.name, 'Masyarakat') : 'Masyarakat';
                const desaName = item.desa ? safeText(item.desa.nama_desa || item.desa.name, 'Sektor Umum') : 'Sektor Umum';
                const lokasi = safeText(item.lokasi_spesifik, '');
                const deskripsi = safeText(item.deskripsi, '');

                const searchable = `${userName} ${desaName} ${lokasi} ${deskripsi}`.toLowerCase();

                const matchKeyword = searchable.includes(keyword);
                const matchStatus = filter === 'all' || status === filter;

                return matchKeyword && matchStatus;
            });

            if (filtered.length === 0) {
                grid.innerHTML = `
                    <div class="adm-empty">
                        Tidak ada data pengaduan yang cocok.
                    </div>
                `;
                return;
            }

            grid.innerHTML = filtered.map(item => {
                const status = normalizeStatus(item.status);

                const imageUrl = item.foto
                    ? `/storage/${item.foto}`
                    : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=900';

                const userName = item.user ? safeText(item.user.name, 'Masyarakat') : 'Masyarakat';
                const initial = userName.charAt(0).toUpperCase();

                const desaName = item.desa ? safeText(item.desa.nama_desa || item.desa.name, 'Sektor Umum') : 'Sektor Umum';
                const rt = item.rtrw ? safeText(item.rtrw.rt) : '-';
                const rw = item.rtrw ? safeText(item.rtrw.rw) : '-';

                const lokasi = safeText(item.lokasi_spesifik, 'Lokasi belum tersedia');
                const deskripsi = safeText(item.deskripsi, 'Tidak ada deskripsi tambahan.');

                return `
                    <article class="adm-card">
                        <div class="adm-image">
                            <img src="${escapeHtml(imageUrl)}" alt="Foto laporan">

                            <span class="adm-status ${status}">
                                ${statusLabel(status)}
                            </span>

                            <div class="adm-location">
                                <span>📍</span>
                                <span>${escapeHtml(desaName)} • RT ${escapeHtml(rt)}/RW ${escapeHtml(rw)}</span>
                            </div>
                        </div>

                        <div class="adm-body">
                            <h3 class="adm-card-title">${escapeHtml(lokasi)}</h3>

                            <p class="adm-card-desc">${escapeHtml(deskripsi)}</p>

                            <div class="adm-meta">
                                <div class="adm-user">
                                    <div class="adm-avatar">${escapeHtml(initial)}</div>

                                    <div>
                                        <span class="adm-user-label">Pelapor</span>
                                        <span class="adm-user-name">${escapeHtml(userName)}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="adm-actions">
                                <select class="adm-select" id="status-${escapeHtml(item.id)}">
                                    <option value="pending" ${status === 'pending' ? 'selected' : ''}>Pending</option>
                                    <option value="proses" ${status === 'proses' ? 'selected' : ''}>Proses</option>
                                    <option value="selesai" ${status === 'selesai' ? 'selected' : ''}>Selesai</option>
                                </select>

                                <button class="adm-btn update" onclick="updatePengaduanStatus(${escapeHtml(item.id)})">
                                    Update
                                </button>

                                <button class="adm-btn delete" onclick="deletePengaduan(${escapeHtml(item.id)})">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </article>
                `;
            }).join('');
        };

        const loadPengaduan = () => {
            grid.innerHTML = `
                <div class="adm-empty">
                    <span class="adm-loading">Memuat data pengaduan...</span>
                </div>
            `;

            fetch('/api/pengaduan', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(data => {
                if (!Array.isArray(data)) {
                    grid.innerHTML = `
                        <div class="adm-empty">
                            Response API tidak valid.
                        </div>
                    `;
                    return;
                }

                allPengaduan = data;
                setSummary();
                renderData();
            })
            .catch(error => {
                console.error(error);

                grid.innerHTML = `
                    <div class="adm-empty">
                        Gagal memuat data pengaduan. Cek API, token admin, atau koneksi database.
                    </div>
                `;
            });
        };

        window.updatePengaduanStatus = function (id) {
            const select = document.getElementById(`status-${id}`);

            if (!select) {
                alert('Status tidak ditemukan.');
                return;
            }

            const status = select.value;

            fetch(`/api/admin/pengaduan/${id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status })
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                alert('Status pengaduan berhasil diubah.');
                loadPengaduan();
            })
            .catch(error => {
                console.error(error);

                if (error.errors) {
                    const firstError = Object.values(error.errors)[0][0];
                    alert(firstError || 'Validasi gagal.');
                    return;
                }

                alert(error.message || 'Gagal mengubah status pengaduan.');
            });
        };

        window.deletePengaduan = function (id) {
            const confirmDelete = confirm('Yakin mau menghapus pengaduan ini? Data dan foto akan ikut dihapus.');

            if (!confirmDelete) {
                return;
            }

            fetch(`/api/admin/pengaduan/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                alert('Pengaduan berhasil dihapus.');
                loadPengaduan();
            })
            .catch(error => {
                console.error(error);
                alert(error.message || 'Gagal menghapus pengaduan.');
            });
        };

        searchInput.addEventListener('input', renderData);
        statusFilter.addEventListener('change', renderData);
        refreshBtn.addEventListener('click', loadPengaduan);

        loadPengaduan();
    });
</script>
@endpush