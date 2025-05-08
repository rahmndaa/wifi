@extends('layouts.pelanggan-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-3">
                <h3 class="mb-0">Pengaduan</h3>
            </div>
                <a href="{{ route('pelanggan.komplain.create') }}" class="btn btn-primary mb-3 btn-sm">Buat Baru</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Bukti</th>
                            <th>Balasan Admin</th> <!-- Kolom Balasan dari Admin ditambahkan -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($komplains as $komplain)
                        <tr>
                            <td>{{ $komplain->id_komplain }}</td>
                            <td>{{ $komplain->tanggal_komplain }}</td>
                            <td>{{ $komplain->deskripsi }}</td>
                            <td>
                                @if ($komplain->status == 'menunggu')
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif ($komplain->status == 'proses')
                                    <span class="badge bg-primary">Diproses</span>
                                @else
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                @if($komplain->bukti_komplain)
                                <a href="{{ asset('storage/' . $komplain->bukti_komplain) }}" target="_blank" class="btn btn-primary btn-xs">
                                    <i class="fa fa-image fa-lg"></i>
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ $komplain->balasan_admin ?? '-' }}</td> <!-- Tampilkan balasan admin jika ada -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </section>
</div>
@endsection
