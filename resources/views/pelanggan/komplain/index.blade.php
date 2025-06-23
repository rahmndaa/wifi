@extends('layouts.pelanggan-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Keluhan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('pelanggan.dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('pelanggan.komplain.index') }}">Keluhan</a></li>
            </ul>
        </div>
        <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('pelanggan.komplain.create') }}" class="btn btn-primary btn-sm">Buat Baru</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Dibuat</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                    <th>Balasan Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($komplains as $komplain)
                                <tr>
                                    <td>{{ $komplain->id_komplain }}</td>
                                    <td>{{ $komplain->tanggal_komplain }}</td>
                                    <td>{{ $komplain->deskripsi }}</td>
                                    <td>
                                        @if ($komplain->status == 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif ($komplain->status == 'proses')
                                            <span class="badge bg-primary">Diproses</span>
                                        @else
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($komplain->bukti_komplain)
                                        <a href="{{ asset('storage/' . $komplain->bukti_komplain) }}" target="_blank" class="btn btn-primary btn-xs"data-bs-toggle="tooltip" title="Bukti Transfer">
                                            <i class="fa fa-image fa-lg"></i>
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>{{ $komplain->balasan_admin ?? '-' }}</td>
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
