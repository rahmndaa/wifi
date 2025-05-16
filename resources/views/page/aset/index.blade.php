@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Aset</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Aset</a></li>
            </ul>
        </div>

        <div class="row mb-3">
            <div class="col-md-2">
                <a href="{{ route('admin.aset.create') }}" class="btn btn-primary btn-sm w-100">
                    <i class="fa fa-plus"></i> Tambah Aset
                </a>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.aset') }}" class="row mb-4">
            <div class="col-md-2">
                <select name="status_aset" class="form-control">
                    <option value="">Status</option>
                    <option value="tersedia" {{ request('status_aset') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="digunakan" {{ request('status_aset') == 'digunakan' ? 'selected' : '' }}>Digunakan</option>
                    <option value="rusak" {{ request('status_aset') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Aset</th>
                            <th>Tipe</th>
                            <th>Merk</th>
                            <th>Digunakan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aset as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $a->nama_aset }}</td>
                            <td>{{ $a->tipe_aset }}</td>
                            <td>{{ $a->merk ?? '-' }}</td>
                            <td>{{ $a->pelanggan->nama_pelanggan ?? '-' }}</td>
                            <td>
                                @if($a->status_aset == 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @elseif($a->status_aset == 'digunakan')
                                    <span class="badge bg-warning">Digunakan</span>
                                @elseif($a->status_aset == 'rusak')
                                    <span class="badge bg-danger">Rusak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="form-button-action">
                                    <a href="{{ route('admin.aset.show', $a->id_aset) }}" class="btn btn-link btn-primary btn-sm" data-bs-toggle="tooltip" title="Detail Aset">
                                        <i class="fa fa-eye fa-lg"></i>
                                    </a>
                                    <a href="{{ route('admin.aset.edit', $a->id_aset) }}" class="btn btn-link btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Aset">
                                        <i class="fa fa-edit fa-lg"></i>
                                    </a>
                                    <form action="{{ route('admin.aset.destroy', $a->id_aset) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus Aset">
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
