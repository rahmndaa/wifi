@extends('layouts.pelanggan-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Form Pembayaran</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow rounded">
                <div class="card-body">

                    <h5 class="mb-3">Tagihan Bulan {{ \Carbon\Carbon::create()->month($tagihan->periode_bulan)->format('F') }} {{ $tagihan->periode_tahun }}</h5>
                    <p>Total Tagihan: <strong class="text-primary">Rp {{ number_format($tagihan->total_tagihan, 0, ',', '.') }}</strong></p>

                    <div class="alert alert-success rounded shadow-sm">
                        <h6 class="mb-2">Transfer ke Rekening Berikut:</h6>
                        <ul class="mb-0" style="list-style-type: none; padding-left: 0;">
                            <li><strong>Bank:</strong> BCA</li>
                            <li><strong>No. Rekening:</strong> 1234567890</li>
                            <li><strong>Atas Nama:</strong> Fadillah</li>
                        </ul>
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

                        <div class="form-group">
                            <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-danger btn-sm">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm">
                             konfirmasi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
