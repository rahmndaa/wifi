@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    
    {{-- Header Halaman Disamakan Persis Dashboard --}}
    <div class="page-header">
      <h3 class="fw-bold mb-3">Paket</h3>
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
          <a href="{{ route('admin.paket_wifi') }}">Paket</a>
        </li>
      </ul>
    </div>

    {{-- Tombol Tambah Paket --}}
    <div class="row mb-3">
      <div class="col-6 col-md-3 col-lg-2">
        <a href="{{ route('admin.paket_wifi.create') }}" class="btn btn-primary btn-sm w-100 py-2 shadow-sm">
          <i class="fa fa-plus me-1"></i> Tambah Paket
        </a>
      </div>
    </div>

    {{-- Tampilan Card Khusus Mobile (Agar Tidak Geser Sama Sekali) --}}
    <div class="d-block d-md-none">
      @foreach ($paket as $p)
      <div class="card border-0 shadow-sm mb-3 rounded-3">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
              <span class="text-muted fs-8 fw-bold">No. {{ $loop->iteration }}</span>
              <h6 class="fw-bold mb-0 text-dark mt-1">{{ $p->nama_paket }}</h6>
            </div>
          </div>
          <hr class="my-2 text-muted opacity-25">
          <div class="d-flex justify-content-end gap-1">
            <a href="{{ route('admin.paket_wifi.show', $p->id_paket) }}" class="btn btn-primary btn-sm py-1 px-2" title="Lihat">
              <i class="fa fa-eye"></i> Detail
            </a>
            <a href="{{ route('admin.paket_wifi.edit', $p->id_paket) }}" class="btn btn-warning btn-sm py-1 px-2 text-white" title="Edit">
              <i class="fa fa-edit"></i> Edit
            </a>
            <form id="form-hapus-mobile-{{ $p->id_paket }}" action="{{ route('admin.paket_wifi.destroy', $p->id_paket) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="button" class="btn btn-danger btn-sm py-1 px-2 btn-hapus" data-id="{{ $p->id_paket }}" title="Hapus">
                <i class="fa fa-times"></i> Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Tabel Normal (Hanya Tampil di Tablet & Laptop / d-none d-md-block) --}}
    <div class="card border-0 shadow-sm rounded-4 d-none d-md-block">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase fs-7">
              <tr>
                <th class="py-3 px-3">No</th>
                <th class="py-3 px-3">Nama Paket</th>
                <th class="py-3 px-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($paket as $p)
              <tr>
                <td class="py-3 px-3 fw-bold">{{ $loop->iteration }}</td>
                <td class="py-3 px-3 fw-semibold text-dark">{{ $p->nama_paket }}</td>
                <td class="py-3 px-3 text-center">
                  <div class="d-flex justify-content-center gap-1">
                    <a href="{{ route('admin.paket_wifi.show', $p->id_paket) }}" class="btn btn-icon btn-round btn-primary btn-sm shadow-sm" data-bs-toggle="tooltip" title="Lihat Paket">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.paket_wifi.edit', $p->id_paket) }}" class="btn btn-icon btn-round btn-warning btn-sm shadow-sm" data-bs-toggle="tooltip" title="Edit Paket">
                      <i class="fa fa-edit"></i>
                    </a>
                    <form id="form-hapus-{{ $p->id_paket }}" action="{{ route('admin.paket_wifi.destroy', $p->id_paket) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-icon btn-round btn-danger btn-sm shadow-sm btn-hapus" data-id="{{ $p->id_paket }}" data-bs-toggle="tooltip" title="Hapus Paket">
                        <i class="fa fa-times"></i>
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
@endsection