<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKoperasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambah data!',
                'data' => $validator->errors()
            ]);
        }

        $dataAnggota = new AnggotaKoperasi;
        $dataAnggota->nama = $request->nama;
        $dataAnggota->alamat = $request->alamat;
        $dataAnggota->tgl_daftar = $request->tglDaftar;

        $post = $dataAnggota->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil tambah data!'
        ]);
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
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataAnggota = AnggotaKoperasi::find($id);
        if(empty($dataAnggota)){
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

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Gagal ubah data!',
                'data' => $validator->errors()
            ]);
        }

        $dataAnggota->nama = $request->nama;
        $dataAnggota->alamat = $request->alamat;
        $dataAnggota->tgl_daftar = $request->tglDaftar;

        $post = $dataAnggota->save();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil ubah data!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataAnggota = AnggotaKoperasi::find($id);
        if(empty($dataAnggota)){
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $post = $dataAnggota->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil hapus data!'
        ]);
    }
}
