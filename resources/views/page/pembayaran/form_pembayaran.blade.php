@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Pembayaran Tagihan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Tagihan</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Pembayaran</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Informasi Tagihan</h4>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Nama Pelanggan</dt>
                            <dd class="col-sm-9">{{ $tagihan->nama_pelanggan }}</dd>

                            <dt class="col-sm-3">Periode</dt>
                            <dd class="col-sm-9">{{ $tagihan->periode_bulan }}/{{ $tagihan->periode_tahun }}</dd>

                            <dt class="col-sm-3">Paket</dt>
                            <dd class="col-sm-9">{{ $tagihan->nama_paket ?? '-' }}</dd>

                            <dt class="col-sm-3">Total Tagihan</dt>
                            <dd class="col-sm-9">Rp {{ number_format($tagihan->total_tagihan, 0, ',', '.') }}</dd>
                        </dl>

                        <form action="{{ route('admin.tagihan.pembayaran', $tagihan->id_tagihan) }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="metode_pembayaran">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="tunai">Tunai</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-start mt-4">
                                <a href="{{ route('admin.tagihan') }}" class="btn btn-danger btn-sm me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
