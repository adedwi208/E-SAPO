@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-0 shadow-sm">
            <img src="{{ asset('storage/' . $pengaduan->foto) }}" class="card-img-top" alt="Foto Sampah">
            <div class="card-body">
                <h6 class="fw-bold">Deskripsi</h6>
                <p>{{ $pengaduan->deskripsi }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Informasi Lokasi</h5>
                <p class="mb-1 text-muted">Desa: <strong>{{ $pengaduan->desa->nama_desa }}</strong></p>
                <p class="mb-1 text-muted">RT/RW: <strong>{{ $pengaduan->rtrw->rt }}/{{ $pengaduan->rtrw->rw }}</strong></p>
                <p class="mb-0 text-muted">Detail: <strong>{{ $pengaduan->lokasi_spesifik }}</strong></p>
            </div>
        </div>

        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <h5 class="fw-bold mb-3 text-white">Update Status</h5>
                <form action="{{ url('/api/admin/pengaduan/'.$pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <button type="submit" class="btn btn-light text-success fw-bold">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection