@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Tagihan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Tagihan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Detail</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Informasi Tagihan</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Nama Pelanggan</dt>
                            <dd class="col-sm-9">{{ $tagihan->pelanggan->nama_pelanggan }}</dd>

                            <dt class="col-sm-3">Periode</dt>
                            <dd class="col-sm-9">{{ $tagihan->periode_bulan }}/{{ $tagihan->periode_tahun }}</dd>

                            <dt class="col-sm-3">Metode Pembayaran</dt>
                            <dd class="col-sm-9">{{ $tagihan->pembayaran->metode_pembayaran ?? '-' }}</dd>
                            
                            <dt class="col-sm-3">Tanggal Pembayaran</dt>
                            <dd class="col-sm-9">{{ $tagihan->pembayaran->tanggal_bayar ?? '-' }}</dd>

                            <dt class="col-sm-3">Paket</dt>
                            <dd class="col-sm-9">{{ $tagihan->pelanggan->paketWifi->nama_paket ?? '-' }}</dd>

                            <dt class="col-sm-3">Total Tagihan</dt>
                            <dd class="col-sm-9">Rp {{ number_format($tagihan->total_tagihan, 0, ',', '.') }}</dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">
                                @if ($tagihan->status == 'belum lunas')
                                    <span class="badge badge-danger">Belum Lunas</span>
                                @elseif ($tagihan->status == 'lunas')
                                    <span class="badge badge-success">Lunas</span>
                                @else
                                    <span class="badge badge-warning">Menunggu</span>
                                @endif
                            </dd>

                            @if($tagihan->pembayaran && $tagihan->pembayaran->bukti_transfer)
                            <dt class="col-sm-3">Bukti Transfer</dt>
                            <dd class="col-sm-9">
                                <a href="{{ asset('storage/' . $tagihan->pembayaran->bukti_transfer) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $tagihan->pembayaran->bukti_transfer) }}" width="300">
                                </a>
                            </dd>
                            @endif
                        </dl>

                            <div class="d-flex justify-content-start mt-4">
                                <a href="{{ route('admin.tagihan') }}" class="btn btn-danger btn-sm me-2">Kembali</a>

                                @if($tagihan->status == 'belum lunas')
                                    <a href="{{ route('admin.tagihan.pembayaran.form', $tagihan->id_tagihan) }}" class="btn btn-primary btn-sm">Bayar</a>
                                @elseif ($tagihan->status == 'pending')
                                    <a href="{{ route('admin.tagihan.pembayaran.form', $tagihan->id_tagihan) }}" class="btn btn-primary btn-sm">Konfirmasi</a>
                                @endif
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
