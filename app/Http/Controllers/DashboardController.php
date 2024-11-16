<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKoperasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $countAnggota = AnggotaKoperasi::count();
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('dashboard', compact('countAnggota'));
            } else {
                return view('kelola-koperasi.index');
            }
        }
    }
}
