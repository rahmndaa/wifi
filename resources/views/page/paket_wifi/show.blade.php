@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Paket</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Paket WiFi</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Detail</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Informasi Paket</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Nama Paket</dt>
                            <dd class="col-sm-9">{{ $paket->nama_paket }}</dd>

                            <dt class="col-sm-3">Kecepatan</dt>
                            <dd class="col-sm-9">{{ $paket->kecepatan }}</dd>

                            <dt class="col-sm-3">Harga</dt>
                            <dd class="col-sm-9">Rp {{ number_format($paket->harga, 0, ',', '.') }}</dd>
                        </dl>

                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('admin.paket_wifi') }}" class="btn btn-danger btn-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
