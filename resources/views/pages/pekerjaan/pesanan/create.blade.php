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
            <form action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <h6 class="text-uppercase text-center">Tambah Pesanan</h6>
                <div class="row mb-2">
                    <div class="col-md-4">
                        <a href="{{ url('pekerjaan') }}" class="mb-4 btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
                            <div class="col-sm-8">
                                <select class="form-select form-select-sm" name="pelanggan_id">
                                    <option value="">--Pilih Pelanggan--</option>
                                    @foreach ($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama_pesanan" class="col-sm-4 col-form-label">Nama Pesanan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="nama_pesanan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nomor_nota" class="col-sm-4 col-form-label">No Nota</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-sm" name="nomor_nota">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tanggal_pesanan" class="col-sm-4 col-form-label">Tanggal Pesanan</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" name="tanggal_pesanan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="rencana_jadi" class="col-sm-4 col-form-label">Rencana Jadi</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" name="rencana_jadi">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis_pesanan" class="col-sm-4 col-form-label">Jenis Order</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="jenis_pesanan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="jumlah">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="ukuran" class="col-sm-4 col-form-label">Ukuran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="ukuran">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="jenis_kertas" class="col-sm-4 col-form-label">Jenis Kertas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="jenis_kertas">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="warna" class="col-sm-4 col-form-label">Warna Tinta</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="warna">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="keterangan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="penerima_pesanan" class="col-sm-4 col-form-label">Penerima Pesanan</label>
                            <div class="col-sm-8">
                                <select class="form-select form-select-sm" name="pegawai_penerima_pesanan_id">
                                    @foreach ($penerima_pesanans as $penerima_pesanan)
                                        <option value="{{ $penerima_pesanan->id }}">{{ $penerima_pesanan->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="pegawai_desain_id" class="col-sm-4 col-form-label">Desain</label>
                            <div class="col-sm-8">
                                <select class="form-select form-select-sm" name="pegawai_desain_id">
                                    @foreach ($desains as $desain)
                                        <option value="{{ $desain->id }}">{{ $desain->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cabang_cetak_id" class="col-sm-4 col-form-label">Cetak</label>
                            <div class="col-sm-8">
                                <select class="form-select form-select-sm" name="cabang_cetak_id">
                                    @foreach ($cabang_cetaks as $cabang_cetak)
                                        <option value="{{ $cabang_cetak->id }}" {{ $cabang_cetak->id == Auth::user()->masterKaryawan->masterCabang->id ? 'hidden' : '' }}>{{ $cabang_cetak->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="cabang_finishing_id" class="col-sm-4 col-form-label">Finishing</label>
                            <div class="col-sm-8">
                                <select class="form-select form-select-sm" name="cabang_finishing_id">
                                    <option value="">--Tanpa Finishing--</option>
                                    @foreach ($cabang_finishings as $cabang_finishing)
                                        <option value="{{ $cabang_finishing->id }}">{{ $cabang_finishing->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="desain" class="col-sm-4 col-form-label">File</label>
                            <div class="col-sm-8">
                                <input class="form-control form-control-sm" id="file" type="file" name="file">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @foreach ($tipe_pekerjaans as $tipe_pekerjaan)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>{{ $tipe_pekerjaan->tipe }}</p>
                                        {{-- @if ($tipe_pekerjaan->tipe == "Cetak" )
                                            @php $type = "radio"; @endphp
                                        @else --}}
                                            @php $type = "checkbox"; @endphp
                                        {{-- @endif --}}
                                    </div>
                                    <div class="col-md-6">
                                        @foreach ($tipe_pekerjaan->jenisPekerjaan as $jenis_pekerjaan)
                                            <div class="form-check">
                                                <input class="form-check-input" type="{{ $type }}" data-id="{{ $jenis_pekerjaan->id }}" id="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_id[]" style="padding: 10px; margin-right: 10px;" value="{{ $jenis_pekerjaan->id }}">
                                                <label class="form-check-label" for="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}">
                                                    {{ $jenis_pekerjaan->jenis }}
                                                </label>
                                            </div>
                                            <input type="text" id="jenis_pekerjaan_keterangan_{{ $type }}" class="form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_keterangan[]">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit">Simpan</button>
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
