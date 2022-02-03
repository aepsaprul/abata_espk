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
                    <h1 class="m-0">Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pesanan</li>
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
                        <div class="card-header">
                            @if (Auth::user()->roles != "admin_espk")
                                <button id="button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3"><i class="fa fa-plus"></i> Tambah</button>
                            @endif
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Pemesan</th>
                                        <th class="text-center text-indigo">Nama Pesanan</th>
                                        <th class="text-center text-indigo">Tgl Dibuat SPK</th>
                                        <th class="text-center text-indigo">Penerima</th>
                                        <th class="text-center text-indigo">Tanggal Disetujui</th>
                                        <th class="text-center text-indigo">Status</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanans as $key => $pesanan)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $pesanan->cabangPemesan->nama_cabang }}</td>
                                        <td>{{ $pesanan->nama_pesanan }}</td>
                                        <td class="text-center">{{ tgl_indo($pesanan->tanggal_pesanan) }}</td>
                                        <td>
                                            @if ($pesanan->pegawaiPenerimaPesanan)
                                                {{ $pesanan->pegawaiPenerimaPesanan->nama_lengkap }}
                                            @else
                                                Kosong
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
                                        <td>
                                            @if ($pesanan->status_id != null)
                                                {{ $pesanan->status->nama_status }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a
                                                    class="dropdown-toggle btn bg-gradient-primary btn-sm"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @if ($pesanan->status_id == null || $pesanan->status_id == 8)
                                                        <button
                                                            class="dropdown-item text-indigo border-bottom publish"
                                                            data-id="{{ $pesanan->id }}"
                                                            title="Publish">
                                                            <i class="fas fa-rocket" style="width: 20px;"></i> Publish
                                                        </button>
                                                        <a
                                                            href="{{ route('pekerjaan.edit', [$pesanan->id]) }}"
                                                            class="dropdown-item text-indigo border-bottom"
                                                            title="Ubah">
                                                            <i class="fas fa-pencil-alt" style="width: 20px;"></i> Ubah
                                                        </a>
                                                        <form
                                                            action="{{ route('pekerjaan.destroy', [$pesanan->id]) }}"
                                                            method="POST"
                                                            class="d-inline">
                                                                @method('delete')
                                                                @csrf
                                                                    <button
                                                                        class="dropdown-item text-indigo border-bottom"
                                                                        onclick="return confirm('Yakin akan dihapus?')"
                                                                        title="Hapus">
                                                                        <i class="fas fa-minus-circle" style="width: 20px;"></i> Hapus
                                                                    </button>
                                                        </form>
                                                        <a
                                                            href="{{ route('pekerjaan.show', [$pesanan->id]) }}"
                                                            class="dropdown-item text-indigo"
                                                            title="Lihat">
                                                            <i class="fas fa-eye" style="width: 20px;"></i> Lihat
                                                        </a>
                                                    @else
                                                        <a
                                                            href="{{ route('pekerjaan.show', [$pesanan->id]) }}"
                                                            class="dropdown-item text-indigo"
                                                            title="Lihat">
                                                            <i class="fas fa-eye" style="width: 20px;"></i> Lihat
                                                        </a>
                                                    @endif
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
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

{{-- modal create  --}}
<div class="modal fade" tabindex="-1" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Publish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_create">
                    <input type="hidden" class="form-control" id="modal_id" name="modal_id">
                    <div class="mb-3">
                        <label for="modal_nama_pesanan" class="form-label">Nama Pesanan</label>
                        <input type="text" class="form-control" id="modal_nama_pesanan" name="modal_nama_pesanan" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modal_cabang_pelaksana_id" class="form-label">Pelaksana</label>
                        <select class="form-control modal_cabang_pelaksana_id" id="modal_cabang_pelaksana_id" name="modal_cabang_pelaksana_id">

                        </select>
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
    $(function () {
        $("#example1").DataTable({
            'responsive': true
        });
    });

    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('body').on('click', '.publish', function() {
            var id = $(this).attr('data-id');

            var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('pekerjaan.publish') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#modal_id').val(response.id);
                    $('#modal_nama_pesanan').val(response.nama_pesanan);

                    $.each(response.pelaksanas, function(index, value) {
                        var pelaksana = "<option value=\"" + value.id + "\"> " + value.nama_cabang + "</option>";
                        $('.modal_cabang_pelaksana_id').append(pelaksana);
                    });

                    $('#modal_create').modal('show');
                }
            });
        });

        $('#form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#modal_id').val(),
                cabang_pelaksana_id: $('#modal_cabang_pelaksana_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('pekerjaan.publish_store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#modal_create').modal('hide');
                    setTimeout(() => {
                        window.location.reload(1);
                    }, 500);
                }
            });
        });
    } );
</script>
@endsection
