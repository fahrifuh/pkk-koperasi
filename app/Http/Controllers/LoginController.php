<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required | min:8',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->intended('/');
        }

        return back()->withErrors(['Username atau password salah.']);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
