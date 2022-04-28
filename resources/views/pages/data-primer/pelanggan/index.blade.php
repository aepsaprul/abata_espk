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
                    <h1 class="m-0">Pelanggan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pelanggan</li>
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
                                <button id="button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3"><i class="fa fa-plus"></i> Tambah</button>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Pelanggan</th>
                                        <th class="text-center text-indigo">Telepon</th>
                                        <th class="text-center text-indigo">Alamat</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelanggans as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="nama_{{ $item->id }}">{{ $item->nama }}</td>
                                        <td class="telepon_{{ $item->id }}">{{ $item->telp }}</td>
                                        <td class="alamat_{{ $item->id }}">{{ $item->alamat }}</td>
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
                                                    <a
                                                        class="dropdown-item text-indigo btn-edit"
                                                        href="#"
                                                        data-id="{{ $item->id }}">
                                                            <i class="fa fa-pencil-alt px-2"></i> Ubah
                                                    </a>
                                                    <a
                                                        class="dropdown-item text-indigo btn-delete"
                                                        href="#"
                                                        data-id="{{ $item->id }}">
                                                            <i class="fa fa-trash-alt px-2"></i> Hapus
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
<div class="modal fade modal-create" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_create">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelanggan</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_nama" class="form-label">Nama</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="create_nama"
                            name="create_nama"
                            maxlength="30"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="create_telepon" class="form-label">Telepon</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="create_telepon"
                            name="create_telepon"
                            maxlength="15"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="create_alamat" class="form-label">Alamat</label>
                        <textarea
                            class="form-control form-control-sm"
                            rows="3"
                            id="create_alamat"
                            name="create_alamat"
                            required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-create-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-create-save" style="width: 130px;"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal edit  --}}
<div class="modal fade modal-edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_edit">

                {{-- id  --}}
                <input
                    type="hidden"
                    id="edit_id"
                    name="edit_id">

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Pelanggan</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="edit_nama"
                            name="edit_nama"
                            maxlength="30"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_telepon" class="form-label">Telepon</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="edit_telepon"
                            name="edit_telepon"
                            maxlength="15"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea
                            class="form-control form-control-sm"
                            rows="3"
                            id="edit_alamat"
                            name="edit_alamat"
                            required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-edit-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-edit-save" style="width: 130px;"><i class="fa fa-save"></i> Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal delete  --}}
<div class="modal fade modal-delete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form_delete">

                {{-- id  --}}
                <input type="hidden" id="delete_id" name="delete_id">

                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="delete_title text-decoration-underline"></span> ?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 130px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary btn-delete-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary btn-delete-yes text-center" style="width: 130px;">Ya</button>
                </div>
            </form>
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
    $(function () {
        $("#example1").DataTable();
    });

    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        // create
        $('#button-create').on('click', function() {
            $('.modal-create').modal('show');
        });

        $(document).on('shown.bs.modal', '.modal-create', function() {
            $('#create_nama').focus();
        });

        $('#form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                nama: $('#create_nama').val(),
                telepon: $('#create_telepon').val(),
                alamat: $('#create_alamat').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('pelanggan.store') }} ',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-create-spinner').css("display", "block");
                    $('.btn-create-save').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil disimpan.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
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
        });

        // edit
        $('body').on('click', '.btn-edit', function(e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("pelanggan.edit", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function(response) {
                    $('#edit_id').val(response.id);
                    $('#edit_nama').val(response.nama);
                    $('#edit_telepon').val(response.telepon);
                    $('#edit_alamat').val(response.alamat);

                    $('.modal-edit').modal('show');
                }
            })
        });

        $('#form_edit').submit(function(e) {
            e.preventDefault();

            $('.nama_' + $('#edit_id').val()).empty();
            $('.telepon_' + $('#edit_id').val()).empty();
            $('.alamat_' + $('#edit_id').val()).empty();

            var formData = {
                nama: $('#edit_nama').val(),
                telepon: $('#edit_telepon').val(),
                alamat: $('#edit_alamat').val(),
                _token: CSRF_TOKEN
            }

            var id = $('#edit_id').val();
            var url = '{{ route("pelanggan.update", ":id") }}';
            url = url.replace(':id', id );

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                beforeSend: function() {
                    $('.btn-edit-spinner').css("display", "block");
                    $('.btn-edit-save').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil diperbaharui.'
                    });

                    $('.nama_' + response.id).append(response.nama);
                    $('.telepon_' + response.id).append(response.telepon);
                    $('.alamat_' + response.id).append(response.alamat);

                    setTimeout(() => {
                        $('.modal-edit').modal('hide');
                        $('.btn-edit-spinner').css("display", "none");
                        $('.btn-edit-save').css("display", "block");
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
        });

        // delete
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            $('.delete_title').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("pelanggan.delete_btn", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: id,
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function(response) {
                    $('.delete_title').append(response.nama);
                    $('#delete_id').val(response.id);
                    $('.modal-delete').modal('show');
                }
            });
        });

        $('#form_delete').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#delete_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('pelanggan.delete') }}',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.btn-delete-spinner').css("display", "block");
                    $('.btn-delete-yes').css("display", "none");
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus.'
                    });

                    setTimeout(() => {
                        window.location.reload(1);
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
        });
    });
</script>
@endsection
