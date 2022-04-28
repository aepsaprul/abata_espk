@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pesanan Publish</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan Publish</li>
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
                            <table id="table_satu" class="table table-bordered table-striped" style="width:100%; font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Pelaksana</th>
                                        <th class="text-center text-indigo">Nama Pekerjaan</th>
                                        <th class="text-center text-indigo">No Nota</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Status</th>
                                        <th class="text-center text-indigo">Tgl Disetujui</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanans as $key => $pesanan)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $pesanan->cabangCetak->nama_cabang }}</td>
                                        <td>{{ $pesanan->nama_pesanan }}</td>
                                        <td>{{ $pesanan->nomor_nota }}</td>
                                        <td class="text-center">{{ tgl_indo($pesanan->tanggal_pesanan) }}</td>
                                        <td>
                                            @if ($pesanan->status_id != null)
                                                {{ $pesanan->status->nama_status }}
                                                @if ($pesanan->status_id != null && $pesanan->status_id != 9)
                                                    @php $hide = "d-none"; @endphp
                                                @else
                                                    @php $hide = ""; @endphp
                                                @endif
                                            @else
                                                -
                                                @php $hide = ""; @endphp
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $tanggal_disetujui = explode(" ", $pesanan->tanggal_disetujui);
                                            @endphp
                                            @if ($pesanan->tanggal_disetujui)
                                                {{ tgl_indo($tanggal_disetujui[0]) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (Auth::user()->roles != "admin_espk")
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                        data-toggle="dropdown"
                                                        aria-expanded="false"
                                                        title="Aksi">
                                                            <i class="fas fa-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @php $modul = explode('/', $pesanan->file); @endphp
                                                        <a
                                                            href="{{ route('pekerjaan.download', [$pesanan->file]) }}"
                                                            class="dropdown-item border-bottom text-indigo">
                                                                <i class="fas fa-download pr-2"></i> Download
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item border-bottom text-indigo status {{ $hide }}"
                                                            data-status="{{ $pesanan->status_id }}"
                                                            data-pesanan="{{ $pesanan->nama_pesanan }}"
                                                            data-id="{{ $pesanan->id }}">
                                                                <i class="fas fa-exchange-alt pr-2"></i> Status
                                                        </a>
                                                        <a
                                                            href="{{ route('pesanan_publish.show', [$pesanan->id]) }}"
                                                            class="dropdown-item border-bottom text-indigo"
                                                            title="Lihat">
                                                                <i class="fas fa-eye pr-2"></i> Lihat
                                                        </a>
                                                        <a
                                                            href="{{ route('proses_pekerjaan.print', [$pesanan->id]) }}"
                                                            class="dropdown-item text-indigo"
                                                            title="Print"
                                                            target="_blank">
                                                                <i class="fas fa-print pr-2"></i> Print
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                -
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
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

{{-- modal create  --}}
<div class="modal fade" tabindex="-1" id="modal_ubah_status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal">
                        <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_ubah_status">
                    <input type="hidden" class="form-control" id="modal_id" name="modal_id">
                    <div class="mb-3">
                        <label for="modal_pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="modal_pekerjaan" name="modal_pekerjaan" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modal_status" class="form-label">Status</label>
                        <select class="form-control modal_status" id="modal_status" name="modal_status" required>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modal_keterangan" class="form-label">Keterangan <span class="notif-keterangan text-danger fst-italic"></span></label>
                        <input type="text" class="form-control modal_keterangan" id="modal_keterangan" name="modal_keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('#table_satu').DataTable({
            'responsive': true
        });

        $('body').on('click', '.status', function() {
            $('.modal_status').empty();

            $('#modal_keterangan').val("");
            $('#modal_id').val($(this).attr('data-id'));
            $('#modal_pekerjaan').val($(this).attr('data-pesanan'));

            var status_val = "<option value=\"\">--Pilih Status--</option>";

            if ($(this).attr('data-status') == 1) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"3\">Pra Cetak</option>";
            } else if ($(this).attr('data-status') == 3) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"4\">Proses Cetak</option>" +
                    "<option value=\"5\">Proses Finishing</option>";
            } else if ($(this).attr('data-status') == 4) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"5\">Proses Finishing</option>" +
                    "<option value=\"6\">Selesai, Siap Dikirim</option>";
            } else if ($(this).attr('data-status') == 5) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"6\">Selesai, Siap Dikirim</option>";
            } else {
                status_val += "" +
                    "<option value=\"2\">Dibatalkan</option>" +
                    "<option value=\"8\">Revisi</option>" +
                    "<option value=\"1\">Disetujui</option>";
            }

            $('.modal_status').append(status_val);
            $('#modal_ubah_status').modal('show');
        });

        $('#form_ubah_status').submit(function(e) {
            e.preventDefault();
            $('.notif-keterangan').empty();

            if ($('#modal_status').val() == 2 && $('#modal_keterangan').val() == "") {
                $('.notif-keterangan').append("Keterangan harus diisi !!!");
                return false;
            }

            if ($('#modal_status').val() == 7 && $('#modal_keterangan').val() == "") {
                $('.notif-keterangan').append("Keterangan harus diisi !!!");
                return false;
            }

            if ($('#modal_status').val() == 8 && $('#modal_keterangan').val() == "") {
                $('.notif-keterangan').append("Keterangan harus diisi !!!");
                return false;
            }

            var formData = {
                id: $('#modal_id').val(),
                status_id: $('#modal_status').val(),
                keterangan: $('#modal_keterangan').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('proses_pekerjaan.update_status') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });
    } );
</script>
@endsection
