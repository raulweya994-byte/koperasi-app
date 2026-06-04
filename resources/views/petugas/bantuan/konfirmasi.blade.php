@extends('layouts.app')
@section('title', 'Konfirmasi Penyaluran - ' . $bantuan->nama_bantuan)
@section('page-title', 'Konfirmasi Penyaluran Bantuan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.bantuan.index') }}">Bantuan</a></li>
    <li class="breadcrumb-item active">Konfirmasi Penyaluran</li>
@endsection
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

{{-- Info & Stats --}}
<div class="row mb-3">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-clipboard-check mr-2"></i>{{ $bantuan->nama_bantuan }}
                </h3>
                <div class="card-tools">
                    <a href="{{ route('petugas.bantuan.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{-- Progress Bar --}}
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="font-weight-bold">Progres Penyaluran</span>
                        <span class="font-weight-bold text-primary">{{ $stats['progres'] }}%</span>
                    </div>
                    <div class="progress" style="height:20px;border-radius:10px">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                             style="width:{{ $stats['progres'] }}%">
                            {{ $stats['progres'] }}%
                        </div>
                    </div>
                </div>
                {{-- Stats Cards --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-box bg-primary mb-2">
                            <span class="info-box-icon"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Penerima</span>
                                <span class="info-box-number">{{ $stats['total'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-success mb-2">
                            <span class="info-box-icon"><i class="fas fa-check-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tersalurkan</span>
                                <span class="info-box-number">{{ $stats['tersalurkan'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-warning mb-2">
                            <span class="info-box-icon"><i class="fas fa-times-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tidak Hadir</span>
                                <span class="info-box-number">{{ $stats['tidak_hadir'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-secondary mb-2">
                            <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Belum Konfirmasi</span>
                                <span class="info-box-number">{{ $stats['belum'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Penerima --}}
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list mr-2"></i>Daftar Penerima Bantuan</h3>
        <div class="card-tools">
            <input type="text" id="searchPenerima" class="form-control form-control-sm" 
                   placeholder="Cari penerima..." style="width:200px">
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0" id="tablePenerima">
            <thead class="thead-dark">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Koperasi</th>
                    <th>Nama Pemilik</th>
                    <th>Distrik</th>
                    <th>Status</th>
                    <th>Waktu Konfirmasi</th>
                    <th>Dikonfirmasi Oleh</th>
                    <th width="22%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penerima as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $p->koperasi->nama_usaha ?? '-' }}</strong></td>
                    <td>{{ $p->koperasi->nama_pemilik ?? '-' }}</td>
                    <td><span class="badge badge-secondary">{{ $p->koperasi->distrik ?? '-' }}</span></td>
                    <td>
                        @if($p->status_penyaluran === 'tersalurkan')
                            <span class="badge badge-success"><i class="fas fa-check mr-1"></i>Tersalurkan</span>
                        @elseif($p->status_penyaluran === 'tidak_hadir')
                            <span class="badge badge-warning"><i class="fas fa-times mr-1"></i>Tidak Hadir</span>
                        @else
                            <span class="badge badge-secondary"><i class="fas fa-clock mr-1"></i>Belum Dikonfirmasi</span>
                        @endif
                    </td>
                    <td>
                        <small class="text-muted">
                            {{ $p->waktu_konfirmasi ? \Carbon\Carbon::parse($p->waktu_konfirmasi)->format('d/m/Y H:i') : '-' }}
                        </small>
                    </td>
                    <td>
                        <small>{{ $p->dikonfirmasiOleh->name ?? '-' }}</small>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('petugas.bantuan.konfirmasiPenyaluran', $p) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="status_penyaluran" value="tersalurkan">
                            <button type="submit" class="btn btn-sm btn-success"
                                onclick="return confirm('Konfirmasi sebagai Tersalurkan?')">
                                <i class="fas fa-check mr-1"></i>Tersalurkan
                            </button>
                        </form>
                        <form method="POST" action="{{ route('petugas.bantuan.konfirmasiPenyaluran', $p) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="status_penyaluran" value="tidak_hadir">
                            <button type="submit" class="btn btn-sm btn-warning"
                                onclick="return confirm('Konfirmasi sebagai Tidak Hadir?')">
                                <i class="fas fa-times mr-1"></i>Tidak Hadir
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">
                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>Tidak ada penerima bantuan
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
$('#searchPenerima').on('keyup', function() {
    var val = $(this).val().toLowerCase();
    $('#tablePenerima tbody tr').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
    });
});
</script>
@endpush
@endsection
