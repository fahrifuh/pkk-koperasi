@extends('layout.template')

@section('title')
    Data Transaksi | Koperasi RW 14 Cihurip
@endsection

@section('header')
    Daftar Riwayat Transaksi
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ url('data-anggota/transaksi/create') }}" class="btn btn-primary mb-4">Tambah Data</a>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Riwayat Transaksi
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal</th>
                        <th>Jenis Simpanan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                @php
                                    echo $no;
                                @endphp
                            </td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ date('d/m/Y', strtotime($item['tanggal_transaksi'])) }}</td>
                            <td>{{ $item['jenis_simpanan'] }}</td>
                            <td>{{ $item['jumlah_simpanan'] }}</td>
                            <td>
                               
                            </td>
                        </tr>
                        @php
                            $no++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
