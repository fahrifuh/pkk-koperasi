@extends('layout.template')

@section('title')
    Dashboard | Koperasi RW 14 Cihurip
@endsection

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-5 col-md-6">
            <div class="rounded text-white mb-4 d-flex flex-column gap-2 p-2" style="background-color: #1D3D70;">
                <p class="text-white fw-semibold fs-4">
                    JUMLAH ANGGOTA KOPERASI
                </p>
                <p class="text-white fw-semibold fs-5">
                    {{ $countAnggota }}
                </p>
            </div>
        </div>
        <div class="col-xl-5 col-md-6">
            <div class="rounded text-white mb-4 d-flex flex-column gap-2 p-2" style="background-color: #1D3D70;">
                <p class="text-white fw-semibold fs-4">
                    JUMLAH WARGA
                </p>
                <p class="text-white fw-semibold fs-5">
                    {{ $countWarga }}
                </p>
            </div>
        </div>
    </div>
@endsection
