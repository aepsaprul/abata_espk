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
                        @if (Auth::user()->roles != "admin_espk")
                            <div class="card-header">
                                <button type="button" id="btn-create" class="btn bg-gradient-primary btn-sm pl-3 pr-3"><i class="fa fa-plus"></i> Tambah</button>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        @if (Auth::user()->roles == "admin_espk")
                                            <th class="text-center text-indigo">Pemesan</th>
                                        @endif
                                        <th class="text-center text-indigo">Pelaksana</th>
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
                                        @if (Auth::user()->roles == "admin_espk")
                                            <td>{{ $pesanan->cabangPemesan->nama_cabang }}</td>
                                        @endif
                                        <td>{{ $pesanan->cabangCetak->nama_cabang }}</td>
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
                                            @if (Auth::user()->roles != "admin_espk")
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

{{-- modal publish  --}}
<div class="modal fade" tabindex="-1" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Publish</h5>
                <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
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

{{-- modal tambah  --}}
<div class="modal fade modal-tambah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_tambah">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pemesanan</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_cabang_id" class="form-label">Nama Cabang Pelaksana</label>
                        <select name="create_cabang_id" id="create_cabang_id" class="form-control form-control-sm">
                            <option value="0">--Pilih Cabang--</option>
                            @foreach ($cabangs as $item)
                                <option value="{{ $item->id }}">{{ $item->masterCabang->nama_cabang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-create-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;"><i class="fa fa-angle-double-right"></i> Lanjut</button>
                </div>
            </form>
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

        $('#btn-create').on('click', function () {
            $('.modal-tambah').modal('show');
        });

        $('#form_tambah').submit(function (e) {
            e.preventDefault();

            var id = $('#create_cabang_id').val();
            var url = '{{ route("pekerjaan.create", ":id") }}';
            url = url.replace(':id', id );

            window.location.href = url;
        })

        $('body').on('click', '.publish', function() {
            var id = $(this).attr('data-id');
            $('.modal_cabang_pelaksana_id').empty();

            var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{ URL::route('pekerjaan.publish') }}",
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
                url: "{{ URL::route('pekerjaan.publish_store') }}",
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
