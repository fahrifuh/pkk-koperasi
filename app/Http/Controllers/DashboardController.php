<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKoperasi;
use App\Models\Transaksi;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $anggotaID = Auth::user()->id_anggota;
        $countAnggota = AnggotaKoperasi::count();
        $countWarga = Warga::count();
        $countTransaksi = Transaksi::where('id_anggota', $anggotaID)->count();
        $sumTransaksi = Transaksi::where('id_anggota', $anggotaID)->sum('jumlah');
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('dashboard', compact('countAnggota', 'countWarga'));
            } else {
                return view('wargaDashboard', compact('countTransaksi', 'sumTransaksi'));
            }
        }
    }
}
