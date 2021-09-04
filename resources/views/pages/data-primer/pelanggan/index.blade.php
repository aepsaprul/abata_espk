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
            <h6 class="text-uppercase text-center">Data Pelanggan</h6>
            <div class="row mb-2">
                <div class="col-md-4">
                    <button id="pelanggan_btn_create" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <table id="table_satu" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggans as $key => $pelanggan)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $pelanggan->nama }}</td>
                        <td>{{ $pelanggan->telp }}</td>
                        <td>{{ $pelanggan->alamat }}</td>
                        <td class="text-center">
                            <button data-id="{{ $pelanggan->id }}" class="border-0 bg-white pelanggan_btn_edit"><i class="fas fa-edit"></i></button> |
                            <button data-id="{{ $pelanggan->id }}" class="border-0 bg-white pelanggan_btn_delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- pelanggan modal create  --}}
<div class="modal fade" tabindex="-1" id="pelanggan_modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pelanggan_form_create">
                    <div class="mb-3">
                        <label for="pelanggan_create_nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="pelanggan_create_nama" name="pelanggan_create_nama">
                    </div>
                    <div class="mb-3">
                        <label for="pelanggan_create_telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="pelanggan_create_telp" name="pelanggan_create_telp">
                    </div>
                    <div class="mb-3">
                        <label for="pelanggan_create_alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="pelanggan_create_alamat" name="pelanggan_create_alamat">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- pelanggan modal edit  --}}
<div class="modal fade" tabindex="-1" id="pelanggan_modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pelanggan_form_edit">
                    <input type="hidden" class="form-control" id="pelanggan_edit_id" name="pelanggan_edit_id">
                    <div class="mb-3">
                        <label for="pelanggan_edit_nama" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="pelanggan_edit_nama" name="pelanggan_edit_nama">
                    </div>
                    <div class="mb-3">
                        <label for="pelanggan_edit_telp" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="pelanggan_edit_telp" name="pelanggan_edit_telp">
                    </div>
                    <div class="mb-3">
                        <label for="pelanggan_edit_alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="pelanggan_edit_alamat" name="pelanggan_edit_alamat">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- pelanggan modal delete  --}}
<div class="modal fade" tabindex="-1" id="pelanggan_modal_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="pelanggan_form_delete">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin akan dihapus <span class="pelanggan_title_delete text-decoration-underline"></span> ?</h5>
                </div>
                <input type="hidden" class="form-control" id="pelanggan_delete_id" name="pelanggan_delete_id">
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

        $('#pelanggan_btn_create').on('click', function() {
            $('#pelanggan_modal_create').modal('show');
        });

        $('#pelanggan_form_create').submit(function(e) {
            e.preventDefault();

            var formData = {
                nama: $('#pelanggan_create_nama').val(),
                telp: $('#pelanggan_create_telp').val(),
                alamat: $('#pelanggan_create_alamat').val(),
                _token: CSRF_TOKEN
            };

            $.ajax({
                url: '{{ URL::route('pelanggan.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });

        $('.pelanggan_btn_edit').on('click', function(e) {
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
                    $('#pelanggan_edit_id').val(response.id);
                    $('#pelanggan_edit_nama').val(response.nama);
                    $('#pelanggan_edit_telp').val(response.telp);
                    $('#pelanggan_edit_alamat').val(response.alamat);
                    $('#pelanggan_modal_edit').modal('show');
                }
            });

        });

        $('#pelanggan_form_edit').submit(function(e) {
            e.preventDefault();

            var id = $('#pelanggan_edit_id').val();
            var url = '{{ route("pelanggan.update", ":id") }}';
            url = url.replace(':id', id );

            var formData = {
                id: id,
                nama: $('#pelanggan_edit_nama').val(),
                telp: $('#pelanggan_edit_telp').val(),
                alamat: $('#pelanggan_edit_alamat').val(),
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

        $('.pelanggan_btn_delete').on('click', function() {

            $('.pelanggan_title_delete').empty();

            var id = $(this).attr('data-id');
            var url = '{{ route("pelanggan.delete.btn", ":id") }}';
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
                    $('#pelanggan_delete_id').val(response.id);
                    $('.pelanggan_title_delete').append(response.nama);
                    $('#pelanggan_modal_delete').modal('show');
                }
            });
        });

        $('#pelanggan_form_delete').submit(function(e) {
            e.preventDefault();

            var id = $('#pelanggan_delete_id').val();
            var url = '{{ route("pelanggan.delete", ":id") }}';
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
