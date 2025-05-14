@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Pelanggan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Pelanggan</a></li>
            </ul>
        </div>

        <div class="row mb-3">
            <div class="col-md-2">
                <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary btn-sm w-100">
                    <i class="fa fa-plus"></i> Tambah Pelanggan
                </a>
            </div>
        </div>

        <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>WhatsApp</th>
                            <th>Paket</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama_pelanggan }}</td>
                            <td>{{ $p->username }}</td>
                            <td>{{ $p->no_whatsapp }}</td>
                            <td>{{ $p->paketwifi->nama_paket ?? '-' }}</td>
                            <td>
                                @if ($p->status_pelanggan == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Arsip</span>
                                @endif
                            </td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('admin.pelanggan.show', $p->id_pelanggan) }}" class="btn btn-link btn-primary btn-sm" data-bs-toggle="tooltip" title="Detail Pelanggan">
                                        <i class="fa fa-eye fa-lg"></i>
                                    </a>
                                    <a href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-link btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Pelanggan">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </a>
                                    <form action="{{ route('admin.pelanggan.destroy', $p->id_pelanggan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus Pelanggan">
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
@endsection
