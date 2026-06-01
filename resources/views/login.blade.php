@extends('app')

@section('content')

<style>
    .esapo-login-page {
        min-height: calc(100vh - 130px);
        width: 100%;
        background:
            radial-gradient(circle at top left, rgba(16, 185, 129, 0.22), transparent 35%),
            radial-gradient(circle at bottom right, rgba(20, 184, 166, 0.18), transparent 35%),
            linear-gradient(135deg, #f8fafc 0%, #ecfdf5 48%, #f1f5f9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 52px 18px;
        position: relative;
        overflow: hidden;
    }

    .esapo-login-page::before,
    .esapo-login-page::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        filter: blur(2px);
        pointer-events: none;
    }

    .esapo-login-page::before {
        width: 260px;
        height: 260px;
        background: rgba(16, 185, 129, 0.16);
        top: 8%;
        left: 12%;
    }

    .esapo-login-page::after {
        width: 220px;
        height: 220px;
        background: rgba(20, 184, 166, 0.16);
        right: 12%;
        bottom: 10%;
    }

    .esapo-login-card {
        width: 100%;
        max-width: 470px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(18px);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 28px;
        padding: 38px;
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
        margin-bottom: 28px;
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
        margin-bottom: 28px;
    }

    .esapo-header h1 {
        margin: 0;
        color: #0f172a;
        font-size: 31px;
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
        gap: 18px;
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
        height: 53px;
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

    .esapo-login-btn {
        width: 100%;
        height: 55px;
        margin-top: 4px;
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

    .esapo-login-btn:hover {
        transform: translateY(-2px);
        box-shadow:
            0 20px 40px rgba(16, 185, 129, 0.36),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
    }

    .esapo-login-btn b {
        font-size: 20px;
        transition: 0.24s ease;
    }

    .esapo-login-btn:hover b {
        transform: translateX(4px);
    }

    .esapo-links {
        margin-top: 26px;
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
        .esapo-login-page {
            min-height: calc(100vh - 120px);
            padding: 34px 16px;
        }

        .esapo-login-card {
            max-width: 440px;
            padding: 30px;
            border-radius: 24px;
        }

        .esapo-header h1 {
            font-size: 27px;
        }
    }

    @media (max-width: 480px) {
        .esapo-login-page {
            padding: 28px 14px;
            align-items: flex-start;
        }

        .esapo-login-card {
            padding: 24px;
            border-radius: 22px;
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

        .esapo-header h1 {
            font-size: 25px;
        }

        .esapo-header p {
            font-size: 13.5px;
        }

        .esapo-input-wrap input {
            height: 50px;
            font-size: 14px;
        }

        .esapo-login-btn {
            height: 52px;
            font-size: 14.5px;
        }
    }
</style>

<div class="esapo-login-page">
    <div class="esapo-login-card">

        <div class="esapo-brand">
            <div class="esapo-logo-box">♻</div>
            <div>
                <h2>E-SAPO</h2>
                <p>Sistem Pelaporan Sampah Liar</p>
            </div>
        </div>

        <div class="esapo-header">
            <h1>Selamat Datang</h1>
            <p>Masuk ke akun E-SAPO untuk melaporkan sampah liar dengan mudah dan cepat.</p>
        </div>

        <form id="form-login" class="esapo-form">
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
                        placeholder="Masukkan password"
                    >
                </div>
            </div>

            <button type="submit" class="esapo-login-btn">
                <span>Masuk Sekarang</span>
                <b>→</b>
            </button>
        </form>

    <div class="esapo-links">
    <p>
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar di sini</a>
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
@push('scripts')
<script>
    document.getElementById('form-login').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
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
            if (resData.access_token) {
                localStorage.setItem('access_token', resData.access_token);
                localStorage.setItem('user_role', resData.role);
                localStorage.setItem('user_name', resData.user.name);

                alert('Login Berhasil!');

                if (resData.role === 'admin') {
                    window.location.href = '/admin/dashboard';
                } else if (resData.role === 'masyarakat') {
                    window.location.href = '/masyarakat/dashboard';
                } else {
                    alert('Role akun tidak dikenali.');
                    localStorage.clear();
                    window.location.href = '/login';
                }
            } else {
                alert(resData.message || 'Email atau password salah.');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert(err.message || 'Terjadi kesalahan sistem.');
        });
    });
</script>
@endpush