@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Pengeluaran</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.keuangan.index') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.keuangan.index') }}">Laporan Keuangan</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">Edit Pengeluaran</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.keuangan.updatePengeluaran', $pengeluaran->id_pengeluaran) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Input Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input 
                            type="date" 
                            name="tanggal" 
                            class="form-control" 
                            value="{{ old('tanggal', $pengeluaran->tanggal) }}"
                        >
                        @error('tanggal') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    {{-- Input Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input 
                            type="text" 
                            name="keterangan" 
                            class="form-control" 
                            placeholder="Deskripsi" 
                            value="{{ old('keterangan', $pengeluaran->keterangan) }}"
                        >
                        @error('keterangan') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    {{-- Input Jumlah --}}
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input 
                            type="number" 
                            name="jumlah" 
                            id="jumlah_edit_pengeluaran" 
                            class="form-control" 
                            placeholder="250000" 
                            value="{{ old('jumlah', $pengeluaran->jumlah) }}" 
                            required
                        >
                        <small id="error_pengeluaran" class="text-danger d-none">Nilai tidak boleh negatif!</small>
                        @error('jumlah') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    {{-- Script Validasi Nilai Negatif --}}
                    <script>
                        document.getElementById("jumlah_edit_pengeluaran").addEventListener("input", function() {
                            const errorMsg = document.getElementById("error_pengeluaran");
                            if (this.value < 0) {
                                errorMsg.classList.remove("d-none");
                            } else {
                                errorMsg.classList.add("d-none");
                            }
                        });
                    </script>

                    {{-- Tombol Aksi --}}
                    <a href="{{ route('admin.keuangan.index') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
