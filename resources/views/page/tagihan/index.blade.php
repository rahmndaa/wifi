@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    
    {{-- Header Halaman --}}
    <div class="page-header">
      <h3 class="fw-bold mb-3">Tagihan</h3>
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
          <a href="{{ route('admin.tagihan') }}">Tagihan</a>
        </li>
      </ul>
    </div>

    {{-- Card Wrapper untuk Tombol Aksi & Filter --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
      <div class="card-body p-3 p-md-4">
        
        {{-- Baris Tombol Atas (Generate & Tambah) --}}
        <div class="d-flex flex-wrap gap-2 mb-3 pb-3 border-bottom">
          <form action="{{ route('admin.tagihan.generate') }}" method="POST" id="form-generate-tagihan" class="d-inline">
            @csrf
            <button type="button" class="btn btn-black btn-sm px-3 py-2 shadow-sm text-nowrap rounded-3" id="btn-generate-tagihan">
              <i class="fa fa-plus me-1"></i> Generate Tagihan
            </button>
          </form>

          <a href="{{ route('admin.tagihan.create') }}" class="btn btn-primary btn-sm px-3 py-2 shadow-sm text-nowrap rounded-3">
            <i class="fa fa-plus me-1"></i> Tambah Tagihan
          </a>
        </div>

        {{-- Baris Filter Pencarian --}}
        <form method="GET" action="{{ route('admin.tagihan') }}">
          <div class="row align-items-end g-3">
            <div class="col-6 col-md-3">
              <label class="form-label fw-semibold text-secondary small">Tahun</label>
              <select name="tahun" class="form-select rounded-3 fs-8">
                <option value="">Semua Tahun</option>
                @for ($i = 2020; $i <= 2030; $i++)
                  <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
              </select>
            </div>
            
            <div class="col-6 col-md-3">
              <label class="form-label fw-semibold text-secondary small">Bulan</label>
              <select name="bulan" class="form-select rounded-3 fs-8">
                <option value="">Semua Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                  </option>
                @endfor
              </select>
            </div>

            <div class="col-6 col-md-4">
              <label class="form-label fw-semibold text-secondary small">Status</label>
              <select name="status" class="form-select rounded-3 fs-8">
                <option value="">Semua Status</option>
                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="belum lunas" {{ request('status') == 'belum lunas' ? 'selected' : '' }}>Belum Lunas</option>
              </select>
            </div>

            <div class="col-6 col-md-2">
              <label class="form-label d-none d-md-block">&nbsp;</label>
              <button type="submit" class="btn btn-primary rounded-3 px-3 shadow-sm py-2 w-100" title="Cari">
                <i class="fa fa-search me-1"></i> Cari
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>

    {{-- Tampilan List Card Khusus Mobile --}}
    <div class="d-block d-md-none">
      @foreach ($tagihan as $t)
      <div class="card border-0 shadow-sm mb-3 rounded-3">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
              <h6 class="fw-bold mb-1 text-dark">{{ $t->pelanggan->nama_pelanggan }}</h6>
              <span class="text-muted fs-8">Periode: {{ $t->periode_bulan }}/{{ $t->periode_tahun }}</span><br>
              <span class="fw-semibold text-primary fs-8">Rp {{ number_format($t->total_tagihan, 0, ',', '.') }}</span>
            </div>
            <div>
              @if ($t->status == 'lunas')
                <span class="badge bg-success-subtle text-success px-2 py-1">Lunas</span>
              @elseif ($t->status == 'pending')
                <span class="badge bg-warning-subtle text-warning px-2 py-1">Menunggu</span>
              @else
                <span class="badge bg-danger-subtle text-danger px-2 py-1">Belum</span>
              @endif
            </div>
          </div>
          <hr class="my-2 text-muted opacity-25">
          <div class="d-flex justify-content-between align-items-center">
            <a href="https://wa.me/{{ $t->pelanggan->no_whatsapp }}?text={{ urlencode('Halo ' . $t->pelanggan->nama_pelanggan . ', ini tagihan Anda untuk periode ' . $t->periode_bulan . '/' . $t->periode_tahun . ' sebesar Rp ' . number_format($t->total_tagihan, 0, ',', '.') . '. Segera lakukan pembayaran di dalam website fdlnet.my.id atau datang ke gerai. Sekian terima kasih. Hormat kami, TTD Fdlnet.') }}" target="_blank" class="btn btn-success btn-sm py-1 px-2">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <div class="d-flex gap-1">
                <a href="{{ route('admin.tagihan.show', $t->id_tagihan) }}" class="btn btn-primary btn-sm py-1 px-2" title="Lihat">
                  <i class="fa fa-eye"></i>
                </a>
                <a href="{{ route('admin.tagihan.edit', $t->id_tagihan) }}" class="btn btn-warning btn-sm py-1 px-2 text-white" title="Edit">
                  <i class="fa fa-edit"></i>
                </a>
                <form action="{{ route('admin.tagihan.destroy', $t->id_tagihan) }}" method="POST" class="d-inline" id="form-hapus-mobile-{{ $t->id_tagihan }}">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-danger btn-sm py-1 px-2 btn-hapus" data-id="{{ $t->id_tagihan }}" title="Hapus">
                    <i class="fa fa-times"></i>
                  </button>
                </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Tabel Desktop dengan Mencegah Text Wrapping & Mengatur Lebar Minimal --}}
    <div class="card border-0 shadow-sm rounded-4 d-none d-md-block mb-4">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0 text-nowrap">
            <thead class="table-light text-uppercase fs-7">
              <tr>
                <th class="py-3 px-3">ID</th>
                <th class="py-3 px-3">Nama Pelanggan</th>
                <th class="py-3 px-3">Periode</th>
                <th class="py-3 px-3">Paket</th>
                <th class="py-3 px-3">Total</th>
                <th class="py-3 px-3">Status</th>
                <th class="py-3 px-3 text-center">WA</th>
                <th class="py-3 px-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tagihan as $t)
              <tr>
                <td class="py-3 px-3 fw-bold">{{ $t->id_tagihan }}</td>
                <td class="py-3 px-3 fw-semibold text-dark">{{ $t->pelanggan->nama_pelanggan }}</td>
                <td class="py-3 px-3">{{ $t->periode_bulan }}/{{ $t->periode_tahun }}</td>
                <td class="py-3 px-3">{{ $t->pelanggan->paketWifi->nama_paket ?? '-' }}</td>
                <td class="py-3 px-3 fw-semibold text-dark">Rp {{ number_format($t->total_tagihan, 0, ',', '.') }}</td>
                <td class="py-3 px-3">
                  @if ($t->status == 'lunas')
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold">Lunas</span>
                  @elseif ($t->status == 'pending')
                    <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-bold">Menunggu</span>
                  @else
                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-bold">Belum</span>
                  @endif
                </td>
                <td class="py-3 px-3 text-center">
                  <a href="https://wa.me/{{ $t->pelanggan->no_whatsapp }}?text={{ urlencode('Halo ' . $t->pelanggan->nama_pelanggan . ', ini tagihan Anda untuk periode ' . $t->periode_bulan . '/' . $t->periode_tahun . ' sebesar Rp ' . number_format($t->total_tagihan, 0, ',', '.') . '. Segera lakukan pembayaran di dalam website fdlnet.my.id atau datang ke gerai. Sekian terima kasih. Hormat kami, TTD Fdlnet.') }}" target="_blank" class="btn btn-icon btn-round btn-success btn-sm shadow-sm" data-bs-toggle="tooltip" title="Kirim Pesan">
                      <i class="fab fa-whatsapp"></i>
                  </a>
                </td>
                <td class="py-3 px-3 text-center">
                  <div class="d-flex justify-content-center gap-1">
                      <a href="{{ route('admin.tagihan.show', $t->id_tagihan) }}" class="btn btn-icon btn-round btn-primary btn-sm shadow-sm" data-bs-toggle="tooltip" title="Lihat">
                      <i class="fa fa-eye"></i>
                      </a>
                      <a href="{{ route('admin.tagihan.edit', $t->id_tagihan) }}" class="btn btn-icon btn-round btn-warning btn-sm shadow-sm" data-bs-toggle="tooltip" title="Edit">
                      <i class="fa fa-edit"></i>
                      </a>
                      <form action="{{ route('admin.tagihan.destroy', $t->id_tagihan) }}" method="POST" class="d-inline" id="form-hapus-{{ $t->id_tagihan }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-icon btn-round btn-danger btn-sm shadow-sm btn-hapus" data-id="{{ $t->id_tagihan }}" data-bs-toggle="tooltip" title="Hapus">
                          <i class="fa fa-times"></i>
                        </button>
                      </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- End Tabel Desktop --}}

  </div>
</div>
@endsection