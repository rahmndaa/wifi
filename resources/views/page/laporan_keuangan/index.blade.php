@extends('layouts.admin-master')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Laporan Keuangan</h2>

    <!-- Tabel Pemasukan -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Pemasukan</h4>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalPemasukan">
                + Tambah Pemasukan
            </a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemasukan as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.laporan_keuangan.edit', ['type' => 'pemasukan', 'id' => $p->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.laporan_keuangan.destroy', ['type' => 'pemasukan', 'id' => $p->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-hapus" data-id="{{ $p->id }}">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Pengeluaran -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Pengeluaran</h4>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalPengeluaran">
                + Tambah Pengeluaran
            </a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengeluaran as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                            <td>{{ $p->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.laporan_keuangan.edit', ['type' => 'pengeluaran', 'id' => $p->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.laporan_keuangan.destroy', ['type' => 'pengeluaran', 'id' => $p->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-hapus" data-id="{{ $p->id }}">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Pemasukan -->
<div class="modal fade" id="modalPemasukan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.laporan_keuangan.store_pemasukan') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pemasukan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Pengeluaran -->
<div class="modal fade" id="modalPengeluaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.laporan_keuangan.store_pengeluaran') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
