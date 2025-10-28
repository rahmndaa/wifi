@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Tagihan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.tagihan') }}">Tagihan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.tagihan.edit', $tagihan->id_tagihan) }}">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('admin.tagihan.update', $tagihan->id_tagihan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Pilih Pelanggan --}}
                            <div class="form-group mb-3">
                                <label>Pelanggan</label>
                                <select name="id_pelanggan" class="form-control" required>
                                    @foreach($pelanggan as $p)
                                        <option value="{{ $p->id_pelanggan }}" {{ $tagihan->id_pelanggan == $p->id_pelanggan ? 'selected' : '' }}>
                                            {{ $p->nama_pelanggan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_pelanggan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Periode Bulan --}}
                            <div class="form-group mb-3">
                                <label>Periode Bulan</label>
                                <input 
                                    type="number" 
                                    name="periode_bulan" 
                                    class="form-control" 
                                    value="{{ old('periode_bulan', $tagihan->periode_bulan) }}" 
                                    required
                                >
                                @error('periode_bulan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Periode Tahun --}}
                            <div class="form-group mb-3">
                                <label>Periode Tahun</label>
                                <input 
                                    type="number" 
                                    name="periode_tahun" 
                                    class="form-control" 
                                    value="{{ old('periode_tahun', $tagihan->periode_tahun) }}" 
                                    required
                                >
                                @error('periode_tahun')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Total Tagihan --}}
                            <div class="form-group mb-3">
                                <label>Total Tagihan</label>
                                <input 
                                    type="number" 
                                    name="total_tagihan" 
                                    id="total_tagihan" 
                                    class="form-control" 
                                    value="{{ old('total_tagihan', $tagihan->total_tagihan) }}" 
                                    required
                                >
                                <small id="total-error" class="text-danger d-none">Nilai tidak boleh nol atau negatif!</small>
                                @error('total_tagihan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Script Validasi Input Negatif --}}
                            <script>
                                document.getElementById("total_tagihan").addEventListener("input", function() {
                                    const errorMsg = document.getElementById("total-error");
                                    if (this.value <= 0) {
                                        errorMsg.classList.remove("d-none");
                                    } else {
                                        errorMsg.classList.add("d-none");
                                    }
                                });
                            </script>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-start mt-4">
                                <a href="{{ route('admin.tagihan') }}" class="btn btn-danger btn-sm me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
