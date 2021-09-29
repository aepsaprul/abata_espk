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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-6">
            <h6 class="text-uppercase text-center">Menu Utama</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button id="menu_utama_btn_create" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <table id="table_satu" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Link</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu_utamas as $key => $menu_utama)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $menu_utama->nama_menu }}</td>
                        <td>{{ $menu_utama->link }}</td>
                        <td class="text-center">
                            <button data-id="{{ $menu_utama->id }}" class="border-0 bg-white menu_utama_btn_edit"><i class="fas fa-edit"></i></button> |
                            <button data-id="{{ $menu_utama->id }}" class="border-0 bg-white menu_utama_btn_delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5"></div>
            {{-- <h6 class="text-uppercase text-center">Menu Tombol</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button id="menu_button_btn_create" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <table id="table_dua" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Menu Utama</th>
                        <th>Menu Sub</th>
                        <th>Nama Tombol</th>
                        <th>Link</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu_btns as $key => $menu_btn)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $menu_btn->menu_utama_id }}</td>
                        <td>{{ $menu_btn->menu_sub_id }}</td>
                        <td>{{ $menu_btn->nama_button }}</td>
                        <td>{{ $menu_btn->link }}</td>
                        <td class="text-center">
                            <a href="{{ route('menu.edit', [$menu_btn->id]) }}"><i class="fas fa-edit"></i></a> |
                            <a href="{{ route('menu.edit', [$menu_btn->id]) }}"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>
        <div class="col-md-6">
            <h6 class="text-uppercase text-center">Menu Sub</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button id="menu_sub_btn_create" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <table id="table_tiga" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Menu Utama</th>
                        <th>Link</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu_subs as $key => $menu_sub)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $menu_sub->nama_menu }}</td>
                        <td>{{ $menu_sub->menuUtama->nama_menu }}</td>
                        <td>{{ $menu_sub->link }}</td>
                        <td class="text-center">
                            <button data-id="{{ $menu_sub->id }}" class="border-0 bg-white menu_sub_btn_edit"><i class="fas fa-edit"></i></button> |
                            <button data-id="{{ $menu_sub->id }}" class="border-0 bg-white menu_sub_btn_delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- menu utama modal create  --}}
<div class="modal fade" tabindex="-1" id="menu_utama_modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Utama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_utama_form_create">
                    <div class="mb-3">
                      <label for="menu_utama_create_nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="menu_utama_create_nama_menu" name="menu_utama_create_nama_menu">
                    </div>
                    <div class="mb-3">
                      <label for="menu_utama_create_link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="menu_utama_create_link" name="menu_utama_create_link">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- menu utama modal edit  --}}
<div class="modal fade" tabindex="-1" id="menu_utama_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Menu Utama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_utama_form_edit">
                    <input type="hidden" class="form-control" id="menu_utama_edit_id" name="menu_utama_edit_id">
                    <div class="mb-3">
                      <label for="menu_utama_edit_nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="menu_utama_edit_nama_menu" name="menu_utama_edit_nama_menu">
                    </div>
                    <div class="mb-3">
                      <label for="menu_utama_edit_link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="menu_utama_edit_link" name="menu_utama_edit_link">
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- menu utama modal delete  --}}
<div class="modal fade" tabindex="-1" id="menu_utama_modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="menu_utama_form_delete">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="menu_utama_title_delete text-decoration-underline"></span> ?</h5>
                </div>
                <input type="hidden" class="form-control" id="menu_utama_delete_id" name="menu_utama_delete_id">
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal" style="width: 100px;">Tidak</button>
                    <button type="submit" class="btn btn-primary text-center" style="width: 100px;">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- menu sub modal create  --}}
<div class="modal fade" tabindex="-1" id="menu_sub_modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Sub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_sub_form_create">
                    <div class="mb-3">
                        <label for="menu_sub_create_nama_menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="menu_sub_create_nama_menu" name="menu_sub_create_nama_menu">
                    </div>
                    <div class="mb-3">
                        <label for="menu_sub_create_link" class="form-label">Link</label>
                        <input type="text" class="form-control" id="menu_sub_create_link" name="menu_sub_create_link">
                    </div>
                    <div class="mb-3">
                        <label for="menu_sub_create_menu_utama_id" class="form-label">Menu Utama</label>
                        <div class="menu_sub_create_menu_utama_id"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- menu sub modal edit  --}}
<div class="modal fade" tabindex="-1" id="menu_sub_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Menu Sub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_sub_form_edit">
                    <input type="hidden" class="form-control" id="menu_sub_edit_id" name="menu_sub_edit_id">
                    <div class="mb-3">
                      <label for="menu_sub_edit_nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="menu_sub_edit_nama_menu" name="menu_sub_edit_nama_menu">
                    </div>
                    <div class="mb-3">
                      <label for="menu_sub_edit_link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="menu_sub_edit_link" name="menu_sub_edit_link">
                    </div>
                    <div class="mb-3">
                      <label for="menu_sub_edit_menu_utam_id" class="form-label">Menu Utama</label>
                      <div class="menu_sub_edit_menu_utama_id"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- menu sub modal delete --}}
<div class="modal fade" tabindex="-1" id="menu_sub_modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="menu_sub_form_delete">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="menu_sub_title_delete text-decoration-underline"></span> ?</h5>
                </div>
                <input type="hidden" class="form-control" id="menu_sub_delete_id" name="menu_sub_delete_id">
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
        $('#table_tiga').DataTable({
            "ordering": false
        });

        $('#menu_utama_btn_create').on('click', function() {
            $('#menu_utama_modal_create').modal('show');
        });

        $('#menu_utama_form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                nama_menu: $('#menu_utama_create_nama_menu').val(),
                link: $('#menu_utama_create_link').val(),
                button: 'menu_utama_btn_store',
                _token: CSRF_TOKEN
            };

            $.ajax({
                url: '{{ URL::route('menu.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.menu_utama_btn_edit').on('click', function(e) {
            e.preventDefault();

            var formData = {
                id: $(this).attr('data-id'),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.edit.menu_utama') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#menu_utama_edit_id').val(response.id);
                    $('#menu_utama_edit_nama_menu').val(response.nama_menu);
                    $('#menu_utama_edit_link').val(response.link);
                    $('#menu_utama_modal_edit').modal('show');
                }
            });

        });

        $('#menu_utama_form_edit').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#menu_utama_edit_id').val(),
                nama_menu: $('#menu_utama_edit_nama_menu').val(),
                link: $('#menu_utama_edit_link').val(),
                button: "menu_utama_btn_update",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.update') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.menu_utama_btn_delete').on('click', function() {

            $('.menu_utama_title_delete').empty();
            var formData = {
                id: $(this).attr('data-id'),
                button: "menu_utama_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.delete.btn') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#menu_utama_delete_id').val(response.id);
                    $('.menu_utama_title_delete').append(response.value);
                    $('#menu_utama_modal_delete').modal('show');
                }
            });
        });

        $('#menu_utama_form_delete').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#menu_utama_delete_id').val(),
                button: "menu_utama_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.delete') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('#menu_sub_btn_create').on('click', function() {
            $('.menu_sub_create_menu_utama_id').empty();

            $.ajax({
                url: '{{ URL::route('menu.create.menu_sub') }}',
                type: 'GET',
                success: function(response) {

                    var val = "<select class=\"form-control\" id=\"menu_sub_create_menu_utama_id\" name=\"menu_sub_create_menu_utama_id\">" +
                        "<option value=\"\">--Pilih Menu Utama--</option>";

                    $.each(response.menu_utama, function(index, value) {
                        val += "<option value=\"" + value.id + "\">"+ value.nama_menu +"</option>";
                    });

                    val += "</select>";

                    $('.menu_sub_create_menu_utama_id').append(val);
                    $('#menu_sub_modal_create').modal('show');
                }
            });
        });

        $('#menu_sub_form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                nama_menu: $('#menu_sub_create_nama_menu').val(),
                link: $('#menu_sub_create_link').val(),
                menu_utama_id: $('#menu_sub_create_menu_utama_id').val(),
                button: "menu_sub_btn_store",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.menu_sub_btn_edit').on('click', function() {
            $('.menu_sub_edit_menu_utama_id').empty();

            var formData = {
                id: $(this).attr('data-id'),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.edit.menu_sub') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#menu_sub_edit_id').val(response.id);
                    $('#menu_sub_edit_nama_menu').val(response.nama_menu);
                    $('#menu_sub_edit_link').val(response.link);

                    var val = "<select class=\"form-control\" id=\"menu_sub_edit_menu_utama_id\" name=\"menu_sub_edit_menu_utama_id\">" +
                        "<option value=\"\">--Pilih Menu Utama--</option>";

                    $.each(response.menu_utama, function(index, value) {
                        val += "<option value=\"" + value.id + "\"";
                        if (response.menu_utama_id == value.id) {
                            val += "selected";
                        }
                        val += ">"+ value.nama_menu +"</option>";
                    });

                    val += "</select>";

                    $('.menu_sub_edit_menu_utama_id').append(val);
                    $('#menu_sub_modal_edit').modal('show');
                }
            });
        });

        $('#menu_sub_form_edit').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#menu_sub_edit_id').val(),
                nama_menu: $('#menu_sub_edit_nama_menu').val(),
                link: $('#menu_sub_edit_link').val(),
                menu_utama_id: $('#menu_sub_edit_menu_utama_id').val(),
                button: "menu_sub_btn_update",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.update') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.menu_sub_btn_delete').on('click', function() {
            $('.menu_sub_title_delete').empty();

            var formData = {
                id: $(this).attr('data-id'),
                button: "menu_sub_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.delete.btn') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#menu_sub_delete_id').val(response.id);
                    $('.menu_sub_title_delete').append(response.value);
                    $('#menu_sub_modal_delete').modal('show');
                }
            })
        });

        $('#menu_sub_form_delete').submit( function(e) {
            e.preventDefault();

            var formData = {
                id: $('#menu_sub_delete_id').val(),
                button: "menu_sub_btn_delete",
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('menu.delete') }}',
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
