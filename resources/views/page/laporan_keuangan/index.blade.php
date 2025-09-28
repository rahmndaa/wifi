@extends('layouts.admin-master')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📊 Laporan Keuangan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Saldo</th>
                            <th>Aksi</th> {{-- Tambah kolom aksi --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php $saldo = 0; @endphp
                        @foreach($laporans as $laporan)
                            @php $saldo += $laporan->pemasukan - $laporan->pengeluaran; @endphp
                            <tr>
                                <td>{{ $laporan->tanggal }}</td>
                                <td>{{ $laporan->deskripsi }}</td>
                                <td class="text-success">
                                    Rp{{ number_format($laporan->pemasukan,0,',','.') }}
                                </td>
                                <td class="text-danger">
                                    Rp{{ number_format($laporan->pengeluaran,0,',','.') }}
                                </td>
                                <td class="fw-bold">
                                    Rp{{ number_format($saldo,0,',','.') }}
                                </td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.laporan_keuangan.edit', $laporan->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $laporans->links() }} {{-- pagination --}}
            </div>
        </div>
    </div>
</div>
@endsection
