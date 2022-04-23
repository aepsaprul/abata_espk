@extends('layouts.app')

@section('style')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Pesanan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{ $cabang->masterCabang->nama_cabang }}
                            </h3>
                            <div class="card-tools mr-0">
                                <a href="{{ route('pekerjaan.index') }}" class="btn bg-gradient-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form id="form-digital-print" action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Formulir {{ $cabang->form_group == "offset" ? 'Offset' : 'Digital Print' }}
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            {{-- forumulir offset --}}
                                            @if ($cabang->form_group == "offset")
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pelanggan_id">Pelanggan</label>
                                                            <select name="pelanggan_id" id="pelanggan_id" class="form-control form-control-sm" required>
                                                                <option value="">--Pilih Pelanggan--</option>
                                                                @foreach ($pelanggans as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="nama_pesanan">Nama Pesanan</label>
                                                            <input type="text" id="nama_pesanan" name="nama_pesanan" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="nomor_nota">Nomor Nota</label>
                                                            <input type="text" id="nomor_nota" name="nomor_nota" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                                            <input type="date" id="tanggal_pesanan" name="tanggal_pesanan" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="rencana_jadi">Rencana Jadi</label>
                                                            <input type="date" id="rencana_jadi" name="rencana_jadi" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="jenis_pesanan">Jenis Produk</label>
                                                            <input type="text" id="jenis_pesanan" name="jenis_pesanan" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="jumlah_cetak">Jumlah Cetak</label>
                                                            <input type="text" id="jumlah_cetak" name="jumlah_cetak" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="ukuran">Ukuran</label>
                                                            <input type="text" id="ukuran" name="ukuran" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="jenis_kertas">Jenis Kertas</label>
                                                            <input type="text" id="jenis_kertas" name="jenis_kertas" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="warna">Warna Tinta</label>
                                                            <input type="text" id="warna" name="warna" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" id="keterangan" name="keterangan" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pegawai_penerima_pesanan_id">Penerima Pesanan</label>
                                                            <select class="form-control form-control-sm" name="pegawai_penerima_pesanan_id" required>
                                                                @foreach ($penerima_pesanans as $penerima_pesanan)
                                                                    <option value="{{ $penerima_pesanan->id }}">{{ $penerima_pesanan->nama_lengkap }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pegawai_desain_id">Desain</label>
                                                            <select class="form-control form-control-sm" name="pegawai_desain_id">
                                                                @foreach ($desains as $desain)
                                                                    <option value="{{ $desain->id }}">{{ $desain->nama_lengkap }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="cabang_cetak_id">Cetak</label>
                                                        <select class="form-control form-control-sm" name="cabang_cetak_id">
                                                            @foreach ($cabang_cetaks as $cabang_cetak)
                                                                <option value="{{ $cabang_cetak->id }}" {{ $cabang_cetak->id == Auth::user()->masterKaryawan->masterCabang->id ? 'hidden' : '' }}>{{ $cabang_cetak->nama_cabang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="cabang_finishing_id">Finishing</label>
                                                        <select class="form-control form-control-sm" name="cabang_finishing_id">
                                                            <option value="">--Tanpa Finishing--</option>
                                                            @foreach ($cabang_finishings as $cabang_finishing)
                                                                <option value="{{ $cabang_finishing->id }}">{{ $cabang_finishing->nama_cabang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="desain">File</label>
                                                        <input class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" type="file" name="file" required>
                                                        @error('file')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            {{-- forumulir digital print --}}
                                            @else
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pelanggan_id">Pelanggan</label>
                                                            <select name="pelanggan_id" id="pelanggan_id" class="form-control form-control-sm" required>
                                                                <option value="">--Pilih Pelanggan--</option>
                                                                @foreach ($pelanggans as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="nama_pesanan">Nama Pesanan</label>
                                                            <input type="text" id="nama_pesanan" name="nama_pesanan" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="nomor_nota">Nomor Nota</label>
                                                            <input type="text" id="nomor_nota" name="nomor_nota" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                                            <input type="date" id="tanggal_pesanan" name="tanggal_pesanan" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="rencana_jadi">Rencana Jadi</label>
                                                            <input type="date" id="rencana_jadi" name="rencana_jadi" class="form-control form-control-sm" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="jenis_pesanan">Jenis Cetak</label>
                                                            <input type="text" id="jenis_pesanan" name="jenis_pesanan" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="jumlah_cetak">Jumlah Cetak</label>
                                                            <input type="text" id="jumlah_cetak" name="jumlah_cetak" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="ukuran">Ukuran</label>
                                                            <input type="text" id="ukuran" name="ukuran" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="bahan">Bahan</label>
                                                            <input type="text" id="bahan" name="bahan" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="satuan">Satuan</label>
                                                            <input type="text" id="satuan" name="satuan" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="finishing">Finishing</label>
                                                            <input type="text" id="finishing" name="finishing" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="catatan_kasir">Catatan Kasir</label>
                                                            <input type="text" id="catatan_kasir" name="catatan_kasir" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="catatan_produksi">Catatan Produksi</label>
                                                            <input type="text" id="catatan_produksi" name="catatan_produksi" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" id="keterangan" name="keterangan" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pegawai_penerima_pesanan_id">Pemesan</label>
                                                            <select class="form-control form-control-sm" name="pegawai_penerima_pesanan_id" required>
                                                                @foreach ($penerima_pesanans as $penerima_pesanan)
                                                                    <option value="{{ $penerima_pesanan->id }}">{{ $penerima_pesanan->nama_lengkap }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="pegawai_desain_id">Desain</label>
                                                            <select class="form-control form-control-sm" name="pegawai_desain_id">
                                                                @foreach ($desains as $desain)
                                                                    <option value="{{ $desain->id }}">{{ $desain->nama_lengkap }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="cabang_cetak_id">Cabang Cetak</label>
                                                        <select class="form-control form-control-sm" name="cabang_cetak_id">
                                                            @foreach ($cabang_cetaks as $cabang_cetak)
                                                                <option value="{{ $cabang_cetak->id }}" }}>{{ $cabang_cetak->nama_cabang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="cabang_finishing_id">Cabang Finishing</label>
                                                        <select class="form-control form-control-sm" name="cabang_finishing_id">
                                                            <option value="">--Tanpa Finishing--</option>
                                                            @foreach ($cabang_finishings as $cabang_finishing)
                                                                <option value="{{ $cabang_finishing->id }}">{{ $cabang_finishing->nama_cabang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="desain">File</label>
                                                        <input class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" type="file" name="file" required>
                                                        @error('file')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- checkbox --}}
                                    @foreach ($jenis_pekerjaan_groups as $jenis_pekerjaan_group)
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    {{ $jenis_pekerjaan_group->tipePekerjaan->tipe }}
                                                    @php $type = "checkbox"; @endphp
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                @foreach ($jenis_pekerjaans as $jenis_pekerjaan)
                                                    @if ($jenis_pekerjaan->tipe_pekerjaan_id == $jenis_pekerjaan_group->tipe_pekerjaan_id)
                                                        <div class="col-md-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="{{ $type }}" data-id="{{ $jenis_pekerjaan->id }}" id="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_id[]" style="padding: 10px; margin-right: 10px;" value="{{ $jenis_pekerjaan->id }}">
                                                                <label class="form-check-label" for="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}">
                                                                    {{ $jenis_pekerjaan->jenis }}
                                                                </label>
                                                            </div>
                                                            <input type="text" id="jenis_pekerjaan_keterangan_{{ $type }}" class="form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_keterangan[]">
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

@endsection

@section('script')
<!-- Select2 -->
<script src="{{ asset('themes/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
                month = '0' + month.toString();
        if(day < 10)
                day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        // or instead:
        // var maxDate = dtToday.toISOString().substr(0, 10);

        $('#tanggal_pesanan').attr('min', maxDate);
        $('#rencana_jadi').attr('min', maxDate);
    });

    $(document).ready(function() {

        $('.select2-pelanggan').select2();

        $('input[id="jenis_pekerjaan_keterangan_radio"]').prop("disabled", true);
        $('input[id="jenis_pekerjaan_keterangan_checkbox"]').prop("disabled", true);

        $('input[type="radio"]').on('change', function() {
            var id = $(this).attr('data-id');
            $('input[id="jenis_pekerjaan_keterangan_radio"]').prop("disabled", true);
            $('input[id="jenis_pekerjaan_keterangan_radio"]').val("");
            if($('#jenis_pekerjaan_' + id).prop("checked", true)) {
                $('.jenis_pekerjaan_keterangan_' + id).prop("disabled", false);
            }
        });

        $('input[type="checkbox"]').on('change', function() {
            var id = $(this).attr('data-id');
            $('.jenis_pekerjaan_keterangan_' + id).val("");
            if($('#jenis_pekerjaan_' + id).is(":checked")) {
                $('.jenis_pekerjaan_keterangan_' + id).prop("disabled", false);
            } else {
                $('.jenis_pekerjaan_keterangan_' + id).prop("disabled", true);
            }
        });
    });
</script>
@endsection
