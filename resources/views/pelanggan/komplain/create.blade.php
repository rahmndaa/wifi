@extends('layouts.pelanggan-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-3">
                <h3 class="mb-0">Keluhan</h3>
            </div>

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
                    <button type="submit" class="btn btn-success btn-sm">Kirim</button>
                </form>
        </div>
    </section>
</div>
@endsection
