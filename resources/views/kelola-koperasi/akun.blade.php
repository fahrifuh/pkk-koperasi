@extends('layout.template')

@section('title')
    Data Akun Anggota | Koperasi RW 14 Cihurip
@endsection

@section('header')
    Daftar Akun Anggota
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ url('data-anggota') }}" class="btn btn-secondary mb-4">Kembali</a>

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
                        <th>Nama Anggota</th>
                        <th>Username</th>
                        <th>Password</th>
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
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['username'] }}</td>
                            <td>{{ $item['ori_password'] }}</td>
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
