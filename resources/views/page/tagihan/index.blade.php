@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between mb-3">
                <h3 class="mb-0">Data Tagihan</h3>
            </div>

            <form action="{{ route('admin.tagihan.generate') }}" method="POST" class="row" onsubmit="return confirm('Yakin ingin generate tagihan bulan ini?')">
                @csrf
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success mb-3 btn-sm">
                        <i class="fa fa-plus"></i> Generate tagihan
                    </button>
                </div>
                
                <div class="col-md-6">
                    <a href="{{ route('admin.tagihan.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Tagihan
                    </a>
                </div>
            </form>

            {{-- Filter --}}
            
            <form method="GET" action="{{ route('admin.tagihan') }}" class="row mb-3">
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
                    <form action="{{ route('admin.tagihan') }}" method="GET" class="form-inline justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                
                
                
            </form>
            {{-- End Filter --}}

            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-responsive-sm ">
                        <thead>
                            <tr>
                                <th>ID Tagihan</th>
                                <th>Nama</th>
                                <th>Periode</th>
                                <th>Paket</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Bukti Transfer</th>
                                <th>WA</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihan as $t)
                            <tr>
                                <td>{{ $t->id_tagihan}}</td>
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
                                <td class="text-center">
                                    @php
                                        $pembayaran = DB::table('pembayaran')->where('id_tagihan', $t->id_tagihan)->first();
                                    @endphp
                                    @if ($pembayaran && $pembayaran->bukti_transfer)
                                        <a href="{{ Storage::url($pembayaran->bukti_transfer) }}" target="_blank" class="btn btn-primary btn-xs">
                                            <i class="fas fa-image fa-lg"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="https://wa.me/{{ $t->pelanggan->no_whatsapp }}?text={{ urlencode('Halo ' . $t->pelanggan->nama_pelanggan . ', ini tagihan Anda untuk periode ' . $t->periode_bulan . '/' . $t->periode_tahun . ' sebesar Rp ' . number_format($t->total_tagihan, 0, ',', '.') .
                                     '. Segera lakukan pembayaran di dalam website fdl.my.id atau datang ke gerai. Sekian terima kasih. Hormat kami, TTD Fadlnet.') }}" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fa fa-paper-plane fa-sm"></i>
                                    </a>   
                                </td>                                      
                                <td class="text-center">
                                    <a href="{{ route('admin.tagihan.show', $t->id_tagihan) }}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-eye fa-xs"> Detail</i> 
                                    </a>
                                    <a href="{{ route('admin.tagihan.edit', $t->id_tagihan) }}" class="btn btn-success btn-xs">
                                        <i class="fa fa-edit fa-xs"> Edit</i> 
                                    </a>
                                    <form action="{{ route('admin.tagihan.destroy', $t->id_tagihan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-xs" onclick="return confirm('Yakin hapus?')">
                                            <i class="fa fa-trash fa-xs"> Hapus</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection