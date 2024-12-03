<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi', 'jenis_simpanan', 'jumlah_simpanan'
    ];

    protected $table = 'detail_transaksi';

    public function transactions(){
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
