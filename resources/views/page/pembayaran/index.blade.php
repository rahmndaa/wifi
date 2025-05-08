@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Riwayat Pembayaran</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow rounded">
                <div class="card-body table-responsive">

                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th>ID Tagihan</th>
                                <th>Pelanggan</th>
                                <th>Periode</th>
                                <th>Total Tagihan</th>
                                <th>Metode</th>
                                <th>Tanggal Bayar</th>
                                <th>Bukti Transfer</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembayaran as $p)
                                <tr>
                                    <td>{{$p->id_tagihan }}</td>
                                    <td>{{ $p->nama_pelanggan }}</td>
                                    <td>{{ $p->periode_bulan }}/{{ $p->periode_tahun }}</td>
                                    <td>Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($p->metode_pembayaran) }}</td>
                                    <td>{{ $p->tanggal_bayar }}</td>
                                    <td class="text-center">
                                        @if ($p->bukti_transfer)
                                            <a href="{{ Storage::url($p->bukti_transfer) }}" target="_blank">
                                                <i class="fas fa-image fa-lg text-info"></i>
                                            </a>
                                     
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($p->status == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @elseif ($p->status == 'pending')
                                            <span class="badge bg-warning text-white">Menunggu</span>
                                        @else
                                            <span class="badge bg-danger">Belum Lunas</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada pembayaran</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section>
</div>
@endsection
