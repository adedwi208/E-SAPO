<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Rtrw;

class WilayahController extends Controller
{
    public function getDesa()
    {
        $desa = Desa::orderBy('nama_desa', 'asc')->get();

        return response()->json($desa);
    }

    public function getRtrwByDesa($desa_id)
    {
        $rtrw = Rtrw::where('desa_id', $desa_id)
            ->orderBy('rw', 'asc')
            ->orderBy('rt', 'asc')
            ->get();

        return response()->json($rtrw);
    }
}