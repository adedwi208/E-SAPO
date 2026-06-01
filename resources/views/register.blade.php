@extends('app')

@section('content')
<div class="max-w-md mx-auto my-6 bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Buat Akun Baru</h1>
        <p class="text-sm text-slate-500 mt-1">Daftarkan diri Anda untuk mulai menggunakan layanan E-SAPO</p>
    </div>

    <form id="form-register" class="space-y-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
            <input type="text" name="name" required placeholder="Masukkan nama lengkap" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat Email</label>
            <input type="email" name="email" required placeholder="nama@email.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
            <input type="password" name="password" required placeholder="Minimal 8 karakter" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Daftar Sebagai</label>
            <select name="role" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
                <option value="masyarakat">Masyarakat Umum</option>
                <option value="admin">Petugas / Admin</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-xl hover:bg-emerald-600 transition shadow-sm">
            Daftar Sekarang
        </button>
    </form>

    <div class="text-center mt-6 text-sm text-slate-600">
        Sudah punya akun? <a href="/login" class="text-primary font-semibold hover:underline">Masuk disini</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('form-register').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        fetch('/api/register', {
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
                localStorage.setItem('access_token', resData.access_token);
                localStorage.setItem('user_role', resData.user.role);
                localStorage.setItem('user_name', resData.user.name);

                alert('Registrasi Berhasil!');
                window.location.href = '/';
            } else {
                alert(resData.message || 'Registrasi gagal, periksa kembali data Anda.');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Terjadi kesalahan pada sistem registrasi.');
        });
    });
</script>
@endpush