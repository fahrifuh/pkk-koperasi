<!DOCTYPE html>
<html>

<head>
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    @if (isset($anggota))
        <h1>Daftar Anggota Koperasi RW 14 Cihurip</h1>
        <p><strong>Tanggal diCetak : </strong>{{ $tanggalCetak }}</p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Alamat</th>
                    <th>tanggal Pendaftaran</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($anggota as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->tgl_daftar)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (isset($transaksiDetail))
        <h1>Daftar Anggota Koperasi RW 14 Cihurip</h1>
        <p><strong>Tanggal diCetak : </strong>{{ $tanggalCetak }}</p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jenis Simpanan</th>
                    <th>Jumlah Simpanan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($transaksiDetail as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->tanggal_transaksi)) }}</td>
                        <td>{{ $item->jenis_simpanan }}</td>
                        <td>{{ $item->jumlah_simpanan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if (isset($transaksi))
        <h1>Daftar Anggota Koperasi RW 14 Cihurip</h1>
        <p><strong>Tanggal diCetak : </strong>{{ $tanggalCetak }}</p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['tanggal_transaksi'] }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>
