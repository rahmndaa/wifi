@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tambah Pelanggan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.pelanggan') }}">Pelanggan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.pelanggan.create') }}">Tambah</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Pelanggan</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pelanggan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" name="nama_pelanggan" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>No. WhatsApp</label>
                                        <input type="text" name="no_whatsapp" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Paket WiFi</label>
                                        <select name="id_paket" class="form-control" required>
                                            <option value="">-- Pilih Paket --</option>
                                            @foreach ($paket as $p)
                                                <option value="{{ $p->id_paket }}">{{ $p->nama_paket }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tanggal Gabung</label>
                                        <input type="date" name="tanggal_gabung" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Status Pelanggan</label>
                                        <select name="status_pelanggan" class="form-control" required>
                                            <option value="aktif">Aktif</option>
                                            <option value="arsip">Arsip</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start mt-3">
                                <a href="{{ route('admin.pelanggan') }}" class="btn btn-danger btn-sm me-2">Batal</a>
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
