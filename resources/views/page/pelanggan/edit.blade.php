@extends('layouts.admin-master')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Pelanggan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.pelanggan') }}">Pelanggan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.pelanggan.edit', $pelanggan->id_pelanggan) }}">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('admin.pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Nama Pelanggan:</label>
                                        <input type="text" name="nama_pelanggan" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Username:</label>
                                        <input type="text" name="username" class="form-control" value="{{ $pelanggan->username }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Password: <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>No. WhatsApp:</label>
                                        <input type="text" name="no_whatsapp" class="form-control" 
                                            value="{{ $pelanggan->no_whatsapp }}" 
                                            required maxlength="15" minlength="10" 
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Paket WiFi:</label>
                                        <select name="id_paket" class="form-control" required>
                                            <option value="">-- Pilih Paket --</option>
                                            @foreach ($paket as $p)
                                                <option value="{{ $p->id_paket }}" {{ $pelanggan->id_paket == $p->id_paket ? 'selected' : '' }}>
                                                    {{ $p->nama_paket }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Tanggal Gabung:</label>
                                        <input type="date" name="tanggal_gabung" class="form-control" value="{{ $pelanggan->tanggal_gabung }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label>Status Pelanggan:</label>
                                        <select name="status_pelanggan" class="form-control" required>
                                            <option value="aktif" {{ $pelanggan->status_pelanggan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="arsip" {{ $pelanggan->status_pelanggan == 'arsip' ? 'selected' : '' }}>Arsip</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start mt-4">
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
