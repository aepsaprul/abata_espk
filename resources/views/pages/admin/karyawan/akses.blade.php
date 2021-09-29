@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form action="{{ route('karyawan.akses_simpan', [$karyawan->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <span class="text-uppercase">Akses Menu {{ $karyawan->nama_lengkap }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-secondary">
                                <tr>
                                    <th class="text-light text-center">Menu Utama</th>
                                    <th class="text-light text-center">Menu Sub</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($menu_utamas as $menu_utama)
                                @if ($menu_utama->subMenu->isEmpty())
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="menu_utama[]" data-id="{{ $menu_utama->id }}" id="menu_utama_{{ $menu_utama->id }}" value="{{ $menu_utama->id }}"
                                                @foreach ($karyawan_menu_utamas as $karyawan_menu_utama)
                                                    @if ($karyawan_menu_utama->menu_utama_id == $menu_utama->id)
                                                        checked
                                                    @endif
                                                @endforeach
                                                >
                                                <label class="form-check-label" for="menu_utama_{{ $menu_utama->id }}">
                                                    {{ $menu_utama->nama_menu }}
                                                </label>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="menu_utama[]" data-id="{{ $menu_utama->id }}" id="menu_utama_{{ $menu_utama->id }}" value="{{ $menu_utama->id }}"
                                                @foreach ($karyawan_menu_utamas as $karyawan_menu_utama)
                                                    @if ($karyawan_menu_utama->menu_utama_id == $menu_utama->id)
                                                        checked
                                                    @endif
                                                @endforeach
                                                >
                                                <label class="form-check-label" for="menu_utama_{{ $menu_utama->id }}">
                                                    {{ $menu_utama->nama_menu }}
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach ($menu_utama->subMenu as $menu_sub)
                                                    <li class="list-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="menu_sub[]" data-main="{{ $menu_sub->menu_utama_id }}" id="menu_sub_{{ $menu_sub->id }}" value="{{ $menu_sub->id }}"
                                                            @foreach ($karyawan_menu_subs as $karyawan_menu_sub)
                                                                @if ($karyawan_menu_sub->menu_sub_id == $menu_sub->id)
                                                                    checked
                                                                @endif
                                                            @endforeach
                                                            >
                                                            <label class="form-check-label" for="menu_sub_{{ $menu_sub->id }}">
                                                                {{ $menu_sub->nama_menu }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn_cari btn-sm" style="width: 100px;">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // $('input[name="menu_sub[]"]').prop('disabled', true);

        $('input[name="menu_utama[]"]').on('change', function() {
            var id = $(this).attr('data-id');
            if ($('#menu_utama_' + id).is(":checked")) {
                $('input[data-main="'+ id +'"]').prop('disabled', false);
            } else {
                $('input[data-main="'+ id +'"]').prop('disabled', true);
            }
        });
    });
</script>
@endsection
