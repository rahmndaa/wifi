@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Paket WiFi</h3>
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
      </ul>
    </div>

    <div class="row mb-3">
      <div class="col-md-2">
        <a href="{{ route('admin.paket_wifi.create') }}" class="btn btn-primary btn-sm w-100">
          <i class="fa fa-plus"></i> Tambah Paket
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body table-responsive">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($paket as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->nama_paket }}</td>
                  <td class="text-center">
                      <div class="form-button-action">
                          <a href="{{ route('admin.paket_wifi.show', $p->id_paket) }}" class="btn btn-link btn-primary btn-sm" data-bs-toggle="tooltip" title="Lihat Paket">
                              <i class="fa fa-eye fa-lg"></i>
                          </a>
                          <a href="{{ route('admin.paket_wifi.edit', $p->id_paket) }}" class="btn btn-link btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Paket">
                              <i class="fa fa-edit fa-lg"></i>
                          </a>
                          <form action="{{ route('admin.paket_wifi.destroy', $p->id_paket) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-link btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus Paket">
                                  <i class="fa fa-times fa-lg"></i>
                              </button>
                          </form>
                      </div>
                  </td>

                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
