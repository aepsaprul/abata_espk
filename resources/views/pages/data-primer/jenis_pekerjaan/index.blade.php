@extends('layouts.app')

@section('style')
<link href="{{ asset('lib/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

<style>
    .col-md-6 {
        font-size: 12px;
    }
    .fas {
        font-size: 14px;
    }
    .btn {
        padding: .2rem .6rem;
    }
    table tr td,
    table tr th{
        border-bottom: none;
    }
    table {
        border-bottom: 1px solid #000;
    }
    table .active {
        background-color: rgb(227, 237, 245);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-6">
            <h6 class="text-uppercase text-center">Tipe Pekerjaan</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button
                        id="tipe_btn_create"
                        class="mb-4 btn btn-outline-dark text-dark">
                            <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <table id="table_satu" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center text-light" style="background-color: #004da9;">
                        <th>No</th>
                        <th>Tipe Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipes as $key => $tipe)
                    <tr
                    @if ($key % 2 == 1)
                       echo class="active";
                    @endif
                    >
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $tipe->tipe }}</td>
                        <td class="text-center">
                            <button
                                data-id="{{ $tipe->id }}"
                                class="border-0 bg-transparent tipe_btn_edit">
                                    <i class="fas fa-edit"></i>
                            </button> |
                            <button
                                data-id="{{ $tipe->id }}"
                                class="border-0 bg-transparent tipe_btn_delete">
                                    <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h6 class="text-uppercase text-center">Jenis Pekerjaan</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button
                        id="jenis_btn_create"
                        class="mb-4 btn btn-outline-dark text-dark">
                            <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <table id="table_dua" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center text-light" style="background-color: #004da9;">
                        <th>No</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Tipe Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenis as $key => $jenis)
                    <tr
                    @if ($key % 2 == 1)
                       echo class="active";
                    @endif
                    >
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $jenis->jenis }}</td>
                        <td>{{ $jenis->tipePekerjaan->tipe }}</td>
                        <td class="text-center">
                            <button
                                data-id="{{ $jenis->id }}"
                                class="border-0 bg-transparent jenis_btn_edit">
                                    <i class="fas fa-edit"></i>
                            </button> |
                            <button
                                data-id="{{ $jenis->id }}"
                                class="border-0 bg-transparent jenis_btn_delete">
                                    <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- tipe modal create  --}}
<div class="modal fade" tabindex="-1" id="tipe_modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tipe Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tipe_form_create">
                    <div class="mb-3">
                      <label for="tipe_create_tipe" class="form-label">Tipe Pekerjaan</label>
                      <input type="text" class="form-control" id="tipe_create_tipe" name="tipe_create_tipe">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- tipe modal edit  --}}
<div class="modal fade" tabindex="-1" id="tipe_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Tipe Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tipe_form_edit">
                    <input type="hidden" class="form-control" id="tipe_edit_id" name="tipe_edit_id">
                    <div class="mb-3">
                      <label for="tipe_edit_tipe" class="form-label">Tipe Pekerjaan</label>
                      <input type="text" class="form-control" id="tipe_edit_tipe" name="tipe_edit_tipe">
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- tipe modal delete  --}}
<div class="modal fade" tabindex="-1" id="tipe_modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="tipe_form_delete">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="tipe_title_delete text-decoration-underline"></span> ?</h5>
                </div>
                <input type="hidden" class="form-control" id="tipe_delete_id" name="tipe_delete_id">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal" style="width: 100px;">Tidak</button>
                    <button type="submit" class="btn btn-primary text-center" style="width: 100px;">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jenis modal create  --}}
<div class="modal fade" tabindex="-1" id="jenis_modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jenis Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="jenis_form_create">
                    <div class="mb-3">
                        <label for="jenis_create_jenis" class="form-label">Jenis Pekerjaan</label>
                        <input type="text" class="form-control" id="jenis_create_jenis" name="jenis_create_jenis">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_create_tipe_pekerjaan_id" class="form-label">Tipe Pekerjaan</label>
                        <div class="jenis_create_tipe_pekerjaan_id"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- jenis modal edit  --}}
<div class="modal fade" tabindex="-1" id="jenis_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Jenis Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="jenis_form_edit">
                    <input type="hidden" class="form-control" id="jenis_edit_id" name="jenis_edit_id">
                    <div class="mb-3">
                      <label for="jenis_edit_jenis" class="form-label">Jenis Pekerjaan</label>
                      <input type="text" class="form-control" id="jenis_edit_jenis" name="jenis_edit_jenis">
                    </div>
                    <div class="mb-3">
                      <label for="jenis_edit_tipe_pekerjaan_id" class="form-label">Tipe Pekerjaan</label>
                      <div class="jenis_edit_tipe_pekerjaan_id"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- jenis modal delete --}}
<div class="modal fade" tabindex="-1" id="jenis_modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="jenis_form_delete">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="jenis_title_delete text-decoration-underline"></span> ?</h5>
                </div>
                <input type="hidden" class="form-control" id="jenis_delete_id" name="jenis_delete_id">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal" style="width: 100px;">Tidak</button>
                    <button type="submit" class="btn btn-primary text-center" style="width: 100px;">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('lib/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/jszip.min.js') }}"></script>
<script src="{{ asset('lib/datatables/js/buttons.html5.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $('#table_satu').DataTable({
            "ordering": false
        });
        $('#table_dua').DataTable({
            "ordering": false
        });

        $('#tipe_btn_create').on('click', function() {
            $('#tipe_modal_create').modal('show');
        });

        $('#tipe_form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                tipe: $('#tipe_create_tipe').val(),
                button: 'tipe_btn_store',
                _token: CSRF_TOKEN
            };

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.tipe_btn_edit').on('click', function(e) {
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
                    $('#tipe_modal_edit').modal('show');
                }
            });

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
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.tipe_btn_delete').on('click', function() {

            $('.tipe_title_delete').empty();
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
                    $('#tipe_delete_id').val(response.id);
                    $('.tipe_title_delete').append(response.value);
                    $('#tipe_modal_delete').modal('show');
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
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('#jenis_btn_create').on('click', function() {
            $('.jenis_create_tipe_pekerjaan_id').empty();

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.create') }}',
                type: 'GET',
                success: function(response) {

                    var val = "<select class=\"form-control\" id=\"jenis_create_tipe_pekerjaan_id\" name=\"jenis_create_tipe_pekerjaan_id\">" +
                        "<option value=\"\">--Pilih Tipe Pekerjaan--</option>";

                    $.each(response.tipe, function(index, value) {
                        val += "<option value=\"" + value.id + "\">"+ value.tipe +"</option>";
                    });

                    val += "</select>";

                    $('.jenis_create_tipe_pekerjaan_id').append(val);
                    $('#jenis_modal_create').modal('show');
                }
            });
        });

        $('#jenis_form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                jenis: $('#jenis_create_jenis').val(),
                tipe_pekerjaan_id: $('#jenis_create_tipe_pekerjaan_id').val(),
                button: "jenis_btn_store",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('jenis_pekerjaan.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.jenis_btn_edit').on('click', function() {
            $('.jenis_edit_tipe_pekerjaan_id').empty();

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
                    // console.log(response);
                    $('#jenis_edit_id').val(response.id);
                    $('#jenis_edit_jenis').val(response.jenis);

                    var val = "<select class=\"form-control\" id=\"jenis_edit_tipe_pekerjaan_id\" name=\"jenis_edit_tipe_pekerjaan_id\">" +
                        "<option value=\"\">--Pilih Menu Utama--</option>";

                    $.each(response.tipes, function(index, value) {
                        val += "<option value=\"" + value.id + "\"";
                        if (response.tipe_pekerjaan_id == value.id) {
                            val += "selected";
                        }
                        val += ">"+ value.tipe +"</option>";
                    });

                    val += "</select>";

                    $('.jenis_edit_tipe_pekerjaan_id').append(val);
                    $('#jenis_modal_edit').modal('show');
                }
            });
        });

        $('#jenis_form_edit').submit(function(e) {
            e.preventDefault();

            var id = $('#jenis_edit_id').val();
            var url = '{{ route("jenis_pekerjaan.update", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: id,
                jenis: $('#jenis_edit_jenis').val(),
                tipe_pekerjaan_id: $('#jenis_edit_tipe_pekerjaan_id').val(),
                button: "jenis_btn_update",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: url,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.jenis_btn_delete').on('click', function() {
            $('.jenis_title_delete').empty();

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
                    $('#jenis_delete_id').val(response.id);
                    $('.jenis_title_delete').append(response.value);
                    $('#jenis_modal_delete').modal('show');
                }
            })
        });

        $('#jenis_form_delete').submit( function(e) {
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
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            })
        });


    } );
</script>
@endsection
