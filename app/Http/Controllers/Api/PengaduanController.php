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
            'lokasi_spesifik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        $pengaduan = Pengaduan::create([
            'user_id' => $request->user()->id,
            'desa_id' => $request->desa_id,
            'rtrw_id' => null,
            'lokasi_spesifik' => $request->lokasi_spesifik,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Pengaduan berhasil dikirim.',
            'data' => $pengaduan,
        ], 201);
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | Dipakai admin untuk melihat detail satu laporan.
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