@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        
        <!-- Page Header -->
        <div class="page-header">
            <h3 class="fw-bold mb-3">Daftar ODC</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.odc.index') }}">ODC</a></li>
            </ul>
        </div>

        {{-- Tombol Tambah ODC --}}
        <div class="row mb-3">
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('admin.odc.create') }}" class="btn btn-primary btn-sm w-100 py-2 shadow-sm">
                    <i class="fa fa-plus me-1"></i> Tambah ODC
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tampilan Card Khusus Mobile --}}
        <div class="d-block d-md-none">
            @forelse ($odcs as $odc)
            <div class="card border-0 shadow-sm mb-3 rounded-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <span class="text-muted fs-8 fw-bold">No. {{ $loop->iteration }}</span>
                            <h6 class="fw-bold mb-0 text-dark mt-1">{{ $odc->nama_odc }}</h6>
                        </div>
                    </div>

                    <div class="small text-secondary mb-3">
                        <div class="row g-1">
                            <div class="col-4 fw-semibold">Lokasi</div>
                            <div class="col-8">: {{ $odc->lokasi }}</div>
                        </div>
                    </div>

                    <hr class="my-2 text-muted opacity-25">

                    <div class="d-flex justify-content-end gap-1">
                        <a href="{{ route('admin.odc.show', $odc->id_odc) }}" class="btn btn-primary btn-sm py-1 px-2" title="Detail">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                        <a href="{{ route('admin.odc.edit', $odc->id_odc) }}" class="btn btn-warning btn-sm py-1 px-2 text-white" title="Edit">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.odc.destroy', $odc->id_odc) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ODC ini?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm py-1 px-2" title="Hapus">
                                <i class="fa fa-times"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="card border-0 shadow-sm rounded-3 p-4 text-center text-muted small">Belum ada data ODC yang tersedia.</div>
            @endforelse
        </div>

        {{-- Tampilan Desktop (Tabel Normal) --}}
        <div class="card border-0 shadow-sm rounded-4 d-none d-md-block">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-uppercase fs-7">
                            <tr>
                                <th class="py-3 px-3">No</th>
                                <th class="py-3 px-3">Nama ODC</th>
                                <th class="py-3 px-3">Lokasi</th>
                                <th class="py-3 px-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($odcs as $odc)
                            <tr>
                                <td class="py-3 px-3 fw-bold">{{ $loop->iteration }}</td>
                                <td class="py-3 px-3 fw-semibold text-dark">{{ $odc->nama_odc }}</td>
                                <td class="py-3 px-3">{{ $odc->lokasi }}</td>
                                <td class="py-3 px-3 text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.odc.show', $odc->id_odc) }}" class="btn btn-icon btn-round btn-primary btn-sm shadow-sm" data-bs-toggle="tooltip" title="Detail ODC">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.odc.edit', $odc->id_odc) }}" class="btn btn-icon btn-round btn-warning btn-sm shadow-sm" data-bs-toggle="tooltip" title="Edit ODC">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.odc.destroy', $odc->id_odc) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ODC ini?')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-round btn-danger btn-sm shadow-sm" data-bs-toggle="tooltip" title="Hapus ODC">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data ODC yang tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection