@extends('layouts.admin-master')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Aset</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.aset') }}">Aset</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.aset.show', $aset->id_aset) }}">Detail</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Informasi Aset</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Nama Aset</dt>
                            <dd class="col-sm-9">{{ $aset->nama_aset }}</dd>

                            <dt class="col-sm-3">Tipe Aset</dt>
                            <dd class="col-sm-9">{{ $aset->tipe_aset }}</dd>

                            <dt class="col-sm-3">Merk</dt>
                            <dd class="col-sm-9">{{ $aset->merk ?? '-' }}</dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">
                                @if($aset->status_aset == 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @elseif($aset->status_aset == 'digunakan')
                                    <span class="badge bg-warning">Digunakan</span>
                                @elseif($aset->status_aset == 'rusak')
                                    <span class="badge bg-danger">Rusak</span>
                                @endif
                            </dd>
                            
                            <dt class="col-sm-3">Digunakan (Pelanggan)</dt>
                            <dd class="col-sm-9">{{ $aset->pelanggan->nama_pelanggan ?? '-' }}</dd>
                        </dl>

                        <div class="d-flex justify-content-start mt-4">
                            <a href="{{ route('admin.aset') }}" class="btn btn-danger btn-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
