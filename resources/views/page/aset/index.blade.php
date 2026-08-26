@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        
        {{-- Header Halaman (Hanya Judul & Breadcrumbs) --}}
        <div class="page-header mb-3">
            <div class="d-flex align-items-center flex-wrap">
                <h3 class="fw-bold mb-3 me-3 text-dark">Data Aset</h3>
                <ul class="breadcrumbs mb-3 p-0 bg-transparent list-unstyled d-flex align-items-center m-0">
                    <li class="nav-home">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator px-2 text-muted">
                        <i class="icon-arrow-right fs-9"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.aset') }}" class="text-muted text-decoration-none">Aset</a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Statistik Ringkas Aset --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white border-start border-4 border-primary">
                    <div class="card-body p-3">
                        <div class="text-muted small fw-semibold">Total Aset</div>
                        <h4 class="fw-bold mb-0 mt-1 text-dark">{{ $aset->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white border-start border-4 border-success">
                    <div class="card-body p-3">
                        <div class="text-muted small fw-semibold">Tersedia</div>
                        <h4 class="fw-bold mb-0 mt-1 text-success">{{ $aset->where('status_aset', 'tersedia')->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white border-start border-4 border-warning">
                    <div class="card-body p-3">
                        <div class="text-muted small fw-semibold">Digunakan</div>
                        <h4 class="fw-bold mb-0 mt-1 text-warning">{{ $aset->where('status_aset', 'digunakan')->count() }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white border-start border-4 border-danger">
                    <div class="card-body p-3">
                        <div class="text-muted small fw-semibold">Rusak</div>
                        <h4 class="fw-bold mb-0 mt-1 text-danger">{{ $aset->where('status_aset', 'rusak')->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Form & Tombol Tambah Aset Sejajar --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
            <div class="card-body p-3 p-md-4">
                <form method="GET" action="{{ route('admin.aset') }}">
                    <div class="row align-items-end g-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-secondary small">Filter Berdasarkan Status</label>
                            <select name="status_aset" class="form-select rounded-3 fs-8 bg-light border-0 py-2">
                                <option value="">Semua Status Aset</option>
                                <option value="tersedia" {{ request('status_aset') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="digunakan" {{ request('status_aset') == 'digunakan' ? 'selected' : '' }}>Digunakan</option>
                                <option value="rusak" {{ request('status_aset') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-8 d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary btn-sm rounded-3 shadow-sm px-3 py-2 fw-semibold">
                                <i class="fa fa-search me-1"></i> Terapkan Filter
                            </button>
                            <a href="{{ route('admin.aset.create') }}" class="btn btn-success btn-sm rounded-3 px-3 py-2 shadow-sm fw-semibold">
                                <i class="fa fa-plus me-1"></i> Tambah Aset Baru
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tampilan Card Khusus Mobile --}}
        <div class="d-block d-md-none">
            @forelse ($aset as $a)
            <div class="card border-0 shadow-sm mb-3 rounded-4 bg-white">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <span class="text-dark fs-9 fw-bold">{{ $loop->iteration }}</span>
                            <h6 class="fw-bold mb-0 text-dark mt-1">{{ $a->nama_aset }}</h6>
                        </div>
                        <div>
                            @if($a->status_aset == 'tersedia')
                                <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold fs-9 rounded-pill">Tersedia</span>
                            @elseif($a->status_aset == 'digunakan')
                                <span class="badge bg-warning-subtle text-warning px-2 py-1 fw-bold fs-9 rounded-pill">Digunakan</span>
                            @elseif($a->status_aset == 'rusak')
                                <span class="badge bg-danger-subtle text-danger px-2 py-1 fw-bold fs-9 rounded-pill">Rusak</span>
                            @endif
                        </div>
                    </div>

                    <div class="bg-light p-3 rounded-3 small text-secondary mb-3">
                        <div class="d-flex justify-content-between py-1 border-bottom border-2 border-white">
                            <span class="fw-semibold">Tipe</span>
                            <span>{{ $a->tipe_aset }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom border-2 border-white">
                            <span class="fw-semibold">Merk</span>
                            <span>{{ $a->merk ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 pt-1">
                            <span class="fw-semibold">Digunakan Oleh</span>
                            <span class="text-dark fw-medium">{{ $a->pelanggan->nama_pelanggan ?? '-' }}</span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.aset.show', $a->id_aset) }}" class="btn btn-light btn-sm py-1 px-3 text-primary border-0 bg-primary-subtle rounded-3 fw-semibold" title="Detail">
                            <i class="fa fa-eye me-1"></i> Detail
                        </a>
                        <a href="{{ route('admin.aset.edit', $a->id_aset) }}" class="btn btn-light btn-sm py-1 px-3 text-warning border-0 bg-warning-subtle rounded-3 fw-semibold" title="Edit">
                            <i class="fa fa-edit me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="card border-0 shadow-sm rounded-4 p-4 text-center text-muted small bg-white">Belum ada data aset yang tersedia.</div>
            @endforelse
        </div>

        {{-- Tabel Normal (Desktop) --}}
        <div class="card border-0 shadow-sm rounded-4 d-none d-md-block overflow-hidden bg-white">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="no-sort-table">
                        <thead class="bg-light text-uppercase fs-8 text-secondary">
                            <tr>
                                <th class="py-3 px-4 text-start">No</th>
                                <th class="py-3 px-3 text-start">Nama Aset</th>
                                <th class="py-3 px-3 text-start">Tipe</th>
                                <th class="py-3 px-3 text-start">Merk</th>
                                <th class="py-3 px-3 text-start">Digunakan Oleh</th>
                                <th class="py-3 px-3 text-start">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($aset as $a)
                            <tr>
                                <td class="py-3 px-4 fw-bold text-dark text-start">{{ $loop->iteration }}</td>
                                <td class="py-3 px-3 fw-semibold text-dark text-start">{{ $a->nama_aset }}</td>
                                <td class="py-3 px-3 text-secondary text-start">{{ $a->tipe_aset }}</td>
                                <td class="py-3 px-3 text-secondary text-start">{{ $a->merk ?? '-' }}</td>
                                <td class="py-3 px-3 text-dark fw-medium text-start">{{ $a->pelanggan->nama_pelanggan ?? '-' }}</td>
                                <td class="py-3 px-3 text-start">
                                    @if($a->status_aset == 'tersedia')
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold fs-9">Tersedia</span>
                                    @elseif($a->status_aset == 'digunakan')
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-bold fs-9">Digunakan</span>
                                    @elseif($a->status_aset == 'rusak')
                                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold fs-9">Rusak</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.aset.show', $a->id_aset) }}" class="btn btn-primary-subtle text-primary btn-sm px-2 border-0 rounded-3" data-bs-toggle="tooltip" title="Detail Aset">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.aset.edit', $a->id_aset) }}" class="btn btn-warning-subtle text-warning btn-sm px-2 border-0 rounded-3" data-bs-toggle="tooltip" title="Edit Aset">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">Belum ada data aset yang tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- CSS Tambahan untuk Memaksa Menghilangkan Ikon Panah Sortir bawaan Template/DataTables --}}
<style>
    #no-sort-table th::before,
    #no-sort-table th::after {
        display: none !important;
        content: "" !important;
    }
    #no-sort-table th {
        pointer-events: none !important;
        background-image: none !important;
    }
</style>

@endsection