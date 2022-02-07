@extends('layouts.app')

@section('style')

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lihat Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lihat Pesanan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Cabang Pelaksana : <strong>{{ $cabang->masterCabang->nama_cabang }}</strong>
                            </h3>
                            <div class="card-tools mr-0">
                                <a href="{{ route('pekerjaan.index') }}" class="btn bg-gradient-danger btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">

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
                                                    <input disabled type="text" class="form-control form-control-sm" name="pelanggan_id"
                                                        @if ($pekerjaan->pelanggan)
                                                            value="{{ $pekerjaan->pelanggan->nama }}"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nama_pesanan">Nama Pesanan</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="nama_pesanan" value="{{ $pekerjaan->nama_pesanan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nomor_nota">Nomor Nota</label>
                                                    <input disabled type="number" class="form-control form-control-sm" name="nomor_nota" value="{{ $pekerjaan->nomor_nota }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                                    <input disabled type="date" class="form-control form-control-sm" name="tanggal_pesanan" value="{{ $pekerjaan->tanggal_pesanan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="rencana_jadi">Rencana Jadi</label>
                                                    <input disabled type="date" class="form-control form-control-sm" name="rencana_jadi" value="{{ $pekerjaan->rencana_jadi }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jenis_pesanan">Jenis Produk</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="jenis_pesanan" value="{{ $pekerjaan->jenis_pesanan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jumlah_cetak">Jumlah Cetak</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="jumlah_cetak" value="{{ $pekerjaan->jumlah }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="ukuran">Ukuran</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="ukuran" value="{{ $pekerjaan->ukuran }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jenis_kertas">Jenis Kertas</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="jenis_kertas" value="{{ $pekerjaan->jenis_kertas }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="warna">Warna Tinta</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="warna" value="{{ $pekerjaan->warna }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="keterangan" value="{{ $pekerjaan->keterangan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pegawai_penerima_pesanan_id">Penerima Pesanan</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="pegawai_penerima_pesanan_id"
                                                        @if ($pekerjaan->pegawaiPenerimaPesanan)
                                                            value="{{ $pekerjaan->pegawaiPenerimaPesanan->nama_lengkap }}"
                                                        @else
                                                            value="kosong"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pegawai_desain_id">Desain</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="pegawai_desain_id" value="{{ $pekerjaan->pegawaiDesain->nama_lengkap }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cabang_cetak_id">Cetak</label>
                                                <input disabled type="text" class="form-control form-control-sm" name="cabang_cetak_id" value="{{ $pekerjaan->cabangCetak->nama_cabang }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cabang_finishing_id">Finishing</label>
                                                <input disabled type="text" class="form-control form-control-sm" name="cabang_finishing_id"
                                                        @if ($pekerjaan->cabangFinishing)
                                                            value="{{ $pekerjaan->cabangFinishing->nama_cabang }}"
                                                        @endif
                                                    >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="desain">File</label>
                                                <input disabled class="form-control form-control-sm mb-3" id="file" type="file" name="file">
                                                <div>
                                                    @if (file_exists(storage_path('app/file/' . $pekerjaan->file)))
                                                        <a href="{{ route('pekerjaan.download', [$pekerjaan->file]) }}" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                                    @else
                                                        File Tidak Ada
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    {{-- forumulir digital print --}}
                                    @else
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pelanggan_id">Pelanggan</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="pelanggan_id"
                                                        @if ($pekerjaan->pelanggan)
                                                            value="{{ $pekerjaan->pelanggan->nama }}"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nama_pesanan">Nama Pesanan</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="nama_pesanan" value="{{ $pekerjaan->nama_pesanan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nomor_nota">Nomor Nota</label>
                                                    <input disabled type="number" class="form-control form-control-sm" name="nomor_nota" value="{{ $pekerjaan->nomor_nota }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                                    <input disabled type="date" class="form-control form-control-sm" name="tanggal_pesanan" value="{{ $pekerjaan->tanggal_pesanan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="rencana_jadi">Rencana Jadi</label>
                                                    <input disabled type="date" class="form-control form-control-sm" name="rencana_jadi" value="{{ $pekerjaan->rencana_jadi }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jenis_pesanan">Jenis Produk</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="jenis_pesanan" value="{{ $pekerjaan->jenis_pesanan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="jumlah_cetak">Jumlah Cetak</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="jumlah_cetak" value="{{ $pekerjaan->jumlah }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="ukuran">Ukuran</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="ukuran" value="{{ $pekerjaan->ukuran }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="catatan_kasir">Catatan Kasir</label>
                                                    <input disabled type="text" id="catatan_kasir" name="catatan_kasir" class="form-control form-control-sm" value="{{ $pekerjaan->catatan_kasir }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="catatan_produksi">Catatan Produksi</label>
                                                    <input disabled type="text" id="catatan_produksi" name="catatan_produksi" class="form-control form-control-sm" value="{{ $pekerjaan->catatan_produksi }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="keterangan" value="{{ $pekerjaan->keterangan }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pegawai_penerima_pesanan_id">Penerima Pesanan</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="pegawai_penerima_pesanan_id"
                                                        @if ($pekerjaan->pegawaiPenerimaPesanan)
                                                            value="{{ $pekerjaan->pegawaiPenerimaPesanan->nama_lengkap }}"
                                                        @else
                                                            value="kosong"
                                                        @endif
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pegawai_desain_id">Desain</label>
                                                    <input disabled type="text" class="form-control form-control-sm" name="pegawai_desain_id" value="{{ $pekerjaan->pegawaiDesain->nama_lengkap }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cabang_cetak_id">Cetak</label>
                                                <input disabled type="text" class="form-control form-control-sm" name="cabang_cetak_id" value="{{ $pekerjaan->cabangCetak->nama_cabang }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cabang_finishing_id">Finishing</label>
                                                <input disabled type="text" class="form-control form-control-sm" name="cabang_finishing_id"
                                                    @if ($pekerjaan->cabangFinishing)
                                                        value="{{ $pekerjaan->cabangFinishing->nama_cabang }}"
                                                    @endif
                                                >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="desain">File</label>
                                                <input disabled class="form-control form-control-sm mb-3" id="file" type="file" name="file">
                                                <div>
                                                    @if (file_exists(storage_path('app/file/' . $pekerjaan->file)))
                                                        <a href="{{ route('pekerjaan.download', [$pekerjaan->file]) }}" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                                    @else
                                                        File Tidak Ada
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- checkbox --}}
                                    @foreach ($tipe_pekerjaans as $tipe_pekerjaan)
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    {{ $tipe_pekerjaan->tipe }}
                                                    @php $type = "checkbox"; @endphp
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    @foreach ($tipe_pekerjaan->jenisPekerjaan as $jenis_pekerjaan)
                                                        @php if (!$jenis_pekerjaan->pekerjaanProses->isEmpty()) { @endphp
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    <input
                                                                        disabled
                                                                        class="form-check-input"
                                                                        type="{{ $type }}"
                                                                        data-id="{{ $jenis_pekerjaan->id }}"
                                                                        id="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}"
                                                                        name="jenis_pekerjaan_id[]"
                                                                        style="padding: 10px; margin-right: 10px;"
                                                                        value="{{ $jenis_pekerjaan->id }}"
                                                                        checked>
                                                                    <label
                                                                        class="form-check-label"
                                                                        for="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}">
                                                                            {{ $jenis_pekerjaan->jenis }}
                                                                    </label>
                                                                </div>
                                                                @foreach ($jenis_pekerjaan->pekerjaanProses as $item)
                                                                    <input
                                                                        disabled
                                                                        type="text"
                                                                        id="jenis_pekerjaan_keterangan_{{ $type }}"
                                                                        class="form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_keterangan[]"
                                                                        value="{{ $item->keterangan}}">
                                                                @endforeach
                                                            </div>
                                                        @php } else {}  @endphp
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <table class="table table-bordered table-stripped">
                                        <tr>
                                            <th class="text-center text-indigo">Status</th>
                                            <th class="text-center text-indigo">Pelaksana</th>
                                            <th class="text-center text-indigo">Waktu</th>
                                            <th class="text-center text-indigo">Keterangan</th>
                                        </tr>
                                        @foreach ($status_pekerjaans as $status)
                                            <tr>
                                                <td>{{ $status->status->nama_status }}</td>
                                                <td>{{ $status->pelaksana->nama_lengkap }}</td>
                                                <td class="text-center">
                                                    @php
                                                        $waktu = explode(" ", $status->waktu);
                                                    @endphp
                                                    {{ tgl_indo($waktu[0]) }} - {{ $waktu[1] }}
                                                </td>
                                                <td>{{ $status->status_keterangan }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#file').hide();
        // $('input[id="jenis_pekerjaan_keterangan_radio"]').prop("disabled", true);
        // $('input[id="jenis_pekerjaan_keterangan_checkbox"]').prop("disabled", true);

        $('#ganti').on('click', function(e) {
            e.preventDefault();

            $('#file').show();
        })

        // $('input[type="radio"]').on('change', function() {
        //     var id = $(this).attr('data-id');
        //     $('input[id="jenis_pekerjaan_keterangan_radio"]').prop("disabled", true);
        //     $('input[id="jenis_pekerjaan_keterangan_radio"]').val("");
        //     if($('#jenis_pekerjaan_' + id).prop("checked", true)) {
        //         $('.jenis_pekerjaan_keterangan_' + id).prop("disabled", false);
        //     }
        // });

        // $('input[type="checkbox"]').on('change', function() {
        //     var id = $(this).attr('data-id');
        //     $('.jenis_pekerjaan_keterangan_' + id).val("");
        //     if($('#jenis_pekerjaan_' + id).is(":checked")) {
        //         $('.jenis_pekerjaan_keterangan_' + id).prop("disabled", false);
        //     } else {
        //         $('.jenis_pekerjaan_keterangan_' + id).prop("disabled", true);
        //     }
        // });
    });
</script>
@endsection
