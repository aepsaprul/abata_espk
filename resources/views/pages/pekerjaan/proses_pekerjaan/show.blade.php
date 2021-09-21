@extends('layouts.app')

@section('style')

<style>
    .col-md-10 {
        font-size: 16px;
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
            <form action="{{ route('pekerjaan.update', [$pekerjaan->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <h6 class="text-uppercase text-center">Lihat Pesanan</h6>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <a href="{{ url('proses_pekerjaan') }}" class="mb-4 btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="pelanggan_id" value="{{ $pekerjaan->pelanggan->nama }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama_pesanan" class="col-sm-4 col-form-label">Nama Pesanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="nama_pesanan" value="{{ $pekerjaan->nama_pesanan }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nomor_nota" class="col-sm-4 col-form-label">No Nota</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-sm" name="nomor_nota" value="{{ $pekerjaan->nomor_nota }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal_pesanan" class="col-sm-4 col-form-label">Tanggal Pesanan</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" name="tanggal_pesanan" value="{{ $pekerjaan->tanggal_pesanan }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="rencana_jadi" class="col-sm-4 col-form-label">Rencana Jadi</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" name="rencana_jadi" value="{{ $pekerjaan->rencana_jadi }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis_pesanan" class="col-sm-4 col-form-label">Jenis Pesanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="jenis_pesanan" value="{{ $pekerjaan->jenis_pesanan }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="jumlah" value="{{ $pekerjaan->jumlah }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="ukuran" class="col-sm-4 col-form-label">Ukuran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="ukuran" value="{{ $pekerjaan->ukuran }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis_kertas" class="col-sm-4 col-form-label">Jenis Kertas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="jenis_kertas" value="{{ $pekerjaan->jenis_kertas }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="warna" class="col-sm-4 col-form-label">Warna Tinta</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="warna" value="{{ $pekerjaan->warna }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="keterangan" value="{{ $pekerjaan->keterangan }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="penerima_pesanan" class="col-sm-4 col-form-label">Penerima Pesanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="pegawai_penerima_pesanan_id" value="{{ $pekerjaan->pegawaiPenerimaPesanan->nama_lengkap }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="pegawai_desain_id" class="col-sm-4 col-form-label">Desain</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="pegawai_desain_id" value="{{ $pekerjaan->pegawaiDesain->nama_lengkap }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cabang_cetak_id" class="col-sm-4 col-form-label">Cetak</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="cabang_cetak_id" value="{{ $pekerjaan->cabangCetak->nama_cabang }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cabang_finishing_id" class="col-sm-4 col-form-label">Finishing</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="cabang_finishing_id" value="{{ $pekerjaan->cabangFinishing->nama_cabang }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="desain" class="col-sm-4 col-form-label">File</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm mb-3" id="file" type="file" name="file">
                                <div>
                                    @php $modul = explode('/', $pekerjaan->file); @endphp
                                    <a href="{{ route('pekerjaan.download', [$modul[1], $pekerjaan->nama_pesanan]) }}" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                    {{-- <button id="ganti" class="btn btn-warning"><i class="fas fa-exchange-alt"></i> Ganti</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            @foreach ($tipe_pekerjaans as $tipe_pekerjaan)
                                <div class="col-md-6">
                                    <p>{{ $tipe_pekerjaan->tipe }}</p>
                                    @if ($tipe_pekerjaan->tipe == "Cetak" )
                                        @php $type = "radio"; @endphp
                                    @else
                                        @php $type = "checkbox"; @endphp
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @foreach ($tipe_pekerjaan->jenisPekerjaan as $jenis_pekerjaan)
                                    @php if (!$jenis_pekerjaan->pekerjaanProses->isEmpty()) { @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="{{ $type }}" data-id="{{ $jenis_pekerjaan->id }}" id="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_id[]" style="padding: 10px; margin-right: 10px;" value="{{ $jenis_pekerjaan->id }}" checked>
                                            <label class="form-check-label" for="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}">
                                                {{ $jenis_pekerjaan->jenis }}
                                            </label>
                                        </div>
                                        @foreach ($jenis_pekerjaan->pekerjaanProses as $item)
                                            <input type="hidden" name="pekerjaan_proses_id[]" value="{{ $item->id }}">
                                            <input type="text" id="jenis_pekerjaan_keterangan_{{ $type }}" class="form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_keterangan[]" value="{{ $item->keterangan}}">
                                            @endforeach
                                    @php } else {}  @endphp

                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>
            </form>
        </div>
    </div>
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
