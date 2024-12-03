<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKoperasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AnggotaKoperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AnggotaKoperasi::all();
        return response()->json([
            'status' => true,
            'message' => 'Data tersedia!',
            'data' => $data
        ], 200);
    }

    /**
     * Mengambil data user
     */
    public function getAkun()
    {
        $data = User::where('role', 'warga')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data tersedia!',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'tglDaftar' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak valid!',
                'data' => $validator->errors()
            ], 401);
        }

        $dataAnggota = new AnggotaKoperasi();
        $dataAnggota->nama = $request->nama;
        $dataAnggota->alamat = $request->alamat;
        $dataAnggota->tgl_daftar = $request->tglDaftar;
        $dataAnggota->save();

        $nama = $request->nama;
        $idAnggota = $dataAnggota->id;
        $this->generateAccount($nama, $idAnggota);

        //generate akun untuk anggota
        return response()->json([
            'status' => true,
            'message' => 'Berhasil tambah data!'
        ], 200);
    }

    private function generateAccount($nama, $idAnggota)
    {
        $username = strtolower(str_replace(' ', '', $nama));

        if (strlen($username) < 4) {
            $username = $username . strtolower(Str::random(4 - strlen($username)));
        }

        $password = $username . rand(1000, 9999);
        $hashedPassword = bcrypt($password);

        $dataUser = new User();
        $dataUser->name = $nama;
        $dataUser->username = $username;
        $dataUser->password = $hashedPassword;
        $dataUser->ori_password = $password;
        $dataUser->id_anggota = $idAnggota;
        return $dataUser->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = AnggotaKoperasi::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan!',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataAnggota = AnggotaKoperasi::find($id);
        if (empty($dataAnggota)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'tglDaftar' => 'required|date'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal ubah data!',
                'data' => $validator->errors()
            ], 401);
        }

        $dataAnggota->nama = $request->nama;
        $dataAnggota->alamat = $request->alamat;
        $dataAnggota->tgl_daftar = $request->tglDaftar;

        $dataAnggota->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil ubah data!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataAnggota = AnggotaKoperasi::find($id);
        if (empty($dataAnggota)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $dataAnggota->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil hapus data!'
        ], 200);
    }

    public function deleteAkun(string $id)
    {
        $akun = User::find($id);
        if (empty($akun)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $akun->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil hapus data!'
        ], 200);
    }
}
