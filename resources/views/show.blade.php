@extends('app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Foto & Deskripsi --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <img src="{{ asset('storage/' . $pengaduan->foto) }}" class="w-full h-64 object-cover" alt="Foto Sampah">
            <div class="p-5">
                <h6 class="font-semibold text-slate-700 mb-2">Deskripsi</h6>
                <p class="text-slate-600 text-sm leading-relaxed">{{ $pengaduan->deskripsi }}</p>
            </div>
        </div>

        <div class="space-y-4">
            {{-- Informasi Lokasi --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                <h5 class="font-bold text-slate-800 mb-4">Informasi Lokasi</h5>
                <p class="text-sm text-slate-500 mb-1">Desa: <strong class="text-slate-700">{{ $pengaduan->desa->nama_desa }}</strong></p>
                <p class="text-sm text-slate-500 mb-1">RT/RW: <strong class="text-slate-700">{{ $pengaduan->rtrw->rt }}/{{ $pengaduan->rtrw->rw }}</strong></p>
                <p class="text-sm text-slate-500 mb-1">Detail: <strong class="text-slate-700">{{ $pengaduan->lokasi_spesifik }}</strong></p>
                <p class="text-sm text-slate-500">Pelapor: <strong class="text-slate-700">{{ $pengaduan->user->name ?? '-' }}</strong></p>
            </div>

            {{-- Status saat ini --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                <h5 class="font-bold text-slate-800 mb-3">Status Laporan</h5>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold
                    {{ $pengaduan->status === 'selesai' ? 'bg-green-100 text-green-700' : 
                       ($pengaduan->status === 'proses' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                    {{ strtoupper($pengaduan->status) }}
                </span>
            </div>

            {{-- Update Status (pakai JS/fetch karena API butuh Bearer token) --}}
            <div class="bg-emerald-600 rounded-2xl shadow-sm p-5">
                <h5 class="font-bold text-white mb-3">Update Status</h5>
                <div class="flex gap-2">
                    <select id="select-status" class="flex-1 px-3 py-2 rounded-xl border-0 text-sm outline-none">
                        <option value="pending"  {{ $pengaduan->status == 'pending'  ? 'selected' : '' }}>Pending</option>
                        <option value="proses"   {{ $pengaduan->status == 'proses'   ? 'selected' : '' }}>Proses</option>
                        <option value="selesai"  {{ $pengaduan->status == 'selesai'  ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button onclick="updateStatus({{ $pengaduan->id }})" class="px-4 py-2 bg-white text-emerald-700 font-bold text-sm rounded-xl hover:bg-emerald-50 transition">
                        Update
                    </button>
                </div>
                <p id="update-msg" class="text-xs text-emerald-100 mt-2 hidden"></p>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function updateStatus(id) {
    const status = document.getElementById('select-status').value;
    const msg    = document.getElementById('update-msg');
    const token  = localStorage.getItem('access_token');

    fetch(`/api/admin/pengaduan/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type':  'application/json',
            'Accept':        'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({ status })
    })
    .then(res => res.json())
    .then(data => {
        msg.textContent = data.message || 'Status berhasil diupdate.';
        msg.classList.remove('hidden');
        setTimeout(() => msg.classList.add('hidden'), 3000);
    })
    .catch(() => {
        msg.textContent = 'Gagal mengupdate status.';
        msg.classList.remove('hidden');
    });
}
</script>
@endpush