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
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <strong>Data pelanggan belum dapat disimpan.</strong>
                                <ul class="mb-0 mt-2 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.pelanggan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Nama Pelanggan</label>
                                        <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>No. WhatsApp</label>
                                        <input type="text" name="no_whatsapp" class="form-control @error('no_whatsapp') is-invalid @enderror" value="{{ old('no_whatsapp') }}"
                                            required
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" >
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Paket WiFi</label>
                                        <select name="id_paket" class="form-control @error('id_paket') is-invalid @enderror" required>
                                            <option value="">-- Pilih Paket --</option>
                                            @foreach ($paket as $p)
                                                <option value="{{ $p->id_paket }}" @selected(old('id_paket') == $p->id_paket)>{{ $p->nama_paket }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tanggal Gabung</label>
                                        <input type="date" name="tanggal_gabung" class="form-control @error('tanggal_gabung') is-invalid @enderror" value="{{ old('tanggal_gabung') }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Status Pelanggan</label>
                                        <select name="status_pelanggan" class="form-control @error('status_pelanggan') is-invalid @enderror" required>
                                            <option value="aktif" @selected(old('status_pelanggan', 'aktif') === 'aktif')>Aktif</option>
                                            <option value="arsip" @selected(old('status_pelanggan') === 'arsip')>Arsip</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" required>
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
