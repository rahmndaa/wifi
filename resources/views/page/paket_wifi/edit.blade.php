
@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-md-6">
                    <h3 class="mb-3">Edit Paket WiFi</h3>
                </div>
            </div>
    <form action="{{ route('admin.paket_wifi.update', $paket->id_paket) }}" method="POST" class="card card-body">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Paket:</label>
            <input type="text" name="nama_paket" value="{{ $paket->nama_paket }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Kecepatan:</label>
            <input type="text" name="kecepatan" value="{{ $paket->kecepatan }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="number" name="harga" value="{{ $paket->harga }}" class="form-control" required>
        </div>
       
        <div class="d-flex justify-content mt-3">
                <a href="{{ route('admin.paket_wifi') }}" class="btn btn-danger mr-2 btn-sm">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
    </form>
    </section>
</div>
@endsection
