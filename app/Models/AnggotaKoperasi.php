<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKoperasi extends Model
{
    use HasFactory;

    protected $table = 'anggota_koperasi';
    protected $fillable = [
        'nama',
        'alamat',
        'tgl_daftar'
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($anggota) {
            $lastId = self::max('id');
            $newId = $lastId ? $lastId + 1 : 1;
            $anggota->no_anggota = str_pad($newId, 3, '0', STR_PAD_LEFT);
        });
    }
}
