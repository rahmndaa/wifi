@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3>Tambah Tagihan</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tagihan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Pelanggan</label>
                            <select name="id_pelanggan" class="form-control" required>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Periode Tahun</label>
                            <input type="number" name="periode_tahun" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Periode Bulan</label>
                            <input type="number" name="periode_bulan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="belum lunas">Belum Lunas</option>
                                <option value="lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Total Tagihan</label>
                            <input type="number" name="total_tagihan" class="form-control" required>
                        </div>
                            <a href="{{ route('admin.tagihan') }}" class="btn btn-danger btn-xs">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
