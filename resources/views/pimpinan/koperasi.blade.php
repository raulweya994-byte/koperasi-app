@extends('layouts.app')
@section('title','Data Koperasi')
@section('page-title','Data Koperasi')
@section('breadcrumb')<li class="breadcrumb-item active">Koperasi</li>@endsection

@section('content')
<div class="container-fluid">
    {{-- Filter Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('pimpinan.koperasi') }}" id="filterForm">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Filter Distrik
                                </label>
                                <select name="distrik" class="form-control" style="border-radius:10px" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Distrik</option>
                                    @foreach($distrik as $d)
                                    <option value="{{ $d }}" {{ request('distrik') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-tag mr-1"></i>Filter Kategori
                                </label>
                                <select name="kategori" class="form-control" style="border-radius:10px" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Kategori</option>
                                    <option value="mikro" {{ request('kategori') == 'mikro' ? 'selected' : '' }}>Mikro</option>
                                    <option value="kecil" {{ request('kategori') == 'kecil' ? 'selected' : '' }}>Kecil</option>
                                    <option value="menengah" {{ request('kategori') == 'menengah' ? 'selected' : '' }}>Menengah</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-check-circle mr-1"></i>Filter Status
                                </label>
                                <select name="status" class="form-control" style="border-radius:10px" onchange="document.getElementById('filterForm').submit()">
                                    <option value="">Semua Status</option>
                                    <option value="diverifikasi" {{ request('status') == 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                @if(request('distrik') || request('kategori') || request('status'))
                                <a href="{{ route('pimpinan.koperasi') }}" class="btn btn-secondary" style="border-radius:10px">
                                    <i class="fas fa-redo mr-1"></i>Reset Filter
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#3b82f6,#2563eb)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-building fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ $koperasi->total() }}</h3>
                            <p class="mb-0" style="opacity:0.9">Total Koperasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(request('distrik') || request('kategori') || request('status'))
        <div class="col-md-9">
            <div class="alert alert-info mb-0" style="border-radius:16px">
                <i class="fas fa-info-circle mr-2"></i>
                Menampilkan koperasi
                @if(request('distrik'))
                    di <strong>Distrik {{ request('distrik') }}</strong>
                @endif
                @if(request('kategori'))
                    dengan kategori <strong>{{ ucfirst(request('kategori')) }}</strong>
                @endif
                @if(request('status'))
                    dengan status <strong>{{ ucfirst(request('status')) }}</strong>
                @endif
            </div>
        </div>
        @endif
    </div>

    {{-- Data Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                        <i class="fas fa-list mr-2"></i>Daftar Koperasi
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background:#f8f9fa">
                                <tr>
                                    <th style="padding:15px">#</th>
                                    <th>No. Registrasi</th>
                                    <th>Nama Usaha</th>
                                    <th>Distrik</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($koperasi as $i => $k)
                                <tr style="border-bottom:1px solid #e5e7eb">
                                    <td style="padding:15px">{{ $koperasi->firstItem()+$i }}</td>
                                    <td>
                                        <span class="badge badge-secondary" style="font-size:11px;padding:5px 10px">
                                            {{ $k->no_registrasi }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="font-weight-600" style="color:#1f2937">{{ $k->nama_usaha }}</div>
                                        <small class="text-muted">{{ $k->alamat }}</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info" style="font-size:11px;padding:5px 10px">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $k->distrik }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $k->kategori == 'mikro' ? 'primary' : ($k->kategori == 'kecil' ? 'success' : 'warning') }}" style="font-size:11px;padding:5px 10px">
                                            {{ ucfirst($k->kategori) }}
                                        </span>
                                    </td>
                                    <td>{!! $k->status_verifikasi_label !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pimpinan.koperasi.show', $k->id) }}" class="btn btn-sm btn-primary" style="border-radius:8px;padding:6px 16px">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block" style="opacity:0.3"></i>
                                        <p class="text-muted mb-0">Tidak ada data koperasi</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($koperasi->hasPages())
                <div class="card-footer" style="background:white;border-radius:0 0 16px 16px;padding:20px">
                    {{ $koperasi->links('pagination::bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    transform: scale(1.01);
    transition: all 0.3s;
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    border-radius: 8px;
    margin: 0 3px;
    border: none;
    color: #1a3a6e;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    border: none;
}
</style>
@endsection
