@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data</h2>
    <form action="{{ route('laporan.update', $pemasukan?->id ?? $pengeluaran->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="type" value="{{ $pemasukan ? 'pemasukan' : 'pengeluaran' }}">

        <input type="date" name="tanggal" value="{{ $pemasukan->tanggal ?? $pengeluaran->tanggal }}" required>
        <input type="text" name="keterangan" value="{{ $pemasukan->keterangan ?? $pengeluaran->keterangan }}" required>
        <input type="number" name="jumlah" value="{{ $pemasukan->jumlah ?? $pengeluaran->jumlah }}" required>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
