@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Pembayaran Tagihan</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h3 class="card-title mb-0">Informasi Tagihan</h3>
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

                        <div class="form-group">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="transfer">Transfer</option>
                                <option value="tunai">Tunai</option>
                            </select>
                        </div>

                        <a href="{{ route('admin.tagihan') }}" class="btn btn-secondary mt-3">Kembali</a>
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
