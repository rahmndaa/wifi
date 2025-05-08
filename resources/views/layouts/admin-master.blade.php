<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WIpaykuu Management dan Pembayaran internet</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font/fontawesome/css/all.min.css') }}">

    <!-- Overlay Scrollbar -->
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img src="{{ asset('img/logo-wipaykuu-2.png') }}" width="200"/>
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                    @csrf
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>
                </form>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-3">
            <div class="d-flex justify-content-center">
                <a href="#" class="brand-link d-block text-center">
                    <span class="brand-text font-weight-light">
                        <img src="{{ asset('img/logo-wipaykuu-2.png') }}" width="40"/> <b>Fadillahnet Gladag</b>
                    </span>
                </a>
            </div>           
            
            <div class="sidebar">
                <div class="user-panel d-flex justify-content-center">
                    <div class="info">
                        <a href="#" class="d-block">Hallo, {{ session('admin')->nama_admin ?? '' }} !!</a>
                    </div>
                </div>
                
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.paket_wifi') ? 'active' : '' }}" href="{{route('admin.paket_wifi')}}">
                                <i class="nav-icon fas fa-box"></i>
                                <p>Paket</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.pelanggan') ? 'active' : '' }}" href="{{route('admin.pelanggan')}}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Pelangggan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.tagihan') ? 'active' : '' }}" href="{{ route('admin.tagihan') }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Tagihan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.pembayaran') ? 'active' : '' }}" href="{{ route('admin.pembayaran') }}">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.komplain') ? 'active' : '' }}" href="#">
                                <i class="nav-icon fas fa-info"></i>
                                <p>Pengaduan</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        

        @yield('content')

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>


    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- Demo -->
    <script src="{{ asset('js/demo.js') }}"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Inisialisasi semua tabel -->
    <script>
        $(document).ready(function () {
            $('table').DataTable({
                responsive: true,
                autoWidth: false,
                ordering: true,
                paging: true,
                info: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "›",
                        previous: "‹"
                    },
                    zeroRecords: "Tidak ada data ditemukan"
                }
            });
        });
    </script>
</body>

</html>
