<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['produk_id', 'kelompok_produk_id', 'kode', 'merk', 'nama', 'nama_coo', 'coo', 'no_akd', 'ket', 'status'];

    function kelompokProduk()
    {
        return $this->belongsTo(KelompokProduk::class, 'kelompok_produk_id');
    }

    function produk()
    {
        return $this->belongsTo(MProduk::class, 'produk_id');
    }
}
