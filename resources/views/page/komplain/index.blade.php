@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Keluhan Pelanggan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Keluhan Pelanggan</a></li>
            </ul>
        </div>

        {{-- Filter Status --}}
        <form method="GET" action="{{ route('admin.komplain.index') }}" class="row mb-3">
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Bukti</th>
                            <th>Dibuat</th>
                            <th>Selesai</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($komplain as $k)
                        <tr>
                            <td>{{ $k->id_komplain }}</td>
                            <td>{{ $k->pelanggan->nama_pelanggan }}</td>
                            <td>{{ Str::limit($k->deskripsi, 50) }}</td>
                            <td>
                                @if ($k->status == 'menunggu')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif ($k->status == 'proses')
                                    <span class="badge bg-primary">Diproses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($k->bukti_komplain)
                                    <a href="{{ Storage::url($k->bukti_komplain) }}" target="_blank" class="btn btn-primary btn-xs">
                                        <i class="fas fa-image fa-lg"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $k->tanggal_komplain }}</td>
                            <td>{{ $k->tanggal_komplain_selesai ?? '-' }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('admin.komplain.show', $k->id_komplain) }}" class="btn btn-link btn-primary btn-sm" data-bs-toggle="tooltip" title="Lihat Komplain">
                                        <i class="fa fa-eye fa-lg"></i>
                                    </a>
                                    @if($k->status != 'selesai')
                                    <a href="{{ route('admin.komplain.balas.form', $k->id_komplain) }}" class="btn btn-link btn-success btn-sm" data-bs-toggle="tooltip" title="Balas Komplain">
                                        <i class="fa fa-reply fa-lg"></i>
                                    </a>
                                    @endif
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
