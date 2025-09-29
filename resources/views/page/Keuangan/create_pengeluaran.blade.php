@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Input Pengeluaran</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.keuangan.index') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.keuangan.index') }}">Laporan Keuangan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">Input Pengeluaran</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.keuangan.storePengeluaran') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                        @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Deskripsi" value="{{ old('keterangan') }}">
                        @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="250000" value="{{ old('jumlah') }}">
                        @error('jumlah') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <a href="{{ route('admin.keuangan.index') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
