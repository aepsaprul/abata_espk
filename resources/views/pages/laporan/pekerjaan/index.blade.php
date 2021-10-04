@extends('layouts.app')

@section('style')
<link href="{{ asset('lib/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

<style>
    .col-md-12 {
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
        <div class="col-md-12">
            <h6 class="text-uppercase text-center">Data Laporan</h6>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-filter"></i> Filter
                </div>
                <div class="card-body">
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
                                    <label for="tanggal_akhir" class="form-label">Sampai</label>
                                    <input type="date" class="form-control form-control-sm" id="tanggal_akhir" name="tanggal_akhir">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="pelanggan_id" class="form-label">Pelanggan</label>
                                    <select id="pelanggan_id" class="form-select form-select-sm" name="pelanggan_id">
                                        <option value="">-- Pilih Pelanggan --</option>
                                        @foreach ($pelanggans as $pelanggan)
                                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="nama_pesanan" class="form-label">Nama Pesanan</label>
                                    <input type="text" class="form-control form-control-sm" id="nama_pesanan" name="nama_pesanan">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="cabang_pemesan_id" class="form-label">Cabang Pemesan</label>
                                    <select id="cabang_pemesan_id" class="form-select form-select-sm" name="cabang_pemesan_id">
                                        <option value="">-- Pilih Cabang Pemesan --</option>
                                        @foreach ($cabangs as $cabang)
                                            <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="cabang_pelaksana_id" class="form-label">Cabang Pelaksana</label>
                                    <select id="cabang_pelaksana_id" class="form-select form-select-sm" name="cabang_pelaksana_id">
                                        <option value="">-- Pilih Cabang Pelaksana --</option>
                                        @foreach ($cabangs as $cabang)
                                            <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status_id" class="form-label">Status Pekerjaan</label>
                                    <select id="status_id" class="form-select form-select-sm" name="status_id">
                                        <option value="">-- Pilih Status --</option>
                                        @foreach ($status as $status)
                                            <option value="{{ $status->id }}">{{ $status->nama_status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn_cari btn-sm" style="width: 100px;">Cari</button>
                        <button type="button" class="btn btn-primary btn_reset btn-sm mx-3" style="width: 100px;">Reset</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-list"></i> Data Laporan
                </div>
                <div class="card-body">
                    <table class="table table-bordered yajra-datatable">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white text-center fw-bold">No</th>
                                <th class="text-white text-center fw-bold">Pemesan</th>
                                <th class="text-white text-center fw-bold">Nama Pekerjaan</th>
                                <th class="text-white text-center fw-bold">No Nota</th>
                                <th class="text-white text-center fw-bold">Tanggal Order</th>
                                <th class="text-white text-center fw-bold">Rencana Jadi</th>
                                <th class="text-white text-center fw-bold">Pelaksana</th>
                                <th class="text-white text-center fw-bold">Status</th>
                                <th class="text-white text-center fw-bold">Tanggal Selesai</th>
                                <th class="text-white text-center fw-bold">Penerima Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
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

        $('.btn_cari').on('click', function() {
            var tanggal_awal = $('#tanggal_awal').val();
            var tanggal_akhir = $('#tanggal_akhir').val();

            if (tanggal_awal == "" || tanggal_akhir == "") {
                alert('tanggal harap diisi terlebih dahulu');
            } else {
                $('.yajra-datatable').DataTable().draw(true);
            }
        });

        $('.btn_reset').on('click', function() {
            $('#tanggal_awal').val("");
            $('#tanggal_akhir').val("");
            $('#pelanggan_id').val("");
            $('#nama_pesanan').val("");
            $('#cabang_pemesan_id').val("");
            $('#cabang_pelaksana_id').val("");
        })

        $(function () {
            var table = $('.yajra-datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdf'
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('laporan.get_data_pekerjaan') }}",
                    data: function (d) {
                        d.tanggal_awal = $('#tanggal_awal').val(),
                        d.tanggal_akhir = $('#tanggal_akhir').val(),
                        d.pelanggan_id = $('#pelanggan_id').val(),
                        d.nama_pesanan = $('#nama_pesanan').val(),
                        d.cabang_pemesan_id = $('#cabang_pemesan_id').val(),
                        d.cabang_pelaksana_id = $('#cabang_pelaksana_id').val(),
                        d.status_id = $('#status_id').val()
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'cabangPemesan', name: 'cabangPemesan.nama_cabang'},
                    {data: 'nama_pesanan', name: 'nama_pesanan'},
                    {data: 'nomor_nota', name: 'nomor_nota'},
                    {data: 'tanggal_pesanan', name: 'tanggal_pesanan'},
                    {data: 'rencana_jadi', name: 'rencana_jadi'},
                    {data: 'cabangPelaksana', name: 'cabangPelaksana.nama_cabang'},
                    {data: 'status', name: 'status.nama_status'},
                    {data: 'tanggal_selesai', name: 'tanggal_selesai'},
                    {data: 'pegawaiPenerimaPesanan', name: 'pegawaiPenerimaPesanan.nama_panggilan'},
                ],
                'columnDefs': [
                    {
                        "targets": 0, // your case first column
                        "className": "text-center",
                        "width": "4%"
                    },
                    {
                        "targets": 3,
                        "className": "text-center",
                    }
                ]
            });
        });

        $('body').on('click', '.lihat', function () {
            // alert($(this).attr('data-id'));

            var id = $(this).attr('data-id');
            var url = '{{ route("proses_pekerjaan.show", ":id") }}';
            url = url.replace(':id', id );

            var id = $(this).attr('data-id');
            window.open(url, '_blank');
        });
    } );
</script>
@endsection
