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
                    <a href="{{ route('pekerjaan.create') }}" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></a>
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
                        <td>{{ $pesanan->masterCabang->nama_cabang }}</td>
                        <td>{{ $pesanan->nama_pesanan }}</td>
                        <td>{{ $pesanan->rencana_jadi }}</td>
                        <td>{{ $pesanan->pegawaiPenerimaPesanan->nama_lengkap }}</td>
                        <td class="text-center">
                            <a href="{{ route('pekerjaan.edit', [$pesanan->id]) }}" class="border-0 bg-white text-dark"><i class="fas fa-edit"></i></a> |
                            <form action="{{ route('pekerjaan.destroy', [$pesanan->id]) }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="border-0 bg-white" onclick="return confirm('Yakin akan dihapus?')">
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
