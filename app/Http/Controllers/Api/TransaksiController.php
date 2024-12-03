<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('transaksi')
            ->distinct()
            ->join('detail_transaksi', 'transaksi.id', '=', 'detail_transaksi.id_transaksi')
            ->join('anggota_koperasi', 'transaksi.id_anggota', '=', 'anggota_koperasi.id')
            ->get([
                'anggota_koperasi.nama',
                'transaksi.tanggal_transaksi',
                'detail_transaksi.jenis_simpanan',
                'detail_transaksi.jumlah_simpanan'
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Tersedia!',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'tglTransaksi' => 'required|date',
            'nama' => 'required',
            'detail' => 'required|array',
            'detail.*.jenis' => 'required|in:wajib,pokok,sukarela',
            'detail.*.jumlah' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak valid!',
                'data' => $validator->errors()
            ], 401);
        }

        

        $jumlahAll = 0;

        foreach($request->detail as $item){
            $jumlahAll += $item['jumlah'];
            if($item['jenis'] == 'pokok'){
                $cekTransaksi = DetailTransaksi::whereHas('transactions', function($query) use ($request){
                    $query->where('id_anggota', $request->nama);
                })->where('jenis_simpanan', 'pokok')->first();

                if($cekTransaksi){
                    return response()->json([
                        'status' => false,
                        'message' => 'Anggota sudah membayar simpanan pokok.'
                    ]);
                }
            }

        }

        $transaksi = new Transaksi();
        $transaksi->tanggal_transaksi = $request->tglTransaksi;
        $transaksi->id_anggota = $request->nama;
        $transaksi->jumlah = $jumlahAll;
        $transaksi->save();

        foreach($request->detail as $item){
            $detail = new DetailTransaksi();
            $detail->id_transaksi = $transaksi->id;
            $detail->jenis_simpanan = $item['jenis'];
            $detail->jumlah_simpanan = $item['jumlah'];
            $detail->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Berhasil tambah data!'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
