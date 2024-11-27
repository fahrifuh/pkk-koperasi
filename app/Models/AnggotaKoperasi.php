<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnggotaKoperasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anggota_koperasi';
    protected $fillable = [
        'nama',
        'alamat',
        'tgl_daftar',
        'deleted_at'
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
