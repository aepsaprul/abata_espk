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
                                {{-- offset --}}
                                <form id="form-offset" action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 row">
                                                <label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control form-control-sm select2-pelanggan" name="pelanggan_id" required>
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
                                                    <input type="text" class="form-control form-control-sm" name="nama_pesanan" maxlength="50" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="nomor_nota" class="col-sm-4 col-form-label">No Nota</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control form-control-sm" name="nomor_nota" min="0" maxlength="11" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="tanggal_pesanan" class="col-sm-4 col-form-label">Tanggal Pesanan</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control form-control-sm" id="tanggal_pesanan" name="tanggal_pesanan" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="rencana_jadi" class="col-sm-4 col-form-label">Rencana Jadi</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control form-control-sm" id="rencana_jadi" name="rencana_jadi" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="jenis_pesanan" class="col-sm-4 col-form-label">Jenis Order</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="jenis_pesanan" maxlength="30" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="jumlah" maxlength="30" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="ukuran" class="col-sm-4 col-form-label">Ukuran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="ukuran" maxlength="100" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="jenis_kertas" class="col-sm-4 col-form-label">Jenis Kertas</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="jenis_kertas" maxlength="30" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="warna" class="col-sm-4 col-form-label">Warna Tinta</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="warna" maxlength="30" required>
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
                                                    <select class="form-control form-control-sm" name="pegawai_penerima_pesanan_id" required>
                                                        @foreach ($penerima_pesanans as $penerima_pesanan)
                                                            <option value="{{ $penerima_pesanan->id }}">{{ $penerima_pesanan->nama_lengkap }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="pegawai_desain_id" class="col-sm-4 col-form-label">Desain</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control form-control-sm" name="pegawai_desain_id">
                                                        @foreach ($desains as $desain)
                                                            <option value="{{ $desain->id }}">{{ $desain->nama_lengkap }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="cabang_cetak_id" class="col-sm-4 col-form-label">Cetak</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control form-control-sm" name="cabang_cetak_id">
                                                        @foreach ($cabang_cetaks as $cabang_cetak)
                                                            <option value="{{ $cabang_cetak->id }}" {{ $cabang_cetak->id == Auth::user()->masterKaryawan->masterCabang->id ? 'hidden' : '' }}>{{ $cabang_cetak->nama_cabang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="cabang_finishing_id" class="col-sm-4 col-form-label">Finishing</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control form-control-sm" name="cabang_finishing_id">
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
                                                    <input class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" type="file" name="file" required>
                                                    @error('file')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @foreach ($jenis_pekerjaan_groups as $jenis_pekerjaan_group)
                                            <div class="card mb-2">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>{{ $jenis_pekerjaan_group->tipePekerjaan->tipe }}</p>
                                                            {{-- @if ($tipe_pekerjaan->tipe == "Cetak" )
                                                                @php $type = "radio"; @endphp
                                                            @else --}}
                                                                @php $type = "checkbox"; @endphp
                                                            {{-- @endif --}}
                                                        </div>
                                                        <div class="col-md-6">
                                                            @foreach ($jenis_pekerjaans as $jenis_pekerjaan)
                                                                @if ($jenis_pekerjaan->tipe_pekerjaan_id == $jenis_pekerjaan_group->tipe_pekerjaan_id)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="{{ $type }}" data-id="{{ $jenis_pekerjaan->id }}" id="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_id[]" style="padding: 10px; margin-right: 10px;" value="{{ $jenis_pekerjaan->id }}">
                                                                        <label class="form-check-label" for="jenis_pekerjaan_{{ $jenis_pekerjaan->id }}">
                                                                            {{ $jenis_pekerjaan->jenis }}
                                                                        </label>
                                                                    </div>
                                                                    <input type="text" id="jenis_pekerjaan_keterangan_{{ $type }}" class="form-control form-control-sm mt-1 mb-2 jenis_pekerjaan_keterangan_{{ $jenis_pekerjaan->id }}" name="jenis_pekerjaan_keterangan[]">
                                                                @endif
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

                                {{-- digital print --}}
                                <form id="form-digital-print" action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 row">
                                                <label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control form-control-sm select2-pelanggan" name="pelanggan_id" required>
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
                                                    <input type="text" class="form-control form-control-sm" name="nama_pesanan" maxlength="50" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="nomor_nota" class="col-sm-4 col-form-label">No Nota</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control form-control-sm" name="nomor_nota" min="0" maxlength="11" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="tanggal_pesanan" class="col-sm-4 col-form-label">Tanggal Pesanan</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control form-control-sm" id="tanggal_pesanan" name="tanggal_pesanan" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="rencana_jadi" class="col-sm-4 col-form-label">Rencana Jadi</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control form-control-sm" id="rencana_jadi" name="rencana_jadi" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="jenis_pesanan" class="col-sm-4 col-form-label">Jenis Produk</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="jenis_pesanan" maxlength="30" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="jumlah" class="col-sm-4 col-form-label">Jumlah Cetak</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="jumlah" maxlength="30" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="ukuran" class="col-sm-4 col-form-label">Ukuran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="ukuran" maxlength="100" required>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="catatan_kasir" class="col-sm-4 col-form-label">Catatan Kasir</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="catatan_kasir">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="catatan_produksi" class="col-sm-4 col-form-label">Catatan Produksi</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control form-control-sm" name="catatan_produksi">
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
                                                    <select class="form-control form-control-sm" name="pegawai_penerima_pesanan_id" required>
                                                        @foreach ($penerima_pesanans as $penerima_pesanan)
                                                            <option value="{{ $penerima_pesanan->id }}">{{ $penerima_pesanan->nama_lengkap }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="pegawai_desain_id" class="col-sm-4 col-form-label">Desain</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control form-control-sm" name="pegawai_desain_id">
                                                        @foreach ($desains as $desain)
                                                            <option value="{{ $desain->id }}">{{ $desain->nama_lengkap }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="cabang_finishing_id" class="col-sm-4 col-form-label">Finishing</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control form-control-sm" name="cabang_finishing_id">
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
                                                    <input class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" type="file" name="file" required>
                                                    @error('file')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
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

                                {{-- digital print --}}
                                <form id="form-digital-print" action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="pelanggan_id">Pelanggan</label>
                                                <select name="pelanggan_id" id="pelanggan_id" class="form-control form-control-sm">
                                                    <option value="0">--Pilih Pelanggan--</option>
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
                                                <input type="date" id="tanggal_pesanan" name="tanggal_pesanan" class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="rencana_jadi">Rencana Jadi</label>
                                                <input type="text" id="rencana_jadi" name="rencana_jadi" class="form-control form-control-sm" required>
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
                                            <label for="cabang_finishing_id" class="col-sm-4 col-form-label">Finishing</label>
                                            <div class="col-sm-8">
                                                <select class="form-control form-control-sm" name="cabang_finishing_id">
                                                    <option value="">--Tanpa Finishing--</option>
                                                    @foreach ($cabang_finishings as $cabang_finishing)
                                                        <option value="{{ $cabang_finishing->id }}">{{ $cabang_finishing->nama_cabang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="desain" class="col-sm-4 col-form-label">File</label>
                                            <div class="col-sm-8">
                                                <input class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" type="file" name="file" required>
                                                @error('file')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
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
