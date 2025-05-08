@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Detail Paket</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
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

                    <div class="mt-3">
                        <a href="{{ route('admin.paket_wifi') }}" class="btn btn-danger btn-xs">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
