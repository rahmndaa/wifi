@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Paket WiFi</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Paket</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="card-title">Form Edit Paket</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.paket_wifi.update', $paket->id_paket) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label>Nama Paket:</label>
                                <input type="text" name="nama_paket" value="{{ $paket->nama_paket }}" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Kecepatan:</label>
                                <input type="text" name="kecepatan" value="{{ $paket->kecepatan }}" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Harga:</label>
                                <input type="number" name="harga" value="{{ $paket->harga }}" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-start mt-3">
                                <a href="{{ route('admin.paket_wifi') }}" class="btn btn-danger btn-sm me-2">Batal</a>
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
