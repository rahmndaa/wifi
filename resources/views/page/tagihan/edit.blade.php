@extends('layouts.admin-master')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3>Edit Tagihan</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.tagihan.update', $tagihan->id_tagihan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Pelanggan</label>
                            <select name="id_pelanggan" class="form-control" required>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->id_pelanggan }}" {{ $tagihan->id_pelanggan == $p->id_pelanggan ? 'selected' : '' }}>
                                        {{ $p->nama_pelanggan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Periode Tahun</label>
                            <input type="number" name="periode_tahun" class="form-control" value="{{ $tagihan->periode_tahun }}" required>
                        </div>

                        <div class="form-group">
                            <label>Periode Bulan</label>
                            <input type="number" name="periode_bulan" class="form-control" value="{{ $tagihan->periode_bulan }}" required>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="belum lunas" {{ $tagihan->status == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                <option value="lunas" {{ $tagihan->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Total Tagihan</label>
                            <input type="number" name="total_tagihan" class="form-control" value="{{ $tagihan->total_tagihan }}" required>
                        </div>

                        <a href="{{ route('admin.tagihan') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
