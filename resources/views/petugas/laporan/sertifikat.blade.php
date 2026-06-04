@extends('layouts.app')
@section('title','Sertifikat Koperasi')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div class="page-header-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Sertifikat Koperasi</h3>
                                <p class="page-header-subtitle">Daftar koperasi terverifikasi dan cetak sertifikat</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.laporan.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-box">
                <form method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Cari Koperasi</label>
                                <div class="search-box-modern">
                                    <i class="fas fa-search"></i>
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari nama usaha atau pemilik..." 
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Distrik</label>
                                <select name="distrik" class="form-control">
                                    <option value="">Semua Distrik</option>
                                    @foreach($distrik as $d)
                                        <option value="{{ $d }}" {{ request('distrik')===$d?'selected':'' }}>{{ $d }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary-modern btn-block">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="{{ route('petugas.laporan.sertifikat') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="content-card">
        <div class="content-card-header">
            <h5 class="content-card-title">
                <i class="fas fa-list"></i> Daftar Sertifikat Terverifikasi
                <span class="badge badge-custom badge-orange ml-2">{{ $koperasi->total() }}</span>
            </h5>
        </div>
        
        <div class="content-card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">No. Registrasi</th>
                            <th width="20%">Nama Usaha</th>
                            <th width="15%">Pemilik</th>
                            <th width="12%">Distrik</th>
                            <th width="10%">Kategori</th>
                            <th width="12%">Tgl Verifikasi</th>
                            <th width="14%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($koperasi as $i => $u)
                        <tr>
                            <td>{{ $koperasi->firstItem()+$i }}</td>
                            <td>
                                <code style="background:#fef3c7;color:#d97706;padding:4px 8px;border-radius:6px;font-size:11px;font-weight:600">
                                    {{ $u->no_registrasi }}
                                </code>
                            </td>
                            <td>
                                <strong style="color:#1a3a6e">{{ $u->nama_usaha }}</strong>
                            </td>
                            <td>
                                <span class="text-muted">
                                    <i class="fas fa-user mr-1"></i>{{ $u->nama_pemilik }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $u->distrik }}
                                </span>
                            </td>
                            <td>
                                @if($u->kategori === 'mikro')
                                    <span class="badge badge-info-modern">
                                        <i class="fas fa-store"></i> Mikro
                                    </span>
                                @elseif($u->kategori === 'kecil')
                                    <span class="badge badge-success-modern">
                                        <i class="fas fa-store-alt"></i> Kecil
                                    </span>
                                @else
                                    <span class="badge badge-warning-modern">
                                        <i class="fas fa-building"></i> {{ ucfirst($u->kategori) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="far fa-calendar mr-1"></i>
                                    {{ $u->verified_at ? \Carbon\Carbon::parse($u->verified_at)->format('d/m/Y') : '-' }}
                                </small>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('petugas.laporan.cetakSertifikat', $u) }}" 
                                   target="_blank" 
                                   class="btn btn-sm btn-warning-modern"
                                   title="Cetak Sertifikat">
                                    <i class="fas fa-certificate"></i> Cetak PDF
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-certificate"></i>
                                    <h5>Belum Ada Koperasi Terverifikasi</h5>
                                    <p>Koperasi yang sudah terverifikasi akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($koperasi->hasPages())
        <div class="content-card-body">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $koperasi->firstItem() }}–{{ $koperasi->lastItem() }} dari {{ $koperasi->total() }} koperasi
                </small>
                <div>
                    {{ $koperasi->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
