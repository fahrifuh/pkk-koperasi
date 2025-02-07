<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKoperasi;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //request data ke api
        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/transaksi";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        return view('transaksi.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = AnggotaKoperasi::get(['id', 'nama']);
        return view('transaksi.create', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $param = [
            'nama' => $request->nama,
            'tglTransaksi' => $request->tglTransaksi,
            'detail' => $request->detail
        ];

        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/transaksi";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($param)
        ]);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $err = $contentArray['data'];
            return redirect()->to('data-anggota/transaksi/create')->withErrors($err)->withInput();
        } else {
            return redirect()->to('data-anggota/transaksi')->with('success', 'Berhasil tambah data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //request data ke api
        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/transaksi/$id";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        $detail = $contentArray['detail'];

        return view('transaksi.index', [
            'data' => $data,
            'detail' => $detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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

    public function generatePdfById(string $id)
    {
        $transaksiDetail= DB::table('detail_transaksi')
        ->join('transaksi', 'transaksi.id', '=', 'detail_transaksi.id_transaksi')
        ->where('id_transaksi', $id)
        ->get([
            'transaksi.tanggal_transaksi',
            'detail_transaksi.*'
        ]);
        $tanggalCetak = Carbon::now('Asia/Jakarta')->format('d F Y, H:i');

        $pdf = Pdf::loadview('pdf.struck', ['transaksiDetail' => $transaksiDetail, 'tanggalCetak' => $tanggalCetak]);
        return $pdf->stream('transaksi_' . $id . 'pdf');
    }

    public function generatePDF(){
        //request data ke api
        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/transaksi";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $transaksi = $contentArray['data'];
        
        $tanggalCetak = Carbon::now('Asia/Jakarta')->format('d F Y, H:i');

        $pdf = Pdf::loadView('pdf.struck',['transaksi' => $transaksi, 'tanggalCetak' => $tanggalCetak]);
        return $pdf->stream('riwayat_transaksi.pdf');
    }
}
