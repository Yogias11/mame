<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KelompokProduk;
use App\Models\Mjenis;
use App\Models\Satuan;
use Illuminate\Http\Request;

class Master extends Controller
{
    function get_kelompok_produk()
    {
        $data = KelompokProduk::all();

        return response()->json($data);
    }

    function get_jenis_kelompok()
    {
        $data = Mjenis::all();
        return response()->json($data);
    }

    function get_satuan()
    {
        $data = Satuan::all();
        return response()->json($data);
    }
}
