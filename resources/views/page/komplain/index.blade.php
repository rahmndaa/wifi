@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between mb-3">
                <h3 class="mb-0">Keluhan Pelanggan</h3>
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
                <div class="card-body">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Pelanggan</th>
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
                                <td class="text-center">
                                    <a href="{{ route('admin.komplain.show', $k->id_komplain) }}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-eye fa-xs"> Detail</i>
                                    </a>
                                    @if($k->status != 'selesai')
                                    <a href="{{ route('admin.komplain.balas.form', $k->id_komplain) }}" class="btn btn-warning btn-xs">Balas</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
