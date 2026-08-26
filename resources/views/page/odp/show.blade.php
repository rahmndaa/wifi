@extends('layouts.admin-master')

@section('content')
<div class="container-fluid">
    
    {{-- Header & Informasi ODP --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Detail ODP: {{ $odp->nama_odp }}</h3>
            <p class="text-muted mb-0">
                ODC Induk: <strong>{{ $odp->odc->nama_odc ?? '-' }}</strong> | 
                Lokasi: {{ $odp->lokasi }} | 
                Kapasitas: {{ $odp->kapasitas }} Port
            </p>
        </div>
        <div>
            <a href="{{ route('admin.odc.show', $odp->id_odc) }}" class="btn btn-secondary btn-sm rounded-3 px-3 py-2 fw-semibold">
                <i class="fa fa-arrow-left me-1"></i> Kembali ke ODC
            </a>
        </div>
    </div>

    {{-- Notifikasi Sukses / Error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        {{-- Kolom Kiri: Form Tambah Pelanggan ke ODP --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Tambah Pelanggan</h5>
                    
                    <form action="{{ route('admin.odp.storePelanggan', $odp->id_odp) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label fw-semibold small">Nama Pelanggan</label>
                            <input type="text" class="form-control rounded-3 bg-light border-0 py-2 @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama pelanggan..." value="{{ old('nama_pelanggan') }}" required>
                            @error('nama_pelanggan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="paket" class="form-label fw-semibold small">Paket Internet</label>
                            <input type="text" class="form-control rounded-3 bg-light border-0 py-2 @error('paket') is-invalid @enderror" id="paket" name="paket" placeholder="Contoh: Paket 10 Mbps / 20 Mbps" value="{{ old('paket') }}" required>
                            @error('paket')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm rounded-3 px-3 py-2 fw-semibold shadow-sm w-100">
                                <i class="fa fa-plus me-1"></i> Tambahkan ke ODP
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Daftar Pelanggan --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Daftar Pelanggan Terhubung</h5>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="text-uppercase fs-7 text-secondary">
                                    <th>Nama Pelanggan</th>
                                    <th>Paket</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($odp->pelanggan as $p)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $p->nama_pelanggan }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1">{{ $p->paket ?? '-' }}</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.odp.hapusPelanggan', $p->id_pelanggan ?? $p->id) }}" method="POST" class="d-inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-3 px-2 py-1" onclick="return confirm('Yakin ingin mengeluarkan pelanggan ini dari ODP?')">
                                                <i class="fa fa-trash me-1"></i> Keluarkan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada pelanggan yang terhubung pada ODP ini.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection