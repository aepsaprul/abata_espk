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
                    <a href="#" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></a>
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
                    <a href="#" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></a>
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
                    <a href="#" class="mb-4 btn btn-outline-primary"><i class="fas fa-plus"></i></a>
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
