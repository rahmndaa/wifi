    @extends('layouts.pelanggan-master')

    @section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h3 class="mb-0">Dashboard</h3>
            </div>
        </section>

        <section class="content">
            @php
            $totalTagihan = $tagihan->where('status', 'belum lunas')->sum('total_tagihan');
            $sudahLunas = $tagihan->where('status', 'lunas')->count();
            $belumLunas = $tagihan->where('status', 'belum lunas')->count();
        @endphp

        <div class="row mb-4">
            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp {{ number_format($totalTagihan, 0, ',', '.') }}</h3>
                        <p>Total Tagihan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $sudahLunas }}</h3>
                        <p>Sudah Dibayar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $belumLunas }}</h3>
                        <p>Belum Dibayar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                </div>
            </div>
        </div>


                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Riwayat Tagihan</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Tagihan</th>
                                    <th>Periode</th>
                                    <th>Paket</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Metode</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tagihan as $t)
                                <tr>
                                    <td>{{ $t->id_tagihan}}</td>
                                    <td>{{ \Carbon\Carbon::create()->month($t->periode_bulan)->format('F') }} {{ $t->periode_tahun }}</td>
                                    <td>{{ $t->pelanggan->paketWifi->nama_paket ?? '-' }}</td>
                                    <td>Rp {{ number_format($t->total_tagihan, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($t->status == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @elseif ($t->status == 'pending')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @else
                                            <span class="badge bg-danger">Belum Lunas</span>
                                        @endif

                                    </td>
                                    <td>
                                        @php
                                            $pembayaran = DB::table('pembayaran')->where('id_tagihan', $t->id_tagihan)->first();
                                        @endphp
                                        {{ $pembayaran->tanggal_bayar ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($pembayaran)
                                            {{ ucfirst($pembayaran->metode_pembayaran) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pembayaran && $pembayaran->bukti_transfer)
                                        <a href="{{ Storage::url($pembayaran->bukti_transfer) }}" target="_blank" class="text-primary" title="lihat">
                                            <i class="fas fa-image fa-lg text-info"></i>
                                        </a>                                    
                                        @else
                                            -
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if ($t->status == 'belum lunas')
                                        <a href="{{ route('pelanggan.pembayaran.form', $t->id_tagihan) }}" class="text-primary" title="Bayar">
                                            <i class="fas fa-credit-card fa-lg text-success"></i>
                                        </a>
                                        
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                @if ($tagihan->count() == 0)
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada tagihan</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
    @endsection
