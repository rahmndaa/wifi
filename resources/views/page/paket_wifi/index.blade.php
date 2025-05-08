@extends('layouts.admin-master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
             <h3 class="mb-3">Paket WiFi</h3>
            <div class="row mb-2 align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('admin.paket_wifi.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah paket
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
                                        <th>Nama Paket</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paket as $p)
                                    <tr> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_paket }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.paket_wifi.show', $p->id_paket) }}" class="btn btn-sm btn-primary mr-2 btn-xs">
                                                <i class="fa fa-eye fa-xs"> Detail</i>
                                            </a>
                                            <a href="{{ route('admin.paket_wifi.edit', $p->id_paket) }}" class="btn btn-sm btn-success mr-2 btn-xs">
                                                <i class="fa fa-edit fa-xs"> Edit</i>
                                            </a>
                                            <form action="{{ route('admin.paket_wifi.destroy', $p->id_paket) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash fa-xs"> Hapus</i>
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
            </div>
        </div>
    </section>
</div>
@endsection
