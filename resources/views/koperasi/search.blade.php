@extends('layouts.app')
@section('title','Hasil Pencarian')
@section('page-title','Pencarian')
@section('breadcrumb')
<li class="breadcrumb-item active">Pencarian</li>
@endsection
@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-search mr-2"></i>Hasil: <strong>"{{ $q }}"</strong></h3>
    </div>
    <div class="card-body">
        <h5 class="text-primary mb-3"><i class="fas fa-gift mr-2"></i>Program Bantuan ({{ $bantuan->count() }})</h5>
        @if($bantuan->count())
        <div class="table-responsive mb-4">
            <table class="table table-hover">
                <thead class="thead-light"><tr><th>Nama Bantuan</th><th>Jenis</th><th>Tahun</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($bantuan as $b)
                <tr>
                    <td><strong>{{ $b->nama_bantuan }}</strong></td>
                    <td>{{ $b->jenis_bantuan }}</td>
                    <td>{{ $b->tahun }}</td>
                    <td><span class="badge badge-success">{{ $b->status }}</span></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-4">Tidak ada bantuan ditemukan.</p>
        @endif

        <h5 class="text-warning mb-3"><i class="fas fa-calendar mr-2"></i>Jadwal ({{ $jadwal->count() }})</h5>
        @if($jadwal->count())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light"><tr><th>Judul</th><th>Tanggal</th><th>Lokasi</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($jadwal as $j)
                <tr>
                    <td><strong>{{ $j->judul }}</strong></td>
                    <td>{{ $j->tanggal->format('d M Y') }}</td>
                    <td>{{ $j->lokasi ?? '-' }}</td>
                    <td><span class="badge badge-{{ $j->status_color }}">{{ $j->status_label }}</span></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted">Tidak ada jadwal ditemukan.</p>
        @endif
    </div>
</div>
@endsection
