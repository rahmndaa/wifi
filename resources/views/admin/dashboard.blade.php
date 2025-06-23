@extends('layouts.admin-master')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Dashboard</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="icon-home"></i></a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      </ul>
    </div>

    <div class="row mb-4">
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-wifi"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Paket</p>
               <h4 class="card-title">{{ $totalPaket ?? 0 }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-history"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Transaksi</p>
                  <h4 class="card-title">{{$totalTagihanMenunggu ?? 0}}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-warning bubble-shadow-small">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Pelanggan</p>
                  <h4 class="card-title">{{ $totalPelanggan ?? 0 }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-danger bubble-shadow-small">
                  <i class="fas fa-info-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Keluhan</p>
                  <h4 class="card-title">{{ $totalKeluhanMenunggu ?? 0 }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mb-4">
  {{-- Aset --}}
  <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div class="icon-big text-center icon-primary bubble-shadow-small">
              <i class="fas fa-box"></i>
            </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">Aset</p>
              <h4 class="card-title">{{ $totalAset ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
{{-- Aset Tersedia --}}
<div class="col-sm-6 col-md-3">
  <div class="card card-stats card-round">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col-icon">
          <div class="icon-big text-center icon-success bubble-shadow-small">
            <i class="fas fa-clipboard-check"></i>
          </div>
        </div>
        <div class="col col-stats ms-3 ms-sm-0">
          <div class="numbers">
            <p class="card-category">Aset Tersedia</p>
            <h4 class="card-title">{{ $asetTersedia ?? 0 }}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  {{-- Aset Digunakan --}}
  <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div class="icon-big text-center icon-warning bubble-shadow-small">
              <i class="fas fa-check-circle"></i>
            </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">Aset Digunakan</p>
              <h4 class="card-title">{{ $asetDigunakan ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Aset Rusak --}}
  <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div class="icon-big text-center icon-danger bubble-shadow-small">
              <i class="fas fa-times-circle"></i>
            </div>
          </div>
          <div class="col col-stats ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">Aset Rusak</p>
              <h4 class="card-title">{{ $asetRusak ?? 0 }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  </div>
</div>
@endsection
