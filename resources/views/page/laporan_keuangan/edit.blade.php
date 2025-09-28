@extends('layouts.admin-master')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">✏️ Edit Laporan Keuangan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.laporan_keuangan.update', $laporan->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" 
                           value="{{ old('tanggal', $laporan->tanggal) }}" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" 
                           value="{{ old('deskripsi', $laporan->deskripsi) }}" required>
                </div>

                {{-- Pemasukan --}}
                <div class="mb-3">
                    <label for="pemasukan" class="form-label">Pemasukan</label>
                    <input type="number" class="form-control" id="pemasukan" name="pemasukan" 
                           value="{{ old('pemasukan', $laporan->pemasukan) }}" min="0">
                </div>

                {{-- Pengeluaran --}}
                <div class="mb-3">
                    <label for="pengeluaran" class="form-label">Pengeluaran</label>
                    <input type="number" class="form-control" id="pengeluaran" name="pengeluaran" 
                           value="{{ old('pengeluaran', $laporan->pengeluaran) }}" min="0">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.laporan_keuangan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
