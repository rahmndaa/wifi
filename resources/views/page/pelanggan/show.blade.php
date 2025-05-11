@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Pelanggan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Pelanggan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Detail</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Informasi Pelanggan</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Nama Pelanggan</dt>
                            <dd class="col-sm-9">{{ $pelanggan->nama_pelanggan }}</dd>

                            <dt class="col-sm-3">Username</dt>
                            <dd class="col-sm-9">{{ $pelanggan->username }}</dd>

                            <dt class="col-sm-3">No WhatsApp</dt>
                            <dd class="col-sm-9">{{ $pelanggan->no_whatsapp }}</dd>

                            <dt class="col-sm-3">Tanggal Gabung</dt>
                            <dd class="col-sm-9">{{ $pelanggan->tanggal_gabung }}</dd>

                            <dt class="col-sm-3">Nama Paket</dt>
                            <dd class="col-sm-9">{{ $pelanggan->paketWifi->nama_paket ?? '-' }}</dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">{{ $pelanggan->status_pelanggan }}</dd>
                        </dl>

                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('admin.pelanggan') }}" class="btn btn-danger btn-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
