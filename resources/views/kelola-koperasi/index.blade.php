@extends('layout.template')

@section('title')
    Data Anggota | Koperasi RW 14 Cihurip
@endsection

@section('header')
    Daftar Anggota 
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ url('data-anggota/create') }}" class="btn btn-primary mb-4">Tambah Data</a>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Anggota Koperasi
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggal Pendaftaran</th>
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
                            <td>{{ $item['alamat'] }}</td>
                            <td>{{ date('d/m/Y', strtotime($item['tgl_daftar'])) }}</td>
                            <td>
                                <a href="{{ url('data-anggota/' . $item['id']). '/edit' }}" class="btn btn-warning btn-sm">Ubah</a>
                                <form class="d-inline" action="{{ url('data-anggota/' . $item['id']) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
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
