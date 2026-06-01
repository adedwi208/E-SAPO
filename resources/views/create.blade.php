@extends('app')

@content
<div class="max-w-2xl mx-auto bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Buat Pengaduan Sampah</h1>
        <p class="text-sm text-slate-500">Laporkan tumpukan sampah liar di sekitar wilayah Anda agar segera ditindaklanjuti.</p>
    </div>

    <form id="form-pengaduan" enctype="multipart/form-data" class="space-y-5">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Desa / Kelurahan</label>
            <select id="desa_id" name="desa_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
                <option value="">-- Pilih Desa --</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">RT / RW</label>
            <select id="rtrw_id" name="rtrw_id" required disabled class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50 disabled:opacity-50">
                <option value="">-- Pilih RT/RW --</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Lokasi Spesifik</label>
            <input type="text" name="lokasi_spesifik" required placeholder="Contoh: Jl. Merdeka No. 12, sebelah warung madura" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Kondisi Sampah</label>
            <textarea name="deskripsi" rows="4" required placeholder="Jelaskan kondisi tumpukan sampah secara detail..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-slate-50 resize-none"></textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Bukti Sampah</label>
            <div class="border-2 border-dashed border-slate-300 rounded-xl p-4 text-center bg-slate-50 hover:bg-slate-100 transition cursor-pointer relative">
                <input type="file" name="foto" id="foto-input" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="space-y-1 text-slate-500" id="preview-text">
                    <span class="text-2xl">📸</span>
                    <p class="text-xs font-medium">Klik atau seret gambar ke sini</p>
                    <p class="text-[10px]">Format: PNG, JPG, JPEG (Maks. 2MB)</p>
                </div>
                <img id="image-preview" class="hidden max-h-48 mx-auto rounded-lg shadow-sm" src="#" alt="Preview Foto">
            </div>
        </div>

        <button type="submit" class="w-full bg-primary text-white font-semibold py-3 rounded-xl hover:bg-emerald-600 transition shadow-sm">
            Kirim Laporan Pengaduan
        </button>
    </form>
</div>
@endcontent

@push('scripts')
<script>
    // Helper: ambil token dari localStorage
    function getAuthHeaders() {
        const token = localStorage.getItem('access_token');
        return {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        };
    }

    // 1. Ambil data Desa saat halaman dimuat
    // FIX: tambahkan Authorization header karena route ada di belakang auth:sanctum
    document.addEventListener('DOMContentLoaded', function () {
        fetch('/api/desa', {
            headers: getAuthHeaders()
        })
        .then(res => {
            if (res.status === 401) {
                alert('Sesi habis, silakan login ulang.');
                window.location.href = '/login';
                return;
            }
            return res.json();
        })
        .then(data => {
            if (!data) return;
            const desaSelect = document.getElementById('desa_id');
            data.forEach(desa => {
                let opt = document.createElement('option');
                opt.value = desa.id;
                opt.innerHTML = desa.nama_desa; // sesuai fillable di Model Desa
                desaSelect.appendChild(opt);
            });
        })
        .catch(err => console.error('Gagal memuat desa:', err));
    });

    // 2. Ambil data RT/RW secara dinamis saat Desa dipilih
    // FIX: URL diubah dari /api/rtrw/{id} → /api/desa/{id}/rtrw (sesuai route backend)
    // FIX: tambahkan Authorization header
    document.getElementById('desa_id').addEventListener('change', function () {
        const desaId = this.value;
        const rtrwSelect = document.getElementById('rtrw_id');

        rtrwSelect.innerHTML = '<option value="">-- Pilih RT/RW --</option>';
        if (!desaId) {
            rtrwSelect.disabled = true;
            return;
        }

        fetch(`/api/desa/${desaId}/rtrw`, {  // ← URL sudah diperbaiki
            headers: getAuthHeaders()
        })
        .then(res => res.json())
        .then(data => {
            rtrwSelect.disabled = false;
            data.forEach(item => {
                let opt = document.createElement('option');
                opt.value = item.id;
                opt.innerHTML = `RT ${item.rt} / RW ${item.rw}`;
                rtrwSelect.appendChild(opt);
            });
        })
        .catch(err => console.error('Gagal memuat RT/RW:', err));
    });

    // 3. Preview Foto Sebelum Upload (tidak ada perubahan)
    document.getElementById('foto-input').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('preview-text').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // 4. Submit Form ke API Pengaduan (tidak ada perubahan signifikan)
    document.getElementById('form-pengaduan').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('/api/pengaduan', {
            method: 'POST',
            headers: getAuthHeaders(), // Content-Type TIDAK diset manual, biarkan browser yang atur untuk FormData
            body: formData
        })
        .then(res => res.json())
        .then(resData => {
            if (resData.data) {
                alert('Pengaduan berhasil terkirim!');
                window.location.href = '/';
            } else {
                // Tampilkan pesan error validasi kalau ada
                const errors = resData.errors;
                if (errors) {
                    const messages = Object.values(errors).flat().join('\n');
                    alert('Validasi gagal:\n' + messages);
                } else {
                    alert(resData.message || 'Gagal mengirim aduan, periksa kembali inputan Anda.');
                }
            }
        })
        .catch(err => console.error('Error:', err));
    });
</script>
@endpush