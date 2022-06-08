<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E - SPK') }}</title>

    <style>
        #container {
            border: 2px solid #000;
        }
        #header {
            border-bottom: 2px solid #000;
        }
        #header .judul {
            float: left;
            padding: 10px;
        }
        #header .judul p {
            padding: 0;
            margin: 0;
        }
        #header .judul .title {
            font-size: 1.5em;
            text-transform: uppercase;
        }
        #header .judul .title_sm {
            margin-top: 15px;
        }
        #header .acc {
            float: right;
        }
        #header .acc p {
            padding: 15px 50px;
            margin: 0;
        }
        #header .acc .acc_title {
            border-left: 2px solid #000;
            border-bottom: 2px solid #000;
        }
        #header .acc .acc_ttd {
            border-left: 2px solid #000;
        }
        #content {
            padding: 10px;
            border-bottom: 2px solid #000;
        }
        #content-second {
            height: 30px;
            padding: 10px;
            border-bottom: 2px solid #000;
        }
        #footer {
            height: 60px;
            padding: 10px;
        }
        #footer p {
            margin: 0;
            padding: 0;
        }
        #footer .paraf_desain {
            float: left;
            width: 200px;
            text-align: center;
        }
        #footer .paraf_operator {
            float: right;
            width: 200px;
            text-align: center;
        }
        #footer .paraf_desain .paraf_desain_ttd,
        #footer .paraf_operator .paraf_operator_ttd {
            margin-top: 30px;
        }
    </style>

</head>
<body>
    <div id="container">
        <div id="header">
            <div class="judul">
                <p class="title">spk {{ $pekerjaan->cabangPemesan->nama_cabang }}</p>
                <p class="title_sm">{{ $pekerjaan->nama_pesanan }}</p>
            </div>
            <div class="acc">
                <p class="acc_title">ACC Admin</p>
                <p class="acc_ttd"></p>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div style="clear: both;"></div>
        <div id="content">
            <table>
                <tbody>
                    <tr>
                        <td>Nota</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->nomor_nota }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Order</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->tanggal_pesanan }}</td>
                    </tr>
                    <tr>
                        <td>Pemesan</td>
                        <td>:</td>
                        <td>
                            @if ($pekerjaan->pegawaiPenerimaPesanan)
                                {{ $pekerjaan->pegawaiPenerimaPesanan->nama_lengkap }}
                            @else
                                kosong
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Nama File</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->file }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Cetak</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->jenis_pesanan }}</td>
                    </tr>
                    <tr>
                        <td>Bahan</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->bahan }}</td>
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->satuan }}</td>
                    </tr>
                    <tr>
                        <td>Ukuran</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->ukuran }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Cetak</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->jumlah }}</td>
                    </tr>
                    <tr>
                        <td>Finishing</td>
                        <td>:</td>
                        <td>{{ $pekerjaan->finishing }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="content-second">
            <span>{{ $pekerjaan->keterangan }}</span>
        </div>
        <div id="footer">
            <div class="paraf_desain">
                <p class="paraf_desain_title">Paraf Desain</p>
                <p class="paraf_desain_ttd">({{ $pekerjaan->pegawaiDesain->nama_lengkap }})</p>
            </div>
            <div class="paraf_operator">
                <p class="paraf_operator_title">Paraf Operator</p>
                <p class="paraf_operator_ttd">({{ $pekerjaan->pegawaiDesain->nama_lengkap }})</p>
            </div>
        </div>
    </div>
</body>
</html>
