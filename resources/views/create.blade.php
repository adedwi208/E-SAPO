@extends('app')

@section('content')

{{-- Leaflet CSS --}}
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIINfQ3h8mW9nC7Wq7A6QeV9z1mG8fN5Y0M="
    crossorigin=""
>

<style>
    :root {
        --report-bg: #f6f8f3;
        --report-card: #ffffff;
        --report-dark: #102018;
        --report-text: #24352b;
        --report-muted: #6d7c72;
        --report-line: rgba(16, 32, 24, 0.10);
        --report-green: #16a765;
        --report-green-dark: #087a48;
        --report-green-soft: #def8e9;
        --report-red: #ef4444;
        --report-shadow: 0 18px 48px rgba(18, 34, 25, 0.08);
        --report-radius-xl: 34px;
    }

    * {
        box-sizing: border-box;
    }

    .report-page {
        width: 100%;
        min-height: calc(100vh - 120px);
        margin-top: -24px;
        padding: 34px 0 82px;
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 8% 10%, rgba(22, 167, 101, 0.10), transparent 27%),
            radial-gradient(circle at 92% 6%, rgba(244, 207, 112, 0.16), transparent 22%),
            linear-gradient(180deg, #fbfcf8 0%, var(--report-bg) 48%, #eef5ee 100%);
        color: var(--report-text);
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .report-page::before,
    .report-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        filter: blur(70px);
        pointer-events: none;
        z-index: 0;
    }

    .report-page::before {
        width: 300px;
        height: 300px;
        left: -110px;
        top: 220px;
        background: rgba(22, 167, 101, 0.10);
    }

    .report-page::after {
        width: 280px;
        height: 280px;
        right: -110px;
        bottom: 180px;
        background: rgba(244, 207, 112, 0.13);
    }

    .report-container {
        width: min(1120px, calc(100% - 34px));
        margin-inline: auto;
        position: relative;
        z-index: 2;
    }

    .report-layout {
        display: grid;
        grid-template-columns: minmax(0, 0.82fr) minmax(450px, 1.18fr);
        gap: 22px;
        align-items: start;
    }

    .report-info-card,
    .report-form-card {
        background: var(--report-card);
        border: 1px solid var(--report-line);
        border-radius: var(--report-radius-xl);
        box-shadow: var(--report-shadow);
        overflow: hidden;
    }

    .report-info-card {
        position: sticky;
        top: 28px;
    }

    .report-visual {
        height: 230px;
        position: relative;
        overflow: hidden;
        background: #dfe9df;
    }

    .report-visual img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .report-visual::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(7, 18, 11, 0.05),
            rgba(7, 18, 11, 0.58)
        );
    }

    .report-visual-badge {
        position: absolute;
        left: 18px;
        bottom: 18px;
        z-index: 2;
        min-height: 38px;
        padding: 0 14px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.82);
        border: 1px solid rgba(255, 255, 255, 0.54);
        backdrop-filter: blur(14px);
        color: var(--report-dark);
        font-size: 11px;
        font-weight: 950;
        letter-spacing: 0.10em;
        text-transform: uppercase;
    }

    .report-visual-badge span {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--report-green);
        box-shadow: 0 0 0 5px rgba(22, 167, 101, 0.13);
    }

    .report-info-body {
        padding: 26px;
    }

    .report-info-body h2 {
        margin: 0;
        color: var(--report-dark);
        font-size: 28px;
        line-height: 1.05;
        font-weight: 950;
        letter-spacing: -0.06em;
    }

    .report-info-body p {
        margin: 12px 0 0;
        color: var(--report-muted);
        font-size: 13px;
        line-height: 1.75;
        font-weight: 600;
    }

    .report-steps {
        margin-top: 24px;
        display: grid;
        gap: 12px;
    }

    .report-step {
        display: grid;
        grid-template-columns: 42px 1fr;
        gap: 12px;
        align-items: start;
        padding: 14px;
        border-radius: 20px;
        background: #f6f8f3;
        border: 1px solid rgba(16, 32, 24, 0.07);
    }

    .report-step-icon {
        width: 42px;
        height: 42px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        background: var(--report-green-soft);
        color: var(--report-green-dark);
        font-size: 18px;
    }

    .report-step strong {
        display: block;
        color: var(--report-dark);
        font-size: 13px;
        font-weight: 950;
        letter-spacing: -0.02em;
    }

    .report-step span {
        display: block;
        margin-top: 4px;
        color: var(--report-muted);
        font-size: 12px;
        line-height: 1.55;
        font-weight: 600;
    }

    .report-form-card {
        padding: 32px;
    }

    .report-header {
        margin-bottom: 26px;
    }

    .report-eyebrow {
        width: fit-content;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: var(--report-green-soft);
        color: var(--report-green-dark);
        font-size: 10px;
        font-weight: 950;
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .report-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--report-green);
    }

    .report-header h1 {
        margin: 18px 0 0;
        color: var(--report-dark);
        font-size: clamp(30px, 3vw, 44px);
        line-height: 1.02;
        font-weight: 950;
        letter-spacing: -0.06em;
    }

    .report-header p {
        max-width: 620px;
        margin: 12px 0 0;
        color: var(--report-muted);
        font-size: 13.5px;
        line-height: 1.75;
        font-weight: 600;
    }

    .report-form {
        display: grid;
        gap: 18px;
    }

    .report-field label {
        display: block;
        margin-bottom: 8px;
        color: #304237;
        font-size: 13px;
        font-weight: 850;
    }

    .report-input-wrap {
        position: relative;
    }

    .report-input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        color: #7c8a82;
        font-size: 14px;
        pointer-events: none;
    }

    .report-input,
    .report-select,
    .report-textarea {
        width: 100%;
        border: 1px solid rgba(16, 32, 24, 0.12);
        outline: none;
        border-radius: 17px;
        background: #f8faf6;
        color: var(--report-dark);
        font-size: 14px;
        font-weight: 600;
        transition: 0.22s ease;
    }

    .report-input,
    .report-select {
        height: 52px;
        padding: 0 16px 0 43px;
    }

    .report-select {
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 42px;
    }

    .report-select-arrow {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #7c8a82;
        font-size: 12px;
        pointer-events: none;
    }

    .report-textarea {
        min-height: 132px;
        resize: vertical;
        padding: 15px 16px;
        line-height: 1.7;
    }

    .report-input::placeholder,
    .report-textarea::placeholder {
        color: #9aa59e;
        font-weight: 500;
    }

    .report-input:hover,
    .report-select:hover,
    .report-textarea:hover {
        background: #ffffff;
        border-color: rgba(22, 167, 101, 0.28);
    }

    .report-input:focus,
    .report-select:focus,
    .report-textarea:focus {
        background: #ffffff;
        border-color: var(--report-green);
        box-shadow:
            0 0 0 4px rgba(22, 167, 101, 0.12),
            0 12px 24px rgba(18, 34, 25, 0.06);
    }

    .report-select:disabled {
        opacity: 0.58;
        cursor: not-allowed;
        background: #eef2ee;
    }

    .report-help {
        display: block;
        margin-top: 7px;
        color: #87938b;
        font-size: 11.5px;
        line-height: 1.45;
        font-weight: 600;
    }

    .report-map-card {
        padding: 14px;
        border-radius: 24px;
        background: #f8faf6;
        border: 1px solid rgba(16, 32, 24, 0.10);
    }

    .report-map-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }

    .report-location-btn {
        min-height: 44px;
        padding: 0 15px;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 14px;
        background: var(--report-green);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 900;
        transition: 0.22s ease;
        box-shadow: 0 10px 22px rgba(22, 167, 101, 0.20);
    }

    .report-location-btn:hover {
        transform: translateY(-1px);
        background: var(--report-green-dark);
    }

    .report-location-btn:disabled {
        opacity: 0.65;
        cursor: not-allowed;
        transform: none;
    }

    .report-location-status {
        min-height: 34px;
        padding: 0 11px;
        border-radius: 999px;
        background: #eef2ee;
        color: var(--report-muted);
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }

    .report-location-status::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: #94a3b8;
    }

    .report-location-status.selected {
        color: var(--report-green-dark);
        background: var(--report-green-soft);
    }

    .report-location-status.selected::before {
        background: var(--report-green);
        box-shadow: 0 0 0 4px rgba(22, 167, 101, 0.12);
    }

    #report-map {
        width: 100%;
        height: 360px;
        border-radius: 19px;
        overflow: hidden;
        background: #dfe9df;
        border: 1px solid rgba(16, 32, 24, 0.10);
        z-index: 1;
        position: relative;
        cursor: crosshair;
    }

    .manual-map-marker {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        background: #ef4444;
        border: 5px solid #ffffff;
        position: absolute;
        z-index: 999999 !important;
        transform: translate(-50%, -50%);
        box-shadow:
            0 0 0 8px rgba(239, 68, 68, 0.20),
            0 12px 28px rgba(16, 32, 24, 0.35);
        pointer-events: none;
    }

    .manual-map-marker::after {
        content: "📍";
        position: absolute;
        left: 50%;
        top: -30px;
        transform: translateX(-50%);
        font-size: 25px;
        line-height: 1;
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.25));
    }

    .manual-map-marker-pulse {
        width: 70px;
        height: 70px;
        border-radius: 999px;
        background: rgba(239, 68, 68, 0.16);
        border: 2px solid rgba(239, 68, 68, 0.55);
        position: absolute;
        z-index: 999998 !important;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .report-coordinate-grid {
        margin-top: 12px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .report-coordinate-box {
        min-width: 0;
        padding: 11px 12px;
        border-radius: 15px;
        background: #ffffff;
        border: 1px solid rgba(16, 32, 24, 0.08);
    }

    .report-coordinate-box span {
        display: block;
        color: var(--report-muted);
        font-size: 9px;
        font-weight: 950;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .report-coordinate-box strong {
        display: block;
        margin-top: 5px;
        color: var(--report-dark);
        font-size: 12px;
        font-weight: 850;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .report-upload {
        position: relative;
        min-height: 230px;
        border: 2px dashed rgba(16, 32, 24, 0.18);
        border-radius: 24px;
        background:
            radial-gradient(circle at top left, rgba(22, 167, 101, 0.08), transparent 38%),
            #f8faf6;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.22s ease;
        cursor: pointer;
    }

    .report-upload:hover {
        background:
            radial-gradient(circle at top left, rgba(22, 167, 101, 0.12), transparent 38%),
            #ffffff;
        border-color: rgba(22, 167, 101, 0.45);
    }

    .report-upload input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 5;
    }

    .report-upload-content {
        text-align: center;
        padding: 24px;
    }

    .report-upload-icon {
        width: 68px;
        height: 68px;
        margin-inline: auto;
        border-radius: 24px;
        display: grid;
        place-items: center;
        background: var(--report-green-soft);
        color: var(--report-green-dark);
        font-size: 30px;
    }

    .report-upload-content strong {
        display: block;
        margin-top: 14px;
        color: var(--report-dark);
        font-size: 15px;
        font-weight: 950;
        letter-spacing: -0.02em;
    }

    .report-upload-content span {
        display: block;
        margin-top: 6px;
        color: var(--report-muted);
        font-size: 12px;
        line-height: 1.5;
        font-weight: 600;
    }

    .report-preview {
        width: 100%;
        height: 100%;
        min-height: 230px;
        object-fit: cover;
        display: none;
    }

    .report-upload.has-preview {
        border-style: solid;
    }

    .report-upload.has-preview .report-upload-content {
        display: none;
    }

    .report-upload.has-preview .report-preview {
        display: block;
    }

    .report-preview-change {
        position: absolute;
        right: 14px;
        bottom: 14px;
        z-index: 6;
        min-height: 36px;
        padding: 0 13px;
        border-radius: 999px;
        background: rgba(0, 0, 0, 0.55);
        color: #ffffff;
        backdrop-filter: blur(10px);
        font-size: 11px;
        font-weight: 850;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .report-upload.has-preview .report-preview-change {
        display: inline-flex;
    }

    .report-submit-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 4px;
    }

    .report-submit-btn {
        flex: 1;
        min-height: 56px;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 18px;
        background: var(--report-dark);
        color: #ffffff;
        font-size: 14px;
        font-weight: 950;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 14px 30px rgba(16, 32, 24, 0.16);
        transition: 0.24s ease;
    }

    .report-submit-btn:hover {
        transform: translateY(-2px);
        background: #1a2d22;
        box-shadow: 0 20px 44px rgba(16, 32, 24, 0.18);
    }

    .report-submit-btn:disabled {
        opacity: 0.65;
        cursor: not-allowed;
        transform: none;
    }

    .report-back-link {
        min-height: 56px;
        padding: 0 17px;
        border-radius: 18px;
        background: #f1f5ee;
        color: var(--report-dark);
        border: 1px solid rgba(16, 32, 24, 0.08);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 950;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        transition: 0.22s ease;
        white-space: nowrap;
    }

    .report-back-link:hover {
        transform: translateY(-2px);
        background: #e9efe6;
    }

    .report-alert {
        display: none;
        padding: 13px 15px;
        border-radius: 17px;
        font-size: 12.5px;
        line-height: 1.55;
        font-weight: 700;
        margin-bottom: 18px;
    }

    .report-alert.show {
        display: block;
    }

    .report-alert.error {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    .report-alert.success {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #bbf7d0;
    }

    @media (max-width: 980px) {
        .report-layout {
            grid-template-columns: 1fr;
        }

        .report-info-card {
            position: relative;
            top: auto;
        }

        .report-visual {
            height: 210px;
        }
    }

    @media (max-width: 640px) {
        .report-page {
            margin-top: -18px;
            padding: 24px 0 64px;
        }

        .report-container {
            width: min(100% - 22px, 1120px);
        }

        .report-form-card,
        .report-info-card {
            border-radius: 26px;
        }

        .report-form-card {
            padding: 24px 20px;
        }

        .report-info-body {
            padding: 22px;
        }

        .report-info-body h2 {
            font-size: 24px;
        }

        .report-header h1 {
            font-size: 30px;
        }

        .report-header p {
            font-size: 12.8px;
        }

        .report-input,
        .report-select {
            height: 50px;
            border-radius: 15px;
        }

        .report-textarea {
            min-height: 122px;
            border-radius: 15px;
        }

        .report-map-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .report-location-btn,
        .report-location-status {
            width: 100%;
        }

        .report-location-status {
            justify-content: center;
        }

        #report-map {
            height: 290px;
            border-radius: 17px;
        }

        .report-coordinate-grid {
            grid-template-columns: 1fr;
        }

        .report-upload {
            min-height: 200px;
            border-radius: 20px;
        }

        .report-preview {
            min-height: 200px;
        }

        .report-submit-row {
            flex-direction: column;
            align-items: stretch;
        }

        .report-back-link,
        .report-submit-btn {
            width: 100%;
            min-height: 52px;
        }
    }
</style>

<div class="report-page">
    <div class="report-container">
        <div class="report-layout">

            <aside class="report-info-card">
                <div class="report-visual">
                    <img
                        src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1000"
                        alt="Lingkungan bersih"
                    >

                    <div class="report-visual-badge">
                        <span></span>
                        Laporan Lingkungan
                    </div>
                </div>

                <div class="report-info-body">
                    <h2>Laporkan titik sampah liar dengan data yang jelas.</h2>

                    <p>
                        Pilih desa, tentukan titik pada peta, tulis patokan lokasi,
                        jelaskan kondisi sampah, dan upload foto bukti.
                    </p>

                    <div class="report-steps">
                        <div class="report-step">
                            <div class="report-step-icon">1</div>

                            <div>
                                <strong>Pilih wilayah lapora</strong>
                                <span>Tentukan desa atau kelurahan lokasi sampah liar.</span>
                            </div>
                        </div>

                        <div class="report-step">
                            <div class="report-step-icon">2</div>

                            <div>
                                <strong>Tentukan titik pada peta</strong>
                                <span>Gunakan lokasi perangkat atau klik peta.</span>
                            </div>
                        </div>

                        <div class="report-step">
                            <div class="report-step-icon">3</div>

                            <div>
                                <strong>Lengkapi bukti laporan</strong>
                                <span>Tulis patokan, deskripsi kondisi, dan upload foto.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="report-form-card">
                <div class="report-header">
                    <div class="report-eyebrow">Form Pengaduan</div>

                    <h1>Buat Pengaduan Sampah</h1>

                    <p>
                        Tentukan titik lokasi sampah secara akurat agar petugas
                        lebih mudah menemukan dan menindaklanjuti laporan.
                    </p>
                </div>

                <div id="form-alert" class="report-alert"></div>

                <form
                    id="form-pengaduan"
                    enctype="multipart/form-data"
                    class="report-form"
                >
                    <div class="report-field">
                        <label for="desa_id">Desa / Kelurahan</label>

                        <div class="report-input-wrap">
                            <span class="report-input-icon">🏘️</span>

                            <select
                                id="desa_id"
                                name="desa_id"
                                required
                                class="report-select"
                            >
                                <option value="">Pilih Desa / Kelurahan</option>
                            </select>

                            <span class="report-select-arrow">▼</span>
                        </div>

                        <span class="report-help">
                            Pilih desa atau kelurahan lokasi utama laporan.
                        </span>
                    </div>

                    <div class="report-field">
                        <label>Pilih Titik Lokasi Sampah pada Peta</label>

                        <div class="report-map-card">
                            <div class="report-map-toolbar">
                                <button
                                    type="button"
                                    id="use-my-location"
                                    class="report-location-btn"
                                >
                                    📍 Gunakan Lokasi Saya
                                </button>

                                <div
                                    id="location-status"
                                    class="report-location-status"
                                >
                                    Titik Belum Dipilih
                                </div>
                            </div>

                            <div id="report-map"></div>

                            <div class="report-coordinate-grid">
                                <div class="report-coordinate-box">
                                    <span>Latitude</span>
                                    <strong id="latitude-text">Belum dipilih</strong>
                                </div>

                                <div class="report-coordinate-box">
                                    <span>Longitude</span>
                                    <strong id="longitude-text">Belum dipilih</strong>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">

                        <span class="report-help">
                            Kalau lokasi otomatis gagal, klik langsung titik sampah pada peta.
                        </span>
                    </div>

                    <div class="report-field">
                        <label for="lokasi_spesifik">Lokasi Spesifik / Patokan</label>

                        <div class="report-input-wrap">
                            <span class="report-input-icon">🧭</span>

                            <input
                                type="text"
                                id="lokasi_spesifik"
                                name="lokasi_spesifik"
                                required
                                placeholder="Contoh: Sebelah warung biru, dekat jembatan"
                                class="report-input"
                            >
                        </div>

                        <span class="report-help">
                            Tuliskan patokan tambahan agar petugas mudah menemukan lokasi.
                        </span>
                    </div>

                    <div class="report-field">
                        <label for="deskripsi">Deskripsi Kondisi Sampah</label>

                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            required
                            placeholder="Jelaskan jenis sampah, perkiraan jumlah, kondisi bau, atau dampaknya ke sekitar..."
                            class="report-textarea"
                        ></textarea>

                        <span class="report-help">
                            Semakin jelas deskripsi, semakin mudah laporan diverifikasi.
                        </span>
                    </div>

                    <div class="report-field">
                        <label for="foto-input">Foto Bukti Sampah</label>

                        <div id="upload-box" class="report-upload">
                            <input
                                type="file"
                                name="foto"
                                id="foto-input"
                                accept="image/png, image/jpeg, image/jpg"
                                required
                            >

                            <div class="report-upload-content">
                                <div class="report-upload-icon">📸</div>

                                <strong>Klik untuk upload foto bukti</strong>

                                <span>
                                    Format PNG, JPG, atau JPEG. Maksimal 2MB.
                                </span>
                            </div>

                            <img
                                id="image-preview"
                                class="report-preview"
                                src="#"
                                alt="Preview Foto"
                            >

                            <div class="report-preview-change">
                                Ganti Foto
                            </div>
                        </div>
                    </div>

                    <div class="report-submit-row">
                        <button
                            type="submit"
                            id="submit-btn"
                            class="report-submit-btn"
                        >
                            <span>Kirim Laporan</span>
                            <b>→</b>
                        </button>

                        <a
                            href="{{ route('home') }}"
                            class="report-back-link"
                        >
                            Batal
                        </a>
                    </div>
                </form>
            </main>

        </div>
    </div>
</div>

@endsection

@push('scripts')

{{-- Leaflet JavaScript --}}
<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""
></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const desaSelect = document.getElementById('desa_id');
        const fotoInput = document.getElementById('foto-input');
        const uploadBox = document.getElementById('upload-box');
        const imagePreview = document.getElementById('image-preview');
        const form = document.getElementById('form-pengaduan');
        const alertBox = document.getElementById('form-alert');
        const submitBtn = document.getElementById('submit-btn');

        const useMyLocationBtn = document.getElementById('use-my-location');
        const locationStatus = document.getElementById('location-status');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const latitudeText = document.getElementById('latitude-text');
        const longitudeText = document.getElementById('longitude-text');
        const mapElement = document.getElementById('report-map');

        const token = sessionStorage.getItem('access_token');
        const role = sessionStorage.getItem('user_role');

        const clearSessionAndRedirect = function (message) {
            sessionStorage.removeItem('access_token');
            sessionStorage.removeItem('user_role');
            sessionStorage.removeItem('user_name');

            if (message) {
                alert(message);
            }

            window.location.href = "{{ route('login') }}";
        };

        if (!token) {
            clearSessionAndRedirect('Silakan login terlebih dahulu.');
            return;
        }

        if (role !== 'masyarakat') {
            alert('Halaman buat aduan hanya untuk masyarakat.');
            window.location.href = "{{ route('admin.dashboard') }}";
            return;
        }

        const showAlert = function (message, type = 'error') {
            alertBox.textContent = message;
            alertBox.className = `report-alert show ${type}`;

            alertBox.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        };

        const clearAlert = function () {
            alertBox.textContent = '';
            alertBox.className = 'report-alert';
        };

        const setSubmitLoading = function (isLoading) {
            submitBtn.disabled = isLoading;

            submitBtn.innerHTML = isLoading
                ? '<span>Mengirim Laporan...</span>'
                : '<span>Kirim Laporan</span><b>→</b>';
        };

        /*
        |--------------------------------------------------------------------------
        | Leaflet Map
        |--------------------------------------------------------------------------
        */

        const defaultLocation = [-6.1783, 106.6319];

        const map = L.map('report-map', {
            zoomControl: true,
            scrollWheelZoom: true
        }).setView(defaultLocation, 13);

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                maxZoom: 19,
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }
        ).addTo(map);

        /*
        |--------------------------------------------------------------------------
        | Marker Manual DOM
        |--------------------------------------------------------------------------
        */

        let selectedLatLng = null;
        let manualMarker = null;
        let manualMarkerPulse = null;

        const createManualMarker = function () {
            if (!manualMarkerPulse) {
                manualMarkerPulse = document.createElement('div');
                manualMarkerPulse.className = 'manual-map-marker-pulse';
                mapElement.appendChild(manualMarkerPulse);
            }

            if (!manualMarker) {
                manualMarker = document.createElement('div');
                manualMarker.className = 'manual-map-marker';
                mapElement.appendChild(manualMarker);
            }
        };

        const renderManualMarker = function () {
            if (!selectedLatLng || !manualMarker || !manualMarkerPulse) {
                return;
            }

            const point = map.latLngToContainerPoint(selectedLatLng);

            manualMarker.style.left = `${point.x}px`;
            manualMarker.style.top = `${point.y}px`;

            manualMarkerPulse.style.left = `${point.x}px`;
            manualMarkerPulse.style.top = `${point.y}px`;
        };

        const removeManualMarker = function () {
            if (manualMarker) {
                manualMarker.remove();
                manualMarker = null;
            }

            if (manualMarkerPulse) {
                manualMarkerPulse.remove();
                manualMarkerPulse = null;
            }

            selectedLatLng = null;
        };

        const resetMapLocation = function () {
            latitudeInput.value = '';
            longitudeInput.value = '';

            latitudeText.textContent = 'Belum dipilih';
            longitudeText.textContent = 'Belum dipilih';

            locationStatus.textContent = 'Titik Belum Dipilih';
            locationStatus.classList.remove('selected');

            removeManualMarker();

            map.setView(defaultLocation, 13);
        };

        const setMapLocation = function (latitude, longitude, zoom = 18, moveMap = true) {
            const lat = Number(latitude);
            const lng = Number(longitude);

            if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                showAlert('Koordinat lokasi tidak valid.');
                return;
            }

            const fixedLat = lat.toFixed(7);
            const fixedLng = lng.toFixed(7);

            latitudeInput.value = fixedLat;
            longitudeInput.value = fixedLng;

            latitudeText.textContent = fixedLat;
            longitudeText.textContent = fixedLng;

            locationStatus.textContent = 'Titik Lokasi Dipilih';
            locationStatus.classList.add('selected');

            selectedLatLng = L.latLng(lat, lng);

            createManualMarker();

            if (moveMap) {
                map.setView(selectedLatLng, zoom);
            }

            setTimeout(function () {
                map.invalidateSize();
                renderManualMarker();
            }, 80);
        };

        map.on('click', function (event) {
            clearAlert();

            setMapLocation(
                event.latlng.lat,
                event.latlng.lng,
                map.getZoom(),
                false
            );
        });

        map.on('move zoom resize viewreset', function () {
            renderManualMarker();
        });

        setTimeout(function () {
            map.invalidateSize();
            renderManualMarker();
        }, 250);

        setTimeout(function () {
            map.invalidateSize();
            renderManualMarker();
        }, 800);

        /*
        |--------------------------------------------------------------------------
        | Gunakan Lokasi Saya - Versi Dibenerin
        |--------------------------------------------------------------------------
        */

        const getGeolocationErrorMessage = function (error) {
            if (!error) {
                return 'Gagal mengambil lokasi perangkat. Silakan klik titik lokasi manual pada peta.';
            }

            if (error.code === error.PERMISSION_DENIED) {
                return 'Izin lokasi ditolak. Klik ikon di samping URL, pilih Location, lalu Allow/Izinkan. Setelah itu refresh halaman.';
            }

            if (error.code === error.POSITION_UNAVAILABLE) {
                return 'Lokasi perangkat tidak tersedia dari Windows/Chrome. Ini sering terjadi di laptop/PC. Silakan klik titik lokasi manual pada peta.';
            }

            if (error.code === error.TIMEOUT) {
                return 'Pengambilan lokasi terlalu lama. Coba lagi, atau klik titik lokasi manual pada peta.';
            }

            return 'Gagal mengambil lokasi perangkat. Silakan klik titik lokasi manual pada peta.';
        };

        const requestDeviceLocation = function () {
            clearAlert();

            if (!window.isSecureContext) {
                showAlert(
                    'Fitur lokasi browser hanya aman di localhost/127.0.0.1 atau HTTPS. Pakai http://127.0.0.1:8000/create atau HTTPS.'
                );
                return;
            }

            if (!navigator.geolocation) {
                showAlert('Browser Anda tidak mendukung fitur lokasi perangkat.');
                return;
            }

            useMyLocationBtn.disabled = true;
            useMyLocationBtn.textContent = 'Mencari Lokasi...';

            const finishLoading = function () {
                useMyLocationBtn.disabled = false;
                useMyLocationBtn.textContent = '📍 Gunakan Lokasi Saya';
            };

            const successLocation = function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const accuracy = position.coords.accuracy;

                console.log('Lokasi berhasil:', {
                    latitude: latitude,
                    longitude: longitude,
                    accuracy: accuracy
                });

                setMapLocation(latitude, longitude, 18, true);

                showAlert(
                    `Lokasi berhasil diambil. Akurasi sekitar ${Math.round(accuracy)} meter. Jika titik kurang tepat, klik manual di peta.`,
                    'success'
                );

                finishLoading();
            };

            const finalError = function (error) {
                console.error('Geolocation gagal final:', error);

                showAlert(getGeolocationErrorMessage(error));
                finishLoading();
            };

            const tryLowAccuracy = function () {
                navigator.geolocation.getCurrentPosition(
                    successLocation,
                    finalError,
                    {
                        enableHighAccuracy: false,
                        timeout: 30000,
                        maximumAge: 300000
                    }
                );
            };

            navigator.geolocation.getCurrentPosition(
                successLocation,
                function (firstError) {
                    console.warn('Akurasi tinggi gagal, coba mode biasa:', firstError);

                    tryLowAccuracy();
                },
                {
                    enableHighAccuracy: true,
                    timeout: 12000,
                    maximumAge: 0
                }
            );
        };

        useMyLocationBtn.addEventListener('click', function () {
            if (navigator.permissions && navigator.permissions.query) {
                navigator.permissions.query({ name: 'geolocation' })
                    .then(function (permissionStatus) {
                        console.log('Status izin lokasi:', permissionStatus.state);

                        if (permissionStatus.state === 'denied') {
                            showAlert(
                                'Izin lokasi masih diblokir. Klik ikon di samping URL, ubah Location jadi Allow/Izinkan, lalu refresh halaman.'
                            );
                            return;
                        }

                        requestDeviceLocation();
                    })
                    .catch(function () {
                        requestDeviceLocation();
                    });
            } else {
                requestDeviceLocation();
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Load Desa
        |--------------------------------------------------------------------------
        */

        const loadDesa = function () {
            clearAlert();

            desaSelect.innerHTML =
                '<option value="">Memuat data desa...</option>';

            desaSelect.disabled = true;

            fetch('/api/desa', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(async function (response) {
                let data;

                try {
                    data = await response.json();
                } catch (error) {
                    throw new Error('Respons data desa tidak valid.');
                }

                if (!response.ok) {
                    throw new Error(
                        data.message ||
                        'Gagal memuat data desa.'
                    );
                }

                return data;
            })
            .then(function (data) {
                desaSelect.innerHTML =
                    '<option value="">Pilih Desa / Kelurahan</option>';

                if (!Array.isArray(data)) {
                    showAlert(
                        'Data desa tidak valid. Cek response API /api/desa.'
                    );

                    return;
                }

                if (data.length === 0) {
                    showAlert(
                        'Data desa masih kosong. Isi tabel desas di database.'
                    );

                    return;
                }

                data.forEach(function (desa) {
                    const option = document.createElement('option');

                    option.value = desa.id;

                    option.textContent =
                        desa.nama_desa ||
                        desa.name ||
                        'Nama desa tidak tersedia';

                    desaSelect.appendChild(option);
                });

                desaSelect.disabled = false;
            })
            .catch(function (error) {
                console.error('Error load desa:', error);

                desaSelect.innerHTML =
                    '<option value="">Gagal memuat desa</option>';

                showAlert(
                    error.message ||
                    'Gagal memuat data desa.'
                );
            });
        };

        /*
        |--------------------------------------------------------------------------
        | Preview Foto
        |--------------------------------------------------------------------------
        */

        fotoInput.addEventListener('change', function () {
            clearAlert();

            const file = this.files[0];

            if (!file) {
                uploadBox.classList.remove('has-preview');
                imagePreview.src = '#';

                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/jpg',
                'image/png'
            ];

            const maxSize = 2 * 1024 * 1024;

            if (!allowedTypes.includes(file.type)) {
                this.value = '';

                uploadBox.classList.remove('has-preview');
                imagePreview.src = '#';

                showAlert('Format foto harus PNG, JPG, atau JPEG.');
                return;
            }

            if (file.size > maxSize) {
                this.value = '';

                uploadBox.classList.remove('has-preview');
                imagePreview.src = '#';

                showAlert('Ukuran foto maksimal 2MB.');
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                imagePreview.src = event.target.result;
                uploadBox.classList.add('has-preview');
            };

            reader.readAsDataURL(file);
        });

        /*
        |--------------------------------------------------------------------------
        | Submit Pengaduan
        |--------------------------------------------------------------------------
        */

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            clearAlert();

            const lokasi = document
                .getElementById('lokasi_spesifik')
                .value
                .trim();

            const deskripsi = document
                .getElementById('deskripsi')
                .value
                .trim();

            const latitude = latitudeInput.value.trim();
            const longitude = longitudeInput.value.trim();
            const foto = fotoInput.files[0];

            if (!desaSelect.value) {
                showAlert('Pilih desa terlebih dahulu.');
                return;
            }

            if (!latitude || !longitude) {
                showAlert(
                    'Pilih titik lokasi sampah pada peta terlebih dahulu. Klik langsung titiknya di peta.'
                );

                return;
            }

            if (!lokasi) {
                showAlert('Lokasi spesifik atau patokan wajib diisi.');
                return;
            }

            if (!deskripsi) {
                showAlert('Deskripsi kondisi sampah wajib diisi.');
                return;
            }

            if (!foto) {
                showAlert('Foto bukti sampah wajib diupload.');
                return;
            }

            const formData = new FormData(form);

            setSubmitLoading(true);

            fetch('/api/pengaduan', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async function (response) {
                let data;

                try {
                    data = await response.json();
                } catch (error) {
                    throw new Error('Respons server tidak valid.');
                }

                if (response.status === 401 || response.status === 403) {
                    clearSessionAndRedirect(
                        'Sesi login tidak valid. Silakan login kembali.'
                    );

                    return;
                }

                if (!response.ok) {
                    const validationMessage = data.errors
                        ? Object.values(data.errors)[0][0]
                        : null;

                    throw new Error(
                        validationMessage ||
                        data.message ||
                        'Gagal mengirim pengaduan.'
                    );
                }

                return data;
            })
            .then(function (data) {
                if (!data) {
                    return;
                }

                showAlert(
                    data.message ||
                    'Pengaduan berhasil terkirim.',
                    'success'
                );

                form.reset();

                uploadBox.classList.remove('has-preview');
                imagePreview.src = '#';

                resetMapLocation();

                setTimeout(function () {
                    window.location.href = "{{ route('home') }}";
                }, 1200);
            })
            .catch(function (error) {
                console.error('Error submit pengaduan:', error);

                showAlert(
                    error.message ||
                    'Terjadi kesalahan saat mengirim pengaduan.'
                );
            })
            .finally(function () {
                setSubmitLoading(false);
            });
        });

        /*
        |--------------------------------------------------------------------------
        | Jalankan Saat Halaman Dibuka
        |--------------------------------------------------------------------------
        */

        resetMapLocation();
        loadDesa();
    });
</script>

@endpush