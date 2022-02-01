<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokProduk extends Model
{
    use HasFactory;

    protected $table = 'kelompok_produk';

    protected $fillable = ['jenis_id', 'nama'];

    function jenis()
    {
        return $this->belongsTo(Mjenis::class,'jenis_id');
    }
}
