@extends('layouts.app')

@section('style')
<link href="{{ asset('lib/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

<style>
    .col-md-11 {
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
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h6 class="text-uppercase text-center">Data Pekerjaan</h6>
            <div style="height: 50px;">
            @if (session('status'))
                <div class="text-success fst-italic">
                    {{ session('status') }}
                </div>
            @endif
            </div>

            {{-- tabel pekerjaan  --}}
            @if (!$pekerjaans->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Daftar Pekerjaan
                    </div>
                    <div class="card-body">
                        <table id="table_satu" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr class="text-center text-light" style="background-color: #004da9;">
                                    <th>No</th>
                                    <th>Pemesan</th>
                                    <th>Nama Pesanan</th>
                                    <th>No Nota</th>
                                    <th>Tanggal Order</th>
                                    <th>Status</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pekerjaans as $key => $pekerjaan)
                                <tr
                                @if ($key % 2 == 1)
                                   echo class="active";
                                @endif
                                >
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $pekerjaan->cabangPemesan->nama_cabang }}</td>
                                    <td>{{ $pekerjaan->nama_pesanan }}</td>
                                    <td>{{ $pekerjaan->nomor_nota }}</td>
                                    <td class="text-center">
                                        @if ($pekerjaan->tanggal_disetujui)
                                            @php
                                                $tanggal_disetujui = explode(" ", $pekerjaan->tanggal_disetujui);
                                            @endphp
                                            {{ tgl_indo($tanggal_disetujui[0]) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pekerjaan->status_id != null)
                                            {{ $pekerjaan->status->nama_status }}
                                            @if ($pekerjaan->status_id == 6 || $pekerjaan->status_id == 7)
                                                @php $hide = "d-none"; @endphp
                                            @else
                                                @php $hide = ""; @endphp
                                            @endif
                                        @else
                                            -
                                            @php $hide = ""; @endphp
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $tanggal_selesai = explode(" ", $pekerjaan->tanggal_selesai);
                                        @endphp
                                        @if ($pekerjaan->tanggal_selesai != null)
                                            {{ tgl_indo($tanggal_selesai[0]) }}
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
                                                <li class="border-bottom">
                                                    @php $modul = explode('/', $pekerjaan->file); @endphp
                                                    <a class="dropdown-item" href="{{ route('pekerjaan.download', [$pekerjaan->file]) }}">Download</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="dropdown-item status {{ $hide }}"
                                                        data-status="{{ $pekerjaan->status_id }}"
                                                        data-pesanan="{{ $pekerjaan->nama_pesanan }}"
                                                        data-id="{{ $pekerjaan->id }}">Status</a>
                                                </li>
                                            </ul>
                                        </div> |
                                        <a href="{{ route('proses_pekerjaan.show', [$pekerjaan->id]) }}"
                                            class="border-0 text-dark mx-2"
                                            title="Lihat"><i class="fas fa-eye"></i></a> |
                                        <a href="{{ route('proses_pekerjaan.print', [$pekerjaan->id]) }}"
                                            class="text-dark mx-2" title="Print"
                                            target="_blank"><i class="fas fa-print"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- tabel pesanan  --}}
            @if (!$pesanans->isEmpty())
                <div class="card mt-2">
                    <div class="card-header">
                        <i class="fas fa-th-list"></i> Daftar Pesanan
                    </div>
                    <div class="card-body">
                        <table id="table_dua" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr class="text-center text-light" style="background-color: #004da9;">
                                    <th>No</th>
                                    <th>Pelaksana</th>
                                    <th>Nama Pekerjaan</th>
                                    <th>No Nota</th>
                                    <th>Tanggal Order</th>
                                    <th>Status</th>
                                    <th>Tanggal Disetujui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanans as $key => $pesanan)
                                <tr
                                @if ($key % 2 == 1)
                                   echo class="active";
                                @endif
                                >
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $pesanan->cabangPelaksana->nama_cabang }}</td>
                                    <td>{{ $pesanan->nama_pesanan }}</td>
                                    <td>{{ $pesanan->nomor_nota }}</td>
                                    <td class="text-center">{{ tgl_indo($pesanan->tanggal_pesanan) }}</td>
                                    <td>
                                        @if ($pesanan->status_id != null)
                                            {{ $pesanan->status->nama_status }}
                                            @if ($pesanan->status_id != null && $pesanan->status_id != 9)
                                                @php $hide = "d-none"; @endphp
                                            @else
                                                @php $hide = ""; @endphp
                                            @endif
                                        @else
                                            -
                                            @php $hide = ""; @endphp
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $tanggal_disetujui = explode(" ", $pesanan->tanggal_disetujui);
                                        @endphp
                                        @if ($pesanan->tanggal_disetujui)
                                            {{ tgl_indo($tanggal_disetujui[0]) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button
                                                type="button"
                                                class="btn btn-default dropdown-toggle"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                title="Aksi">
                                                    <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li class="border-bottom">
                                                    @php $modul = explode('/', $pesanan->file); @endphp
                                                    <a class="dropdown-item" href="{{ route('pekerjaan.download', [$pesanan->file]) }}">Download</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item status {{ $hide }}"
                                                        href="#"
                                                        data-status="{{ $pesanan->status_id }}"
                                                        data-pesanan="{{ $pesanan->nama_pesanan }}"
                                                        data-id="{{ $pesanan->id }}">
                                                            Status
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> |
                                        <a href="{{ route('proses_pekerjaan.show', [$pesanan->id]) }}"
                                            class="border-0 text-dark mx-2"
                                            title="Lihat">
                                            <i class="fas fa-eye"></i></a> |
                                        <a href="{{ route('proses_pekerjaan.print', [$pesanan->id]) }}"
                                            class="text-dark mx-2"
                                            title="Print"
                                            target="_blank"><i class="fas fa-print"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- modal create  --}}
<div class="modal fade" tabindex="-1" id="modal_ubah_status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status</h5>
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

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modal_keterangan" class="form-label">Keterangan <span class="notif-keterangan text-danger fst-italic"></span></label>
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

        $('#table_satu').DataTable();

        $('#table_dua').DataTable();

        $('body').on('click', '.status', function() {
            $('.modal_status').empty();

            $('#modal_keterangan').val("");
            $('#modal_id').val($(this).attr('data-id'));
            $('#modal_pekerjaan').val($(this).attr('data-pesanan'));

            var status_val = "<option value=\"\">--Pilih Status--</option>";

            if ($(this).attr('data-status') == 1) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"3\">Pra Cetak</option>";
            } else if ($(this).attr('data-status') == 3) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"4\">Proses Cetak</option>" +
                    "<option value=\"5\">Proses Finishing</option>";
            } else if ($(this).attr('data-status') == 4) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"5\">Proses Finishing</option>" +
                    "<option value=\"6\">Selesai, Siap Dikirim</option>";
            } else if ($(this).attr('data-status') == 5) {
                status_val += "" +
                    "<option value=\"7\">Dibatalkan</option>" +
                    "<option value=\"6\">Selesai, Siap Dikirim</option>";
            } else {
                status_val += "" +
                    "<option value=\"2\">Dibatalkan</option>" +
                    "<option value=\"8\">Revisi</option>" +
                    "<option value=\"1\">Disetujui</option>";
            }

            $('.modal_status').append(status_val);
            $('#modal_ubah_status').modal('show');
        });

        // $('#modal_status').on('change', function() {
        //     if($('#modal_status').val() == 2 || $('#modal_status').val() == 7) {
        //         $('#modal_keterangan').prop('required', true);
        //     } else {
        //         $('#modal_keterangan').prop('required', false);
        //     }
        // });

        $('#form_ubah_status').submit(function(e) {
            e.preventDefault();
            $('.notif-keterangan').empty();

            if ($('#modal_status').val() == 2 && $('#modal_keterangan').val() == "") {
                $('.notif-keterangan').append("Keterangan harus diisi !!!");
                return false;
            }

            if ($('#modal_status').val() == 7 && $('#modal_keterangan').val() == "") {
                $('.notif-keterangan').append("Keterangan harus diisi !!!");
                return false;
            }

            if ($('#modal_status').val() == 8 && $('#modal_keterangan').val() == "") {
                $('.notif-keterangan').append("Keterangan harus diisi !!!");
                return false;
            }

            var formData = {
                id: $('#modal_id').val(),
                status_id: $('#modal_status').val(),
                keterangan: $('#modal_keterangan').val(),
                _token: CSRF_TOKEN
            }

            $.ajax({
                url: '{{ URL::route('proses_pekerjaan.update_status') }}',
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
