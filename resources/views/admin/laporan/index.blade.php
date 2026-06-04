@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Laporan</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Koperasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_koperasi'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-store fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Koperasi Terverifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['koperasi_verified'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-check-circle fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Koperasi Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['koperasi_pending'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Bantuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_bantuan'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-hand-holding-usd fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Penerima Bantuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['penerima_bantuan'] }}</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header font-weight-bold">Laporan Koperasi</div>
                <div class="card-body">
                    <p class="text-muted">Lihat dan ekspor data laporan Koperasi.</p>
                    <a href="{{ route('admin.laporan.koperasi') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-file-alt mr-1"></i> Buka Laporan Koperasi
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header font-weight-bold">Laporan Bantuan</div>
                <div class="card-body">
                    <p class="text-muted">Lihat dan ekspor data laporan penerima bantuan.</p>
                    <a href="{{ route('admin.laporan.bantuan') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-file-alt mr-1"></i> Buka Laporan Bantuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
