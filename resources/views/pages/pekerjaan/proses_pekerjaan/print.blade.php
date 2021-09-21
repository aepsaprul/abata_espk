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
    <link href="{{ asset('lib/fontawesome-5/css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('lib/bootstrap-5/bootstrap.min.css') }}" rel="stylesheet">

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
        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 border border-3">
                        <h1 class="text-center fw-bold text-uppercase my-5">spk</h1>
                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center">pemesan</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center">hilda</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center">judul</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center">testing 4</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">no nota</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">tgl order</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">rencana cetak</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">rencana jadi</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">4</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">06 September 2021</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">-</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">08 September 2021</td>
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
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">test</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">1000</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">folio</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">test</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center">cetak</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase">1. offset</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">jenis kertas</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">penerima order</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">pencatat</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">hvs</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">aep</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">aep</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">setting</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">cetak</th>
                                <th class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">finishing</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">andi</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">holding (ho)</td>
                                <td class="text-uppercase text-center" style="border: 2px solid #d0d0d0;">holding (ho)</td>
                            </tr>
                        </table>

                        <table class="table table-bordered" style="border: 2px solid #d0d0d0;">
                            <tr style="border: 2px solid #d0d0d0;">
                                <th class="text-uppercase">keterangan:</th>
                            </tr>
                            <tr style="border: 2px solid #d0d0d0;">
                                <td class="text-uppercase">test</td>
                            </tr>
                        </table>
                        <button onclick="window.print()">Print this page</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- <script src="{{ asset('lib/bootstrap-5/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('lib/bootstrap-5/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/datatables/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('lib/fontawesome-5/js/fontawesome.min.js') }}"></script>

</body>
</html>
