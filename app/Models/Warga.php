<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik', 'nama_lengkap', 'alamat_lengkap', 'no_kk'
    ];

    protected $table = 'warga';
}
