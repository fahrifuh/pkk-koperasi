<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKoperasi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AnggotaKoperasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //request data ke api
        $client = new Client();
        $url = "http://localhost:8000/api/data-anggota";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        return view('kelola-koperasi.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // format nomor anggota
        $lastId = AnggotaKoperasi::max('id');
        $newId = $lastId ? $lastId + 1 : 1;
        $no_anggota = str_pad($newId, 3, '0', STR_PAD_LEFT);

        return view('kelola-koperasi.create', compact('no_anggota'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nama = $request->nama;
        $alamat = $request->alamat;
        $tglDaftar = $request->tglDaftar;

        $param = [
            'nama' => $nama,
            'alamat' => $alamat,
            'tglDaftar' => $tglDaftar 
        ];

        $client = new Client();
        $url = "http://localhost:8000/api/data-anggota";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($param)
        ]);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $err = $contentArray['data'];
            return redirect()->to('data-anggota/create')->withErrors($err)->withInput();
        } else {
            return redirect()->to('data-anggota')->with('success', 'Berhasil tambah data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = new Client();
        $url = "http://localhost:8000/api/data-anggota/$id";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $msg = $contentArray['message'];
            return redirect()->to('data-anggota')->withErrors($msg)->withInput();
        } else {
            $data = $contentArray['data'];
            return view('kelola-koperasi.edit', ['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $noAnggota = $request->noAnggota;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $tglDaftar = $request->tglDaftar;

        $param = [
            'noAnggota' => $noAnggota,
            'nama' => $nama,
            'alamat' => $alamat,
            'tglDaftar' => $tglDaftar
        ];

        $client = new Client();
        $url = "http://localhost:8000/api/data-anggota/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($param)
        ]);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $err = $contentArray['data'];
            return redirect()->to('data-anggota/edit')->withErrors($err)->withInput();
        } else {
            return redirect()->to('data-anggota')->with('success', 'Berhasil ubah data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = new Client();
        $url = "http://localhost:8000/api/data-anggota/$id";
        $response = $client->request('DELETE', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $err = $contentArray['data'];
            return redirect()->to('data-anggota')->withErrors($err)->withInput();
        } else {
            return redirect()->to('data-anggota')->with('success', 'Berhasil hapus data!');
        }
    }
}
