@extends('layout.template')

@section('title')
    Tambah Transaksi | RW 14 Cihurip
@endsection

@section('header')
    Tambah Transaksi
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
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <label for="tglTransaksi" class="form-label mt-3 fw-semibold">Tanggal Transaksi</label>
        <input type="date" class="form-control border-dark" name="tglTransaksi" id="tglTransaksi" autocomplete="off"
            value="{{ date('Y-m-d') }}" readonly />

        <label for="nama" class="form-label mt-3 fw-semibold">Nama Anggota</label>
        <select name="nama" id="nama" class="form-select select2 border-dark">
            <option value="">Pilih nama...</option>
            @foreach ($anggota as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>

        <div class="container-detail">
            <div class="detail-transaksi">
                <label for="jenis" class="form-label mt-3 fw-semibold">Jenis Simpanan</label>
                <select name="detail[0][jenis]" id="jenis" class="form-select border-dark">
                    <option value="">Pilih jenis...</option>
                    <option value="pokok">Pokok</option>
                    <option value="wajib">Wajib</option>
                    <option value="sukarela">Sukarela</option>
                </select>

                <label for="jumlah" class="form-label mt-3 fw-semibold">Jumlah Simpanan</label>
                <input type="number" class="form-control border-dark" name="detail[0][jumlah]" id="jumlah"
                    autocomplete="off" value="{{ old('jumlah') }}" inputmode="numeric" onmousewheel="return false"
                    onkeydown="handleArrowKey(event)" />
            </div>
        </div>

        <div class="d-flex gap-3">
            <button type="button" id="tambahDetail" class="btn btn-success my-3" onclick="addDetail()">Tambah Detail
                Transaksi</button>
            <button type="submit" class="btn btn-primary my-3" name="submit">Simpan</button>
            <a href="{{ url('data-anggota/transaksi') }}" class="btn btn-secondary my-3">Kembali</a>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });

        let detailCount = 1; // Menghitung jumlah detail transaksi yang ditambahkan
        function addDetail() {
            console.log('tombol diklik');
            document.getElementById('tambahDetail').addEventListener('click', function() {
                const container = document.querySelector('.container-detail');
                const newDetail = document.createElement('div');
                newDetail.classList.add('detail-transaksi');

                newDetail.innerHTML = `
            <label for="jenis" class="form-label mt-3 fw-semibold">Jenis Simpanan</label>
            <select name="detail[${detailCount}][jenis]" class="form-select border-dark">
                <option value="">Pilih jenis...</option>
                <option value="pokok">Pokok</option>
                <option value="wajib">Wajib</option>
                <option value="sukarela">Sukarela</option>
            </select>

            <label for="jumlah" class="form-label mt-3 fw-semibold">Jumlah Simpanan</label>
            <input type="number" class="form-control border-dark" name="detail[${detailCount}][jumlah]" 
                autocomplete="off" value="{{ old('jumlah') }}" inputmode="numeric" 
                onmousewheel="return false" onkeydown="handleArrowKey(event)" />
        `;

                container.appendChild(newDetail);
                detailCount++;
            });
        }
    </script>
@endsection
