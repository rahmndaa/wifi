@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    
    {{-- Header Halaman --}}
    <div class="page-header">
      <h3 class="fw-bold mb-3">Pembayaran</h3>
      <ul class="breadcrumbs mb-3">
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

    {{-- Filter Pencarian & Tombol Export (Sejajar & Rapi) --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
      <div class="card-body p-3 p-md-4">
        <form method="GET" action="{{ route('admin.pembayaran') }}">
          <div class="row align-items-end g-3">
            
            {{-- Lebar diubah dari md-2 ke md-3 agar teks tidak terpotong --}}
            <div class="col-6 col-md-3">
              <label class="form-label fw-semibold text-secondary small">Tahun</label>
              <select name="tahun" class="form-select rounded-3 fs-8 text-truncate">
                <option value="">Semua Tahun</option>
                @for ($i = 2020; $i <= 2030; $i++)
                  <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
              </select>
            </div>
            
            <div class="col-6 col-md-3">
              <label class="form-label fw-semibold text-secondary small">Bulan</label>
              <select name="bulan" class="form-select rounded-3 fs-8 text-truncate">
                <option value="">Semua Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                  </option>
                @endfor
              </select>
            </div>

            <div class="col-6 col-md-3">
              <label class="form-label fw-semibold text-secondary small">Status</label>
              <select name="status" class="form-select rounded-3 fs-8 text-truncate">
                <option value="">Semua Status</option>
                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="belum lunas" {{ request('status') == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
              </select>
            </div>

            <div class="col-6 col-md-3 d-flex gap-2">
              <div class="w-50">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <button type="submit" class="btn btn-primary rounded-3 px-2 shadow-sm py-2 w-100" title="Cari">
                  <i class="fa fa-search me-1"></i> Cari
                </button>
              </div>
              <div class="w-50">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <a href="{{ route('pembayaran.export', ['tahun' => request('tahun'), 'bulan' => request('bulan'), 'status' => request('status')]) }}" class="btn btn-success rounded-3 px-2 shadow-sm py-2 w-100 text-nowrap" title="Export Excel">
                  <i class="fa fa-file-excel me-1"></i> Export
                </a>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>

    {{-- Tampilan Card Khusus Mobile --}}
    <div class="d-block d-md-none">
      @forelse ($pembayaran as $p)
      <div class="card border-0 shadow-sm mb-3 rounded-3">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
              <span class="text-muted fs-9 fw-bold">ID Tagihan: {{ $p->id_tagihan }}</span>
              <h6 class="fw-bold mb-1 text-dark mt-1">{{ $p->nama_pelanggan }}</h6>
              <span class="text-muted fs-8">Periode: {{ $p->periode_bulan }}/{{ $p->periode_tahun }}</span><br>
              <span class="fw-semibold text-primary fs-8">Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</span>
            </div>
            <div>
              @if ($p->status == 'lunas')
                <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold fs-9">Lunas</span>
              @elseif ($p->status == 'pending')
                <span class="badge bg-warning-subtle text-warning px-2 py-1 fw-bold fs-9">Menunggu</span>
              @else
                <span class="badge bg-danger-subtle text-danger px-2 py-1 fw-bold fs-9">Belum</span>
              @endif
            </div>
          </div>
          
          <div class="bg-light p-2 rounded-2 my-2 fs-8 text-secondary">
            <div><strong>Metode:</strong> {{ ucfirst($p->metode_pembayaran) }}</div>
            <div><strong>Tgl Bayar:</strong> {{ $p->tanggal_bayar ?? '-' }}</div>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-3 border-top pt-2">
            <div>
              @if ($p->bukti_transfer)
                <a href="{{ Storage::url($p->bukti_transfer) }}" target="_blank" class="btn btn-outline-primary btn-xs py-1 px-2">
                  <i class="fas fa-image me-1"></i> Lihat Bukti
                </a>
              @else
                <span class="text-muted fs-9">Tanpa Bukti</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="card border-0 shadow-sm rounded-3 p-4 text-center text-muted small">Belum ada data pembayaran yang tersedia.</div>
      @endforelse
    </div>

    {{-- Tabel Normal (Desktop / Laptop) --}}
    <div class="card border-0 shadow-sm rounded-4 d-none d-md-block mb-4">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase fs-7">
              <tr>
                <th class="py-3 px-3">ID</th>
                <th class="py-3 px-3">Nama Pelanggan</th>
                <th class="py-3 px-3">Periode</th>
                <th class="py-3 px-3">Total</th>
                <th class="py-3 px-3">Metode</th>
                <th class="py-3 px-3">Tanggal Bayar</th>
                <th class="py-3 px-3 text-center">Bukti</th>
                <th class="py-3 px-3">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pembayaran as $p)
              <tr>
                <td class="py-3 px-3 fw-bold">{{ $p->id_tagihan }}</td>
                <td class="py-3 px-3 fw-semibold text-dark">{{ $p->nama_pelanggan }}</td>
                <td class="py-3 px-3">{{ $p->periode_bulan }}/{{ $p->periode_tahun }}</td>
                <td class="py-3 px-3 fw-semibold">Rp {{ number_format($p->total_tagihan, 0, ',', '.') }}</td>
                <td class="py-3 px-3">{{ ucfirst($p->metode_pembayaran) }}</td>
                <td class="py-3 px-3">{{ $p->tanggal_bayar ?? '-' }}</td>
                <td class="py-3 px-3 text-center">
                  @if ($p->bukti_transfer)
                    <a href="{{ Storage::url($p->bukti_transfer) }}" target="_blank" class="btn btn-icon btn-round btn-primary btn-sm shadow-sm" data-bs-toggle="tooltip" title="Bukti Transfer">
                      <i class="fas fa-image"></i>
                    </a>
                  @else
                    <span class="text-muted">-</span>
                  @endif
                </td>
                <td class="py-3 px-3">
                  @if ($p->status == 'lunas')
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold">Lunas</span>
                  @elseif ($p->status == 'pending')
                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-bold">Menunggu</span>
                  @else
                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold">Belum Lunas</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center py-4 text-muted">Belum ada data pembayaran yang tersedia.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection