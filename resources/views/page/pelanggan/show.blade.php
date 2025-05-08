@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Detail Pelanggan</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
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

                        <dt class="col-sm-3">Nama Paket</dt>
                        <dd class="col-sm-9">{{ $pelanggan->paketWifi->nama_paket ?? '-' }}</dd>

                        <dt class="col-sm-3">No WhatsApp</dt>
                        <dd class="col-sm-9">{{ $pelanggan->no_whatsapp }}</dd>

                        <dt class="col-sm-3">Tanggal Gabung</dt>
                        <dd class="col-sm-9">{{ $pelanggan->tanggal_gabung }}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">{{ $pelanggan->status_pelanggan }}</dd>
                    </dl>

                    <div class="mt-3">
                        <a href="{{ route('admin.pelanggan') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
