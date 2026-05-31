<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Rtrw;

class WilayahController extends Controller
{
    public function getDesa()
    {
        return response()->json(Desa::all());
    }

    public function getRtrwByDesa($desa_id)
    {
        $rtrw = Rtrw::where('desa_id', $desa_id)->get();
        return response()->json($rtrw);
    }
}