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
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				    <h1>Jenis Pekerjaan</h1>
				</div>
				<div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Jenis Pekerjaan</li>
                    </ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-tipe-tab" data-toggle="pill" href="#custom-tabs-four-tipe" role="tab" aria-controls="custom-tabs-four-tipe" aria-selected="true">Tipe Pekerjaan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-jenis-tab" data-toggle="pill" href="#custom-tabs-four-jenis" role="tab" aria-controls="custom-tabs-four-jenis" aria-selected="false">Jenis Pekerjaan</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-four-tipe" role="tabpanel" aria-labelledby="custom-tabs-four-tipe-tab">
                                            <button id="tipe-button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3 mb-4">
                                                <i class="fa fa-plus"></i> Tambah
                                            </button>
                                            <table id="table_satu" class="table table-bordered table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-indigo">No</th>
                                                        <th class="text-center text-indigo">Tipe Pekerjaan</th>
                                                        <th class="text-center text-indigo">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tipes as $key => $tipe)
                                                    <tr>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td class="tipe_{{ $tipe->id }}">{{ $tipe->tipe }}</td>
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
                                                                    <button
                                                                        data-id="{{ $tipe->id }}"
                                                                        class="dropdown-item text-indigo border-bottom tipe-btn-edit">
                                                                            <i class="fas fa-pencil-alt" style="width: 20px;"></i> Ubah
                                                                    </button>
                                                                    <button
                                                                        data-id="{{ $tipe->id }}"
                                                                        class="dropdown-item text-indigo tipe-btn-delete">
                                                                            <i class="fas fa-minus-circle" style="width: 20px;"></i> Hapus
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-jenis" role="tabpanel" aria-labelledby="custom-tabs-four-jenis-tab">
                                            <button id="jenis-button-create" type="button" class="btn bg-gradient-primary btn-sm pl-3 pr-3 mb-4">
                                                <i class="fa fa-plus"></i> Tambah
                                            </button>
                                            <table id="table_dua" class="table table-bordered table-striped" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-indigo">No</th>
                                                        <th class="text-center text-indigo">Jenis Pekerjaan</th>
                                                        <th class="text-center text-indigo">Tipe Pekerjaan</th>
                                                        <th class="text-center text-indigo">Group</th>
                                                        <th class="text-center text-indigo">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($jenis as $key => $jenis)
                                                    <tr>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td>{{ $jenis->jenis }}</td>
                                                        <td>{{ $jenis->tipePekerjaan->tipe }}</td>
                                                        <td>
                                                            @php
                                                                $a = json_decode($jenis->cetak)
                                                            @endphp
                                                            @foreach ($a as $key => $item)
                                                            @if ($key > 0)
                                                                {{ ", " . $item }}
                                                            @else
                                                                {{ $item }}
                                                            @endif
                                                            @endforeach
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
                                                                    <button
                                                                        data-id="{{ $jenis->id }}"
                                                                        class="dropdown-item text-indigo border-bottom jenis-btn-edit">
                                                                            <i class="fas fa-pencil-alt" style="width: 20px;"></i> Ubah
                                                                    </button>
                                                                    <button
                                                                        data-id="{{ $jenis->id }}"
                                                                        class="dropdown-item text-indigo jenis-btn-delete">
                                                                            <i class="fas fa-minus-circle" style="width: 20px;"></i> Hapus
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card -->
                                </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

{{-- tipe modal create  --}}
<div class="modal fade tipe-modal-create" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="tipe_form_create">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tipe Pekerjaan</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tipe_create_tipe" class="form-label">Tipe Pekerjaan</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="tipe_create_tipe"
                            name="tipe_create_tipe"
                            maxlength="30" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary tipe-btn-create-spinner" disabled style="width: 120px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary tipe-btn-create-save" style="width: 120px;"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- tipe modal edit  --}}
<div class="modal fade tipe-modal-edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="tipe_form_edit">

                {{-- id  --}}
                <input
                    type="hidden"
                    id="tipe_edit_id"
                    name="tipe_edit_id">

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Tipe Pekerjaan</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tipe_edit_tipe" class="form-label">Tipe Pekerjaan</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="tipe_edit_tipe"
                            name="tipe_edit_tipe"
                            maxlength="30"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary tipe-btn-edit-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary tipe-btn-edit-save" style="width: 130px;"><i class="fa fa-save"></i> Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- tipe modal delete  --}}
<div class="modal fade tipe-modal-delete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="tipe_form_delete">

                {{-- id  --}}
                <input type="hidden" id="tipe_delete_id" name="tipe_delete_id">

                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="tipe_delete_title text-decoration-underline"></span> ?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 120px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary tipe-btn-delete-spinner" disabled style="width: 120px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary tipe-btn-delete-yes text-center" style="width: 120px;">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jenis modal create  --}}
<div class="modal fade jenis-modal-create" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="jenis_form_create">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Pekerjaan</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jenis_create_jenis" class="form-label">Jenis Pekerjaan</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="jenis_create_jenis"
                            name="jenis_create_jenis"
                            maxlength="30" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_create_tipe_pekerjaan_id" class="form-label">Tipe Pekerjaan</label>
                        <select name="jenis_create_tipe_pekerjaan_id" id="jenis_create_tipe_pekerjaan_id" class="form-control form-control-sm" required>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_create_cetak">Cetak</label>
                        <div class="select2-primary">
                            <select id="jenis_create_cetak" name="jenis_create_cetak" class="select2" multiple="multiple" data-placeholder="Select cetak" data-dropdown-css-class="select2-primary" style="width: 100%;">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary jenis-btn-create-spinner" disabled style="width: 120px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary jenis-btn-create-save" style="width: 120px;"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jenis modal edit  --}}
<div class="modal fade jenis-modal-edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="jenis_form_edit">

                {{-- id  --}}
                <input
                    type="hidden"
                    id="jenis_edit_id"
                    name="jenis_edit_id">

                <div class="modal-header">
                    <h5 class="modal-title">Ubah Jenis Pekerjaan</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">
                            <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jenis_edit_jenis" class="form-label">Jenis Pekerjaan</label>
                        <input
                            type="text"
                            class="form-control form-control-sm"
                            id="jenis_edit_jenis"
                            name="jenis_edit_jenis"
                            maxlength="30"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_edit_tipe_pekerjaan_id" class="form-label">Tipe Pekerjaan</label>
                        <select class="form-control form-control-sm" name="jenis_edit_tipe_pekerjaan_id" id="jenis_edit_tipe_pekerjaan_id">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_edit_cetak">Cetak</label>
                        <div class="select2-primary">
                            <select id="jenis_edit_cetak" name="jenis_edit_cetak[]" class="select2" multiple="multiple" data-placeholder="Select cetak" data-dropdown-css-class="select2-primary" style="width: 100%;">
                                <option value="digital_print" selected>p</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary jenis-btn-edit-spinner" disabled style="width: 130px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary jenis-btn-edit-save" style="width: 130px;"><i class="fa fa-save"></i> Perbaharui</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jenis modal delete  --}}
<div class="modal fade jenis-modal-delete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="jenis_form_delete">

                {{-- id  --}}
                <input type="hidden" id="jenis_delete_id" name="jenis_delete_id">

                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="jenis_delete_title text-decoration-underline"></span> ?</h5>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 120px;"><span aria-hidden="true">Tidak</span></button>
                    <button class="btn btn-primary jenis-btn-delete-spinner" disabled style="width: 120px; display: none;">
                        <span class="spinner-grow spinner-grow-sm"></span>
                        Loading..
                    </button>
                    <button type="submit" class="btn btn-primary jenis-btn-delete-yes text-center" style="width: 120px;">Ya</button>
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
<!-- Select2 -->
<script src="{{ asset('themes/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('themes/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('themes/dist/js/demo.js') }}"></script>
<!-- Page specific script -->

<script>
    $(function () {
        $("#table_satu").DataTable();

        $("#table_dua").DataTable();
    });

    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('.select2').select2()

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        // tipe create
        $('#tipe-button-create').on('click', function() {
            $('.tipe-modal-create').modal('show');
        });

        $(document).on('shown.bs.modal', '.tipe-modal-create', function() {
            $('#tipe_create_tipe').focus();
        });

        $('#tipe_form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                tipe: $('#tipe_create_tipe').val(),
                button: 'tipe_btn_store',
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.store') }} ',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.tipe-btn-create-spinner').css("display", "block");
                    $('.tipe-btn-create-save').css("display", "none");
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
                    alert('Error - ' + errorMessage);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // tipe edit
        $('body').on('click', '.tipe-btn-edit', function(e) {
            e.preventDefault();

            var id = $(this).attr('data-id');
            var url = '{{ route("jenis_pekerjaan.edit", ":id") }}';
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
                    $('#tipe_edit_id').val(response.id);
                    $('#tipe_edit_tipe').val(response.tipe);

                    $('.tipe-modal-edit').modal('show');
                }
            })
        });

        $('#tipe_form_edit').submit(function(e) {
            e.preventDefault();

            var id = $('#tipe_edit_id').val();
            var url = '{{ route("jenis_pekerjaan.update", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: id,
                tipe: $('#tipe_edit_tipe').val(),
                button: "tipe_btn_update",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                beforeSend: function() {
                    $('.tipe-btn-edit-spinner').css("display", "block");
                    $('.tipe-btn-edit-save').css("display", "none");
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
                    alert('Error - ' + errorMessage);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // tipe delete
        $('body').on('click', '.tipe-btn-delete', function(e) {
            e.preventDefault();
            $('.tipe_delete_title').empty();

            var formData = {
                id: $(this).attr('data-id'),
                button: "tipe_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.delete.btn') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('.tipe_delete_title').append(response.value);
                    $('#tipe_delete_id').val(response.id);
                    $('.tipe-modal-delete').modal('show');
                }
            });
        });

        $('#tipe_form_delete').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#tipe_delete_id').val(),
                button: "tipe_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.delete') }}',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.tipe-btn-delete-spinner').css("display", "block");
                    $('.tipe-btn-delete-yes').css("display", "none");
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
                    alert('Error - ' + errorMessage);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // jenis create
        $('#jenis-button-create').on('click', function() {
            $('#jenis_create_tipe_pekerjaan_id').empty();
            $('#jenis_create_cetak').empty();

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.create') }}',
                type: 'GET',
                success: function(response) {
                    var value_tipe = "<option value=\"\">--Pilih Tipe Pekerjaan--</option>";

                    $.each(response.tipes, function(index, value) {
                        value_tipe += "<option value=\"" + value.id + "\">" + value.tipe + "</option>";
                    });
                    $('#jenis_create_tipe_pekerjaan_id').append(value_tipe);

                    var value_cetak = "" +
                            "<option value=\"digital_print\">digital_print</option>" +
                            "<option value=\"offset\">offset</option>";
                    $('#jenis_create_cetak').append(value_cetak);

                    $('.jenis-modal-create').modal('show');
                }
            });
        });

        $(document).on('shown.bs.modal', '.jenis-modal-create', function() {
            $('#jenis_create_jenis').focus();
        });

        $('#jenis_form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                jenis: $('#jenis_create_jenis').val(),
                tipe_pekerjaan_id: $('#jenis_create_tipe_pekerjaan_id').val(),
                cetak: $('#jenis_create_cetak').val(),
                button: "jenis_btn_store",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.store') }} ',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.jenis-btn-create-spinner').css("display", "block");
                    $('.jenis-btn-create-save').css("display", "none");
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
                    alert('Error - ' + errorMessage);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });

        // jenis edit
        $('body').on('click', '.jenis-btn-edit', function(e) {
            e.preventDefault();
            $('#jenis_edit_tipe_pekerjaan_id').empty();
            $('#jenis_edit_cetak').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("jenis_pekerjaan.edit.jenis", ":id") }}';
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
                    $('#jenis_edit_id').val(response.id);
                    $('#jenis_edit_jenis').val(response.jenis);


                    var value_tipe = "<option value=\"\">--Pilih Tipe Pekerjaan--</option>";

                    $.each(response.tipes, function(index, value) {
                        value_tipe += "<option value=\"" + value.id + "\"";

                        if (value.id == response.tipe_pekerjaan_id) {
                            value_tipe += "selected";
                        }

                        value_tipe += ">" + value.tipe + "</option>";
                    });
                    $('#jenis_edit_tipe_pekerjaan_id').append(value_tipe);

                    //cetak
                    const json_cetak = JSON.parse(response.cetak);
                    var digital_print = Object.values(json_cetak).filter(item => item == 'digital_print');
                    var offset = Object.values(json_cetak).filter(item => item == 'offset');
                    // console.log(typeof evens); // [2, 4]

                    var value_cetak = "" +
                            "<option value=\"digital_print\"";
                            if (digital_print != '') {
                                value_cetak += " selected";
                            }
                            value_cetak += ">digital_print</option>" +
                            "<option value=\"offset\"";
                            if (offset != '') {
                                value_cetak += " selected";
                            }
                            value_cetak += ">offset</option>";
                    $('#jenis_edit_cetak').append(value_cetak);

                    $('.jenis-modal-edit').modal('show');
                }
            })
        });

        $('#jenis_form_edit').submit(function(e) {
            e.preventDefault();

            var id = $('#jenis_edit_id').val();
            var url = '{{ route("jenis_pekerjaan.update", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: $('#jenis_edit_id').val(),
                jenis: $('#jenis_edit_jenis').val(),
                tipe_pekerjaan_id: $('#jenis_edit_tipe_pekerjaan_id').val(),
                cetak: $('#jenis_edit_cetak').val(),
                button: "jenis_btn_update",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                beforeSend: function() {
                    $('.jenis-btn-edit-spinner').css("display", "block");
                    $('.jenis-btn-edit-save').css("display", "none");
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

        // jenis delete
        $('body').on('click', '.jenis-btn-delete', function(e) {
            e.preventDefault();
            $('.jenis_delete_title').empty();

            var formData = {
                id: $(this).attr('data-id'),
                button: "jenis_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.delete.btn') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('.jenis_delete_title').append(response.value);
                    $('#jenis_delete_id').val(response.id);
                    $('.jenis-modal-delete').modal('show');
                }
            });
        });

        $('#jenis_form_delete').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#jenis_delete_id').val(),
                button: "jenis_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.delete') }}',
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('.jenis-btn-delete-spinner').css("display", "block");
                    $('.jenis-btn-delete-yes').css("display", "none");
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
                    alert('Error - ' + errorMessage);
                    Toast.fire({
                        icon: 'error',
                        title: 'Error - ' + errorMessage
                    });
                }
            });
        });
    } );
</script>
@endsection
