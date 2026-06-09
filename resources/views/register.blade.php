@extends('app')

@section('content')

<style>
    .esapo-register-page {
        min-height: calc(100vh - 130px);
        width: 100%;
        background:
            radial-gradient(circle at top left, rgba(16, 185, 129, 0.22), transparent 35%),
            radial-gradient(circle at bottom right, rgba(20, 184, 166, 0.18), transparent 35%),
            linear-gradient(135deg, #f8fafc 0%, #ecfdf5 48%, #f1f5f9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 46px 18px;
        position: relative;
        overflow: hidden;
    }

    .esapo-register-page::before,
    .esapo-register-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
        filter: blur(2px);
    }

    .esapo-register-page::before {
        width: 280px;
        height: 280px;
        background: rgba(16, 185, 129, 0.16);
        top: 7%;
        left: 10%;
    }

    .esapo-register-page::after {
        width: 230px;
        height: 230px;
        background: rgba(20, 184, 166, 0.16);
        right: 11%;
        bottom: 9%;
    }

    .esapo-register-card {
        width: 100%;
        max-width: 500px;
        background: rgba(255, 255, 255, 0.93);
        backdrop-filter: blur(18px);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 28px;
        padding: 36px;
        box-shadow:
            0 28px 75px rgba(15, 23, 42, 0.12),
            0 10px 30px rgba(16, 185, 129, 0.08);
        position: relative;
        z-index: 2;
    }

    .esapo-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 26px;
    }

    .esapo-logo-box {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        background: linear-gradient(135deg, #10b981, #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 26px;
        box-shadow: 0 14px 28px rgba(16, 185, 129, 0.28);
        flex-shrink: 0;
    }

    .esapo-brand h2 {
        margin: 0;
        font-size: 23px;
        line-height: 1.1;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.04em;
    }

    .esapo-brand p {
        margin: 5px 0 0;
        font-size: 13px;
        font-weight: 500;
        color: #64748b;
    }

    .esapo-header {
        margin-bottom: 26px;
    }

    .esapo-header h1 {
        margin: 0;
        color: #0f172a;
        font-size: 30px;
        line-height: 1.15;
        font-weight: 850;
        letter-spacing: -0.05em;
    }

    .esapo-header p {
        margin: 10px 0 0;
        color: #64748b;
        font-size: 14.5px;
        line-height: 1.65;
    }

    .esapo-form {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .esapo-field label {
        display: block;
        margin-bottom: 8px;
        color: #334155;
        font-size: 13.5px;
        font-weight: 700;
    }

    .esapo-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .esapo-input-icon {
        position: absolute;
        left: 16px;
        font-size: 15px;
        z-index: 2;
        opacity: 0.78;
        pointer-events: none;
    }

    .esapo-input-wrap input {
        width: 100%;
        height: 52px;
        border: 1px solid #e2e8f0;
        outline: none;
        border-radius: 16px;
        padding: 0 16px 0 46px;
        background: rgba(248, 250, 252, 0.95);
        color: #0f172a;
        font-size: 14.5px;
        font-weight: 500;
        transition: 0.22s ease;
    }

    .esapo-input-wrap input::placeholder {
        color: #94a3b8;
    }

    .esapo-input-wrap input:hover {
        border-color: #bbf7d0;
        background: #ffffff;
    }

    .esapo-input-wrap input:focus {
        border-color: #10b981;
        background: #ffffff;
        box-shadow:
            0 0 0 4px rgba(16, 185, 129, 0.13),
            0 10px 25px rgba(15, 23, 42, 0.06);
    }

    .esapo-role-info {
        margin-top: -2px;
        padding: 13px 15px;
        border-radius: 16px;
        background: rgba(236, 253, 245, 0.9);
        border: 1px solid rgba(167, 243, 208, 0.9);
        color: #047857;
        font-size: 13px;
        line-height: 1.55;
        font-weight: 650;
    }

    .esapo-register-btn {
        width: 100%;
        height: 55px;
        margin-top: 6px;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 17px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        font-size: 15px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow:
            0 16px 32px rgba(16, 185, 129, 0.30),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
        transition: 0.24s ease;
    }

    .esapo-register-btn:hover {
        transform: translateY(-2px);
        box-shadow:
            0 20px 40px rgba(16, 185, 129, 0.36),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
    }

    .esapo-register-btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }

    .esapo-register-btn b {
        font-size: 20px;
        transition: 0.24s ease;
    }

    .esapo-register-btn:hover b {
        transform: translateX(4px);
    }

    .esapo-auth-note {
        margin-top: 18px;
        padding: 13px 15px;
        border-radius: 16px;
        background: rgba(209, 250, 229, 0.55);
        border: 1px solid rgba(167, 243, 208, 0.9);
        color: #047857;
        font-size: 13px;
        line-height: 1.55;
        text-align: center;
    }

    .esapo-links {
        margin-top: 22px;
        padding-top: 22px;
        border-top: 1px solid rgba(226, 232, 240, 0.9);
        display: flex;
        flex-direction: column;
        gap: 9px;
        text-align: center;
    }

    .esapo-links p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .esapo-links a {
        color: #059669;
        font-weight: 800;
        text-decoration: none;
    }

    .esapo-links a:hover {
        color: #047857;
        text-decoration: underline;
        text-underline-offset: 4px;
    }

    @media (max-width: 768px) {
        .esapo-register-page {
            min-height: calc(100vh - 120px);
            padding: 34px 16px;
        }

        .esapo-register-card {
            max-width: 460px;
            padding: 30px;
            border-radius: 24px;
        }

        .esapo-header h1 {
            font-size: 27px;
        }
    }

    @media (max-width: 480px) {
        .esapo-register-page {
            align-items: flex-start;
            padding: 26px 14px;
        }

        .esapo-register-page::before {
            width: 170px;
            height: 170px;
            top: 3%;
            left: -45px;
        }

        .esapo-register-page::after {
            width: 160px;
            height: 160px;
            right: -45px;
            bottom: 10%;
        }

        .esapo-register-card {
            padding: 23px;
            border-radius: 22px;
        }

        .esapo-brand {
            gap: 12px;
            margin-bottom: 23px;
        }

        .esapo-logo-box {
            width: 46px;
            height: 46px;
            border-radius: 16px;
            font-size: 22px;
        }

        .esapo-brand h2 {
            font-size: 20px;
        }

        .esapo-brand p {
            font-size: 12px;
        }

        .esapo-header {
            margin-bottom: 22px;
        }

        .esapo-header h1 {
            font-size: 25px;
        }

        .esapo-header p {
            font-size: 13.5px;
            line-height: 1.6;
        }

        .esapo-form {
            gap: 15px;
        }

        .esapo-field label {
            font-size: 13px;
        }

        .esapo-input-wrap input {
            height: 49px;
            border-radius: 15px;
            font-size: 14px;
        }

        .esapo-register-btn {
            height: 52px;
            border-radius: 16px;
            font-size: 14.5px;
        }

        .esapo-auth-note,
        .esapo-role-info {
            font-size: 12.8px;
            padding: 12px 13px;
        }

        .esapo-links {
            margin-top: 20px;
            padding-top: 19px;
        }

        .esapo-links p {
            font-size: 13.5px;
        }
    }

    @media (max-width: 360px) {
        .esapo-register-page {
            padding: 20px 10px;
        }

        .esapo-register-card {
            padding: 20px;
            border-radius: 20px;
        }

        .esapo-header h1 {
            font-size: 23px;
        }

        .esapo-header p {
            font-size: 13px;
        }

        .esapo-input-wrap input {
            height: 47px;
        }

        .esapo-register-btn {
            height: 50px;
        }
    }
</style>

<div class="esapo-register-page">
    <div class="esapo-register-card">

        <div class="esapo-brand">
            <div class="esapo-logo-box">🌱</div>
            <div>
                <h2>E-SAPO</h2>
                <p>Sistem Pelaporan Sampah Liar</p>
            </div>
        </div>

        <div class="esapo-header">
            <h1>Buat Akun Masyarakat</h1>
            <p>
                Daftarkan diri Anda untuk mulai mengirim laporan sampah liar dan membantu lingkungan tetap bersih.
            </p>
        </div>

        <form id="form-register" class="esapo-form">
            <div class="esapo-field">
                <label>Nama Lengkap</label>
                <div class="esapo-input-wrap">
                    <span class="esapo-input-icon">👤</span>
                    <input
                        type="text"
                        name="name"
                        required
                        placeholder="Masukkan nama lengkap"
                    >
                </div>
            </div>

            <div class="esapo-field">
                <label>Alamat Email</label>
                <div class="esapo-input-wrap">
                    <span class="esapo-input-icon">✉</span>
                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="nama@email.com"
                    >
                </div>
            </div>

            <div class="esapo-field">
                <label>Password</label>
                <div class="esapo-input-wrap">
                    <span class="esapo-input-icon">🔒</span>
                    <input
                        type="password"
                        name="password"
                        required
                        minlength="8"
                        placeholder="Minimal 8 karakter"
                    >
                </div>
            </div>

            <div class="esapo-role-info">
                Akun yang dibuat melalui halaman ini otomatis terdaftar sebagai <strong>masyarakat</strong>.
                Setelah registrasi berhasil, silakan login terlebih dahulu.
            </div>

            <button type="submit" id="register-button" class="esapo-register-btn">
                <span id="register-button-text">Daftar Sekarang</span>
                <b>→</b>
            </button>
        </form>

        <div class="esapo-auth-note">
            Gunakan data yang benar agar laporan Anda dapat diproses dengan lebih mudah.
        </div>

        <div class="esapo-links">
            <p>
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk di sini</a>
            </p>

            <p>
                Kembali ke
                <a href="{{ route('home') }}">Beranda</a>
            </p>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        sessionStorage.clear();
        localStorage.clear();
    });

    document.getElementById('form-register').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const button = document.getElementById('register-button');
        const buttonText = document.getElementById('register-button-text');

        button.disabled = true;
        buttonText.textContent = 'Memproses...';

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        data.role = 'masyarakat';

        fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            credentials: 'omit',
            body: JSON.stringify(data)
        })
        .then(async res => {
            const resData = await res.json();

            if (!res.ok) {
                throw resData;
            }

            return resData;
        })
        .then(resData => {
            sessionStorage.clear();
            localStorage.clear();

            alert(resData.message || 'Registrasi berhasil! Silakan login terlebih dahulu.');

            window.location.replace("{{ route('login') }}");
        })
        .catch(err => {
            console.error('Error:', err);

            if (err.errors) {
                const firstError = Object.values(err.errors)[0][0];
                alert(firstError);
            } else {
                alert(err.message || 'Terjadi kesalahan pada sistem registrasi.');
            }

            button.disabled = false;
            buttonText.textContent = 'Daftar Sekarang';
        });
    });
</script>
@endpush