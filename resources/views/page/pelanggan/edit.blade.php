@extends('layouts.admin-master')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
             <h3 class="mb-3">Edit Pelanggan</h3>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pelanggan:</label>
                                            <input type="text" name="nama_pelanggan" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Username:</label>
                                            <input type="text" name="username" class="form-control" value="{{ $pelanggan->username }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>No. WhatsApp:</label>
                                            <input type="text" name="no_whatsapp" class="form-control" value="{{ $pelanggan->no_whatsapp }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
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

                                        <div class="form-group">
                                            <label>Tanggal Gabung:</label>
                                            <input type="date" name="tanggal_gabung" class="form-control" value="{{ $pelanggan->tanggal_gabung }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Status Pelanggan:</label>
                                            <select name="status_pelanggan" class="form-control" required>
                                                <option value="aktif" {{ $pelanggan->status_pelanggan == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="arsip" {{ $pelanggan->status_pelanggan == 'arsip' ? 'selected' : '' }}>Arsip</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content mt-3">
                                    <a href="{{ route('admin.pelanggan') }}" class="btn btn-danger mr-2 btn-sm">Batal</a>
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
