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
            $deletedId = self::onlyTrashed()->orderBy('id', 'desc')->pluck('id')->first();
            if ($deletedId) {
                $newId = $deletedId + 1;
                $anggota->no_anggota = str_pad($newId, 3, '0', STR_PAD_LEFT);
            } else {
                $lastId = self::max('id');
                $newId = $lastId ? $lastId + 1 : 1;
                $anggota->no_anggota = str_pad($newId, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
