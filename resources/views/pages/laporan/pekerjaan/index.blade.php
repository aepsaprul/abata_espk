@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Pekerjaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan Pekerjaan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <strong class="text-uppercase">Filter</strong>
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="tanggal_awal" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control form-control-sm" id="tanggal_awal" name="tanggal_awal">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="tanggal_akhir" class="form-label">Sampai</label>
                                                    <input type="date" class="form-control form-control-sm" id="tanggal_akhir" name="tanggal_akhir">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                                                    <select id="pelanggan_id" class="form-control form-control-sm select-pelanggan" name="pelanggan_id">
                                                        <option value="">-- Pilih Pelanggan --</option>
                                                        @foreach ($pelanggans as $pelanggan)
                                                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="nama_pesanan" class="form-label">Nama Pesanan</label>
                                                    <input type="text" class="form-control form-control-sm" id="nama_pesanan" name="nama_pesanan">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cabang_pemesan_id" class="form-label">Cabang Pemesan</label>
                                                    <select id="cabang_pemesan_id" class="form-control form-control-sm" name="cabang_pemesan_id">
                                                        <option value="">-- Pilih Cabang Pemesan --</option>
                                                        @foreach ($cabangs as $cabang)
                                                            <option value="{{ $cabang->masterCabang->id }}">{{ $cabang->masterCabang->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="cabang_pelaksana_id" class="form-label">Cabang Pelaksana</label>
                                                    <select id="cabang_pelaksana_id" class="form-control form-control-sm" name="cabang_pelaksana_id">
                                                        <option value="">-- Pilih Cabang Pelaksana --</option>
                                                        @foreach ($cabangs as $cabang)
                                                            <option value="{{ $cabang->masterCabang->id }}">{{ $cabang->masterCabang->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="status_id" class="form-label">Status Pekerjaan</label>
                                                    <select id="status_id" class="form-control form-control-sm" name="status_id">
                                                        <option value="">-- Pilih Status --</option>
                                                        @foreach ($status as $status)
                                                            <option value="{{ $status->id }}">{{ $status->nama_status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button
                                        type="button"
                                        class="btn bg-gradient-primary btn-cari btn-sm"
                                        style="width: 120px;">
                                            <i class="fas fa-search" style="font-size: 12px;"></i> Cari
                                    </button>
                                    <button class="btn bg-gradient-default btn-sm btn-spinner" disabled style="width: 120px; display: none;">
                                        <span class="spinner-grow spinner-grow-sm"></span>
                                        Loading..
                                    </button>
                                    <button
                                        type="button"
                                        class="btn bg-gradient-danger btn-reset btn-sm"
                                        style="width: 120px;">
                                            <i class="fas fa-undo" style="font-size: 12px;"></i> Reset
                                    </button>
                                </div>
                            </div>

                            <h6 class="text-uppercase"><strong>Data Laporan</strong></h6>
                            <hr>
                            <div id="data-laporan">
                                <table id="table_one" class="table table-bordered table-striped" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-indigo" style="vertical-align: text-top;">No</th>
                                            <th class="text-center text-indigo" style="vertical-align: text-top;">Pemesan</th>
                                            <th class="text-center text-indigo">Nama Pekerjaan</th>
                                            <th class="text-center text-indigo">No Nota</th>
                                            <th class="text-center text-indigo">Tgl Order</th>
                                            <th class="text-center text-indigo">Rencana Jadi</th>
                                            <th class="text-center text-indigo" style="vertical-align: text-top;">Pelaksana</th>
                                            <th class="text-center text-indigo" style="vertical-align: text-top;">Status</th>
                                            <th class="text-center text-indigo" style="vertical-align: text-top;">Tgl Selesai</th>
                                            <th class="text-center text-indigo">Penerima Pesanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pekerjaans as $key => $item)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>{{ $item->cabangPemesan->nama_cabang }}</td>
                                                <td><a href="#" class="btn-detail" data-id="{{ $item->id }}"> {{ $item->nama_pesanan }} </a> | <a href="{{ route('proses_pekerjaan.print', [$item->id]) }}" target="_blank">Print</a></td>
                                                <td>{{ $item->nomor_nota }}</td>
                                                <td>{{ $item->tanggal_pesanan }}</td>
                                                <td>{{ $item->rencana_jadi }}</td>
                                                <td>{{ $item->cabangPelaksana->nama_cabang }}</td>
                                                <td>
                                                    @if ($item->status)
                                                        {{ $item->status->nama_status }}
                                                    @endif
                                                </td>
                                                <td>{{ $item->tanggal_selesai }}</td>
                                                <td>
                                                    @if ($item->pegawaiPenerimaPesanan)
                                                        {{ $item->pegawaiPenerimaPesanan->nama_panggilan }}
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
<!-- Select2 -->
<script src="{{ asset('public/themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $("#table_one").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf"]
        }).buttons().container().appendTo('#table_one_wrapper .col-md-6:eq(0)');

        $('.select-pelanggan').select2();

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.btn-cari').on('click', function() {
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();

            if (tanggal_awal == "" || tanggal_akhir == "") {
                alert('tanggal harap diisi terlebih dahulu');
            } else {
                $('#data-laporan').empty();
                var formData = {
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                    pelanggan_id: $('#pelanggan_id').val(),
                    nama_pesanan: $('#nama_pesanan').val(),
                    cabang_pemesan_id: $('#cabang_pemesan_id').val(),
                    cabang_pelaksana_id: $('#cabang_pelaksana_id').val(),
                    status_id: $('#status_id').val(),
                    _token:CSRF_TOKEN
                }

                $.ajax({
                    url: '{{ URL::route('laporan.search') }}',
                    type: 'POST',
                    data: formData,
                    beforeSend: function () {
                        $('.btn-spinner').css('display', 'inline-block');
                        $('.btn-cari').css('display', 'none');
                    },
                    success: function (response) {
                        console.log(response.pekerjaans);
                        var value_pekerjaan = "" +
                        "<table id=\"table_one\" class=\"table table-bordered table-striped\" style=\"font-size: 12px;\">" +
                            "<thead>" +
                                "<tr>" +
                                    "<th class=\"text-center text-indigo\" style=\"vertical-align: text-top;\">No</th>" +
                                    "<th class=\"text-center text-indigo\" style=\"vertical-align: text-top;\">Pemesan</th>" +
                                    "<th class=\"text-center text-indigo\">Nama Pekerjaan</th>" +
                                    "<th class=\"text-center text-indigo\">No Nota</th>" +
                                    "<th class=\"text-center text-indigo\">Tgl Order</th>" +
                                    "<th class=\"text-center text-indigo\">Rencana Jadi</th>" +
                                    "<th class=\"text-center text-indigo\" style=\"vertical-align: text-top;\">Pelaksana</th>" +
                                    "<th class=\"text-center text-indigo\" style=\"vertical-align: text-top;\">Status</th>" +
                                    "<th class=\"text-center text-indigo\" style=\"vertical-align: text-top;\">Tgl Selesai</th>" +
                                    "<th class=\"text-center text-indigo\">Penerima Pesanan</th>" +
                                "</tr>" +
                            "</thead>" +
                            "<tbody>";
                        $.each(response.pekerjaans, function (index, item) {
                            value_pekerjaan += "" +
                            "<tr>" +
                                "<td class=\"text-center\">" + (index + 1) + "</td>" +
                                "<td>" + item.cabang_pemesan.nama_cabang + "</td>" +
                                "<td>" + item.nama_pesanan + "</td>" +
                                "<td>" + item.nomor_nota + "</td>" +
                                "<td>" + item.tanggal_pesanan + "</td>" +
                                "<td>" + item.rencana_jadi + "</td>" +
                                "<td>";
                                    if (item.cabang_pelaksana) {
                                        value_pekerjaan += item.cabang_pelaksana.nama_cabang;
                                    }
                            value_pekerjaan += "" +
                                "</td>" +
                                "<td>";
                                    if (item.status) {
                                        value_pekerjaan += item.status.nama_status;
                                    }
                            value_pekerjaan += "" +
                                "</td>" +
                                "<td>" + item.tanggal_selesai + "</td>" +
                                "<td>";
                                    if (item.pegawai_penerima_pesanan) {
                                        value_pekerjaan += item.pegawai_penerima_pesanan.nama_panggilan;
                                    }
                            value_pekerjaan += "" +
                                "</td>" +
                            "</tr>";
                        });
                        value_pekerjaan += "" +
                            "</tbody>" +
                        "</table>";

                        if (value_pekerjaan == '') {
                            value_pekerjaan_condition = "" +
                                "<tr>" +
                                    "<td colspan=\"10\" class=\"text-center\">Kosong</td>" +
                                "</tr>";
                        } else {
                            value_pekerjaan_condition = value_pekerjaan
                        }
                        $('#data-laporan').append(value_pekerjaan_condition);

                        setTimeout(() => {
                            $('.btn-spinner').css('display', 'none');
                            $('.btn-cari').css('display', 'inline-block');
                        }, 1000);

                        $("#table_one").DataTable({
                            "responsive": true, "lengthChange": false, "autoWidth": false,
                            "buttons": ["excel", "pdf"]
                        }).buttons().container().appendTo('#table_one_wrapper .col-md-6:eq(0)');
                    },
                    error: function(xhr, status, error){
                        var errorMessage = xhr.status + ': ' + xhr.statusText
                        Toast.fire({
                            icon: 'error',
                            title: 'Error - ' + errorMessage
                        });
                    }
                });
            }
        });

        $('.btn-reset').on('click', function() {
            $('.btn-spinner').css('display', 'inline-block');
            $('.btn-reset').css('display', 'none');

            $('#tanggal_awal').val("");
            $('#tanggal_akhir').val("");
            $('#pelanggan_id').val("");
            $('#nama_pesanan').val("");
            $('#cabang_pemesan_id').val("");
            $('#cabang_pelaksana_id').val("");

            setTimeout(() => {
                $('.btn-spinner').css('display', 'none');
                $('.btn-reset').css('display', 'inline-block');
            }, 1000);
        });

        $('body').on('click', '.btn-detail', function (e) {
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
                                            "<label for=\"pelanggan_id\">Pelanggan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pelanggan_id\"";

                                                if (response.pekerjaan.pelanggan) {
                                                    data_laporan_detail += "value=" + response.pekerjaan.pelanggan.nama;
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
                            // forumulir digital print
                            else {
                                data_laporan_detail += "<div class=\"row mb-3\">" +
                                    "<div class=\"col-md-3\">" +
                                        "<div class=\"form-group\">" +
                                            "<label for=\"pelanggan_id\">Pelanggan</label>" +
                                            "<input disabled type=\"text\" class=\"form-control form-control-sm\" name=\"pelanggan_id\"";

                                                if (response.pekerjaan.pelanggan) {
                                                    data_laporan_detail += "value=" + response.pekerjaan.pelanggan.nama;
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
    } );
</script>
@endsection
