@extends('layout.template')

@section('title')
    Data Transaksi | Koperasi RW 14 Cihurip
@endsection

@section('header')
    Riwayat Transaksi
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
        @if (Auth::check() && Auth::user()->role == 'admin')
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Tanggal</th>
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
                                <td>{{ $item['jumlah'] }}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#transaksiModal" data-id="{{ $item['id'] }}"
                                        onclick="showDetail(this)">
                                        Lihat detail
                                    </button>
                                </td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (Auth::check() && Auth::user()->role == 'warga')
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jenis Simpanan</th>
                            <th>Jumlah Simpanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($detail as $item)
                            <tr>
                                <td>
                                    @php
                                        echo $no;
                                    @endphp
                                </td>
                                <td>{{ date('d/m/Y', strtotime($item['tanggal_transaksi'])) }}</td>
                                <td>{{ $item['jenis_simpanan'] }}</td>
                                <td>{{ $item['jumlah_simpanan'] }}</td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if (Auth::check() && Auth::user()->role == 'admin')
        <!-- Modal -->
        <div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="detailTransaksi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        function showDetail(button) {
            var id = button.getAttribute('data-id');
            console.log(id);

            $("#detailTransaksi").empty();
            $.ajax({
                type: "GET",
                url: 'http://localhost:8000/api/transaksi/' + id,
                success: function(res) {
                    console.log(res);
                    $.each(res.data, function(key, value) {
                        var html = `
                <div>
                    <p>Jenis Simpanan : ${value.jenis_simpanan}</p>   
                    <p>Jumlah Simpanan : ${value.jumlah_simpanan}</p>   
                </div>
                    `;

                        $("#detailTransaksi").append(html);
                    });

                    $("#transaksiModal").modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }
    </script>
@endsection
