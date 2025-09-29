<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>FDLnet Gladag</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ asset('kaiadmin/assets/img/kaiadmin/favicon.ico') }}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{ asset('kaiadmin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('kaiadmin/assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>


    <!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/kaiadmin.min.css') }}" />

<!-- CSS Just for demo purpose, don't include it in your project -->
{{-- <link rel="stylesheet" href="{{ asset('kaiadmin/assets/css/demo.css') }}" /> --}}
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
                src="{{ asset('kaiadmin/assets/img/logo-fdl-white.png') }}"
                alt="navbar brand"
                class="navbar-brand"
                width="100"
              /> 
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Kelola</h4>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.paket_wifi') ? 'active' : '' }}">
                <a href="{{ route('admin.paket_wifi') }}">
                  <i class="fas fa-wifi"></i>
                  <p>Paket</p>
                </a>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.pelanggan') ? 'active' : '' }}">
                <a href="{{ route('admin.pelanggan') }}">
                  <i class="fas fa-users"></i>
                  <p>Pelanggan</p>
                </a>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.tagihan') ? 'active' : '' }}">
                <a href="{{ route('admin.tagihan') }}">
                  <i class="fas fa-money-bill"></i>
                  <p>Tagihan</p>
                </a>
              </li>

              <li class="nav-item {{ request()->routeIs('admin.pembayaran') ? 'active' : '' }}">
                <a href="{{ route('admin.pembayaran') }}">
                  <i class="fas fa-history"></i>
                  <p>Pembayaran</p>
                </a>
              </li>

              <li class="nav-item {{ request()->is('admin.aset') ? 'active' : '' }}">
                <a href="{{ route('admin.aset') }}">
                  <i class="fas fa-box"></i>
                  <p>Aset</p>
                </a>
              </li>
              <li class="nav-item {{ request()->routeIs('admin.komplain.index') ? 'active' : '' }}">
                <a href="{{ route('admin.komplain.index') }}">
                  <i class="fas fa-info"></i>
                  <p>Keluhan</p>
                </a>
              </li>

            <li class="nav-item {{ request()->routeIs('admin.laporan_keuangan.*') ? 'active' : '' }}">
    <a href="{{ route('admin.laporan_keuangan.index') }}">
        <i class="fas fa-file-invoice-dollar"></i>
        <p>Laporan Keuangan</p>
    </a>
</li>




            </ul>
          </div>

        </div>
      </div>
      <!-- End Sidebar -->

      <div class="main-panel">
        <div class="main-header">
          <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
              <a href="index.html" class="logo">
                <img
                  src="kaiadmin/assets/img/kaiadmin/logo_light.svg"
                  alt="navbar brand"
                  class="navbar-brand"
                  height="20"
                />
              </a>
              <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
                </button>
              </div>
              <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
              </button>
            </div>
            <!-- End Logo Header -->
          </div>
          <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                              data-bs-toggle="dropdown" aria-expanded="false">
                                Hallo, <strong>{{ session('admin')->nama_admin ?? 'Admin' }}</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end animated fadeIn" aria-labelledby="navbarDropdown">
                                <li>
                                    <form method="POST" action="{{ route('admin.logout') }}" id="logout-form">
                                        @csrf
                                        <a class="dropdown-item" href="#"
                                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>


          <!-- End Navbar -->
          
        </div>
              @yield('content')
        </div>
      </div>
    </div>
<!-- Core JS Files -->
<script src="{{ asset('kaiadmin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('kaiadmin/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('kaiadmin/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('kaiadmin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('kaiadmin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('kaiadmin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('kaiadmin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('kaiadmin/assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('kaiadmin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('kaiadmin/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('kaiadmin/assets/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('kaiadmin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Kaiadmin JS -->
<script src="{{ asset('kaiadmin/assets/js/kaiadmin.min.js') }}"></script>

<!-- Inisialisasi DataTables -->
<script>
  $(document).ready(function() {
    $('table').DataTable({
      paging: true,          // Mengaktifkan paginasi
      searching: true,       // Mengaktifkan pencarian
      lengthChange: true,    // Mengaktifkan dropdown "Show entries"
    });
  });
</script>

{{-- sweet alert --}}
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        showConfirmButton: true
    });
</script>
@endif


<!-- Script Hapus Sweet alert-->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tombolHapus = document.querySelectorAll('.btn-hapus');
    tombolHapus.forEach(button => {
      button.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        Swal.fire({
          title: 'Yakin ingin menghapus?',
          text: "Data yang dihapus tidak bisa dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            document.getElementById(`form-hapus-${id}`).submit();
          }
        });
      });
    });
  });
</script>

<!-- Script Generate Tagihan Sweet alert -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btnGenerate = document.getElementById('btn-generate-tagihan');
    const formGenerate = document.getElementById('form-generate-tagihan');

    btnGenerate.addEventListener('click', function () {
      Swal.fire({
        title: 'Yakin ingin generate tagihan?',
        text: "Tagihan akan dibuat untuk bulan ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, lanjutkan!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          formGenerate.submit();
        }
      });
    });
  });
</script>

</body>
</html>

