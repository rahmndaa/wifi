@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
<div class="page-header d-flex justify-content-between align-items-center">
    {{-- Kiri: Breadcrumb + Judul --}}
    <div class="d-flex align-items-center">
        <h3 class="fw-bold mb-0 me-3">Pembayaran</h3>
        <ul class="breadcrumbs mb-0 d-flex align-items-center">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pembayaran') }}">Pembayaran</a>
            </li>
        </ul>
    </div>

    
    {{-- Kanan: Tombol Export --}}
    <div>
        <a href="{{ route('pembayaran.export') }}" class="btn btn-success btn-sm">Export</a>

    </div>
</div>


    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.pembayaran') }}" class="row mb-4">
      <div class="col-md-2">
        <select name="tahun" class="form-control">
          <option value="">Tahun</option>
          @for ($i = date('Y'); $i >= 2020; $i--)
            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
          @endfor
        </select>
      </div>
      <div class="col-md-2">
        <select name="bulan" class="form-control">
          <option value="">Bulan</option>
          @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
              {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
          @endfor
        </select>
      </div>
      <div class="col-md-2">
        <select name="status" class="form-control">
          <option value="">Status</option>
          <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
          <option value="belum lunas" {{ request('status') == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
        </select>
      </div>
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-search"></i>
        </button>
      </div>

      </form>

    {{-- Tabel Pembayaran --}}
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-hover table-responsive-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Periode</th>
              <th>Total</th>
              <th>Metode</th>
              <th>Tanggal Bayar</th>
              <th>Bukti</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pembayaran as $p)
            <tr>
              <td>{{ $p->id_tagihan }}</td>
              <td>{{ $p->nama_pelanggan }}</td>
              <td>{{ $p->periode_bulan }}/{{ $p->periode_tahun }}</td>
              <td>Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</td>
              <td>{{ ucfirst($p->metode_pembayaran) }}</td>
              <td>{{ $p->tanggal_bayar }}</td>
              <td class="text-center">
                @if ($p->bukti_transfer)
                  <a href="{{ Storage::url($p->bukti_transfer) }}" target="_blank" class="btn btn-primary btn-xs"data-bs-toggle="tooltip" title="Bukti Transfer">
                    <i class="fas fa-image fa-lg"></i>
                  </a>
                @else
                  <span class="text-muted">-</span>
                @endif
              </td>
              <td>
                @if ($p->status == 'lunas')
                  <span class="badge bg-success">Lunas</span>
                @elseif ($p->status == 'pending')
                  <span class="badge bg-warning">Menunggu</span>
                @else
                  <span class="badge bg-danger">Belum Lunas</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{-- End Tabel --}}
  </div>
</div>
@endsection
