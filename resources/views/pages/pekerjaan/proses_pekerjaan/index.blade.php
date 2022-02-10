@extends('layouts.app')

@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pekerjaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pekerjaan</li>
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
                            <table id="table_satu" class="table table-bordered table-striped" style="font-size: 14px; width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Pemesan</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">No Nota</th>
                                        <th class="text-center text-indigo">Tgl Order</th>
                                        <th class="text-center text-indigo">Status</th>
                                        <th class="text-center text-indigo">Tgl Selesai</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pekerjaans as $key => $pekerjaan)
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
                                        <td class="text-center">
                                            @php
                                                $tanggal_selesai = explode(" ", $pekerjaan->tanggal_selesai);
                                            @endphp
                                            @if ($pekerjaan->tanggal_selesai != null)
                                                {{ tgl_indo($tanggal_selesai[0]) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
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
                                                        @php $modul = explode('/', $pekerjaan->file); @endphp
                                                        <a
                                                            class="dropdown-item border-bottom text-indigo"
                                                            href="{{ route('pekerjaan.download', [$pekerjaan->file]) }}">
                                                                <i class="fas fa-download pr-2"></i> Download
                                                        </a>
                                                        <a
                                                            href="#"
                                                            class="dropdown-item border-bottom text-indigo status {{ $hide }}"
                                                            data-status="{{ $pekerjaan->status_id }}"
                                                            data-pesanan="{{ $pekerjaan->nama_pesanan }}"
                                                            data-id="{{ $pekerjaan->id }}">
                                                                <i class="fas fa-exchange-alt pr-2"></i> Status
                                                        </a>
                                                        <a
                                                            href="{{ route('proses_pekerjaan.show', [$pekerjaan->id]) }}"
                                                            class="dropdown-item border-bottom text-indigo"
                                                            title="Lihat">
                                                                <i class="fas fa-eye pr-2"></i> Lihat
                                                        </a>
                                                        <a
                                                            href="{{ route('proses_pekerjaan.print', [$pekerjaan->id]) }}"
                                                            class="dropdown-item text-indigo" title="Print"
                                                            target="_blank">
                                                                <i class="fas fa-print pr-2"></i> Print
                                                        </a>
                                                </div>
                                            </div>
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

{{-- modal create  --}}
<div class="modal fade" tabindex="-1" id="modal_ubah_status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> --}}
<script src="{{ asset('lib/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/jszip.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/buttons.html5.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('#table_satu').DataTable();

        $('#table_dua').DataTable();

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

        // $('#modal_status').on('change', function() {
        //     if($('#modal_status').val() == 2 || $('#modal_status').val() == 7) {
        //         $('#modal_keterangan').prop('required', true);
        //     } else {
        //         $('#modal_keterangan').prop('required', false);
        //     }
        // });

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
