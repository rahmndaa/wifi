@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Tambah Paket WiFi</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Paket WiFi</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Tambah</a>
        </li>
      </ul>
    </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Form Tambah Paket</div>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.paket_wifi.store') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label>Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" required>
              </div>
              <div class="form-group mb-3">
                <label>Kecepatan</label>
                <input type="text" name="kecepatan" class="form-control" required>
              </div>
              <div class="form-group mb-4">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
              </div>
              <div class="d-flex justify-content-start">
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
