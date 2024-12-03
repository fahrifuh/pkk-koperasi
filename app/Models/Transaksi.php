<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_anggota', 'tanggal_transaksi', 'jumlah'
    ];

    protected $table = 'transaksi';

    public function details(){
        return $this->hasMany(DetailTransaksi::class);
    }

    public function anggota(){
        return $this->belongsTo(AnggotaKoperasi::class);
    }
}
