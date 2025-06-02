@extends('layouts.pelanggan-master')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Dashboard</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home"><a href="{{ route('pelanggan.dashboard') }}"><i class="icon-home"></i></a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ route('pelanggan.dashboard') }}">Dashboard</a></li>
      </ul>
    </div>

    @php
      $totalTagihan = $tagihan->where('status', 'belum lunas')->sum('total_tagihan');
      $sudahLunas = $tagihan->where('status', 'lunas')->count();
      $belumLunas = $tagihan->where('status', 'belum lunas')->count();
    @endphp

    <div class="row mb-4">
      <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Tagihan</p>
                  <h4 class="card-title">Rp {{ number_format($totalTagihan, 0, ',', '.') }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Sudah Dibayar</p>
                  <h4 class="card-title">{{ $sudahLunas }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-danger bubble-shadow-small">
                  <i class="fas fa-exclamation-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Belum Dibayar</p>
                  <h4 class="card-title">{{ $belumLunas }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow rounded">
      <div class="card-header">
        <h3 class="card-title mb-0">Riwayat Tagihan</h3>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover">
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
              <td>{{ $t->id_tagihan }}</td>
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
              <td>{{ $pembayaran->metode_pembayaran ?? '-' }}</td>
              <td>
                @if ($pembayaran && $pembayaran->bukti_transfer)
                  <a href="{{ Storage::url($pembayaran->bukti_transfer) }}" target="_blank" class="btn btn-primary btn-xs"data-bs-toggle="tooltip" title="Bukti Transfer">
                    <i class="fas fa-image fa-lg"></i>
                  </a>
                @else
                  -
                @endif
              </td>
              <td>
                @if ($t->status == 'belum lunas')
                <div class="form-button-action">
                  <a href="{{ route('pelanggan.pembayaran.form', $t->id_tagihan) }}" class="btn btn-success btn-xs"data-bs-toggle="tooltip" title="Bayar Tagihan">
                    <i class="fa fa-credit-card fa-lg"></i>
                  </a>
                </div>
                @else
                  -
                @endif
              </td>
            </tr>
            @endforeach

            @if ($tagihan->count() == 0)
            <tr>
              <td colspan="9" class="text-center">Belum ada tagihan</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection
