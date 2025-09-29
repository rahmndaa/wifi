@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Laporan Keuangan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">Laporan Keuangan</li>
            </ul>
        </div>

    {{-- Filter Periode --}}
    <form action="{{ route('admin.keuangan.index') }}" method="GET" class="mb-4">
        <div class="row mb-3">
            <div class="col-md-2">
                <label class="form-label">Dari</label>
                <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Sampai</label>
                <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
            </div>
            <div class="col-md-2 d-grid">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            </div>
        </div>
    </form>

    {{-- Ringkasan --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-small text-center pe-3">
                            <i class="fas fa-arrow-down text-success"></i>
                        </div>
                        <div>
                            <p class="card-category mb-1">Total Pemasukan</p>
                            <h4 class="card-title">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-small text-center pe-3">
                            <i class="fas fa-arrow-up text-danger"></i>
                        </div>
                        <div>
                            <p class="card-category mb-1">Total Pengeluaran</p>
                            <h4 class="card-title">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon-small text-center pe-3">
                            <i class="fas fa-balance-scale text-primary"></i>
                        </div>
                        <div>
                            <p class="card-category mb-1">Laba / Rugi</p>
                            <h4 class="card-title">Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="row mb-3">
            <div class="col-md-2">
                <a href="{{ route('admin.keuangan.createPemasukan') }}" class="btn btn-success btn-sm w-100">
                    <i class="fa fa-plus"></i> Pemasukan
                </a>
            </div>
     </div>
    {{-- Tabel Pemasukan --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Data Pemasukan</div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemasukan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.keuangan.editPemasukan', $item->id_pemasukan) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.keuangan.destroyPemasukan', $item->id_pemasukan) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada pemasukan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
         <div class="row mb-3">
            <div class="col-md-2">
                <a href="{{ route('admin.keuangan.createPengeluaran') }}" class="btn btn-danger btn-sm w-100">
                    <i class="fa fa-plus"></i> Pengeluaran
                </a>
            </div>
         </div>
    {{-- Tabel Pengeluaran --}}
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">Data Pengeluaran</div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengeluaran as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.keuangan.editPengeluaran', $item->id_pengeluaran) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.keuangan.destroyPengeluaran', $item->id_pengeluaran) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada pengeluaran</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
