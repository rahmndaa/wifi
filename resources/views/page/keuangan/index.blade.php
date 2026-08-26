@extends('layouts.admin-master')

@section('content')
<div class="container-fluid px-2 px-md-4 pt-0">
    <div class="page-inner px-1 px-md-3 pt-1">
        <div class="page-header mb-3">
            <h3 class="fw-bold mb-3">Laporan Keuangan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Laporan Keuangan</a></li>
            </ul>
        </div>

        {{-- Tombol Export Excel --}}
        <div class="row mb-3">
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('admin.keuangan.export', ['dari' => request('dari'), 'sampai' => request('sampai')]) }}" class="btn btn-success btn-sm w-100 py-2 shadow-sm">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </a>
            </div>
        </div>

        <!-- Filter Periode Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-3 p-md-4">
                <form action="{{ route('admin.keuangan.index') }}" method="GET">
                    <div class="row align-items-end g-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-secondary small">Dari Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="far fa-calendar-alt text-muted"></i></span>
                                <input type="date" name="dari" class="form-control border-start-0 rounded-end-3 fs-8" value="{{ request('dari') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-secondary small">Sampai Tanggal</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 rounded-start-3"><i class="far fa-calendar-alt text-muted"></i></span>
                                <input type="date" name="sampai" class="form-control border-start-0 rounded-end-3 fs-8" value="{{ request('sampai') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary rounded-3 flex-grow-1 shadow-sm py-2">
                                <i class="fa fa-search me-1"></i> Filter Data
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- 4 Kartu Statistik Keuangan -->
        <div class="row g-3 mb-4">
            <!-- Total Pemasukan -->
            <div class="col-6 col-xl-3">
                <div class="card card-stats card-round border-0 shadow-sm h-100 border-start border-success border-4">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center">
                            <div class="col-4 d-none d-sm-block">
                                <div class="icon-big text-center bg-success-subtle text-success rounded-4 p-3 shadow-sm">
                                    <i class="fas fa-arrow-down fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 ps-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-muted mb-1 fs-9 fw-bold text-uppercase">Pemasukan</p>
                                    <h5 class="card-title fw-bold text-dark mb-0 fs-7 fs-md-6">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pengeluaran -->
            <div class="col-6 col-xl-3">
                <div class="card card-stats card-round border-0 shadow-sm h-100 border-start border-danger border-4">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center">
                            <div class="col-4 d-none d-sm-block">
                                <div class="icon-big text-center bg-danger-subtle text-danger rounded-4 p-3 shadow-sm">
                                    <i class="fas fa-arrow-up fa-lg"></i>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 ps-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-muted mb-1 fs-9 fw-bold text-uppercase">Pengeluaran</p>
                                    <h5 class="card-title fw-bold text-dark mb-0 fs-7 fs-md-6">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Balance -->
            <div class="col-6 col-xl-3">
                <div class="card card-stats card-round border-0 shadow-sm h-100 @if($balance >= 0) bg-success text-white @else bg-danger text-white @endif">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center">
                            <div class="col-4 d-none d-sm-block">
                                <div class="icon-big text-center bg-white bg-opacity-25 rounded-4 p-3 shadow-sm">
                                    <i class="fas fa-balance-scale fa-lg text-white"></i>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 ps-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-white-50 mb-1 fs-9 fw-bold text-uppercase">Balance</p>
                                    <h5 class="card-title fw-bold mb-0 fs-7 fs-md-6 text-white">Rp {{ number_format($balance, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Potensi Paket Pelanggan -->
            <div class="col-6 col-xl-3">
                <div class="card card-stats card-round border-0 shadow-sm h-100 bg-primary text-white">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center">
                            <div class="col-4 d-none d-sm-block">
                                <div class="icon-big text-center bg-white bg-opacity-25 rounded-4 p-3 shadow-sm">
                                    <i class="fas fa-users fa-lg text-white"></i>
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 ps-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-white-50 mb-1 fs-9 fw-bold text-uppercase">Potensi Paket</p>
                                    <h5 class="card-title fw-bold mb-0 fs-7 fs-md-6 text-white">Rp {{ number_format($totalUangPelanggan, 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekapitulasi Per Bulan -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0 text-dark fs-5"><i class="fas fa-calendar-alt text-primary me-2"></i> Rekapitulasi Keuangan Per Bulan</h5>
            </div>
            <div class="card-body px-3 px-md-4 pb-4">
                
                {{-- Tampilan Mobile (Card List) --}}
                <div class="d-block d-md-none">
                    @forelse($rekapBulanan as $rekap)
                    <div class="card border bg-light-subtle rounded-3 p-3 mb-3 shadow-none">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-dark fs-6">{{ \Carbon\Carbon::createFromFormat('Y-m', $rekap['bulan'])->translatedFormat('F Y') }}</span>
                            <span class="badge {{ $rekap['balance'] >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-2 py-1 fw-bold">
                                Rp {{ number_format($rekap['balance'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between text-secondary fs-8 border-top pt-2">
                            <div>
                                <span class="d-block text-muted fs-9">PEMASUKAN</span>
                                <span class="text-success fw-semibold">Rp {{ number_format($rekap['pemasukan'], 0, ',', '.') }}</span>
                            </div>
                            <div class="text-end">
                                <span class="d-block text-muted fs-9">PENGELUARAN</span>
                                <span class="text-danger fw-semibold">Rp {{ number_format($rekap['pengeluaran'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted small">Belum ada data rekapitulasi bulanan.</div>
                    @endforelse
                </div>

                {{-- Tampilan Desktop (Tabel) --}}
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7">
                            <tr>
                                <th class="py-3 px-3 rounded-start">Bulan</th>
                                <th class="py-3 px-3">Total Pemasukan</th>
                                <th class="py-3 px-3">Total Pengeluaran</th>
                                <th class="py-3 px-3 text-center rounded-end">Balance Bulan Ini</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekapBulanan as $rekap)
                            <tr>
                                <td class="fw-bold text-dark py-3 px-3">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m', $rekap['bulan'])->translatedFormat('F Y') }}
                                </td>
                                <td class="text-success fw-semibold px-3">
                                    Rp {{ number_format($rekap['pemasukan'], 0, ',', '.') }}
                                </td>
                                <td class="text-danger fw-semibold px-3">
                                    Rp {{ number_format($rekap['pengeluaran'], 0, ',', '.') }}
                                </td>
                                <td class="text-center px-3">
                                    <span class="badge {{ $rekap['balance'] >= 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2 rounded-pill fw-bold">
                                        Rp {{ number_format($rekap['balance'], 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data rekapitulasi bulanan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- TABEL RINCIAN TRANSAKSI (FILTER TABS) -->
        @php
            $tabAktif = (request()->has('search_pengeluaran') || request()->has('pengeluaran_page')) ? 'pengeluaran' : 'pemasukan';
        @endphp

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-transparent border-0 pt-4 px-3 px-md-4">
                <h5 class="fw-bold mb-0 text-dark fs-5"><i class="fas fa-list-alt text-primary me-2"></i> Rincian Transaksi</h5>
                
                <!-- Tab Navigation / Pilihan Filter -->
                <ul class="nav nav-pills nav-secondary mt-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ $tabAktif == 'pemasukan' ? 'active' : '' }} fw-bold px-4" id="pills-pemasukan-tab" data-bs-toggle="pill" href="#pills-pemasukan" role="tab" aria-controls="pills-pemasukan" aria-selected="{{ $tabAktif == 'pemasukan' ? 'true' : 'false' }}">
                            <i class="fas fa-arrow-circle-down me-1"></i> Data Pemasukan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $tabAktif == 'pengeluaran' ? 'active' : '' }} fw-bold px-4" id="pills-pengeluaran-tab" data-bs-toggle="pill" href="#pills-pengeluaran" role="tab" aria-controls="pills-pengeluaran" aria-selected="{{ $tabAktif == 'pengeluaran' ? 'true' : 'false' }}">
                            <i class="fas fa-arrow-circle-up me-1"></i> Data Pengeluaran
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body px-3 px-md-4 pb-4 pt-2">
                <!-- Tab Content -->
                <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                    
                    <!-- ==============================================
                        TAB PEMASUKAN 
                    =============================================== -->
                    <div class="tab-pane fade {{ $tabAktif == 'pemasukan' ? 'show active' : '' }}" id="pills-pemasukan" role="tabpanel" aria-labelledby="pills-pemasukan-tab">
                        
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                            <!-- Form Pencarian Pemasukan -->
                            <form action="{{ route('admin.keuangan.index') }}" method="GET" class="w-100" style="max-width: 400px;">
                                @if(request('dari')) <input type="hidden" name="dari" value="{{ request('dari') }}"> @endif
                                @if(request('sampai')) <input type="hidden" name="sampai" value="{{ request('sampai') }}"> @endif
                                
                                <div class="input-group">
                                    <input type="text" name="search_pemasukan" class="form-control bg-light" placeholder="Cari pemasukan..." value="{{ request('search_pemasukan') }}">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    @if(request('search_pemasukan'))
                                        <a href="{{ route('admin.keuangan.index', ['dari' => request('dari'), 'sampai' => request('sampai')]) }}" class="btn btn-outline-danger" title="Reset Pencarian"><i class="fa fa-times"></i></a>
                                    @endif
                                </div>
                            </form>

                            <a href="{{ route('admin.keuangan.createPemasukan') }}" class="btn btn-success btn-round shadow-sm px-4">
                                <i class="fa fa-plus me-1"></i> Tambah Pemasukan
                            </a>
                        </div>

                        {{-- Mobile Card List Pemasukan --}}
                        <div class="d-block d-md-none">
                            @forelse($pemasukan as $item)
                            <div class="card border bg-light-subtle rounded-3 p-3 mb-3 shadow-none border-start border-success border-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-dark fs-7">{{ $item->keterangan }}</span>
                                    <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold">
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center text-secondary fs-8 border-top pt-2 mt-2">
                                    <div>
                                        <span class="d-block text-muted fs-9">TANGGAL</span>
                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.keuangan.editPemasukan', $item->id_pemasukan) }}" class="btn btn-warning btn-xs px-2 py-1" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.keuangan.destroyPemasukan', $item->id_pemasukan) }}" method="POST" class="d-inline hapus-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs px-2 py-1 btn-hapus" title="Hapus">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4 text-muted small">Belum ada data pemasukan.</div>
                            @endforelse
                        </div>

                        {{-- Desktop Table Pemasukan --}}
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-uppercase fs-7">
                                    <tr>
                                        <th class="py-3 px-3 rounded-start">Tanggal</th>
                                        <th class="py-3 px-3">Keterangan</th>
                                        <th class="py-3 px-3">Jumlah</th>
                                        <th class="py-3 px-3 text-center rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemasukan as $item)
                                    <tr>
                                        <td class="py-3 px-3 text-secondary fw-semibold text-nowrap">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="fw-bold text-dark py-3 px-3">
                                            {{ $item->keterangan }}
                                        </td>
                                        <td class="text-success fw-bold text-nowrap px-3">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-3 text-center text-nowrap">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.keuangan.editPemasukan', $item->id_pemasukan) }}" class="btn btn-icon btn-round btn-warning btn-sm shadow-sm" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.keuangan.destroyPemasukan', $item->id_pemasukan) }}" method="POST" class="d-inline hapus-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-round btn-danger btn-sm shadow-sm btn-hapus" title="Hapus">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada data pemasukan ditemukan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Pemasukan -->
                        @if (method_exists($pemasukan, 'links'))
                            <div class="mt-4 d-flex justify-content-end">
                                {{ $pemasukan->appends(request()->except('pemasukan_page'))->links() }}
                            </div>
                        @endif

                    </div>

                    <!-- ==============================================
                        TAB PENGELUARAN 
                    =============================================== -->
                    <div class="tab-pane fade {{ $tabAktif == 'pengeluaran' ? 'show active' : '' }}" id="pills-pengeluaran" role="tabpanel" aria-labelledby="pills-pengeluaran-tab">
                        
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
                            <!-- Form Pencarian Pengeluaran -->
                            <form action="{{ route('admin.keuangan.index') }}" method="GET" class="w-100" style="max-width: 400px;">
                                <input type="hidden" name="tab" value="pengeluaran">
                                @if(request('dari')) <input type="hidden" name="dari" value="{{ request('dari') }}"> @endif
                                @if(request('sampai')) <input type="hidden" name="sampai" value="{{ request('sampai') }}"> @endif
                                
                                <div class="input-group">
                                    <input type="text" name="search_pengeluaran" class="form-control bg-light" placeholder="Cari pengeluaran..." value="{{ request('search_pengeluaran') }}">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                    @if(request('search_pengeluaran'))
                                        <a href="{{ route('admin.keuangan.index', ['dari' => request('dari'), 'sampai' => request('sampai'), 'tab' => 'pengeluaran']) }}" class="btn btn-outline-danger" title="Reset Pencarian"><i class="fa fa-times"></i></a>
                                    @endif
                                </div>
                            </form>

                            <a href="{{ route('admin.keuangan.createPengeluaran') }}" class="btn btn-danger btn-round shadow-sm px-4">
                                <i class="fa fa-plus me-1"></i> Tambah Pengeluaran
                            </a>
                        </div>

                        {{-- Mobile Card List Pengeluaran --}}
                        <div class="d-block d-md-none">
                            @forelse($pengeluaran as $item)
                            <div class="card border bg-light-subtle rounded-3 p-3 mb-3 shadow-none border-start border-danger border-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-bold text-dark fs-7">{{ $item->keterangan }}</span>
                                    <span class="badge bg-danger-subtle text-danger px-2 py-1 fw-bold">
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center text-secondary fs-8 border-top pt-2 mt-2">
                                    <div>
                                        <span class="d-block text-muted fs-9">TANGGAL</span>
                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.keuangan.editPengeluaran', $item->id_pengeluaran) }}" class="btn btn-warning btn-xs px-2 py-1" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.keuangan.destroyPengeluaran', $item->id_pengeluaran) }}" method="POST" class="d-inline hapus-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs px-2 py-1 btn-hapus" title="Hapus">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4 text-muted small">Belum ada data pengeluaran.</div>
                            @endforelse
                        </div>

                        {{-- Desktop Table Pengeluaran --}}
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-uppercase fs-7">
                                    <tr>
                                        <th class="py-3 px-3 rounded-start">Tanggal</th>
                                        <th class="py-3 px-3">Keterangan</th>
                                        <th class="py-3 px-3">Jumlah</th>
                                        <th class="py-3 px-3 text-center rounded-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengeluaran as $item)
                                    <tr>
                                        <td class="py-3 px-3 text-secondary fw-semibold text-nowrap">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="fw-bold text-dark py-3 px-3">
                                            {{ $item->keterangan }}
                                        </td>
                                        <td class="text-danger fw-bold text-nowrap px-3">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-3 text-center text-nowrap">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.keuangan.editPengeluaran', $item->id_pengeluaran) }}" class="btn btn-icon btn-round btn-warning btn-sm shadow-sm" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.keuangan.destroyPengeluaran', $item->id_pengeluaran) }}" method="POST" class="d-inline hapus-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-round btn-danger btn-sm shadow-sm btn-hapus" title="Hapus">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Belum ada data pengeluaran ditemukan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Pengeluaran -->
                        @if (method_exists($pengeluaran, 'links'))
                            <div class="mt-4 d-flex justify-content-end">
                                {{ $pengeluaran->appends(request()->except('pengeluaran_page'))->links() }}
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        <!-- END TABEL RINCIAN TRANSAKSI -->

    </div>
</div>
@endsection