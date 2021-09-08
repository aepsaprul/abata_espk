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
                            <select class="form-select form-select-sm" name="pelanggan">
                                <option value="">--Pilih Pelanggan--</option>
                                @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pelanggan" class="col-sm-4 col-form-label">Nama Pesanan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="pelanggan">
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
                        <label for="jenis_pesanan" class="col-sm-4 col-form-label">Jenis Pesanan</label>
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
                            <input type="text" class="form-control form-control-sm" name="penerima_pesanan">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="desain" class="col-sm-4 col-form-label">Desain</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" name="desain">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cabang_cetak" class="col-sm-4 col-form-label">Cetak</label>
                        <div class="col-sm-8">
                            <select class="form-select form-select-sm" name="cabang_cetak">
                                @foreach ($cabang_cetaks as $cabang_cetak)
                                    <option value="{{ $cabang_cetak->id }}">{{ $cabang_cetak->nama_cabang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cabang_finishing" class="col-sm-4 col-form-label">Finishing</label>
                        <div class="col-sm-8">
                            <select class="form-select form-select-sm" name="cabang_finishing">
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
                    <div class="row">
                        @foreach ($tipe_pekerjaans as $tipe_pekerjaan)
                            <div class="col-md-6">
                                <p>{{ $tipe_pekerjaan->tipe }}</p>
                            </div>
                            <div class="col-md-6">
                                @foreach ($tipe_pekerjaan->jenisPekerjaan as $jenis_pekerjaan)
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="jenis_pekerjaan_switch" style="padding: 10px; width: 40px; margin-right: 10px;">
                                        <label class="form-check-label" for="jenis_pekerjaan_switch">{{ $jenis_pekerjaan->jenis }}</label>
                                    </div>
                                    <input type="text" class="form-control form-control-sm mt-1 mb-2" name="jenis_pekerjaan_keterangan">
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
