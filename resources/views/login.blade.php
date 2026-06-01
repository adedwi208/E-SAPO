@extends('app')

@section('content')
<div class="max-w-md mx-auto my-12 bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Selamat Datang</h1>
        <p class="text-sm text-slate-500 mt-1">Masuk ke akun E-SAPO untuk melaporkan sampah liar</p>
    </div>

    <form id="form-login" class="space-y-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
            <input type="email" name="email" required placeholder="nama@email.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
            <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
        </div>

        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-xl hover:bg-emerald-600 transition shadow-sm">
            Masuk Sekarang
        </button>
    </form>

    <div class="text-center mt-6 text-sm text-slate-600">
        Belum punya akun? <a href="/register" class="text-primary font-semibold hover:underline">Daftar disini</a>
    </div>
</div>
@endsection

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
        .then(res => res.json())
        .then(resData => {
            if (resData.access_token) {
                // Simpan token dan data user ke browser
                localStorage.setItem('access_token', resData.access_token);
                localStorage.setItem('user_role', resData.role);
                localStorage.setItem('user_name', resData.user.name);
                
                alert('Login Berhasil!');
                window.location.href = '/'; // Lempar ke halaman utama/index
            } else {
                alert(resData.message || 'Email atau password salah.');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Terjadi kesalahan sistem.');
        });
    });
</script>
@endpush