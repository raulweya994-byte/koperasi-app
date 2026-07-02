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
        <h5 class="text-success mb-3"><i class="fas fa-users mr-2"></i>Anggota ({{ $anggota->count() }})</h5>
        @if($anggota->count())
        <div class="table-responsive mb-4">
            <table class="table table-hover">
                <thead class="thead-light"><tr><th>No. Anggota</th><th>Nama</th><th>Distrik</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($anggota as $a)
                <tr>
                    <td><span class="badge badge-success">{{ $a->no_anggota }}</span></td>
                    <td><strong>{{ $a->nama }}</strong></td>
                    <td>{{ $a->distrik }}</td>
                    <td><span class="badge badge-{{ $a->status == 'Aktif' ? 'success' : 'secondary' }}">{{ $a->status }}</span></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-4">Tidak ada anggota ditemukan.</p>
        @endif

        <h5 class="text-primary mb-3"><i class="fas fa-calendar mr-2"></i>Jadwal ({{ $jadwal->count() }})</h5>
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
