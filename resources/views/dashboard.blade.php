@extends('layout.template')

@section('title')
Dashboard | Koperasi RW 14 Cihurip
@endsection

@section('header')
Dashboard
@endsection

<<<<<<< HEAD
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
=======
@section ('content')
<div class="row justify-content-center">
    <div class="col-xl-5 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Jumlah Anggota : {{ $countAnggota }} </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="{{ url('data-anggota') }}">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
>>>>>>> 22fda59 (perbaikan code)
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Jumlah Warga : {{ $countWarga }}</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Success Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Danger Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
@endsection