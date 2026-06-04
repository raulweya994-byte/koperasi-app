@extends('layouts.app')
@section('title','Riwayat Bantuan')
@section('page-title','Riwayat Bantuan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('koperasi.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Riwayat Bantuan</li>
@endsection
@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fas fa-history mr-2 text-info"></i>Riwayat Penerimaan Bantuan
        </h3>
    </div>
    <div class="card-body">
        @if(is_object($riwayat) && $riwayat->count())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Program Bantuan</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($riwayat as $i => $r)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        <strong>{{ $r->bantuan->nama_bantuan ?? '-' }}</strong>
                        <small class="d-block text-muted">{{ $r->bantuan->tahun ?? '' }}</small>
                    </td>
                    <td>{{ $r->created_at->format('d F Y') }}</td>
                    <td>
                        @php $badge = ['pending'=>'warning','disetujui'=>'success','ditolak'=>'danger','diterima'=>'primary'][$r->status] ?? 'secondary' @endphp
                        <span class="badge badge-{{ $badge }}">{{ ucfirst($r->status) }}</span>
                    </td>
                    <td><small>{{ $r->keterangan ?? '-' }}</small></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-history fa-4x d-block mb-3" style="opacity:.15"></i>
            <h5 class="text-muted">Belum ada riwayat bantuan</h5>
            <p class="text-muted">Riwayat penerimaan bantuan Anda akan tampil di sini.</p>
            <a href="{{ route('koperasi.bantuan.index') }}" class="btn btn-primary mt-2">
                <i class="fas fa-hand-holding-usd mr-1"></i> Lihat Program Bantuan
            </a>
        </div>
        @endif
    </div>
    @if(is_object($riwayat) && method_exists($riwayat,'links') && $riwayat->count())
    <div class="card-footer">{{ $riwayat->links('pagination::bootstrap-4') }}</div>
    @endif
</div>
@endsection
