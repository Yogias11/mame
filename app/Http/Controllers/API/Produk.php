<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MProduk;
use Illuminate\Http\Request;

class Produk extends Controller
{
    function get_data_produk()
    {
        $data = MProduk::all();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('kode', function($d) {
                return $d->kode ? $d->kode : '-';
            })
            ->addColumn('nama', function($d) {
                return $d->nama;
            })
            ->escapeColumns()
            ->make(true);
    }
}
