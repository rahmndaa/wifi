@extends('layouts.pelanggan-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Form Pembayaran</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Form Pembayaran</a></li>
            </ul>
        </div>
        <div class="card shadow rounded">
            <div class="card-body">
                <dl class="row mb-4">
                    <dt class="col-sm-3">Nama Pelanggan</dt>
                    <dd class="col-sm-9">{{ $tagihan->nama_pelanggan }}</dd>

                    <dt class="col-sm-3">Periode</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::create()->month($tagihan->periode_bulan)->format('F') }} {{ $tagihan->periode_tahun }}</dd>

                    <dt class="col-sm-3">Total Tagihan</dt>
                    <dd class="col-sm-9 text-danger">Rp {{ number_format($tagihan->total_tagihan, 0, ',', '.') }}</dd>
                </dl>

                <div class="alert alert-primary rounded shadow-sm mb-4">
                    <h6 class="mb-3">Informasi Rekening Tujuan:</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-secondary bg-secondary-gradient">
                                <div class="card-body bubble-shadow">
                                    <h5 class="text-white op-8">BNI</h5>
                                    <h2 class="text-white">098763523323</h2>
                                    <div class="text-end">
                                        <div class="text-small text-uppercase fw-bold op-8">Fadillahnet</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-secondary bg-secondary-gradient">
                                <div class="card-body bubble-shadow">
                                    <h5 class="text-white op-8">BRI</h5>
                                    <h2 class="text-white">834917894611328</h2>
                                    <div class="text-end">
                                        <div class="text-small text-uppercase fw-bold op-8">Fadillahnet</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-secondary bg-secondary-gradient">
                                <div class="card-body bubble-shadow">
                                    <h5 class="text-white op-8">BCA</h5>
                                    <h2 class="text-white">3456789302</h2>
                                    <div class="text-end">
                                        <div class="text-small text-uppercase fw-bold op-8">Fadillahnet</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('pelanggan.pembayaran.proses', $tagihan->id_tagihan) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-control" required>
                            <option value="transfer">Transfer Bank</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="bukti_transfer">Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" class="form-control" accept="image/*" required>
                        <small class="text-muted">Upload foto bukti transfer (jpg, png, max 2MB)</small>
                    </div>

                    <div class="form-group mt-4">
                        <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-danger btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
