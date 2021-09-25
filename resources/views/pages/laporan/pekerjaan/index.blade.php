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
            <h6 class="text-uppercase text-center">Data Laporan</h6>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-12 mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="tanggal_awal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control form-control-sm" id="tanggal_awal" name="tanggal_awal">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="sampai" class="form-label">Sampai</label>
                            <input type="date" class="form-control form-control-sm" id="sampai" name="sampai">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="pelanggan" class="form-label">Pelanggan</label>
                            <select id="pelanggan" class="form-select form-select-sm" name="pelanggan">
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control form-control-sm" id="judul" name="judul">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="cabang_pemesan" class="form-label">Cabang Pemesan</label>
                            <select id="cabang_pemasan" class="form-select form-select-sm" name="cabang_pemasan">
                                <option value="">-- Pilih Cabang Pemesan --</option>
                                @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="cabang_pelaksana" class="form-label">Cabang Pelaksana</label>
                            <select id="cabang_pelaksan" class="form-select form-select-sm" name="cabang_pelaksan">
                                <option value="">-- Pilih Cabang Pelaksana --</option>
                                @foreach ($cabangs as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="status_pekerjaan" class="form-label">Status Pekerjaan</label>
                            <select id="status_pekerjaan" class="form-select form-select-sm" name="status_pekerjaan">
                                <option value="">-- Pilih Status --</option>
                                @foreach ($status as $status)
                                    <option value="{{ $status->id }}">{{ $status->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <table id="table_satu" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Pemesan</th>
                        <th>Nama Pekerjaan</th>
                        <th>No Nota</th>
                        <th>Rencana Jadi</th>
                        <th>Pelaksana</th>
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
                        <td>{{ $pekerjaan->cabangPelaksana->nama_cabang }}</td>
                        <td>{{ $pekerjaan->status->nama_status }}</td>
                        <td class="text-center">
                            <button data-id="{{ $pekerjaan->id }}" class="border-0 bg-white btn_edit" title="Ubah">
                                <span class="border border-primary border-1 px-2 py-1"><i class="fas fa-edit"></i></span>
                            </button> |
                            <button data-id="{{ $pekerjaan->id }}" class="border-0 bg-white btn_delete" title="Hapus">
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
{{-- <div class="modal fade" tabindex="-1" id="modal_create">
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
</div> --}}

{{-- modal edit  --}}
{{-- <div class="modal fade" tabindex="-1" id="modal_edit">
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
</div> --}}

{{-- modal delete  --}}
{{-- <div class="modal fade" tabindex="-1" id="modal_delete">
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
    } );
</script>
@endsection
