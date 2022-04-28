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
                    <h1 class="m-0">Cabang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cabang</li>
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
                            <button id="button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-indigo">No</th>
                                        <th class="text-center text-indigo">Nama Cabang</th>
                                        <th class="text-center text-indigo">Form Group</th>
                                        <th class="text-center text-indigo">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cabangs as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td class="nama_{{ $item->id }}">
                                            @if ($item->masterCabang)
                                                {{ $item->masterCabang->nama_cabang }}
                                            @else
                                                kosong
                                            @endif
                                        </td>
                                        <td class="group_{{ $item->id }}">{{ $item->form_group }}</td>
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
                    <h5 class="modal-title">Tambah Cabang</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_cabang_id" class="form-label">Nama Cabang</label>
                        <select name="create_cabang_id" id="create_cabang_id" class="form-control select2-create-cabang-id">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_form_group" class="form-label">Form Group</label>
                        <select name="create_form_group" id="create_form_group" class="form-control">
                            <option value="0">--Pilih Form Group--</option>
                            <option value="digital_print">digital_print</option>
                            <option value="offset">offset</option>
                        </select>
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
                    <h5 class="modal-title">Ubah Cabang</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_cabang_id" class="form-label">Nama Cabang</label>
                        <select name="edit_cabang_id" id="edit_cabang_id" class="form-control select2-edit-cabang-id">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_form_group" class="form-label">Form Group</label>
                        <select name="edit_form_group" id="edit_form_group" class="form-control">

                        </select>
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
<!-- Select2 -->
<script src="{{ asset('public/themes/plugins/select2/js/select2.full.min.js') }}"></script>

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
            $.ajax({
                url: "{{ URL::route('cabang.create') }}",
                type: 'GET',
                success: function (response) {
                    var value_cabang = "<option value=\"0\">--Pilih Cabang--</option>";
                    $.each(response.master_cabangs, function (index, item) {
                        value_cabang += "<option value=\"" + item.id + "\">" + item.nama_cabang + "</option>";
                    });
                    $('#create_cabang_id').append(value_cabang);
                    $('.modal-create').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.modal-create', function() {
            $('#create_cabang_id').focus();
        });

        $('#form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                cabang_id: $('#create_cabang_id').val(),
                form_group: $('#create_form_group').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{ URL::route('cabang.store') }}",
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
            $('#edit_cabang_id').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("cabang.edit", ":id") }}';
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

                    var value_cabang = "<option value=\"0\">--Pilih Cabang--</option>";
                    $.each(response.master_cabangs, function (index, item) {
                        value_cabang += "<option value=\"" + item.id + "\"";
                        if (item.id == response.cabang_id) {
                            value_cabang += " selected";
                        }
                        value_cabang += ">" + item.nama_cabang + "</option>";
                    });
                    $('#edit_cabang_id').append(value_cabang);

                    var value_form_group = "" +
                        "<option value=\"0\">--Pilih Form Group--</option>" +
                        "<option value=\"digital_print\"";
                        if (response.form_group == "digital_print") {
                            value_form_group += " selected";
                        }
                        value_form_group += ">digital_print</option>" +
                        "<option value=\"offset\"";
                        if (response.form_group == "offset") {
                            value_form_group += " selected";
                        }
                        value_form_group += ">offset</option>";

                    $('#edit_form_group').append(value_form_group);

                    $('.modal-edit').modal('show');
                }
            })
        });

        $('#form_edit').submit(function(e) {
            e.preventDefault();

            var formData = {
                cabang_id: $('#edit_cabang_id').val(),
                form_group: $('#edit_form_group').val(),
                _token: CSRF_TOKEN
            }

            var id = $('#edit_id').val();
            var url = '{{ route("cabang.update", ":id") }}';
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

        // delete
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            $('#delete_id').val($(this).attr('data-id'));
            $('.modal-delete').modal('show');
        });

        $('#form_delete').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#delete_id').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: "{{ URL::route('cabang.delete') }}",
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
