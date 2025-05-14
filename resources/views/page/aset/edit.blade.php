@extends('layouts.admin-master')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Aset</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Aset</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('admin.aset.update', $aset->id_aset) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Nama Aset:</label>
                                        <input type="text" name="nama_aset" class="form-control" value="{{ $aset->nama_aset }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tipe Aset:</label>
                                        <input type="text" name="tipe_aset" class="form-control" value="{{ $aset->tipe_aset }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Merk:</label>
                                        <input type="text" name="merk" class="form-control" value="{{ $aset->merk }}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Status:</label>
                                        <select name="status_aset" class="form-control" required>
                                            <option value="tersedia" {{ $aset->status_aset == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="digunakan" {{ $aset->status_aset == 'digunakan' ? 'selected' : '' }}>Digunakan</option>
                                            <option value="rusak" {{ $aset->status_aset == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Digunakan (Pelanggan):</label>
                                        <select name="id_pelanggan" class="form-control">
                                            <option value="">-- Tidak Dipilih --</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}" {{ $aset->id_pelanggan == $p->id_pelanggan ? 'selected' : '' }}>
                                                    {{ $p->nama_pelanggan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start mt-4">
                                <a href="{{ route('admin.aset') }}" class="btn btn-danger btn-sm me-2">Batal</a>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
