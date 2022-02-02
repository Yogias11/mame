<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    function index_produk()
    {
        return view('admin.produk.index');
    }

    function index_produk_sub()
    {
        return view('admin.produk.produk');
    }

    function index_kategori()
    {
        return view('admin.kelompokproduk.index');
    }

    function index_varian()
    {
        return view('admin.produk.varian');
    }
}
