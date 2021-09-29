@guest
    @yield('content')
@else

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'E - SPK') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('lib/fontawesome-5/css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('lib/bootstrap-5/bootstrap.min.css') }}" rel="stylesheet">

    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase">
                        @if (Auth::user()->roles == "administrator")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('menu.index') }}">Menu</a></li>
                                    <li><a class="dropdown-item border-top" href="{{ route('karyawan.index') }}">Karyawan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Data Primer
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item border-bottom" href="{{ route('pelanggan.index') }}"><i class="fas fa-chevron-right"></i> Pelanggan</a></li>
                                    <li><a class="dropdown-item" href="{{ route('jenis_pekerjaan.index') }}"><i class="fas fa-chevron-right"></i> Jenis Pekerjaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pekerjaan
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item border-bottom" href="{{ route('pekerjaan.index') }}"><i class="fas fa-chevron-right"></i> Pesanan</a></li>
                                    <li><a class="dropdown-item" href="{{ route('proses_pekerjaan.index') }}"><i class="fas fa-chevron-right"></i> Pekerjaan</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('laporan.index_pekerjaan') }}"><i class="fas fa-chevron-right"></i> Pekerjaan</a></li>
                                </ul>
                            </li>
                        @else
                            @foreach (Auth::user()->masterKaryawan->karyawanMenuUtama as $item)
                                @if ($item->menuUtama->subMenu->isEmpty())
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="{{ url($item->menuUtama->link) }}">{{ $item->menuUtama->nama_menu }}</a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $item->menuUtama->nama_menu }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach (Auth::user()->masterKaryawan->karyawanMenuSub as $sub_menu)
                                                @if ($item->menu_utama_id == $sub_menu->menuSub->menu_utama_id)
                                                    <li><a class="dropdown-item" href="{{ url($sub_menu->menuSub->link) }}">- {{ $sub_menu->menuSub->nama_menu }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                    <div class="btn-group d-flex">
                        <button type="button" class="btn dropdown-toggle text-uppercase" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            {{-- <li><button class="dropdown-item text-uppercase" type="button">Profile</button></li> --}}
                            <li>
                                <a class="dropdown-item text-uppercase"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- <script src="{{ asset('lib/bootstrap-5/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('lib/bootstrap-5/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/datatables/js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('lib/fontawesome-5/js/fontawesome.min.js') }}"></script>

    @yield('script')
</body>
</html>

@endguest
