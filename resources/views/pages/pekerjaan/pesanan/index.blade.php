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
            <h6 class="text-uppercase text-center">Data Pesanan</h6>
            <div style="height: 50px;">
            @if (session('status'))
                <div class="text-success fst-italic">
                    {{ session('status') }}
                </div>
            @endif
            </div>
            <div class="row mb-2">
                <div class="col-md-4">
                    <a href="{{ route('pekerjaan.create') }}" class="mb-4 btn btn-outline-primary" title="Tambah"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <table id="table_satu" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Pemesan</th>
                        <th>Nama Pesanan</th>
                        <th>Rencana Jadi</th>
                        <th>Penerima</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $key => $pesanan)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $pesanan->cabangPemesan->nama_cabang }}</td>
                        <td>{{ $pesanan->nama_pesanan }}</td>
                        <td>{{ $pesanan->rencana_jadi }}</td>
                        <td>{{ $pesanan->pegawaiPenerimaPesanan->nama_lengkap }}</td>
                        <td class="text-center">
                            <button class="border-0 bg-white text-dark mx-1 publish" data-id="{{ $pesanan->id }}" title="Publish"><i class="fas fa-rocket"></i></button> |
                            <a href="{{ route('pekerjaan.edit', [$pesanan->id]) }}" class="border-0 bg-white text-dark mx-2" title="Ubah"><i class="fas fa-edit"></i></a> |
                            <form action="{{ route('pekerjaan.destroy', [$pesanan->id]) }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="border-0 bg-white" onclick="return confirm('Yakin akan dihapus?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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

        $('.publish').on('click', function() {
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
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 100);
                }
            });
        });
    } );
</script>
@endsection
