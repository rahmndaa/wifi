@extends('layouts.admin-master')

@section('content')
<div class="container-fluid">
    <h3>Detail ODC: {{ $odc->nama_odc }}</h3>
    <p>Lokasi: {{ $odc->lokasi }}</p>
    
    <div class="d-flex justify-content-between mb-3">
        <h5>Daftar ODP</h5>
        <a href="{{ route('admin.odp.create', ['id_odc' => $odc->id_odc]) }}" class="btn btn-primary btn-sm">Tambah ODP</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama ODP</th>
                <th>Lokasi</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($odc->odps as $odp)
            <tr>
                <td>{{ $odp->nama_odp }}</td>
                <td>{{ $odp->lokasi }}</td>
                <td>{{ $odp->kapasitas }}</td>
                <td>
                    <a href="{{ route('admin.odp.show', $odp->id_odp) }}" class="btn btn-info btn-sm">Lihat Pelanggan</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection