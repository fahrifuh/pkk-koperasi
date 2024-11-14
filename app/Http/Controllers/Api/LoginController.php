<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'status' => true,
                'message' => 'Login berhasil!',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login gagal, data tidak cocok!'
            ], 401);
        }
    }

    public function logout(){
        Auth::logout();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil!'
        ]);
    }
}
