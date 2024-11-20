<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKoperasi;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $countAnggota = AnggotaKoperasi::count();
        $countWarga = Warga::count();
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('dashboard', compact('countAnggota', 'countWarga'));
            } else {
                return redirect()->route('data-anggota.index');
            }
        }
    }
}
