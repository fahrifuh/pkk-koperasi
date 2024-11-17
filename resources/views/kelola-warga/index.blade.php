@extends('layout.template')

@section('title')
    Data Kepala Keluarga | RW 14 Cihurip
@endsection

@section('header')
    Daftar Kepala Keluarga
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ url('data-warga/create') }}" class="btn btn-primary mb-4">Tambah Data</a>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Anggota Koperasi
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat Lengkap</th>
                        <th>No. KK</th>
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
                            <td>{{ $item['nik'] }}</td>
                            <td>{{ $item['nama_lengkap'] }}</td>
                            <td>{{ $item['alamat_lengkap'] }}</td>
                            <td>{{ $item['no_kk'] }}</td>
                            <td>
                                <a href="{{ url('data-warga/' . $item['id']). '/edit' }}" class="btn btn-warning btn-sm">Ubah</a>
                                <form class="d-inline" action="{{ url('data-warga/' . $item['id']) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
