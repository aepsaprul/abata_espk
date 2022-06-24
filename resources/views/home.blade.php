@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

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
                            <a href="#card_pesanan_hari_ini">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $jumlah_pesanan_hari_ini }}</h3>
                                        <p>Pesanan Hari Ini</p>
                                    </div>
                                    {{-- <a href="{{ route('home.selengkapnya', ["pesanan_hari_ini"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <a href="#card_pesanan_menunggu_disetujui">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $jumlah_pesanan_menunggu_disetujui }}</h3>
                                        <p>Menunggu Di Setujui</p>
                                    </div>
                                    {{-- <a href="{{ route('home.selengkapnya', ["menunggu_disetujui"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <a href="#card_pesanan_proses">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $jumlah_pesanan_proses }}</h3>
                                        <p>Sedang Di Proses</p>
                                    </div>
                                    {{-- <a href="{{ route('home.selengkapnya', ["sedang_diproses"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <a href="#card_pesanan_selesai">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ $jumlah_pesanan_selesai }}</h3>
                                        <p>Selesai Bulan Ini</p>
                                    </div>
                                    {{-- <a href="{{ route('home.selengkapnya', ["selesai"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <a href="#card_pesanan_batal">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $jumlah_pesanan_batal }}</h3>
                                        <p>Dibatalkan</p>
                                    </div>
                                    {{-- <a href="{{ route('home.selengkapnya', ["selesai"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-2 col-6">
                            <a href="#card_pekerjaan">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{ $jumlah_data_pekerjaan }}</h3>
                                        <p>Pekerjaan</p>
                                    </div>
                                    {{-- <a href="{{ route('home.selengkapnya', ["selesai"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> --}}
                                </div>
                            </a>
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
                                        <th class="text-center text-indigo">ID</th>
                                        <th class="text-center text-indigo">Judul Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Dibuat</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_hari_ini as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->id_espk }}</td>
                                            <td><a href="#" class="btn_detail" data-id="{{ $item->id }}">{{ $item->nama_pesanan }}</a></td>
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
                                <div id="card_pesanan_menunggu_disetujui"></div>
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
                                        <th class="text-center text-indigo">ID</th>
                                        <th class="text-center text-indigo">Judul Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Dibuat</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_menunggu_disetujui as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->id_espk }}</td>
                                            <td><a href="#" class="btn_detail" data-id="{{ $item->id }}">{{ $item->nama_pesanan }}</a></td>
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
                                <div id="card_pesanan_proses"></div>
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
                                        <th class="text-center text-indigo">ID</th>
                                        <th class="text-center text-indigo">Judul Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Dibuat</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_proses as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->id_espk }}</td>
                                            <td><a href="#" class="btn_detail" data-id="{{ $item->id }}">{{ $item->nama_pesanan }}</a></td>
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
                                <div id="card_pesanan_selesai"></div>
                            </table>
                        </div>
                    </div>
                    {{-- data pesanan selesai --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pesanan Selesai Bulan Ini</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pesanan" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">ID</th>
                                        <th class="text-center text-indigo">Judul Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Dibuat</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Tgl Selesai</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_selesai as $key => $item)

                                        @php
                                            $tgl_selesai = explode(" ", $item->tanggal_selesai);
                                        @endphp

                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->id_espk }}</td>
                                            <td><a href="#" class="btn_detail" data-id="{{ $item->id }}">{{ $item->nama_pesanan }}</a></td>
                                            <td class="text-center">{{ tgl_indo($item->tanggal_pesanan) }}</td>
                                            <td class="text-center">{{ tgl_indo($item->rencana_jadi) }}</td>
                                            <td class="text-center">{{ tgl_indo($tgl_selesai[0]) }}</td>
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
                                <div id="card_pesanan_batal"></div>
                            </table>
                        </div>
                    </div>
                    {{-- data pesanan batal --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold text-uppercase">Data Pesanan Dibatalkan</h5>
                        </div>
                        <div class="card-body">
                            <table id="tabel_pesanan_batal" class="table table-bordered" style="font-size: 13px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">ID</th>
                                        <th class="text-center text-indigo">Judul Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Dibuat</th>
                                        <th class="text-center text-indigo">Rencana Jadi</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_batal as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->id_espk }}</td>
                                            <td><a href="#" class="btn_detail" data-id="{{ $item->id }}">{{ $item->nama_pesanan }}</a></td>
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
                                <div id="card_pekerjaan"></div>
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
                                        <th class="text-center text-indigo">ID</th>
                                        <th class="text-center text-indigo">Pemesan</th>
                                        <th class="text-center text-indigo">Judul Pesanan</th>
                                        <th class="text-center text-indigo">No Nota</th>
                                        <th class="text-center text-indigo">Tgl Dibuat</th>
                                        <th class="text-center text-indigo">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_pekerjaan as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->id_espk }}</td>
                                            <td>{{ $item->cabangPemesan->nama_cabang }}</td>
                                            <td><a href="#" class="btn_detail" data-id="{{ $item->id }}">{{ $item->nama_pesanan }}</a></td>
                                            <td>{{ $item->nomor_nota }}</td>
                                            <td class="text-center">
                                                @if ($item->tanggal_disetujui)
                                                    @php
                                                        $tanggal_disetujui = explode(" ", $item->tanggal_disetujui);
                                                    @endphp
                                                    {{ tgl_indo($tanggal_disetujui[0]) }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status_id != null)
                                                    {{ $item->status->nama_status }}
                                                    @if ($item->status_id == 6 || $item->status_id == 7)
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

{{-- modal detail  --}}
<div class="modal fade modal-detail" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div id="data-laporan-detail">
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<!-- DataTables  & Plugins -->
<script src="{{ asset('public/themes/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/themes/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#tabel_pesanan').DataTable();
        $('#tabel_pesanan_hari_ini').DataTable();
        $('#tabel_pesanan_proses').DataTable();
        $('#tabel_pesanan_menunggu_disetujui').DataTable();
        $('#tabel_pesanan_batal').DataTable();
        $('#tabel_pekerjaan').DataTable();

        $(document).on('click', '.btn_detail', function (e) {
            e.preventDefault();
            $('#data-laporan-detail').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("laporan.show", ":id") }}';
            url = url.replace(':id', id );

            $.ajax({
                url: url,
                type: 'get',
                success: function (response) {
                    let data_laporan_detail = "" +
                    "<div class=\"modal-header\">" +
                        "<h5 class=\"modal-title\">Detail Laporan " + (response.cabang.form_group == "offset" ? 'Offset' : 'Digital Print') + "</h5>" +
                        "<button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">x</span></button>" +
                    "</div>" +
                    "<div class=\"modal-body\">" +
                        "<div class=\"card-body\">";

                            // forumulir offset
                            if (response.cabang.form_group == "offset") {
                                data_laporan_detail += "" +
                                "<div class=\"row mb-3\">" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"pelanggan_id\">Pemesan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pelanggan_id\"";

                                                if (response.pekerjaan.pelanggan) {
                                                    data_laporan_detail += 'value="' + response.pekerjaan.pelanggan.nama + '"';
                                                }

                                            data_laporan_detail += ">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"nama_pesanan\">Judul Pesanan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"nama_pesanan\" value=\"" + response.pekerjaan.nama_pesanan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"nomor_nota\">No Nota</label>" +
                                            "<input disabled type=\"number\" class=\"form-control form-control-sm\" name=\"nomor_nota\" value=\"" + response.pekerjaan.nomor_nota + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"tanggal_pesanan\">Tanggal Dibuat</label>" +
                                            "<input disabled type=\"date\" class=\"form-control form-control-sm\" name=\"tanggal_pesanan\" value=\"" + response.pekerjaan.tanggal_pesanan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"rencana_jadi\">Rencana Jadi</label>" +
                                            "<input disabled type=\"date\" class=\"form-control form-control-sm\" name=\"rencana_jadi\" value=\"" + response.pekerjaan.rencana_jadi + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"jenis_pesanan\">Jenis Order</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"jenis_pesanan\" value=\"" + response.pekerjaan.jenis_pesanan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"jumlah_cetak\">Jumlah Cetak</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"jumlah_cetak\" value=\"" + response.pekerjaan.jumlah + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"ukuran\">Ukuran</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"ukuran\" value=\"" + response.pekerjaan.ukuran + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"jenis_kertas\">Jenis Kertas</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"jenis_kertas\" value=\"" + response.pekerjaan.jenis_kertas + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"warna\">Warna Tinta</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"warna\" value=\"" + response.pekerjaan.warna + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"keterangan\">Keterangan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"keterangan\" value=\"" + response.pekerjaan.keterangan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"pegawai_penerima_pesanan_id\">Penerima Order</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pegawai_penerima_pesanan_id\"";

                                                if (response.pekerjaan.pegawai_penerima_pesanan) {
                                                    data_laporan_detail += 'value="' + response.pekerjaan.pegawai_penerima_pesanan.nama_lengkap + '"';
                                                }
                                                else {
                                                    data_laporan_detail += "value=kosong";
                                                }

                                            data_laporan_detail += ">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"pegawai_desain_id\">Desain</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pegawai_desain_id\" value=\"" + response.pekerjaan.pegawai_desain.nama_lengkap + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<label for=\"cabang_cetak_id\">Cetak</label>" +
                                        "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"cabang_cetak_id\" value=\"" + response.pekerjaan.cabang_cetak.nama_cabang + "\">" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<label for=\"cabang_finishing_id\">Finishing</label>" +
                                        "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"cabang_finishing_id\"";

                                                if (response.pekerjaan.cabang_finishing) {
                                                    data_laporan_detail += "value=" + response.pekerjaan.cabang_finishing.nama_cabang;
                                                }

                                                data_laporan_detail += ">" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<label for=\"desain\">File</label>" +
                                        "<div>" +
                                            "<div>";
                                                var id = response.pekerjaan.file;
                                                var url = '{{ route("pekerjaan.download", ":id") }}';
                                                url = url.replace(':id', id );
                                                data_laporan_detail += "<a href=\"" + url + "\" class=\"btn btn-primary\"><i class=\"fas fa-download\"></i> Download</a>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>";
                            }
                            // forumulir digital print
                            else {
                                data_laporan_detail += "<div class=\"row mb-3\">" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"pelanggan_id\">Pelanggan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pelanggan_id\"";

                                                if (response.pekerjaan.pelanggan) {
                                                    data_laporan_detail += 'value="' + response.pekerjaan.pelanggan.nama + '"';
                                                }

                                                data_laporan_detail += ">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"nama_pesanan\">Nama Pesanan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"nama_pesanan\" value=\"" + response.pekerjaan.nama_pesanan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"nomor_nota\">Nomor Nota</label>" +
                                            "<input disabled type=\"number\" class=\"form-control form-control-sm\" name=\"nomor_nota\" value=\"" + response.pekerjaan.nomor_nota + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"tanggal_pesanan\">Tanggal Pesanan</label>" +
                                            "<input disabled type=\"date\" class=\"form-control form-control-sm\" name=\"tanggal_pesanan\" value=\"" + response.pekerjaan.tanggal_pesanan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"rencana_jadi\">Rencana Jadi</label>" +
                                            "<input disabled type=\"date\" class=\"form-control form-control-sm\" name=\"rencana_jadi\" value=\"" + response.pekerjaan.rencana_jadi + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"jenis_pesanan\">Jenis Produk</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"jenis_pesanan\" value=\"" + response.pekerjaan.jenis_pesanan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"jumlah_cetak\">Jumlah Cetak</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"jumlah_cetak\" value=\"" + response.pekerjaan.jumlah + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"ukuran\">Ukuran</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"ukuran\" value=\"" + response.pekerjaan.ukuran + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"bahan\">Bahan</label>" +
                                            "<input disabled type=\"text\" id=\"bahan\" name=\"bahan\" class=\"form-control form-control-sm\" value=\"" + response.pekerjaan.bahan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"satuan\">Satuan</label>" +
                                            "<input disabled type=\"text\" id=\"satuan\" name=\"satuan\" class=\"form-control form-control-sm\" value=\"" + response.pekerjaan.satuan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"finishing\">Finishing</label>" +
                                            "<input disabled type=\"text\" id=\"finishing\" name=\"finishing\" class=\"form-control form-control-sm\" value=\"" + response.pekerjaan.finishing + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"catatan_kasir\">Catatan Kasir</label>" +
                                            "<input disabled type=\"text\" id=\"catatan_kasir\" name=\"catatan_kasir\" class=\"form-control form-control-sm\" value=\"" + response.pekerjaan.catatan_kasir + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"catatan_produksi\">Catatan Produksi</label>" +
                                            "<input disabled type=\"text\" id=\"catatan_produksi\" name=\"catatan_produksi\" class=\"form-control form-control-sm\" value=\"" + response.pekerjaan.catatan_produksi + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"keterangan\">Keterangan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"keterangan\" value=\"" + response.pekerjaan.keterangan + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"pegawai_penerima_pesanan_id\">Penerima Pesanan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pegawai_penerima_pesanan_id\"";

                                                if (response.pekerjaan.pegawai_penerima_pesanan) {
                                                    data_laporan_detail += "value=" + response.pekerjaan.pegawai_penerima_pesanan.nama_lengkap;
                                                }
                                                else {
                                                    data_laporan_detail += "value=kosong";
                                                }

                                                data_laporan_detail += ">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"pegawai_desain_id\">Desain</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pegawai_desain_id\" value=\"" + response.pekerjaan.pegawai_desain.nama_lengkap + "\">" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<label for=\"cabang_cetak_id\">Cetak</label>" +
                                        "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"cabang_cetak_id\" value=\"" + response.pekerjaan.cabang_cetak.nama_cabang + "\">" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<label for=\"cabang_finishing_id\">Finishing</label>" +
                                        "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"cabang_finishing_id\"";

                                            if (response.pekerjaan.cabang_finishing) {
                                                data_laporan_detail += "value=" + response.pekerjaan.cabang_finishing.nama_cabang;
                                            }

                                            data_laporan_detail += ">" +
                                    "</div>" +
                                    "<div class=\"col-md-3\">" +
                                        "<label for=\"desain\">File</label>" +
                                        "<div>" +
                                            "<div>";
                                                var id = response.pekerjaan.file;
                                                var url = '{{ route("pekerjaan.download", ":id") }}';
                                                url = url.replace(':id', id );
                                                data_laporan_detail += "<a href=\"" + url + "\" class=\"btn btn-primary\"><i class=\"fas fa-download\"></i> Download</a>" +
                                            "</div>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>";
                            }

                            // checkbox
                            $.each(response.tipe_pekerjaans, function (index, value) {
                                data_laporan_detail += "" +
                                "<div class=\"card card-primary\">" +
                                    "<div class=\"card-header\">" +
                                        "<h3 class=\"card-title\">";
                                            data_laporan_detail += value.tipe;

                                            let type = "checkbox";
                                            data_laporan_detail += "</h3>" +
                                    "</div>" +
                                    "<div class=\"card-body\">" +
                                        "<div class=\"row mb-3\">";
                                            $.each(value.jenis_pekerjaan, function (index_jenis, value_jenis) {
                                                if (value_jenis.pekerjaan_proses.length > 0) {
                                                    data_laporan_detail += "" +
                                                    "<div class=\"col-md-3\">" +
                                                        "<div class=\"form-check\">" +
                                                            "<input disabled class=\"form-check-input\" type=\"" + type + "\" data-id=\"" + value_jenis.id + "\" id=\"jenis_pekerjaan_" + value_jenis.id + "\" name=\"jenis_pekerjaan_id[]\" style=\"padding: 10px; margin-right: 10px;\" value=\"" + value_jenis.id + "\" checked>" +
                                                            "<label class=\"form-check-label\" for=\"jenis_pekerjaan_" + value_jenis.id + "\">" + value_jenis.jenis + "</label>" +
                                                        "</div>";

                                                        $.each(value_jenis.pekerjaan_proses, function (index_proses, value_proses) {
                                                            data_laporan_detail += "<input disabled type=\"text\" id=\"jenis_pekerjaan_keterangan_" + type + "\" class=\"form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_" + value_proses.id + "\" name=\"jenis_pekerjaan_keterangan[]\" value=\"" + value_proses.keterangan + "\">";
                                                        })
                                                        data_laporan_detail += "</div>";
                                                } else {

                                                }
                                            })
                                            data_laporan_detail += "</div>" +
                                    "</div>" +
                                "</div>";
                            })

                            data_laporan_detail += "<table class=\"table table-bordered table-stripped\">" +
                                "<tr>" +
                                    "<th class=\"text-center text-indigo\">Status</th>" +
                                    "<th class=\"text-center text-indigo\">Pelaksana</th>" +
                                    "<th class=\"text-center text-indigo\">Waktu</th>" +
                                    "<th class=\"text-center text-indigo\">Keterangan</th>" +
                                "</tr>";

                                $.each(response.status_pekerjaans, function (index, value) {
                                    data_laporan_detail += "" +
                                    "<tr>" +
                                        "<td>" + value.status.nama_status + "</td>" +
                                        "<td>" + value.pelaksana.nama_lengkap + "</td>";

                                        let tanggal = value.waktu;
                                        let tanggal_split = tanggal.split(" ");

                                        data_laporan_detail += "<td class=\"text-center\">" + tanggalIndo(tanggal_split[0]) + " " + tanggal_split[1] + "</td>" +
                                        "<td>" + value.status_keterangan + "</td>" +
                                    "</tr>";
                                })
                                data_laporan_detail += "</table>" +
                        "</div>" +
                    "</div>";
                    $('#data-laporan-detail').append(data_laporan_detail);

                    $('.modal-detail').modal('show');
                }
            })
        });
    })
</script>
@endsection

