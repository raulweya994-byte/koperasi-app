@extends('layouts.app')
@section('title','Peserta Pelatihan')
@section('page-title','Peserta Pelatihan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.pelatihan.index') }}">Pelatihan</a></li>
    <li class="breadcrumb-item active">Peserta</li>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chalkboard-teacher mr-2"></i>{{ $pelatihan->judul }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="150"><i class="fas fa-building mr-2"></i>Penyelenggara</td>
                                <td>: {{ $pelatihan->penyelenggara ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><i class="far fa-calendar mr-2"></i>Tanggal</td>
                                <td>: {{ $pelatihan->tanggal_mulai->format('d M Y') }}
                                    @if($pelatihan->tanggal_selesai)
                                    s/d {{ $pelatihan->tanggal_selesai->format('d M Y') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-map-marker-alt mr-2"></i>Lokasi</td>
                                <td>: {{ $pelatihan->lokasi ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="150"><i class="fas fa-users mr-2"></i>Kuota</td>
                                <td>: {{ $pelatihan->kuota }} peserta</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-user-check mr-2"></i>Terdaftar</td>
                                <td>: <span class="badge badge-info">{{ $peserta->count() }} peserta</span></td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-info-circle mr-2"></i>Status</td>
                                <td>: 
                                    @if($pelatihan->status === 'dibuka')
                                        <span class="badge badge-success">Dibuka</span>
                                    @elseif($pelatihan->status === 'berlangsung')
                                        <span class="badge badge-primary">Berlangsung</span>
                                    @elseif($pelatihan->status === 'ditutup')
                                        <span class="badge badge-warning">Ditutup</span>
                                    @else
                                        <span class="badge badge-secondary">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-users mr-2"></i>Daftar Peserta</h3>
        <div class="card-tools">
            <span class="badge badge-lg badge-info">{{ $peserta->count() }} / {{ $pelatihan->kuota }} Peserta</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="25%">Nama Peserta</th>
                        <th width="15%">No HP</th>
                        <th width="20%">Koperasi</th>
                        <th width="15%" class="text-center">Status</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($peserta as $i=>$p)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        <strong>{{ $p->nama_peserta }}</strong>
                        <br><small class="text-muted"><i class="fas fa-envelope mr-1"></i>{{ $p->email }}</small>
                    </td>
                    <td><i class="fas fa-phone mr-1"></i>{{ $p->no_hp }}</td>
                    <td>
                        @if($p->koperasi)
                            {{ $p->koperasi->nama }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($p->status === 'diterima')
                            <span class="badge badge-success">Diterima</span>
                        @elseif($p->status === 'ditolak')
                            <span class="badge badge-danger">Ditolak</span>
                        @else
                            <span class="badge badge-warning">Menunggu</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <form method="POST" action="{{ route('admin.pelatihan.peserta.status', $p) }}" class="form-inline justify-content-center">
                            @csrf @method('PUT')
                            <select name="status" class="form-control form-control-sm mr-1" style="width:120px">
                                <option value="menunggu" {{ $p->status==='menunggu'?'selected':'' }}>Menunggu</option>
                                <option value="diterima" {{ $p->status==='diterima'?'selected':'' }}>Diterima</option>
                                <option value="ditolak" {{ $p->status==='ditolak'?'selected':'' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-save"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                        <p>Belum ada peserta yang mendaftar</p>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($peserta->count() > 0)
    <div class="card-footer">
        <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>Kembali
        </a>
    </div>
    @endif
</div>
@endsection