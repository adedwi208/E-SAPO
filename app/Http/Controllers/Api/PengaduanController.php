<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC INDEX
    |--------------------------------------------------------------------------
    | Dipakai dashboard masyarakat / halaman publik untuk transparansi laporan.
    |--------------------------------------------------------------------------
    */

    public function publicIndex()
    {
        $pengaduan = Pengaduan::with([
                'user:id,name',
                'desa:id,nama_desa',
            ])
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->foto_url = $item->foto
                    ? asset('storage/' . $item->foto)
                    : null;

                return $item;
            });

        return response()->json($pengaduan);
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN INDEX
    |--------------------------------------------------------------------------
    | Dipakai admin untuk melihat semua data laporan.
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pengaduan = Pengaduan::with([
                'user',
                'desa',
            ])
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->foto_url = $item->foto
                    ? asset('storage/' . $item->foto)
                    : null;

                return $item;
            });

        return response()->json($pengaduan);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    | Dipakai masyarakat untuk membuat laporan baru.
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'lokasi_spesifik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'desa_id.required' => 'Desa wajib dipilih.',
            'desa_id.exists' => 'Desa yang dipilih tidak valid.',

            'latitude.required' => 'Titik latitude lokasi wajib dipilih.',
            'latitude.numeric' => 'Latitude harus berupa angka.',

            'longitude.required' => 'Titik longitude lokasi wajib dipilih.',
            'longitude.numeric' => 'Longitude harus berupa angka.',

            'lokasi_spesifik.required' => 'Lokasi spesifik wajib diisi.',
            'lokasi_spesifik.max' => 'Lokasi spesifik maksimal 255 karakter.',

            'deskripsi.required' => 'Deskripsi wajib diisi.',

            'foto.required' => 'Foto bukti wajib diupload.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        $pengaduan = Pengaduan::create([
            'user_id' => $request->user()->id,
            'desa_id' => $request->desa_id,
            'rtrw_id' => null,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'lokasi_spesifik' => $request->lokasi_spesifik,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status' => 'pending',
        ]);

        $pengaduan->foto_url = $pengaduan->foto
            ? asset('storage/' . $pengaduan->foto)
            : null;

        return response()->json([
            'message' => 'Pengaduan berhasil dikirim.',
            'data' => $pengaduan,
        ], 201);
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | Dipakai admin / detail untuk melihat satu laporan.
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $pengaduan = Pengaduan::with([
                'user',
                'desa',
            ])
            ->find($id);

        if (!$pengaduan) {
            return response()->json([
                'message' => 'Data pengaduan tidak ditemukan.'
            ], 404);
        }

        $pengaduan->foto_url = $pengaduan->foto
            ? asset('storage/' . $pengaduan->foto)
            : null;

        return response()->json($pengaduan);
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    | Dipakai admin untuk mengubah status laporan.
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::find($id);

        if (!$pengaduan) {
            return response()->json([
                'message' => 'Data pengaduan tidak ditemukan.'
            ], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
        ], [
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status harus pending, proses, atau selesai.',
        ]);

        $pengaduan->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Status pengaduan berhasil diperbarui.',
            'data' => $pengaduan,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    | Dipakai admin untuk menghapus laporan.
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $pengaduan = Pengaduan::find($id);

        if (!$pengaduan) {
            return response()->json([
                'message' => 'Data pengaduan tidak ditemukan.'
            ], 404);
        }

        if ($pengaduan->foto && Storage::disk('public')->exists($pengaduan->foto)) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return response()->json([
            'message' => 'Pengaduan berhasil dihapus.'
        ]);
    }
}