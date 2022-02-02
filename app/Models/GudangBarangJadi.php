<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangBarangJadi extends Model
{
    use HasFactory;

    protected $table = 'gdg_barang_jadi';

    protected $fillable = ['produk_id', 'kode', 'nama', 'deskripsi', 'stok', 'satuan_id'];

    function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
