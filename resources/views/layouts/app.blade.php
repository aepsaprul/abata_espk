@guest

@yield('content')

@else

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('themes/dist/img/logo-daun.png') }}" rel="icon" type="image/x-icon">
    <title>{{ config('app.name', 'E - SPK') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/font-google/font-google.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/dist/css/adminlte.min.css') }}">

    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed skin-blue">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('themes/dist/img/logo-biru.png') }}" alt="AdminLTELogo" height="60" width="110">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                            <i class="fa fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a
                            class="dropdown-item main-btn-edit"
                            href="#">
                                <i class="fa fa-id-card px-2"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item main-btn-delete"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt px-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('themes/dist/img/logo-daun.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                <span class="brand-text font-weight-light">Abata Group</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('themes/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        @if (Auth::user()->roles == "administrator")
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('admin/*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('admin/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-lock"></i><p>Admin<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('menu.index') }}" class="nav-link {{ request()->is('admin/menu') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i><p>Menu</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('karyawan.index') }}" class="nav-link {{ request()->is('admin/karyawan') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i><p>Karyawan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->is('data_primer/*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('data_primer/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-database"></i><p>Data Primer<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('pelanggan.index') }}" class="nav-link {{ request()->is('data_primer/pelanggan') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i><p>Pelanggan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('jenis_pekerjaan.index') }}" class="nav-link {{ request()->is('data_primer/jenis_pekerjaan') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i><p>Jenis Pekerjaan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->is('data_pekerjaan/*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('data_pekerjaan/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-briefcase"></i><p>Data Pekerjaan<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('pekerjaan.index') }}" class="nav-link {{ request()->is('data_pekerjaan/pesanan') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i><p>Pesanan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('proses_pekerjaan.index') }}" class="nav-link {{ request()->is('data_pekerjaan/pekerjaan') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i><p>Pekerjaan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->is('laporan/*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('laporan/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clipboard"></i><p>Laporan<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('laporan.index_pekerjaan') }}" class="nav-link {{ request()->is('laporan/pekerjaan') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i><p>Pekerjaan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @elseif (Auth::user()->roles == "admin")

                        @else

                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
          <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
          All rights reserved.
          <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
          </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('themes/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('themes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('themes/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('themes/dist/js/adminlte.js') }}"></script>

    @yield('script')
</body>
</html>

@endguest
