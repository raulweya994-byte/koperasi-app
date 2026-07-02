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
        <h5 class="text-primary mb-3"><i class="fas fa-store mr-2"></i>Koperasi ({{ $koperasi->count() }})</h5>
        @if($koperasi->count())
        <div class="table-responsive mb-4">
            <table class="table table-hover">
                <thead class="thead-light"><tr><th>Nama Usaha</th><th>Pemilik</th><th>Distrik</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($koperasi as $k)
                <tr>
                    <td><strong>{{ $k->nama_usaha }}</strong></td>
                    <td>{{ $k->nama_pemilik }}</td>
                    <td>{{ $k->distrik }}</td>
                    <td><span class="badge badge-success">{{ $k->status_verifikasi }}</span></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted mb-4">Tidak ada koperasi ditemukan.</p>
        @endif

        <h5 class="text-success mb-3"><i class="fas fa-users mr-2"></i>Anggota ({{ $anggota->count() }})</h5>
        @if($anggota->count())
        <div class="table-responsive">
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
        <p class="text-muted">Tidak ada anggota ditemukan.</p>
        @endif
    </div>
</div>
@endsection
