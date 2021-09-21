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
                                <td>
                                    @if ($pesanan->status_id != null)
                                        {{ $pesanan->status->nama_status }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="Aksi">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="border-bottom"><a class="dropdown-item" href="#">Download</a></li>
                                            <li><a class="dropdown-item status" href="#" data-pesanan="{{ $pesanan->nama_pesanan }}" data-id="{{ $pesanan->id }}">Status</a></li>
                                        </ul>
                                      </div> |
                                    <a href="#" class="border-0 bg-white text-dark mx-2" title="Lihat"><i class="fas fa-eye"></i></a> |
                                    <a href="#" class="text-dark mx-2" title="Print"><i class="fas fa-print"></i></a>
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
<div class="modal fade" tabindex="-1" id="modal_ubah_status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Publish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_ubah_status">
                    <input type="hidden" class="form-control" id="modal_id" name="modal_id">
                    <div class="mb-3">
                        <label for="modal_pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" id="modal_pekerjaan" name="modal_pekerjaan" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="modal_status" class="form-label">Status</label>
                        <select class="form-control modal_status" id="modal_status" name="modal_status" required>
                            <option value="">--Pilih Status--</option>
                            <option value="2">Dibatalkan</option>
                            <option value="1">Disetujui</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modal_keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control modal_keterangan" id="modal_keterangan" name="modal_keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> --}}
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

        $('.status').on('click', function() {
            $('#modal_keterangan').val("");
            $('#modal_id').val($(this).attr('data-id'));
            $('#modal_pekerjaan').val($(this).attr('data-pesanan'));
            $('#modal_ubah_status').modal('show');
        });

        $('#modal_status').on('change', function() {
            if($('#modal_status').val() == 2) {
                $('#modal_keterangan').prop('required', true);
            } else {
                $('#modal_keterangan').prop('required', false);
            }
        });

        $('#form_ubah_status').submit(function(e) {
            e.preventDefault();

            var formData = {
                id: $('#modal_id').val(),
                status_id: $('#modal_status').val(),
                keterangan: $('#modal_keterangan').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('proses_pekerjaan.update_pesanan') }}',
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
