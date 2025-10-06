@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Pemasukan</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.keuangan.updatePemasukan', $pemasukan->id_pemasukan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $pemasukan->tanggal) }}">
                        @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', $pemasukan->keterangan) }}">
                        @error('keterangan') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                   <div class="mb-3">
    <label class="form-label">Jumlah</label>
    <input type="number" name="jumlah" id="jumlah_edit_pemasukan" class="form-control" 
           value="{{ old('jumlah', $pemasukan->jumlah) }}" 
           min="0" required>
    @error('jumlah') 
        <small class="text-danger">{{ $message }}</small> 
    @enderror
</div>

<script>
document.getElementById("jumlah_edit_pemasukan").addEventListener("input", function() {
    if (this.value < 0) {
        this.value = Math.abs(this.value); // otomatis ubah ke positif
    }
});
</script>


                    <a href="{{ route('admin.keuangan.index') }}" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
