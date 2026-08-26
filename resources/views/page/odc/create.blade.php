@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        
        {{-- Header Halaman --}}
        <div class="page-header mb-3">
            <div class="d-flex align-items-center flex-wrap">
                <h3 class="fw-bold mb-3 me-3 text-dark">Tambah Data ODC</h3>
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
                        <a href="{{ route('admin.odc.index') }}" class="text-muted text-decoration-none">ODC</a>
                    </li>
                    <li class="separator px-2 text-muted">
                        <i class="icon-arrow-right fs-9"></i>
                    </li>
                    <li class="nav-item">
                        <span class="text-dark">Tambah</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Form Card ODC --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded-4 bg-white">
                    <div class="card-body p-4">
                        
                        <form action="{{ route('admin.odc.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_odc" class="form-label fw-semibold text-secondary small">Nama ODC</label>
                                <input type="text" class="form-control rounded-3 bg-light border-0 py-2 @error('nama_odc') is-invalid @enderror" id="nama_odc" name="nama_odc" value="{{ old('nama_odc') }}" placeholder="Contoh: ODC-BWI-01" required>
                                @error('nama_odc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lokasi" class="form-label fw-semibold text-secondary small">Lokasi</label>
                                <input type="text" class="form-control rounded-3 bg-light border-0 py-2 @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Masukkan lokasi penempatan ODC..." required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kapasitas" class="form-label fw-semibold text-secondary small">Kapasitas</label>
                                <input type="number" class="form-control rounded-3 bg-light border-0 py-2 @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" placeholder="Contoh: 72" required>
                                @error('kapasitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="keterangan" class="form-label fw-semibold text-secondary small">Keterangan (Opsional)</label>
                                <textarea class="form-control rounded-3 bg-light border-0 py-2 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Tambahkan keterangan kondisi atau catatan...">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.odc.index') }}" class="btn btn-secondary btn-sm rounded-3 px-3 py-2 fw-semibold">
                                    <i class="fa fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm rounded-3 px-3 py-2 fw-semibold shadow-sm">
                                    <i class="fa fa-save me-1"></i> Simpan Data
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection