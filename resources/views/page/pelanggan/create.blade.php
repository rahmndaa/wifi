@extends('layouts.admin-master')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
             <h3 class="mb-3">Tambah Pelanggan</h3>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.pelanggan.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pelanggan:</label>
                                            <input type="text" name="nama_pelanggan" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Username:</label>
                                            <input type="text" name="username" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Password:</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>No. WhatsApp:</label>
                                            <input type="text" name="no_whatsapp" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Paket WiFi:</label>
                                            <select name="id_paket" class="form-control" required>
                                                <option value="">-- Pilih Paket --</option>
                                                @foreach ($paket as $p)
                                                    <option value="{{ $p->id_paket }}">{{ $p->nama_paket }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Gabung:</label>
                                            <input type="date" name="tanggal_gabung" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Status Pelanggan:</label>
                                            <select name="status_pelanggan" class="form-control" required>
                                                <option value="aktif">Aktif</option>
                                                <option value="arsip">Arsip</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <a href="{{ route('admin.pelanggan') }}" class="btn btn-secondary mr-2">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
