@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Balas Komplain</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Balas Komplain</a></li>
            </ul>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <p><strong>Deskripsi Komplain:</strong></p>
                <p>{{ $komplain->deskripsi }}</p>

                <form action="{{ route('admin.komplain.balas.kirim', $komplain->id_komplain) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="balasan_admin">Balasan:</label>
                        <textarea name="balasan_admin" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <a href="{{ route('admin.komplain.index') }}" class="btn btn-danger btn-sm">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm">Kirim Balasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
