@extends('layouts.app')

@section('style')
<link href="{{ asset('lib/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

<style>
    .col-md-10 {
        font-size: 14px;
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
            <h6 class="text-uppercase text-center">Data Pekerjaan</h6>
            <div style="height: 50px;">
            @if (session('status'))
                <div class="text-success fst-italic">
                    {{ session('status') }}
                </div>
            @endif
            </div>

            {{-- tabel pesanan  --}}
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-th-list"></i> Daftar Pekerjaan
                </div>
                <div class="card-body">
                    <table id="table_satu" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr class="text-center bg-secondary text-white">
                                <th>No</th>
                                <th>Pemesan</th>
                                <th>Nama Pesanan</th>
                                <th>No Nota</th>
                                <th>Rencana Jadi</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pekerjaans as $key => $pekerjaan)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $pekerjaan->cabangPemesan->nama_cabang }}</td>
                                <td>{{ $pekerjaan->nama_pesanan }}</td>
                                <td>{{ $pekerjaan->nomor_nota }}</td>
                                <td>{{ $pekerjaan->rencana_jadi }}</td>
                                <td></td>
                                <td class="text-center">
                                    <button class="border-0 bg-white text-dark mx-1 publish" data-id="{{ $pekerjaan->id }}" title="Publish"><i class="fas fa-rocket"></i></button> |
                                    <a href="{{ route('pekerjaan.edit', [$pekerjaan->id]) }}" class="border-0 bg-white text-dark mx-2" title="Ubah"><i class="fas fa-edit"></i></a> |
                                    <form action="{{ route('pekerjaan.destroy', [$pekerjaan->id]) }}" method="POST" class="d-inline">
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

            {{-- tabel pekerjaan  --}}
            <div class="card mt-5">
                <div class="card-header">
                    <i class="fas fa-th-list"></i> Daftar Pesanan
                </div>
                <div class="card-body">
                    <table id="table_dua" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr class="text-center bg-secondary text-white">
                                <th>No</th>
                                <th>Pelaksana</th>
                                <th>Nama Pekerjaan</th>
                                <th>No Nota</th>
                                <th>Rencana Jadi</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanans as $key => $pesanan)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $pesanan->cabangPelaksana->nama_cabang }}</td>
                                <td>{{ $pesanan->nama_pesanan }}</td>
                                <td>{{ $pesanan->nomor_nota }}</td>
                                <td>{{ $pesanan->rencana_jadi }}</td>
                                <td></td>
                                <td class="text-center">
                                    <button class="border-0 bg-white text-dark mx-1 publish" data-id="{{ $pesanan->id }}" title="Publish"><i class="fas fa-rocket"></i></button> |
                                    <a href="{{ route('pesanan.edit', [$pesanan->id]) }}" class="border-0 bg-white text-dark mx-2" title="Ubah"><i class="fas fa-edit"></i></a> |
                                    <form action="{{ route('pesanan.destroy', [$pesanan->id]) }}" method="POST" class="d-inline">
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

        $('#table_dua').DataTable({
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
