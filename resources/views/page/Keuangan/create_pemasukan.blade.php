@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Input Pemasukan</h3>
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
                <li class="nav-item">Input Pemasukan</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.keuangan.storePemasukan') }}" method="POST">
                    @csrf

                    {{-- Input Tanggal --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input 
                            type="date" 
                            name="tanggal" 
                            class="form-control" 
                            value="{{ old('tanggal') }}"
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
                            value="{{ old('keterangan') }}"
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
                            id="jumlah" 
                            class="form-control" 
                            placeholder="250000" 
                            value="{{ old('jumlah') }}" 
                            required
                        >
                        <small id="jumlah-error" class="text-danger d-none">Nilai tidak boleh negatif!</small>
                        @error('jumlah') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    {{-- Script Validasi Input Negatif --}}
                    <script>
                        document.getElementById("jumlah").addEventListener("input", function() {
                            const errorMsg = document.getElementById("jumlah-error");
                            if (this.value < 0) {
                                errorMsg.classList.remove("d-none"); // tampilkan pesan
                            } else {
                                errorMsg.classList.add("d-none"); // sembunyikan pesan
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
