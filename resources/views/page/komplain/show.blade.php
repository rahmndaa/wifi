@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Komplain</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Detail Komplain</a></li>
            </ul>
        </div>

        <div class="card shadow rounded">
            <div class="card-header">
                <h3 class="card-title mb-0">Informasi Komplain</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nama Pelanggan</dt>
                    <dd class="col-sm-9">{{ $komplain->pelanggan->nama_pelanggan }}</dd>

                    <dt class="col-sm-3">Deskripsi</dt>
                    <dd class="col-sm-9">{{ $komplain->deskripsi }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        @if ($komplain->status == 'proses')
                            <span class="badge bg-primary">Diproses</span>
                        @elseif ($komplain->status == 'menunggu')
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        @else
                            <span class="badge bg-success">Selesai</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Tanggal Komplain</dt>
                    <dd class="col-sm-9">{{ $komplain->tanggal_komplain }}</dd>

                    @if($komplain->bukti_komplain)
                    <dt class="col-sm-3">Bukti Komplain</dt>
                    <dd class="col-sm-9">
                        <a href="{{ asset('storage/' . $komplain->bukti_komplain) }}" target="_blank">
                            <img src="{{ asset('storage/' . $komplain->bukti_komplain) }}" width="300">
                        </a>
                    </dd>
                    @endif
                </dl>

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
</div>
@endsection
