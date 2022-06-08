<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E - SPK') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('public/lib/fontawesome-5/css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/lib/bootstrap-5/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        table tr th {
            font-size: 10px;
        }
        table tr td {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 border border-3">
                        <h1 class="text-center fw-bold text-uppercase my-2">spk</h1>
                        <p class="text-center text-uppercase" style="font-size: 20px;">{{ $pekerjaan->cabangPemesan->nama_cabang }}</p>
                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center">pemesan</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center">
                                    @if ($pekerjaan->pelanggan)
                                        {{ $pekerjaan->pelanggan->nama }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center">judul</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center">{{ $pekerjaan->nama_pesanan }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">no nota</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">tgl spk dibuat</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">tgl disetujui</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">rencana jadi</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->nomor_nota }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->tanggal_pesanan }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">
                                    @if ($pekerjaan->tanggal_disetujui)
                                        {{ date('Y-m-d', strtotime($pekerjaan->tanggal_disetujui)) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->rencana_jadi }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">jenis order</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">jumlah</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">ukuran</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">warna tinta</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->jenis_pesanan }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->jumlah }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->ukuran }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->warna }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <td>
                                    <ol class="list-group">
                                        @foreach ($proses_pekerjaans as $proses_pekerjaan)
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">
                                                        {{ $proses_pekerjaan->jenisPekerjaan->tipePekerjaan->tipe }}
                                                    </div>
                                                    {{ $proses_pekerjaan->jenisPekerjaan->jenis }} {{ "( " . $proses_pekerjaan->keterangan . " )" }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">jenis kertas</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">penerima order</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">pencatat</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->jenis_kertas }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">
                                    @if ($pekerjaan->pegawaiPenerimaPesanan)
                                        {{ $pekerjaan->pegawaiPenerimaPesanan->nama_lengkap }}
                                    @else
                                        kosong
                                    @endif
                                </td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">
                                    @if ($pekerjaan->pegawaiPenerimaPesanan)
                                        {{ $pekerjaan->pegawaiPenerimaPesanan->nama_lengkap }}
                                    @else
                                        kosong
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">desain</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">cetak</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">finishing</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->pegawaiDesain->nama_lengkap }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->cabangCetak->nama_cabang }}</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">{{ $pekerjaan->cabang_finishing_id !=null ? $pekerjaan->cabangFinishing->nama_cabang : '-' }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase">keterangan:</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase">{{ $pekerjaan->keterangan }}</td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col">
                                <div class="d-flex justify-content-end"><img src="{{ asset('public/asset/acc2.png') }}" class="p-2 mb-2" style="max-width: 60px; border: 1px solid #202020"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- <script src="{{ asset('lib/bootstrap-5/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('public/lib/bootstrap-5/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/lib/datatables/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('public/lib/fontawesome-5/js/fontawesome.min.js') }}"></script>

    <script>
        window.print();
    </script>
</body>
</html>
