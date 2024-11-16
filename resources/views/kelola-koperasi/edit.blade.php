@extends('layout.template')

@section('title')
    Ubah Data Anggota | Koperasi RW 14 Cihurip
@endsection

@section('header')
    Ubah Data Anggota
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('data-anggota/'. $data['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="noAnggota" class="form-label mt-3 fw-semibold">Nomor Anggota</label>
        <input type="text" class="form-control border-dark" name="noAnggota" id="noAnggota" autocomplete="off"
            value="{{ old('noAnggota', $data['no_anggota'] ) }}" disabled/>

        <label for="nama" class="form-label mt-3 fw-semibold">Nama Anggota</label>
        <input type="text" class="form-control border-dark" name="nama" id="nama" autocomplete="off"
            value="{{ old('nama', $data['nama']) }}" />

        <label for="alamat" class="form-label mt-3 fw-semibold">Alamat</label>
        <textarea class="form-control border-dark" name="alamat" id="alamat" autocomplete="off">{{ old('alamat', $data['alamat']) }}</textarea>

        <label for="tglDaftar" class="form-label mt-3 fw-semibold">Tanggal Pendaftaran</label>
        <input type="date" class="form-control border-dark" name="tglDaftar" id="tglDaftar" autocomplete="off"
            value="{{ old('tglDaftar', $data['tgl_daftar']) }}" />

        <button type="submit" class="btn btn-primary mt-3" name="submit">Simpan</button>
    </form>
    <button class="btn btn-secondary mt-2" onclick="window.location.href='{{ url('data-anggota') }}'">Kembali</button>
@endsection
