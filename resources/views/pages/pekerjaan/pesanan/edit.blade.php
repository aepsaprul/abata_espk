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
                    <h1 class="m-0">Ubah Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ubah Pesanan</li>
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
                            <form action="{{ route('pekerjaan.update', [$pekerjaan->id]) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
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
                                                        <label for="pelanggan_id">Pemesan</label>
                                                        <select class="form-control form-control-sm" name="pelanggan_id">
                                                            <option value="">--Pilih Pelanggan--</option>
                                                            @foreach ($pelanggans as $pelanggan)
                                                                <option value="{{ $pelanggan->id }}" {{ $pelanggan->id == $pekerjaan->pelanggan_id ? 'selected' : '' }}>{{ $pelanggan->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="nama_pesanan">Judul Pesanan</label>
                                                        <input type="text" class="form-control form-control-sm" name="nama_pesanan" value="{{ $pekerjaan->nama_pesanan }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="nomor_nota">No Nota</label>
                                                        <input type="number" class="form-control form-control-sm" name="nomor_nota" value="{{ $pekerjaan->nomor_nota }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="tanggal_pesanan">Tanggal Dibuat</label>
                                                        <input type="date" class="form-control form-control-sm" name="tanggal_pesanan" value="{{ $pekerjaan->tanggal_pesanan }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="rencana_jadi">Rencana Jadi</label>
                                                        <input type="date" class="form-control form-control-sm" name="rencana_jadi" value="{{ $pekerjaan->rencana_jadi }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="jenis_pesanan">Jenis Order</label>
                                                        <input type="text" class="form-control form-control-sm" name="jenis_pesanan" value="{{ $pekerjaan->jenis_pesanan }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="jumlah_cetak">Jumlah Cetak</label>
                                                        <input type="text" class="form-control form-control-sm" name="jumlah_cetak" value="{{ $pekerjaan->jumlah }}" maxlength="30">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ukuran">Ukuran</label>
                                                        <input type="text" class="form-control form-control-sm" name="ukuran" value="{{ $pekerjaan->ukuran }}" maxlength="30">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="jenis_kertas">Jenis Kertas</label>
                                                        <input type="text" class="form-control form-control-sm" name="jenis_kertas" value="{{ $pekerjaan->jenis_kertas }}" maxlength="30">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="warna">Warna Tinta</label>
                                                        <input type="text" class="form-control form-control-sm" name="warna" value="{{ $pekerjaan->warna }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <input type="text" class="form-control form-control-sm" name="keterangan" value="{{ $pekerjaan->keterangan }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="pegawai_penerima_pesanan_id">Penerima Order</label>
                                                        <select class="form-control form-control-sm" name="pegawai_penerima_pesanan_id">
                                                            @foreach ($penerima_pesanans as $penerima_pesanan)
                                                                <option value="{{ $penerima_pesanan->id }}" {{ $penerima_pesanan->id == $pekerjaan->pegawai_penerima_pesanan_id ? 'selected' : '' }}>{{ $penerima_pesanan->nama_lengkap }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="pegawai_desain_id">Desain</label>
                                                        <select class="form-control form-control-sm" name="pegawai_desain_id">
                                                            @foreach ($desains as $desain)
                                                                <option value="{{ $desain->id }}" {{ $desain->id == $pekerjaan->pegawai_desain_id ? 'selected' : '' }}>{{ $desain->nama_lengkap }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="cabang_cetak_id">Cetak</label>
                                                    <select class="form-control form-control-sm" name="cabang_cetak_id">
                                                        @foreach ($cabang_cetaks as $cabang_cetak)
                                                            <option value="{{ $cabang_cetak->id }}"
                                                                @if ($pekerjaan->cabang_tujuan_id)
                                                                    {{ $cabang_cetak->id == $pekerjaan->cabang_cetak_id ? 'selected' : '' }}
                                                                @else
                                                                    {{ $cabang_cetak->id == $pekerjaan->cabang_cetak_id ? 'selected' : '' }}
                                                                @endif
                                                            >{{ $cabang_cetak->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="cabang_finishing_id">Finishing</label>
                                                    <select class="form-control form-control-sm" name="cabang_finishing_id">
                                                        @foreach ($cabang_finishings as $cabang_finishing)
                                                            <option value="{{ $cabang_finishing->id }}" {{ $cabang_finishing->id == $pekerjaan->cabang_finishing_id ? 'selected' : '' }}>{{ $cabang_finishing->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="file">File (Maks 15MB)</label>
                                                    <input class="form-control form-control-sm mb-3 @error('file') is-invalid @enderror" id="file" type="file" name="file">
                                                    @error('file')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div>
                                                        <a href="{{ route('pekerjaan.download', [$pekerjaan->file]) }}" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                                        <button id="ganti" class="btn btn-warning"><i class="fas fa-exchange-alt"></i> Ganti</button>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- forumulir digital print --}}
                                        @else
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="pelanggan_id">Pelanggan</label>
                                                        <select class="form-control form-control-sm" name="pelanggan_id">
                                                            <option value="">--Pilih Pelanggan--</option>
                                                            @foreach ($pelanggans as $pelanggan)
                                                                <option value="{{ $pelanggan->id }}" {{ $pelanggan->id == $pekerjaan->pelanggan_id ? 'selected' : '' }}>{{ $pelanggan->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="nama_pesanan">Nama Pesanan</label>
                                                        <input type="text" class="form-control form-control-sm" name="nama_pesanan" value="{{ $pekerjaan->nama_pesanan }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="nomor_nota">Nomor Nota</label>
                                                        <input type="number" class="form-control form-control-sm" name="nomor_nota" value="{{ $pekerjaan->nomor_nota }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                                        <input type="date" class="form-control form-control-sm" name="tanggal_pesanan" value="{{ $pekerjaan->tanggal_pesanan }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="rencana_jadi">Rencana Jadi</label>
                                                        <input type="date" class="form-control form-control-sm" name="rencana_jadi" value="{{ $pekerjaan->rencana_jadi }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="jenis_pesanan">Jenis Produk</label>
                                                        <input type="text" class="form-control form-control-sm" name="jenis_pesanan" value="{{ $pekerjaan->jenis_pesanan }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="jumlah_cetak">Jumlah Cetak</label>
                                                        <input type="text" class="form-control form-control-sm" name="jumlah_cetak" value="{{ $pekerjaan->jumlah }}" maxlength="30">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="ukuran">Ukuran</label>
                                                        <input type="text" class="form-control form-control-sm" name="ukuran" value="{{ $pekerjaan->ukuran }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="bahan">Bahan</label>
                                                        <input type="text" id="bahan" name="bahan" class="form-control form-control-sm" value="{{ $pekerjaan->bahan }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="satuan">Satuan</label>
                                                        <input type="text" id="satuan" name="satuan" class="form-control form-control-sm" value="{{ $pekerjaan->satuan }}" maxlength="20">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="finishing">Finishing</label>
                                                        <input type="text" id="finishing" name="finishing" class="form-control form-control-sm" value="{{ $pekerjaan->finishing }}" maxlength="50">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="catatan_kasir">Catatan Kasir</label>
                                                        <input type="text" id="catatan_kasir" name="catatan_kasir" class="form-control form-control-sm" value="{{ $pekerjaan->catatan_kasir }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="catatan_produksi">Catatan Produksi</label>
                                                        <input type="text" id="catatan_produksi" name="catatan_produksi" class="form-control form-control-sm" value="{{ $pekerjaan->catatan_produksi }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="keterangan">Keterangan</label>
                                                        <input type="text" class="form-control form-control-sm" name="keterangan" value="{{ $pekerjaan->keterangan }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="pegawai_penerima_pesanan_id">Penerima Pesanan</label>
                                                        <select class="form-control form-control-sm" name="pegawai_penerima_pesanan_id">
                                                            @foreach ($penerima_pesanans as $penerima_pesanan)
                                                                <option value="{{ $penerima_pesanan->id }}" {{ $penerima_pesanan->id == $pekerjaan->pegawai_penerima_pesanan_id ? 'selected' : '' }}>{{ $penerima_pesanan->nama_lengkap }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="pegawai_desain_id">Desain</label>
                                                        <select class="form-control form-control-sm" name="pegawai_desain_id">
                                                            @foreach ($desains as $desain)
                                                                <option value="{{ $desain->id }}" {{ $desain->id == $pekerjaan->pegawai_desain_id ? 'selected' : '' }}>{{ $desain->nama_lengkap }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="cabang_cetak_id">Cetak</label>
                                                    <select class="form-control form-control-sm" name="cabang_cetak_id">
                                                        @foreach ($cabang_cetaks as $cabang_cetak)
                                                            <option value="{{ $cabang_cetak->id }}"
                                                                @if ($pekerjaan->cabang_tujuan_id)
                                                                    {{ $cabang_cetak->id == $pekerjaan->cabang_cetak_id ? 'selected' : '' }}
                                                                @else
                                                                    {{ $cabang_cetak->id == $pekerjaan->cabang_cetak_id ? 'selected' : '' }}
                                                                @endif
                                                            >{{ $cabang_cetak->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="cabang_finishing_id">Finishing</label>
                                                    <select class="form-control form-control-sm" name="cabang_finishing_id">
                                                        @foreach ($cabang_finishings as $cabang_finishing)
                                                            <option value="{{ $cabang_finishing->id }}" {{ $cabang_finishing->id == $pekerjaan->cabang_finishing_id ? 'selected' : '' }}>{{ $cabang_finishing->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="file">File (Maks 15MB)</label>
                                                    <input class="form-control form-control-sm mb-3 @error('file') is-invalid @enderror" id="file" type="file" name="file">
                                                    @error('file')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div>
                                                        <a href="{{ route('pekerjaan.download', [$pekerjaan->file]) }}" class="btn btn-primary"><i class="fas fa-download"></i> Download</a>
                                                        <button id="ganti" class="btn btn-warning"><i class="fas fa-exchange-alt"></i> Ganti</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- checkbox --}}
                                @foreach ($tipe_pekerjaans as $tipe_pekerjaan)
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <p>{{ $tipe_pekerjaan->tipe }}</p>
                                                @php $type = "checkbox"; @endphp
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                @foreach ($tipe_pekerjaan->jenisPekerjaan as $jenis_pekerjaan)
                                                    <div class="col-md-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="{{ $type }}" data-id="{{ $jenis_pekerjaan->id }}" id="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}"
                                                            @php if (!$jenis_pekerjaan->pekerjaanProses->isEmpty()) {
                                                                echo "checked";
                                                            }  @endphp
                                                            name="jenis_pekerjaan_id[]" style="padding: 10px; margin-right: 10px;" value="{{ $jenis_pekerjaan->id }}">
                                                            <label class="form-check-label" for="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}">
                                                                {{ $jenis_pekerjaan->jenis }}
                                                            </label>
                                                        </div>
                                                        @php if (!$jenis_pekerjaan->pekerjaanProses->isEmpty()) { @endphp
                                                            @foreach ($jenis_pekerjaan->pekerjaanProses as $item)
                                                            <input type="hidden" name="pekerjaan_proses_id[]" value="{{ $item->id }}">
                                                            <input type="text" id="jenis_pekerjaan_keterangan_{{ $type }}" class="form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_keterangan[]" value="{{ $item->keterangan}}">
                                                            @endforeach
                                                        @php } else { @endphp
                                                            <input type="text" id="jenis_pekerjaan_keterangan_{{ $type }}" class="form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_{{ $jenis_pekerjaan->id }}" disabled name="jenis_pekerjaan_keterangan[]">
                                                        @php }  @endphp
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
