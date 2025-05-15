@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tambah Tagihan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Tagihan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Tambah</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Tagihan</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.tagihan.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label>Pelanggan</label>
                                <select name="id_pelanggan" class="form-control" required>
                                    @foreach($pelanggan as $p)
                                        <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Periode Bulan</label>
                                <input type="number" name="periode_bulan" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Periode Tahun</label>
                                <input type="number" name="periode_tahun" class="form-control" required>
                            </div>


                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="belum lunas">Belum Lunas</option>
                                    <option value="lunas">Lunas</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-start mt-3">
                                <a href="{{ route('admin.tagihan') }}" class="btn btn-danger btn-sm me-2">Kembali</a>
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
