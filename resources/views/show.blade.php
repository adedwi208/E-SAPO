@extends('app')

@section('content')

<style>
    :root {
        --detail-bg: #f6f8f3;
        --detail-card: #ffffff;
        --detail-dark: #102018;
        --detail-text: #24352b;
        --detail-muted: #6d7c72;
        --detail-line: rgba(16, 32, 24, 0.10);
        --detail-green: #16a765;
        --detail-green-dark: #087a48;
        --detail-green-soft: #def8e9;
        --detail-yellow: #f4cf70;
        --detail-orange: #f2994a;
        --detail-blue: #2f80ed;
        --detail-red: #ef4444;
        --detail-shadow: 0 18px 48px rgba(18, 34, 25, 0.08);
        --detail-shadow-hover: 0 24px 64px rgba(18, 34, 25, 0.13);
    }

    * {
        box-sizing: border-box;
    }

    .detail-page {
        width: 100%;
        min-height: calc(100vh - 120px);
        margin-top: -24px;
        padding: 34px 0 82px;
        position: relative;
        overflow: hidden;
        color: var(--detail-text);
        background:
            radial-gradient(circle at 8% 10%, rgba(22, 167, 101, 0.10), transparent 27%),
            radial-gradient(circle at 92% 6%, rgba(244, 207, 112, 0.16), transparent 22%),
            linear-gradient(180deg, #fbfcf8 0%, var(--detail-bg) 48%, #eef5ee 100%);
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .detail-page::before,
    .detail-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        filter: blur(70px);
        pointer-events: none;
        z-index: 0;
    }

    .detail-page::before {
        width: 300px;
        height: 300px;
        left: -110px;
        top: 220px;
        background: rgba(22, 167, 101, 0.10);
    }

    .detail-page::after {
        width: 280px;
        height: 280px;
        right: -110px;
        bottom: 180px;
        background: rgba(244, 207, 112, 0.13);
    }

    .detail-container {
        width: min(1120px, calc(100% - 34px));
        margin-inline: auto;
        position: relative;
        z-index: 2;
    }

    .detail-header {
        margin-bottom: 22px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
    }

    .detail-eyebrow {
        width: fit-content;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: var(--detail-green-soft);
        color: var(--detail-green-dark);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .detail-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--detail-green);
        box-shadow: 0 0 0 5px rgba(22, 167, 101, 0.12);
    }

    .detail-title {
        margin: 14px 0 0;
        color: var(--detail-dark);
        font-size: clamp(30px, 3vw, 46px);
        line-height: 1.02;
        font-weight: 950;
        letter-spacing: -0.065em;
    }

    .detail-subtitle {
        max-width: 620px;
        margin: 10px 0 0;
        color: var(--detail-muted);
        font-size: 13.5px;
        line-height: 1.75;
        font-weight: 600;
    }

    .detail-back {
        min-height: 44px;
        padding: 0 16px;
        border-radius: 15px;
        background: #ffffff;
        border: 1px solid var(--detail-line);
        box-shadow: 0 8px 20px rgba(18, 34, 25, 0.04);
        color: var(--detail-dark);
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

    .detail-back:hover {
        transform: translateY(-2px);
        background: #f1f5ee;
    }

    .detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.08fr) minmax(360px, 0.92fr);
        gap: 22px;
        align-items: start;
    }

    .detail-photo-card,
    .detail-info-card,
    .detail-status-card {
        background: var(--detail-card);
        border: 1px solid var(--detail-line);
        border-radius: 34px;
        box-shadow: var(--detail-shadow);
        overflow: hidden;
    }

    .detail-photo-wrap {
        position: relative;
        height: 430px;
        background: #dfe9df;
        overflow: hidden;
    }

    .detail-photo-wrap img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .detail-photo-wrap::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(7, 18, 11, 0.02), rgba(7, 18, 11, 0.56));
    }

    .detail-photo-badge {
        position: absolute;
        left: 18px;
        top: 18px;
        z-index: 2;
        min-height: 38px;
        padding: 0 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.82);
        border: 1px solid rgba(255, 255, 255, 0.54);
        backdrop-filter: blur(14px);
        color: var(--detail-dark);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 950;
        letter-spacing: 0.10em;
        text-transform: uppercase;
    }

    .detail-photo-badge span {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--detail-green);
        box-shadow: 0 0 0 5px rgba(22, 167, 101, 0.13);
    }

    .detail-status-pill {
        position: absolute;
        right: 18px;
        top: 18px;
        z-index: 2;
        min-height: 38px;
        padding: 0 14px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.36);
    }

    .detail-status-pill.pending {
        background: rgba(254, 243, 199, 0.94);
        color: #7b4d08;
    }

    .detail-status-pill.proses {
        background: rgba(224, 246, 255, 0.94);
        color: #0b5a8d;
    }

    .detail-status-pill.selesai {
        background: rgba(220, 252, 231, 0.95);
        color: #047857;
    }

    .detail-description {
        padding: 26px;
    }

    .detail-description h2,
    .detail-info-card h2,
    .detail-status-card h2 {
        margin: 0;
        color: var(--detail-dark);
        font-size: 22px;
        line-height: 1.18;
        font-weight: 950;
        letter-spacing: -0.045em;
    }

    .detail-description p {
        margin: 12px 0 0;
        color: var(--detail-muted);
        font-size: 14px;
        line-height: 1.8;
        font-weight: 600;
    }

    .detail-side {
        display: grid;
        gap: 18px;
    }

    .detail-info-card,
    .detail-status-card {
        padding: 26px;
    }

    .detail-info-list {
        margin-top: 20px;
        display: grid;
        gap: 12px;
    }

    .detail-info-item {
        display: grid;
        grid-template-columns: 44px 1fr;
        gap: 12px;
        align-items: start;
        padding: 15px;
        border-radius: 21px;
        background: #f7faf6;
        border: 1px solid rgba(16, 32, 24, 0.07);
    }

    .detail-info-icon {
        width: 44px;
        height: 44px;
        border-radius: 17px;
        display: grid;
        place-items: center;
        background: var(--detail-green-soft);
        color: var(--detail-green-dark);
        font-size: 18px;
    }

    .detail-info-label {
        display: block;
        color: #87938b;
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        line-height: 1;
    }

    .detail-info-value {
        display: block;
        margin-top: 7px;
        color: var(--detail-dark);
        font-size: 14px;
        line-height: 1.45;
        font-weight: 850;
    }

    .detail-status-card {
        background:
            radial-gradient(circle at top right, rgba(22, 167, 101, 0.12), transparent 36%),
            #ffffff;
    }

    .detail-status-card p {
        margin: 10px 0 0;
        color: var(--detail-muted);
        font-size: 13px;
        line-height: 1.7;
        font-weight: 600;
    }

    .detail-status-form {
        margin-top: 20px;
        display: grid;
        gap: 14px;
    }

    .detail-select-wrap {
        position: relative;
    }

    .detail-select {
        width: 100%;
        height: 54px;
        border: 1px solid rgba(16, 32, 24, 0.12);
        outline: none;
        border-radius: 18px;
        background: #f8faf6;
        color: var(--detail-dark);
        padding: 0 44px 0 16px;
        font-size: 14px;
        font-weight: 750;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        transition: 0.22s ease;
    }

    .detail-select:focus {
        background: #ffffff;
        border-color: var(--detail-green);
        box-shadow:
            0 0 0 4px rgba(22, 167, 101, 0.12),
            0 12px 24px rgba(18, 34, 25, 0.06);
    }

    .detail-select-arrow {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #7c8a82;
        font-size: 12px;
        pointer-events: none;
    }

    .detail-update-btn {
        width: 100%;
        min-height: 54px;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 18px;
        background: var(--detail-dark);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        font-size: 13px;
        font-weight: 950;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        box-shadow: 0 14px 30px rgba(16, 32, 24, 0.16);
        transition: 0.24s ease;
    }

    .detail-update-btn:hover {
        transform: translateY(-2px);
        background: #1a2d22;
    }

    .detail-warning {
        margin-top: 14px;
        padding: 13px 14px;
        border-radius: 17px;
        background: #fffbeb;
        border: 1px solid #fde68a;
        color: #92400e;
        font-size: 12px;
        line-height: 1.6;
        font-weight: 700;
    }

    @media (max-width: 980px) {
        .detail-layout {
            grid-template-columns: 1fr;
        }

        .detail-photo-wrap {
            height: 360px;
        }
    }

    @media (max-width: 640px) {
        .detail-page {
            margin-top: -18px;
            padding: 24px 0 64px;
        }

        .detail-container {
            width: min(100% - 22px, 1120px);
        }

        .detail-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .detail-back {
            width: 100%;
        }

        .detail-photo-card,
        .detail-info-card,
        .detail-status-card {
            border-radius: 26px;
        }

        .detail-photo-wrap {
            height: 260px;
        }

        .detail-description,
        .detail-info-card,
        .detail-status-card {
            padding: 22px;
        }

        .detail-title {
            font-size: 30px;
        }

        .detail-subtitle {
            font-size: 12.8px;
        }

        .detail-photo-badge,
        .detail-status-pill {
            min-height: 34px;
            padding: 0 11px;
            font-size: 9px;
        }

        .detail-photo-badge {
            left: 14px;
            top: 14px;
        }

        .detail-status-pill {
            right: 14px;
            top: 14px;
        }
    }
</style>

@php
    $statusClass = $pengaduan->status ?? 'pending';

    if (!in_array($statusClass, ['pending', 'proses', 'selesai'])) {
        $statusClass = 'pending';
    }

    $statusLabel = [
        'pending' => 'Pending',
        'proses' => 'Proses',
        'selesai' => 'Selesai',
    ][$statusClass];

    $fotoPath = $pengaduan->foto
        ? asset('storage/' . $pengaduan->foto)
        : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1000';
@endphp

<div class="detail-page">
    <div class="detail-container">

        <div class="detail-header">
            <div>
                <div class="detail-eyebrow">Detail Pengaduan</div>

                <h1 class="detail-title">
                    Informasi Laporan Sampah
                </h1>

                <p class="detail-subtitle">
                    Halaman ini menampilkan bukti foto, deskripsi, lokasi, serta status terbaru
                    dari laporan pengaduan masyarakat.
                </p>
            </div>

            <a href="{{ route('home') }}" class="detail-back">
                ← Kembali
            </a>
        </div>

        <div class="detail-layout">
            <section class="detail-photo-card">
                <div class="detail-photo-wrap">
                    <img src="{{ $fotoPath }}" alt="Foto bukti pengaduan sampah">

                    <div class="detail-photo-badge">
                        <span></span>
                        Bukti Foto
                    </div>

                    <div class="detail-status-pill {{ $statusClass }}">
                        {{ $statusLabel }}
                    </div>
                </div>

                <div class="detail-description">
                    <h2>Deskripsi Kondisi</h2>

                    <p>
                        {{ $pengaduan->deskripsi ?: 'Belum ada deskripsi tambahan untuk laporan ini.' }}
                    </p>
                </div>
            </section>

            <aside class="detail-side">
                <section class="detail-info-card">
                    <h2>Informasi Lokasi</h2>

                    <div class="detail-info-list">
                        <div class="detail-info-item">
                            <div class="detail-info-icon">🏘️</div>

                            <div>
                                <span class="detail-info-label">Desa / Kelurahan</span>
                                <span class="detail-info-value">
                                    {{ optional($pengaduan->desa)->nama_desa ?? 'Data desa belum tersedia' }}
                                </span>
                            </div>
                        </div>

                        <div class="detail-info-item">
                            <div class="detail-info-icon">📍</div>

                            <div>
                                <span class="detail-info-label">RT / RW</span>
                                <span class="detail-info-value">
                                    RT {{ optional($pengaduan->rtrw)->rt ?? '-' }} / RW {{ optional($pengaduan->rtrw)->rw ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="detail-info-item">
                            <div class="detail-info-icon">🧭</div>

                            <div>
                                <span class="detail-info-label">Lokasi Spesifik</span>
                                <span class="detail-info-value">
                                    {{ $pengaduan->lokasi_spesifik ?: 'Lokasi spesifik belum tersedia' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="detail-status-card">
                    <h2>Update Status</h2>

                    <p>
                        Ubah status laporan sesuai proses penanganan di lapangan.
                    </p>

                    <form action="{{ url('/api/admin/pengaduan/'.$pengaduan->id) }}" method="POST" class="detail-status-form">
                        @csrf
                        @method('PUT')

                        <div class="detail-select-wrap">
                            <select name="status" class="detail-select">
                                <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>

                            <span class="detail-select-arrow">▼</span>
                        </div>

                        <button type="submit" class="detail-update-btn">
                            Update Status →
                        </button>
                    </form>

                    <div class="detail-warning">
                        Pastikan status hanya diubah setelah laporan benar-benar diverifikasi atau ditindaklanjuti.
                    </div>
                </section>
            </aside>
        </div>

    </div>
</div>

@endsection