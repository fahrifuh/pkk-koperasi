<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //request data ke api
        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/data-warga";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        return view('kelola-warga.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola-warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $param = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_kk' => $request->no_kk 
        ];
        
        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/data-warga";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($param)
        ]);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $err = $contentArray['data'];
            return redirect()->to('data-warga/create')->withErrors($err)->withInput();
        } else {
            return redirect()->to('data-warga')->with('success', 'Berhasil tambah data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/data-warga/$id";
        $response = $client->request('GET', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $msg = $contentArray['message'];
            return redirect()->to('data-anggota')->withErrors($msg)->withInput();
        } else {
            $data = $contentArray['data'];
            return view('kelola-warga.edit', ['data' => $data]);
        }
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
        $baseUrl = "http://localhost:8000";
        $client = new Client();
        $url = "$baseUrl/api/data-warga/$id";
        $response = $client->request('DELETE', $url);
        $content =  $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $err = $contentArray['data'];
            return redirect()->to('data-warga')->withErrors($err)->withInput();
        } else {
            return redirect()->to('data-warga')->with('success', 'Berhasil hapus data!');
        }
    }
}
