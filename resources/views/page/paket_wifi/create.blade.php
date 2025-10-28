@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Tambah Paket WiFi</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ route('admin.dashboard') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.paket_wifi') }}">Paket WiFi</a>
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
            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('admin.paket_wifi.store') }}" method="POST">
              @csrf
              <div class="form-group mb-3">
                <label>Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket') }}" required>
              </div>
              <div class="form-group mb-3">
                <label>Kecepatan</label>
                <input type="text" name="kecepatan" class="form-control" value="{{ old('kecepatan') }}" required>
              </div>
              <div class="form-group mb-4">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" min="1" required>
                <small class="text-muted">Harga tidak boleh 0 atau negatif.</small>
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
