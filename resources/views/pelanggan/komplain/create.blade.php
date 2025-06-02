@extends('layouts.pelanggan-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Keluhan</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('pelanggan.dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('pelanggan.komplain.create') }}">Keluhan</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Form Keluhan</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ route('pelanggan.komplain.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="bukti_komplain" class="form-label">Bukti (opsional)</label>
                                <input type="file" name="bukti_komplain" class="form-control">
                            </div>

                            <div class="d-flex justify-content-start mt-4">
                                <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-danger btn-sm me-2">Batal</a>
                                <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
