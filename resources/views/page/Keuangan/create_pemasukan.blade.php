@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Input Pemasukan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.keuangan.index') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.keuangan.index') }}">Laporan Keuangan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">Input Pemasukan</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.keuangan.storePemasukan') }}" method="POST">
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
    <input type="number" name="jumlah" id="jumlah" class="form-control" 
           placeholder="250000" 
           value="{{ old('jumlah') }}" 
           min="0" required>
    @error('jumlah') 
        <small class="text-danger">{{ $message }}</small> 
    @enderror
</div>

{{-- Opsional: untuk jaga-jaga kalau user tetap ketik tanda minus --}}
<script>
document.getElementById("jumlah").addEventListener("input", function() {
    if (this.value < 0) {
        this.value = Math.abs(this.value); // otomatis ubah ke positif
    }
});
</script>


                    <!-- {{-- Kalau mau ada jenis pembayaran, tinggal tambah field di model dan migrasi --}}
                    {{-- <div class="mb-3">
                        <label class="form-label">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran" class="form-control">
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div> --}} -->

                    <a href="{{ route('admin.keuangan.index') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
