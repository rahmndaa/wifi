@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between mb-3">
                <h3 class="mb-0">Detail Keluhan</h3>
            </div>

            <div class="card">
                <div class="card-body">
                    <p><strong>Pelanggan:</strong> {{ $komplain->pelanggan->nama_pelanggan }}</p>
                    <p><strong>Deskripsi:</strong><br> {{ $komplain->deskripsi }}</p>
                    <p><strong>Status:</strong>
                    @if ($komplain->status == 'proses')
                    <span class="badge bg-primary">Diproses</span>
                    @elseif ($komplain->status == 'menunggu')
                        <span class="badge bg-primary">Menunggu</span>
                    @else
                        <span class="badge bg-success">Selesai</span>
                    @endif
                    @if($komplain->bukti_komplain)
                    <p><strong>Tanggal Komplain:</strong> {{ $komplain->tanggal_komplain }}</p>
                        <p><strong>Bukti:</strong><br>
                            <a href="{{ asset('storage/' . $komplain->bukti_komplain) }}" target="_blank">
                                <img src="{{ asset('storage/' . $komplain->bukti_komplain) }}" width="500">
                            </a>
                        </p>
                    @endif

                    <form method="POST" action="{{ route('admin.komplain.updateStatus', $komplain->id_komplain) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-3">
                            <label for="status">Update Status</label>
                            <select name="status" class="form-control" required>
                                <option value="menunggu" {{ $komplain->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="proses" {{ $komplain->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $komplain->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.komplain.index') }}" class="btn btn-danger btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
