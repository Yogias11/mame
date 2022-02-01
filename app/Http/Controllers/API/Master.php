<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KelompokProduk;
use Illuminate\Http\Request;

class Master extends Controller
{
    function get_kelompok_produk()
    {
        $data = KelompokProduk::all();

        return response()->json($data);
    }
}
