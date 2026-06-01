<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // MASYARAKAT: Membuat aduan baru
    public function store(Request $request)
    {
        $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'rtrw_id' => 'required|exists:rtrws,id',
            'lokasi_spesifik' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file foto ke folder storage/app/public/pengaduan-sampah
        $fotoPath = $request->file('foto')->store('pengaduan-sampah', 'public');

        $pengaduan = Pengaduan::create([
            'user_id' => auth()->id(), 
            'desa_id' => $request->desa_id,
            'rtrw_id' => $request->rtrw_id,
            'lokasi_spesifik' => $request->lokasi_spesifik,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Pengaduan sampah berhasil dikirim!',
            'data' => $pengaduan
        ], 201);
    }

    // ADMIN: [READ] Lihat semua pengaduan masyarakat secara detail
    public function index()
    {
        $pengaduan = Pengaduan::with(['user', 'desa', 'rtrw'])->latest()->get();
        return response()->json($pengaduan);
    }

    // ADMIN: [READ DETAIL] Lihat detail satu pengaduan
    public function show($id)
    {
        $pengaduan = Pengaduan::with(['user', 'desa', 'rtrw'])->findOrFail($id);
        return response()->json($pengaduan);
    }

    // ADMIN: [UPDATE] Memperbarui status pengaduan
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Status pengaduan berhasil diubah.',
            'data' => $pengaduan
        ]);
    }

    // ADMIN: [DELETE] Menghapus data laporan beserta filenya
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return response()->json([
            'message' => 'Pengaduan berhasil dihapus.'
        ]);
    }

    // Tambahkan method ini di PengaduanController
    public function stats()
    {
    return response()->json([
        'total'   => Pengaduan::count(),
        'pending' => Pengaduan::where('status', 'pending')->count(),
        'proses'  => Pengaduan::where('status', 'proses')->count(),
        'selesai' => Pengaduan::where('status', 'selesai')->count(),
    ]);
    }
}