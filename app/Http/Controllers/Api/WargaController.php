<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Warga::all();
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
            'nik' => 'required|integer',
            'nama' => 'required',
            'alamat' => 'required',
            'no_kk' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak valid  !',
                'data' => $validator->errors()
            ]);
        }

        $dataWarga = new Warga();
        $dataWarga->nik = $request->nik;
        $dataWarga->nama_lengkap = $request->nama;
        $dataWarga->alamat_lengkap = $request->alamat;
        $dataWarga->no_kk = $request->no_kk;
        $post = $dataWarga->save();

        if ($post) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil tambah data!'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal tambah data!'
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Warga::find($id);
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
        $data = Warga::find($id);
        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $rules = [
            'nik' => 'required|integer',
            'nama' => 'required',
            'alamat' => 'required',
            'no_kk' => 'required|integer'
        ];

        $messages = [
            'nik.required' => 'NIK harus diisi!',
            'nik.integer' => 'NIK harus angka, dimulai dari angka selain 0!',
            'nama.required' => 'Nama harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'no_kk.required' => 'Nomor KK harus diisi!',
            'no_kk.integer' => 'Nomor KK harus angka, dimulai dari angka selain 0!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak valid  !',
                'data' => $validator->errors()
            ]);
        }

        $data->nik = $request->nik;
        $data->nama_lengkap = $request->nama;
        $data->alamat_lengkap = $request->alamat;
        $data->no_kk = $request->no_kk;
        $post = $data->save();

        if ($post) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil ubah data!'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal ubah data!'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataWarga = Warga::find($id);
        if (empty($dataWarga)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $dataWarga->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil hapus data!'
        ], 200);
    }
}
