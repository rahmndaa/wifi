@extends('layouts.admin-master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Data ODC</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.odc.update', $odc->id_odc) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_odc" class="form-label">Nama ODC</label>
                    <input type="text" class="form-control" id="nama_odc" name="nama_odc" value="{{ $odc->nama_odc }}" required>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <textarea class="form-control" id="lokasi" name="lokasi" rows="3" required>{{ $odc->lokasi }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.odc.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection