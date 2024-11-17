@extends('layout.template')

@section('title')
    Tambah Data Kepala Keluarga | RW 14 Cihurip
@endsection

@section('header')
    Tambah Data Kepala Keluarga
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
    <form action="{{ route('data-warga.store') }}" method="POST">
        @csrf

        <label for="nik" class="form-label mt-3 fw-semibold">NIK</label>
        <input type="number" class="form-control border-dark" name="nik" id="nik" autocomplete="off"
            value="{{ old('nik') }}" inputmode="numeric" onmousewheel="return false" onkeydown="handleArrowKey(event)" />

        <label for="nama" class="form-label mt-3 fw-semibold">Nama Lengkap</label>
        <input type="text" class="form-control border-dark" name="nama" id="nama" autocomplete="off"
            value="{{ old('nama') }}" />

        <label for="alamat" class="form-label mt-3 fw-semibold">Alamat Lengkap</label>
        <textarea class="form-control border-dark" name="alamat" id="alamat" autocomplete="off">{{ old('alamat') }}</textarea>

        <label for="no_kk" class="form-label mt-3 fw-semibold">Nomor Kartu Keluarga</label>
        <input type="number" class="form-control border-dark" name="no_kk" id="no_kk" autocomplete="off"
            value="{{ old('no_kk') }}" inputmode="numeric" onmousewheel="return false" onkeydown="handleArrowKey(event)" />
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-primary mt-3" name="submit">Simpan</button>
            <a href="{{ url('data-warga') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </form>
@endsection
