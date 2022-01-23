<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MProduk extends Model
{
    use HasFactory;

    protected $table = 'm_produk';

    protected $fillable = ['kode', 'nama'];
}
