<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-SAPO - Sistem Pengaduan Sampah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#10b981', /* Hijau Segar */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="/" class="text-xl font-bold text-primary flex items-center gap-2">
                🌱 <span>E-SAPO</span>
            </a>
            
            <nav class="flex items-center gap-4" id="nav-menu">
                <a href="/login" class="text-sm font-medium text-slate-600 hover:text-primary">Masuk</a>
                <a href="/register" class="text-sm font-medium bg-primary text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition">Daftar</a>
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-6xl w-full mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-6 text-center text-sm text-slate-500 mt-auto">
        &copy; {{ date('Y') }} E-SAPO. Global Institute. All rights reserved.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('access_token');
            const userName = localStorage.getItem('user_name');
            const navMenu = document.getElementById('nav-menu');

            // Jika user sudah login (token tersedia di local storage)
            if (token && userName) {
                navMenu.innerHTML = `
                    <a href="/create" class="text-sm font-medium text-slate-600 hover:text-primary">➕ Buat Aduan</a>
                    <div class="h-4 w-px bg-slate-200"></div>
                    <span class="text-sm font-medium text-slate-700">Halo, <strong class="text-primary">${userName}</strong></span>
                    <button onclick="logoutAccount()" class="text-sm font-medium text-red-500 hover:text-red-600 hover:underline cursor-pointer">Keluar</button>
                `;
            }
        });

        // Fungsi membersihkan token saat logout
        function logoutAccount() {
            if(confirm('Apakah Anda yakin ingin keluar dari sistem E-SAPO?')) {
                const token = localStorage.getItem('access_token');
                
                // Opsional: Tembak ke API logout backend agar token di personal_access_tokens terhapus
                fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                }).finally(() => {
                    // Hapus semua data session dari local storage browser
                    localStorage.clear();
                    alert('Anda telah berhasil keluar.');
                    window.location.href = '/login';
                });
            }
        }
    </script>

    @stack('scripts')
</body>
</html>