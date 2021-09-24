@extends('layouts.app')

@section('style')
<link href="{{ asset('lib/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

<style>
    .col-md-10 {
        font-size: 12px;
    }
    .fas {
        font-size: 14px;
    }
    .btn {
        padding: .2rem .6rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h6 class="text-uppercase text-center">Data Navigasi</h6>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-12 mb-4">
                <a id="btn_create" title="Tambah">
                    <span class="border border-primary border-1 px-2 py-1">
                        <i class="fas fa-plus"></i>
                    </span>
                </a>
            </div>
            <table id="table_satu" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Nama Navigasi</th>
                        <th>Level</th>
                        <th>Root Nav</th>
                        <th>Link</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($navigasis as $key => $navigasi)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $navigasi->nama_nav }}</td>
                        <td>{{ $navigasi->level_nav }}</td>
                        <td>{{ $navigasi->root_nav }}</td>
                        <td>{{ $navigasi->link }}</td>
                        <td class="text-center">
                            <button data-id="{{ $navigasi->id }}" class="border-0 bg-white btn_edit" title="Ubah">
                                <span class="border border-primary border-1 px-2 py-1"><i class="fas fa-edit"></i></span>
                            </button> |
                            <button data-id="{{ $navigasi->id }}" class="border-0 bg-white btn_delete" title="Hapus">
                                <span class="border border-primary border-1 px-2 py-1"><i class="fas fa-trash"></i></span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- modal create  --}}
<div class="modal fade" tabindex="-1" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Navigasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_create">
                    <div class="mb-3">
                        <label for="create_nama_nav" class="form-label">Nama Navigasi</label>
                        <input type="text" class="form-control" id="create_nama_nav" name="create_nama_nav">
                    </div>
                    <div class="mb-3">
                        <label for="create_level_nav" class="form-label">Level Navigasi</label>
                        <select class="form-control" id="create_level_nav" name="create_level_nav">
                            <option value="main_nav">Main Navigasi</option>
                            <option value="sub_nav">Sub Navigasi</option>
                        </select>
                    </div>
                    <div class="mb-3" id="form_root_nav" style="display: none;">
                        <label for="create_root_nav" class="form-label">Root Navigasi</label>
                        <select id="create_root_nav" class="form-control" name="create_root_nav">
                            <option value="">--Pilih Root Navigasi--</option>
                            @foreach ($root_navs as $root_nav)
                                    <option value="{{ $root_nav->id }}">{{ $root_nav->nama_nav }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="create_link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="create_link" name="create_link">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal edit  --}}
<div class="modal fade" tabindex="-1" id="modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Navigasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_edit">
                    <input type="hidden" class="form-control" id="edit_id" name="edit_id">
                    <div class="mb-3">
                        <label for="edit_nama_nav" class="form-label">Nama Navigasi</label>
                        <input type="text" class="form-control" id="edit_nama_nav" name="edit_nama_nav">
                    </div>
                    <div id="level_nav">

                    </div>
                    <div id="root_nav">

                    </div>
                    <div class="mb-3">
                        <label for="edit_link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="edit_link" name="edit_link">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal delete  --}}
<div class="modal fade" tabindex="-1" id="modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_delete">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="title_delete text-decoration-underline"></span> ?</h5>
                </div>
                <input type="hidden" class="form-control" id="delete_id" name="delete_id">
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

        $('#btn_create').on('click', function() {
            $('#modal_create').modal('show');
        });

        $('#create_level_nav').on('change', function() {
            var nav = $('#create_level_nav').val();

            if (nav == "sub_nav") {
                $('#form_root_nav').css('display', 'block');
            } else {
                $('#form_root_nav').css('display', 'none');
            }
        });

        $('#form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                nama_nav: $('#create_nama_nav').val(),
                level_nav: $('#create_level_nav').val(),
                root_nav: $('#create_root_nav').val(),
                link: $('#create_link').val(),
                _token: CSRF_TOKEN
            };

            $.ajax({
                url: '{{ URL::route('navigasi.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.btn_edit').on('click', function(e) {
            e.preventDefault();
            $('#root_nav').empty();
            $('#level_nav').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("navigasi.edit", ":id") }}';
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
                    $('#edit_nama_nav').val(response.nama_nav);
                    $('#edit_level_nav').val(response.level_nav);
                    $('#edit_link').val(response.link);

                    var level_nav_val = "" +
                        "<div class=\"mb-3\">" +
                            "<label for=\"edit_level_nav\" class=\"form-label\">Level Navigasi</label>" +
                            "<select class=\"form-control\" id=\"edit_level_nav\" name=\"edit_level_nav\">" +
                                "<option value=\"main_nav\"";
                                if (response.level_nav == "main_nav") {
                                    level_nav_val += "selected";
                                }
                                level_nav_val += ">Main Navigasi</option>" +
                                "<option value=\"sub_nav\"";
                                if (response.level_nav == "sub_nav") {
                                    level_nav_val += "selected";
                                }
                                level_nav_val += ">Sub Navigasi</option>" +
                            "</select>" +
                        "</div>";

                    $('#level_nav').append(level_nav_val);

                    if (response.root_nav == null) {
                        var style = "display: none;";
                    } else {
                        var style = "display: block;";
                    }

                    var root_nav_val = "" +
                        "<div class=\"mb-3\" id=\"form_edit_root_nav\" style=\"" + style + "\">" +
                            "<label for=\"edit_root_nav\" class=\"form-label\">Root Navigasi</label>" +
                            "<select id=\"edit_root_nav\" class=\"form-control\" name=\"edit_root_nav\">" +
                                "<option value=\"\">--Pilih Root Navigasi--</option>";
                                $.each(response.roots, function(index, value) {
                                    root_nav_val += "<option value=\"" + value.id + "\"";
                                    if (value.id == response.root_nav) {
                                        root_nav_val += "selected";
                                    }
                                    root_nav_val += ">" + value.nama_nav + "</option>";
                                });
                                root_nav_val += "</select>" +
                        "</div>";

                    $('#root_nav').append(root_nav_val);
                    $('#modal_edit').modal('show');

                    // level nav on change
                    $('#edit_level_nav').on('change', function() {
                        var nav = $('#edit_level_nav').val();

                        if (nav == "sub_nav") {
                            $('#form_edit_root_nav').css('display', 'block');
                            $('#edit_root_nav').val("");
                        } else {
                            $('#form_edit_root_nav').css('display', 'none');
                            $('#edit_root_nav').val("");
                        }
                    });
                }
            });

        });


        $('#form_edit').submit(function(e) {
            e.preventDefault();

            var id = $('#edit_id').val();
            var url = '{{ route("navigasi.update", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: id,
                nama_nav: $('#edit_nama_nav').val(),
                level_nav: $('#edit_level_nav').val(),
                root_nav: $('#edit_root_nav').val(),
                link: $('#edit_link').val(),
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

        $('.btn_delete').on('click', function() {

            $('.title_delete').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("navigasi.delete_btn", ":id") }}';
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
                    $('#delete_id').val(response.id);
                    $('.title_delete').append(response.nama);
                    $('#modal_delete').modal('show');
                }
            });
        });

        $('#form_delete').submit(function(e) {
            e.preventDefault();

            var id = $('#delete_id').val();
            var url = '{{ route("navigasi.delete", ":id") }}';
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
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });
    } );
</script>
@endsection
