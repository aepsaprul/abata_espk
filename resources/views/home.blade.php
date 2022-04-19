@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_hari_ini }}</h3>
                                    <p>Pesanan Hari Ini</p>
                                </div>
                                {{-- <a href="{{ route('home.selengkapnya', ["pesanan_hari_ini"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_menunggu_disetujui }}</h3>
                                    <p>Menunggu Di Setujui</p>
                                </div>
                                {{-- <a href="{{ route('home.selengkapnya', ["menunggu_disetujui"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_proses }}</h3>
                                    <p>Sedang Di Proses</p>
                                </div>
                                {{-- <a href="{{ route('home.selengkapnya', ["sedang_diproses"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_selesai }}</h3>
                                    <p>Selesai Bulan Ini</p>
                                </div>
                                {{-- <a href="{{ route('home.selengkapnya', ["selesai"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_batal }}</h3>
                                    <p>Dibatalkan</p>
                                </div>
                                {{-- <a href="{{ route('home.selengkapnya', ["selesai"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $jumlah_data_pekerjaan }}</h3>
                                    <p>Pekerjaan</p>
                                </div>
                                {{-- <a href="{{ route('home.selengkapnya', ["selesai"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{-- data pesanan hari ini --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pesanan Hari Ini</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pesanan_hari_ini" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_hari_ini as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_pesanan }}</td>
                                            <td class="text-center">{{ tgl_indo($item->tanggal_pesanan) }}</td>
                                            <td class="text-center">{{ tgl_indo($item->rencana_jadi) }}</td>
                                            <td>
                                                @if ($item->cabangPelaksana)
                                                    {{ $item->cabangPelaksana->nama_cabang }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status)
                                                    {{ $item->status->nama_status }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- data pesanan menunggu disetujui --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pesanan Menunggu Disetujui</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pesanan_menunggu_disetujui" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_menunggu_disetujui as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_pesanan }}</td>
                                            <td class="text-center">{{ tgl_indo($item->tanggal_pesanan) }}</td>
                                            <td class="text-center">{{ tgl_indo($item->rencana_jadi) }}</td>
                                            <td>
                                                @if ($item->cabangPelaksana)
                                                    {{ $item->cabangPelaksana->nama_cabang }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status)
                                                    {{ $item->status->nama_status }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- data pesanan sedang di proses --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pesanan Sedang Di Proses</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pesanan_proses" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_proses as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_pesanan }}</td>
                                            <td class="text-center">{{ tgl_indo($item->tanggal_pesanan) }}</td>
                                            <td class="text-center">{{ tgl_indo($item->rencana_jadi) }}</td>
                                            <td>
                                                @if ($item->cabangPelaksana)
                                                    {{ $item->cabangPelaksana->nama_cabang }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status)
                                                    {{ $item->status->nama_status }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- data pesanan selesai --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pesanan Selesai</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pesanan" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_selesai as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_pesanan }}</td>
                                            <td class="text-center">{{ tgl_indo($item->tanggal_pesanan) }}</td>
                                            <td class="text-center">{{ tgl_indo($item->rencana_jadi) }}</td>
                                            <td>
                                                @if ($item->cabangPelaksana)
                                                    {{ $item->cabangPelaksana->nama_cabang }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status)
                                                    {{ $item->status->nama_status }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- data pesanan batal --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pesanan Dibatalkan</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pesanan" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_batal as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->nama_pesanan }}</td>
                                            <td class="text-center">{{ tgl_indo($item->tanggal_pesanan) }}</td>
                                            <td class="text-center">{{ tgl_indo($item->rencana_jadi) }}</td>
                                            <td>
                                                @if ($item->cabangPelaksana)
                                                    {{ $item->cabangPelaksana->nama_cabang }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status)
                                                    {{ $item->status->nama_status }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- data pekerjaan --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pekerjaan</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pekerjaan" class="table table-bordered table-striped" style="font-size: 14px; width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Pemesan</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">No Nota</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pekerjaan as $key => $pekerjaan)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $pekerjaan->cabangPemesan->nama_cabang }}</td>
                                        <td>{{ $pekerjaan->nama_pesanan }}</td>
                                        <td>{{ $pekerjaan->nomor_nota }}</td>
                                        <td class="text-center">
                                            @if ($pekerjaan->tanggal_disetujui)
                                                @php
                                                    $tanggal_disetujui = explode(" ", $pekerjaan->tanggal_disetujui);
                                                @endphp
                                                {{ tgl_indo($tanggal_disetujui[0]) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pekerjaan->status_id != null)
                                                {{ $pekerjaan->status->nama_status }}
                                                @if ($pekerjaan->status_id == 6 || $pekerjaan->status_id == 7)
                                                    @php $hide = "d-none"; @endphp
                                                @else
                                                    @php $hide = ""; @endphp
                                                @endif
                                            @else
                                                -
                                                @php $hide = ""; @endphp
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#tabel_pesanan').DataTable();
        $('#tabel_pesanan_hari_ini').DataTable();
        $('#tabel_pesanan_proses').DataTable();
        $('#tabel_pesanan_menunggu_disetujui').DataTable();
        $('#tabel_pekerjaan').DataTable();
    })
</script>
@endsection

