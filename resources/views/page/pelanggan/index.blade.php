@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
                <h3 class="mb-3">Pelanggan</h3>
            <div class="row mb-2 align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Pelanggan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>WhatsApp</thclass=>
                                        <th>Paket WiFi</ths=>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelanggan as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_pelanggan }}</td>
                                        <td>{{ $p->username }}</td>
                                        <td>{{ $p->no_whatsapp }}</td>
                                        <td>{{ $p->paketwifi->nama_paket ?? '-' }}</td>
                                        <td>
                                            @if ($p->status_pelanggan == 'aktif')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Arsip</span>
                                            @endif
                                        </td>
                                        <td class="text-center">

                                            <a href="{{ route('admin.pelanggan.show', $p->id_pelanggan) }}" class="btn btn-sm btn-primary btn-xs">
                                                <i class="fa fa-eye fa-xs"> Detail</i>
                                            </a>
                                            <a href="{{ route('admin.pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-sm btn-success btn-xs">
                                                <i class="fa fa-edit fa-xs"> Edit</i>
                                            </a>
                                            <form action="{{ route('admin.pelanggan.destroy', $p->id_pelanggan) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
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
            </div>
        </div>
    </section>
</div>
@endsection
