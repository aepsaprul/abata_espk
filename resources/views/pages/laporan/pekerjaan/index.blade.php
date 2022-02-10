@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

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

                            <h3>Data Laporan</h3>
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
                                <tbody id="data-laporan">
                                    @foreach ($pekerjaans as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $item->cabangPemesan->nama_cabang }}</td>
                                            <td>{{ $item->nama_pesanan }}</td>
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
    </section>
</div>

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
<!-- Select2 -->
<script src="{{ asset('themes/plugins/select2/js/select2.full.min.js') }}"></script>

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
                        var value_pekerjaan = "";
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

        $('body').on('click', '.lihat', function () {

            var id = $(this).attr('data-id');
            var url = '{{ route("proses_pekerjaan.show", ":id") }}';
            url = url.replace(':id', id );

            var id = $(this).attr('data-id');
            window.open(url, '_blank');
        });
    } );
</script>
@endsection
