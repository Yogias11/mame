<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mjenis extends Model
{
    use HasFactory;

    protected $table = 'm_jenis_gks';

    protected $fillable = ['nama'];
}
