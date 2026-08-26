@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    
    {{-- Header Halaman Disamakan Persis Dashboard --}}
    <div class="page-header">
      <h3 class="fw-bold mb-3">Pelanggan</h3>
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
          <a href="{{ route('admin.pelanggan') }}">Pelanggan</a>
        </li>
      </ul>
    </div>

    {{-- Tombol Tambah Pelanggan --}}
   <div class="row mb-3">
      <div class="col-12 col-sm-auto">
        <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary btn-sm py-2 px-3 shadow-sm w-100 w-sm-auto">
          <i class="fa fa-plus me-1"></i> Tambah Pelanggan
        </a>
      </div>
    </div>

    {{-- Tampilan Card Khusus Mobile (Agar Tidak Geser Sama Sekali) --}}
    <div class="d-block d-md-none">
      @foreach ($pelanggan as $p)
      <div class="card border-0 shadow-sm mb-3 rounded-3">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
              <h6 class="fw-bold mb-1 text-dark">{{ $p->nama_pelanggan }}</h6>
              <span class="text-muted fs-8">Username: {{ $p->username }}</span><br>
              <span class="text-muted fs-8">WA: {{ $p->no_whatsapp }}</span><br>
              <span class="badge bg-secondary-subtle text-secondary mt-1">Paket: {{ $p->paketwifi->nama_paket ?? '-' }}</span>
            </div>
            <div>
              @if ($p->status_pelanggan == 'aktif')
                <span class="badge bg-success-subtle text-success px-2 py-1">Aktif</span>
              @else
                <span class="badge bg-danger-subtle text-danger px-2 py-1">Arsip</span>
              @endif
            </div>
          </div>
          <hr class="my-2 text-muted opacity-25">
          <div class="d-flex justify-content-end gap-1">
            <a href="{{ route('admin.pelanggan.show', $p->id_pelanggan) }}" class="btn btn-primary btn-sm py-1 px-2" title="Detail">
              <i class="fa fa-eye"></i> Detail
            </a>
            <a href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-warning btn-sm py-1 px-2 text-white" title="Edit">
              <i class="fa fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.pelanggan.destroy', $p->id_pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm py-1 px-2" title="Hapus">
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
                <th class="py-3 px-3">ID</th>
                <th class="py-3 px-3">Nama</th>
                <th class="py-3 px-3">Username</th>
                <th class="py-3 px-3">WhatsApp</th>
                <th class="py-3 px-3">Paket</th>
                <th class="py-3 px-3">Status</th>
                <th class="py-3 px-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pelanggan as $p)
              <tr>
                <td class="py-3 px-3 fw-bold">{{ $loop->iteration }}</td>
                <td class="py-3 px-3 fw-semibold text-dark">{{ $p->nama_pelanggan }}</td>
                <td class="py-3 px-3">{{ $p->username }}</td>
                <td class="py-3 px-3">{{ $p->no_whatsapp }}</td>
                <td class="py-3 px-3">{{ $p->paketwifi->nama_paket ?? '-' }}</td>
                <td class="py-3 px-3">
                  @if ($p->status_pelanggan == 'aktif')
                    <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold">Aktif</span>
                  @else
                    <span class="badge bg-danger-subtle text-danger px-2 py-1 fw-bold">Arsip</span>
                  @endif
                </td>
                <td class="py-3 px-3 text-center">
                  <div class="d-flex justify-content-center gap-1">
                    <a href="{{ route('admin.pelanggan.show', $p->id_pelanggan) }}" class="btn btn-icon btn-round btn-primary btn-sm shadow-sm" data-bs-toggle="tooltip" title="Detail Pelanggan">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-icon btn-round btn-warning btn-sm shadow-sm" data-bs-toggle="tooltip" title="Edit Pelanggan">
                      <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.pelanggan.destroy', $p->id_pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-icon btn-round btn-danger btn-sm shadow-sm" data-bs-toggle="tooltip" title="Hapus Pelanggan">
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