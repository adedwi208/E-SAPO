@extends('app')

@section('content')

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
        --report-yellow: #f4cf70;
        --report-red: #ef4444;
        --report-blue: #2f80ed;
        --report-shadow: 0 18px 48px rgba(18, 34, 25, 0.08);
        --report-shadow-hover: 0 24px 64px rgba(18, 34, 25, 0.13);
        --report-radius-xl: 34px;
        --report-radius-lg: 26px;
        --report-radius-md: 18px;
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
        grid-template-columns: minmax(0, 0.86fr) minmax(420px, 1.14fr);
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
        background: linear-gradient(180deg, rgba(7, 18, 11, 0.05), rgba(7, 18, 11, 0.58));
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

    .report-grid-2 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
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
        background: rgba(0,0,0,0.55);
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

        .report-grid-2 {
            grid-template-columns: 1fr;
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
                        Pastikan lokasi, RT/RW, deskripsi kondisi, dan foto bukti diisi dengan benar
                        agar petugas lebih mudah melakukan verifikasi.
                    </p>

                    <div class="report-steps">
                        <div class="report-step">
                            <div class="report-step-icon">1</div>
                            <div>
                                <strong>Pilih wilayah laporan</strong>
                                <span>Tentukan desa/kelurahan dan RT/RW sesuai titik kejadian.</span>
                            </div>
                        </div>

                        <div class="report-step">
                            <div class="report-step-icon">2</div>
                            <div>
                                <strong>Jelaskan kondisi lapangan</strong>
                                <span>Tulis lokasi spesifik dan deskripsi agar laporan mudah dipahami.</span>
                            </div>
                        </div>

                        <div class="report-step">
                            <div class="report-step-icon">3</div>
                            <div>
                                <strong>Upload foto bukti</strong>
                                <span>Gunakan foto yang jelas sebagai dokumentasi kondisi sampah.</span>
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
                        Isi data laporan dengan lengkap. Laporan yang dikirim akan masuk ke sistem
                        E-SAPO untuk dipantau dan ditindaklanjuti.
                    </p>
                </div>

                <div id="form-alert" class="report-alert"></div>

                <form id="form-pengaduan" enctype="multipart/form-data" class="report-form">
                    <div class="report-grid-2">
                        <div class="report-field">
                            <label for="desa_id">Desa / Kelurahan</label>

                            <div class="report-input-wrap">
                                <span class="report-input-icon">🏘️</span>

                                <select id="desa_id" name="desa_id" required class="report-select">
                                    <option value="">Pilih Desa / Kelurahan</option>
                                </select>

                                <span class="report-select-arrow">▼</span>
                            </div>

                            <span class="report-help">Pilih wilayah utama lokasi aduan.</span>
                        </div>

                        <div class="report-field">
                            <label for="rtrw_id">RT / RW</label>

                            <div class="report-input-wrap">
                                <span class="report-input-icon">📍</span>

                                <select id="rtrw_id" name="rtrw_id" required disabled class="report-select">
                                    <option value="">Pilih RT/RW</option>
                                </select>

                                <span class="report-select-arrow">▼</span>
                            </div>

                            <span class="report-help">RT/RW akan aktif setelah desa dipilih.</span>
                        </div>
                    </div>

                    <div class="report-field">
                        <label for="lokasi_spesifik">Lokasi Spesifik</label>

                        <div class="report-input-wrap">
                            <span class="report-input-icon">🧭</span>

                            <input
                                type="text"
                                id="lokasi_spesifik"
                                name="lokasi_spesifik"
                                required
                                placeholder="Contoh: Jl. Merdeka No. 12, sebelah warung"
                                class="report-input"
                            >
                        </div>

                        <span class="report-help">Tuliskan patokan lokasi agar petugas mudah menemukan titik sampah.</span>
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

                        <span class="report-help">Semakin jelas deskripsi, semakin mudah laporan diverifikasi.</span>
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

                            <div id="preview-text" class="report-upload-content">
                                <div class="report-upload-icon">📸</div>
                                <strong>Klik untuk upload foto bukti</strong>
                                <span>Format PNG, JPG, atau JPEG. Maksimal 2MB agar proses upload lebih ringan.</span>
                            </div>

                            <img id="image-preview" class="report-preview" src="#" alt="Preview Foto">

                            <div class="report-preview-change">
                                Ganti Foto
                            </div>
                        </div>
                    </div>

                    <div class="report-submit-row">
                        <button type="submit" id="submit-btn" class="report-submit-btn">
                            <span>Kirim Laporan</span>
                            <b>→</b>
                        </button>

                        <a href="{{ route('home') }}" class="report-back-link">
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const desaSelect = document.getElementById('desa_id');
        const rtrwSelect = document.getElementById('rtrw_id');
        const fotoInput = document.getElementById('foto-input');
        const uploadBox = document.getElementById('upload-box');
        const imagePreview = document.getElementById('image-preview');
        const form = document.getElementById('form-pengaduan');
        const alertBox = document.getElementById('form-alert');
        const submitBtn = document.getElementById('submit-btn');

        const showAlert = (message, type = 'error') => {
            alertBox.textContent = message;
            alertBox.className = `report-alert show ${type}`;
        };

        const clearAlert = () => {
            alertBox.textContent = '';
            alertBox.className = 'report-alert';
        };

        const setSubmitLoading = (isLoading) => {
            submitBtn.disabled = isLoading;
            submitBtn.innerHTML = isLoading
                ? '<span>Mengirim Laporan...</span>'
                : '<span>Kirim Laporan</span><b>→</b>';
        };

        const safeText = (value, fallback = '') => {
            if (value === null || value === undefined || value === '') return fallback;
            return String(value);
        };

        const loadDesa = () => {
            fetch('/api/desa', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                desaSelect.innerHTML = '<option value="">Pilih Desa / Kelurahan</option>';

                if (!Array.isArray(data)) {
                    showAlert('Data desa tidak valid. Cek kembali response API /api/desa.');
                    return;
                }

                data.forEach(desa => {
                    const option = document.createElement('option');
                    option.value = desa.id;
                    option.textContent = desa.nama_desa || desa.name || 'Nama desa tidak tersedia';
                    desaSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Gagal memuat data desa. Pastikan API desa dan koneksi database aktif.');
            });
        };

        const loadRtrw = (desaId) => {
            rtrwSelect.innerHTML = '<option value="">Memuat RT/RW...</option>';
            rtrwSelect.disabled = true;

            if (!desaId) {
                rtrwSelect.innerHTML = '<option value="">Pilih RT/RW</option>';
                return;
            }

            fetch(`/api/rtrw/${desaId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                rtrwSelect.innerHTML = '<option value="">Pilih RT/RW</option>';

                if (!Array.isArray(data)) {
                    showAlert('Data RT/RW tidak valid. Cek kembali response API RT/RW.');
                    return;
                }

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = `RT ${safeText(item.rt, '-')} / RW ${safeText(item.rw, '-')}`;
                    rtrwSelect.appendChild(option);
                });

                rtrwSelect.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                rtrwSelect.innerHTML = '<option value="">Gagal memuat RT/RW</option>';
                showAlert('Gagal memuat data RT/RW. Cek route API atau database.');
            });
        };

        desaSelect.addEventListener('change', function () {
            clearAlert();
            loadRtrw(this.value);
        });

        fotoInput.addEventListener('change', function () {
            clearAlert();

            const file = this.files[0];

            if (!file) {
                uploadBox.classList.remove('has-preview');
                imagePreview.src = '#';
                return;
            }

            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
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

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            clearAlert();

            const token = localStorage.getItem('access_token');

            if (!token) {
                showAlert('Anda harus login terlebih dahulu sebelum membuat laporan.');
                return;
            }

            const formData = new FormData(this);

            setSubmitLoading(true);

            fetch('/api/pengaduan', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(data => {
                if (data.data || data.id || data.message) {
                    showAlert('Pengaduan berhasil terkirim. Anda akan diarahkan ke halaman utama.', 'success');

                    setTimeout(() => {
                        window.location.href = '/';
                    }, 800);

                    return;
                }

                showAlert('Gagal mengirim aduan. Periksa kembali inputan Anda.');
            })
            .catch(error => {
                console.error('Error:', error);

                if (error.errors) {
                    const firstError = Object.values(error.errors)[0][0];
                    showAlert(firstError || 'Validasi gagal. Periksa kembali data yang Anda isi.');
                    return;
                }

                showAlert(error.message || 'Terjadi kesalahan saat mengirim pengaduan.');
            })
            .finally(() => {
                setSubmitLoading(false);
            });
        });

        loadDesa();
    });
</script>
@endpush