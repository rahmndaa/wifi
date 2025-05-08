<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aplikasi Sistem Pembayaran Internet</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('font/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">


    <!-- Scripts -->
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
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
                <form method="POST" action="{{ route('pelanggan.logout') }}" id="logout-form">
                    @csrf
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>
                </form>
                
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <div class="d-flex justify-content-center">
                <a href="#" class="brand-link d-block text-center">
                    <span class="brand-text font-weight-light">
                        <img src="{{ asset('img/logo-wipaykuu-2.png') }}" width="40"/> <b>Fadillahnet Gladag</b>
                    </span>
                </a>
            </div>      
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel d-flex justify-content-center">
                    <div class="info">
                        <a href="#" class="d-block">Hallo, {{ session('pelanggan')->nama_pelanggan ?? '' }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <!--<div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                    </div>
                </div>-->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}" href="{{ route('pelanggan.dashboard') }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dasboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('pelanggan.komplain') ? 'active' : '' }}" href="{{ route('pelanggan.komplain.index') }}">
                                <i class="nav-icon fas fa-info"></i>
                                <p>Pengaduan</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!--<footer class="main-footer">
            //<strong>Copyright &copy; 2021 <a href="#">AiNetwork</a>.</strong>//
        </footer>-->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo.js') }}"></script>
    

</body>

</html>
