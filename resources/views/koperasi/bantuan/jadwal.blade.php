@extends('layouts.app')
@section('title','Jadwal Distribusi Bantuan')
@section('page-title','Jadwal Distribusi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('koperasi.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Jadwal Distribusi</li>
@endsection
@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title mb-0">
            <i class="fas fa-calendar-alt mr-2 text-primary"></i>Jadwal Distribusi Bantuan
        </h3>
    </div>
    <div class="card-body">
        @if($jadwal->count())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Program Bantuan</th>
                        <th>Tanggal Distribusi</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($jadwal as $i => $j)
                <tr>
                    <td>{{ $jadwal->firstItem()+$i }}</td>
                    <td><strong>{{ $j->bantuan->nama_bantuan ?? '-' }}</strong></td>
                    <td>
                        <i class="fas fa-calendar mr-1 text-primary"></i>
                        {{ $j->tanggal_distribusi ? \Carbon\Carbon::parse($j->tanggal_distribusi)->format('d F Y') : '-' }}
                        @if($j->jam)
                        <br><small class="text-muted"><i class="fas fa-clock mr-1"></i>{{ $j->jam }} WIT</small>
                        @endif
                    </td>
                    <td><i class="fas fa-map-marker-alt mr-1 text-danger"></i>{{ $j->lokasi ?? '-' }}</td>
                    <td><small>{{ $j->keterangan ?? '-' }}</small></td>
                    <td>
                        <span class="badge badge-{{ $j->status === 'terjadwal' ? 'info' : ($j->status === 'selesai' ? 'success' : 'secondary') }}">
                            {{ ucfirst($j->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-calendar-times fa-4x text-muted mb-3 d-block" style="opacity:.2"></i>
            <h5 class="text-muted">Belum ada jadwal distribusi</h5>
            <p class="text-muted">Jadwal distribusi bantuan akan tampil di sini.</p>
        </div>
        @endif
    </div>
    @if($jadwal->count())
    <div class="card-footer">{{ $jadwal->links('pagination::bootstrap-4') }}</div>
    @endif
</div>
@endsection
