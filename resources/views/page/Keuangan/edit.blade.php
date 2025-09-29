@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Edit Pemasukan</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="{{ route('admin.dashboard') }}">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ route('admin.keuangan.index') }}">Keuangan</a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Edit</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Form Edit Pemasukan</div>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.keuangan.updatePemasukan', $pemasukan->id_pemasukan) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $pemasukan->tanggal }}" required>
              </div>
              <div class="form-group mb-3">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control" value="{{ $pemasukan->keterangan }}" required>
              </div>
              <div class="form-group mb-4">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{ $pemasukan->jumlah }}" required>
              </div>
              <div class="d-flex justify-content-start">
                <a href="{{ route('admin.keuangan.index') }}" class="btn btn-danger btn-sm me-2">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
