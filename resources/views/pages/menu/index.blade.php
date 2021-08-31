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
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-6">
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
                    {{-- @foreach ($kertas as $key => $kertas) --}}
                    <tr>
                        <td>1</td>
                        <td>Dashboard</td>
                        <td>/dashboard</td>
                        <td class="text-center">
                            <a href="#"><i class="fas fa-edit"></i></a> |
                            <a href="#"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
            <div class="mt-5"></div>
            <table id="table_dua" class="table table-bordered" style="width:100%">
                <thead>
                    <tr class="text-center bg-secondary text-white">
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Link</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($kertas as $key => $kertas) --}}
                    <tr>
                        <td>1</td>
                        <td>Dashboard</td>
                        <td>/dashboard</td>
                        <td><a href="#"><i class="fas fa-edit"></i></a></td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
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
                    {{-- @foreach ($kertas as $key => $kertas) --}}
                    <tr>
                        <td>1</td>
                        <td>Dashboard</td>
                        <td>/dashboard</td>
                        <td><a href="#"><i class="fas fa-edit"></i></a></td>
                    </tr>
                    {{-- @endforeach --}}
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
        $('#table_satu').DataTable({
            "ordering": false
        });
        $('#table_dua').DataTable({
            "ordering": false
        });
        $('#table_tiga').DataTable({
            "ordering": false
        });
    } );
</script>
@endsection
