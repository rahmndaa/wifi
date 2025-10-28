@extends('layouts.admin-master')

@section('content')

<div class="container">
  <div class="page-inner">
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

    {{-- Form Generate dan Tambah Tagihan --}}
    <div class="row mb-3">
        <div class="col-md-2">
          <form action="{{ route('admin.tagihan.generate') }}" method="POST" id="form-generate-tagihan">
            @csrf
            <button type="button" class="btn btn-black btn-sm w-100" id="btn-generate-tagihan">
              <i class="fa fa-plus"></i> Generate tagihan
            </button>
          </form>
      </div>

      <div class="col-md-2">
        <a href="{{ route('admin.tagihan.create') }}" class="btn btn-primary btn-sm w-100">
          <i class="fa fa-plus"></i> Tambah Tagihan
        </a>
      </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.tagihan') }}" class="row mb-4">
      <div class="col-md-2">
        <select name="tahun" class="form-control">
          <option value="">Tahun</option>
          @for ($i = 2020; $i <= 2030; $i++)
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

    {{-- Tabel Tagihan --}}
    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-hover text-nowrap ">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Periode</th>
              <th>Paket</th>
              <th>Total tagihan</th>
              <th>Status</th>
              <th>WA</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($tagihan as $t)
            <tr>
              <td>{{ $t->id_tagihan }}</td>
              <td>{{ $t->pelanggan->nama_pelanggan }}</td>
              <td>{{ $t->periode_bulan }}/{{ $t->periode_tahun }}</td>
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
                <div class="form-button-action">
                    <a href="https://wa.me/{{ $t->pelanggan->no_whatsapp }}?text={{ urlencode('Halo ' . $t->pelanggan->nama_pelanggan . ', ini tagihan Anda untuk periode ' . $t->periode_bulan . '/' . $t->periode_tahun . ' sebesar Rp ' . number_format($t->total_tagihan, 0, ',', '.') . 
                    '. Segera lakukan pembayaran di dalam website fdlnet.my.id atau datang ke gerai. Sekian terima kasih. Hormat kami, TTD Fdlnet.') }}" target="_blank" class="btn btn-link btn-success btn-sm" data-bs-toggle="tooltip" title="Kirim Pesan">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </a>
                </div>

              </td>
                <td>
                <div class="form-button-action">
                    <a href="{{ route('admin.tagihan.show', $t->id_tagihan) }}" class="btn btn-link btn-primary btn-sm" data-bs-toggle="tooltip" title="Lihat Tagihan">
                    <i class="fa fa-eye fa-lg"></i>
                    </a>
                    <a href="{{ route('admin.tagihan.edit', $t->id_tagihan) }}" class="btn btn-link btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Tagihan">
                    <i class="fa fa-edit fa-lg"></i>
                    </a>
                    <form action="{{ route('admin.tagihan.destroy', $t->id_tagihan) }}" method="POST" class="d-inline" id="form-hapus-{{ $t->id_tagihan }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-link btn-danger btn-sm btn-hapus" data-id="{{ $t->id_tagihan }}" data-bs-toggle="tooltip" title="Hapus Tagihan">
                        <i class="fa fa-times fa-lg"></i>
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
    {{-- End Tabel --}}
  </div>
</div>
@endsection
