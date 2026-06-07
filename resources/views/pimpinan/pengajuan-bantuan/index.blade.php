@extends('layouts.app')
@section('title', 'Pengajuan Modal Usaha')
@section('page-title', 'Pengajuan Modal Usaha')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pengajuan Modal Usaha</li>
@endsection
@section('content')
<div class="row mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-primary">
            <div class="inner"><h3>{{ $stats['total'] }}</h3><p>Total Pengajuan</p></div>
            <div class="icon"><i class="fas fa-file-alt"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-warning">
            <div class="inner"><h3>{{ $stats['pending'] }}</h3><p>Menunggu</p></div>
            <div class="icon"><i class="fas fa-clock"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-success">
            <div class="inner"><h3>{{ $stats['disetujui'] }}</h3><p>Disetujui</p></div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-gradient-danger">
            <div class="inner"><h3>{{ $stats['ditolak'] }}</h3><p>Ditolak</p></div>
            <div class="icon"><i class="fas fa-times-circle"></i></div>
        </div>
    </div>
</div>
<div class="card card-outline card-primary mb-4">
    <div class="card-body">
        <form method="GET" class="row align-items-end">
            <div class="col-md-4">
                <label>Cari</label>
                <input type="text" name="search" class="form-control" placeholder="Nama pemohon / usaha..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="disetujui" {{ request('status')=='disetujui'?'selected':'' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter mr-1"></i> Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('pimpinan.pengajuan-bantuan.index') }}" class="btn btn-secondary btn-block"><i class="fas fa-redo mr-1"></i> Reset</a>
            </div>
        </form>
    </div>
</div>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-hand-holding-usd mr-2"></i>Daftar Pengajuan Modal Usaha</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th>Nama Usaha</th>
                    <th>Jenis Bantuan</th>
                    <th>Jumlah Diajukan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengajuan as $i => $p)
                <tr>
                    <td>{{ $pengajuan->firstItem() + $i }}</td>
                    <td><strong>{{ $p->nama_pemohon }}</strong><br><small class="text-muted">{{ $p->no_hp }}</small></td>
                    <td>{{ $p->nama_usaha }}</td>
                    <td><span class="badge badge-info">{{ $p->jenis_bantuan }}</span></td>
                    <td><strong class="text-success">Rp {{ number_format($p->jumlah_diajukan, 0, ',', '.') }}</strong></td>
                    <td>
                        @if($p->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($p->status == 'disetujui')
                            <span class="badge badge-success">Disetujui</span>
                        @else
                            <span class="badge badge-danger">Ditolak</span>
                        @endif
                    </td>
                    <td><small>{{ $p->created_at->format('d/m/Y') }}</small></td>
                    <td>
                        <a href="{{ route('pimpinan.pengajuan-bantuan.show', $p->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">
                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>Tidak ada pengajuan
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pengajuan->hasPages())
    <div class="card-footer">{{ $pengajuan->links('pagination::bootstrap-4') }}</div>
    @endif
</div>
@endsection