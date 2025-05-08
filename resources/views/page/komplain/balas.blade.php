@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Balas Komplain</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow rounded">
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
    </section>
</div>
@endsection
