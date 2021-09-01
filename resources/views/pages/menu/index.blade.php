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
                    <button id="menu_utama_btn_add" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></button>
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
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $menu_utama->nama_menu }}</td>
                        <td>{{ $menu_utama->link }}</td>
                        <td class="text-center">
                            <a href="{{ route('menu.edit', [$menu_utama->id]) }}"><i class="fas fa-edit"></i></a> |
                            <a href="{{ route('menu.edit', [$menu_utama->id]) }}"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5"></div>
            <h6 class="text-uppercase text-center">Menu Tombol</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button id="menu_button_btn_add" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></button>
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
            </table>
        </div>
        <div class="col-md-6">
            <h6 class="text-uppercase text-center">Menu Sub</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button id="menu_sub_btn_add" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <table id="table_tiga" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Link</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu_subs as $key => $menu_sub)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $menu_sub->nama_menu }}</td>
                        <td>{{ $menu_sub->link }}</td>
                        <td class="text-center">
                            <a href="{{ route('menu.edit', [$menu_sub->id]) }}"><i class="fas fa-edit"></i></a> |
                            <a href="{{ route('menu.edit', [$menu_sub->id]) }}"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- menu utama modal add  --}}
<div class="modal fade" tabindex="-1" id="menu_utama_modal_add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Utama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_utama_form_add">
                    <div class="mb-3">
                      <label for="menu_utama_nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="menu_utama_nama_menu" name="menu_utama_nama_menu">
                    </div>
                    <div class="mb-3">
                      <label for="menu_utama_link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="menu_utama_link" name="menu_utama_link">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- menu utama modal edit  --}}
{{-- <div class="modal fade" tabindex="-1" id="menu_utama_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Menu Utama</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_utama_form_edit">
                    <div class="mb-3">
                      <label for="nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="nama_menu" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="link">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- menu sub modal add  --}}
{{-- <div class="modal fade" tabindex="-1" id="menu_sub_modal_add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Sub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_sub_form_add">
                    <div class="mb-3">
                      <label for="nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="nama_menu" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="link">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- menu sub modal edit  --}}
{{-- <div class="modal fade" tabindex="-1" id="menu_sub_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Menu Sub</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_sub_form_edit">
                    <div class="mb-3">
                      <label for="nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="nama_menu" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="link">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- menu button modal add  --}}
{{-- <div class="modal fade" tabindex="-1" id="menu_tombol_modal_add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Tombol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_tombol_form_add">
                    <div class="mb-3">
                      <label for="nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="nama_menu" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="link">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- menu button modal edit  --}}
{{-- <div class="modal fade" tabindex="-1" id="menu_tombol_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Menu Tombol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="menu_tombol_form_edit">
                    <div class="mb-3">
                      <label for="nama_menu" class="form-label">Nama Menu</label>
                      <input type="text" class="form-control" id="nama_menu" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                      <label for="link" class="form-label">Link</label>
                      <input type="text" class="form-control" id="link">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}
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

        $('#menu_utama_btn_add').on('click', function() {
            $('#menu_utama_modal_add').modal('show');
        });

        $('#menu_utama_form_add').submit(function(e) {
            e.preventDefault();

            var formData = {
                nama_menu: $('#menu_utama_nama_menu').val(),
                link: $('#menu_utama_link').val(),
                button: 'menu_utama_btn_add',
                _token: CSRF_TOKEN
            };

            $.ajax({
                url: '{{ URL::route('menu.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                }
            });
        });
        // $('#menu_utama_btn_add').on('click', function() {
        //     $('#menu_utama_modal_add').modal('show');
        // });

        // $('#menu_utama_btn_add').on('click', function() {
        //     $('#menu_utama_modal_add').modal('show');
        // });
        // $('#menu_utama_btn_add').on('click', function() {
        //     $('#menu_utama_modal_add').modal('show');
        // });
        // $('#menu_utama_btn_add').on('click', function() {
        //     $('#menu_utama_modal_add').modal('show');
        // });
        // $('#menu_utama_btn_add').on('click', function() {
        //     $('#menu_utama_modal_add').modal('show');
        // });
    } );
</script>
@endsection
