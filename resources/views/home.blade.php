@extends('layouts.app')

@section('style')
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_hari_ini }}</h3>
                                    <p>Pesanan Hari Ini</p>
                                </div>
                                <a href="{{ route('home.selengkapnya', ["pesanan_hari_ini"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_menunggu_disetujui }}</h3>
                                    <p>Menunggu Di Setujui</p>
                                </div>
                                <a href="{{ route('home.selengkapnya', ["menunggu_disetujui"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_proses }}</h3>
                                    <p>Sedang Di Proses</p>
                                </div>
                                <a href="{{ route('home.selengkapnya', ["sedang_diproses"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $jumlah_pesanan_selesai }}</h3>
                                    <p>Selesai Bulan Ini</p>
                                </div>
                                <a href="{{ route('home.selengkapnya', ["selesai"]) }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
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

@endsection

