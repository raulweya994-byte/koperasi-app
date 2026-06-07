@extends('layouts.app')
@section('title', 'Detail Pengajuan Modal Usaha')
@section('page-title', 'Detail Pengajuan Modal Usaha')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pimpinan.pengajuan-bantuan.index') }}">Pengajuan Modal Usaha</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Detail Pengajuan</h3>
                <div class="card-tools">
                    <a href="{{ route('pimpinan.pengajuan-bantuan.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th width="35%">Nama Pemohon</th><td>{{ $pengajuan->nama_pemohon }}</td></tr>
                    <tr><th>No. HP</th><td>{{ $pengajuan->no_hp }}</td></tr>
                    <tr><th>Email</th><td>{{ $pengajuan->email }}</td></tr>
                    <tr><th>Nama Usaha</th><td>{{ $pengajuan->nama_usaha }}</td></tr>
                    <tr><th>Jenis Bantuan</th><td><span class="badge badge-info">{{ $pengajuan->jenis_bantuan }}</span></td></tr>
                    <tr><th>Jumlah Diajukan</th><td><strong class="text-success">Rp {{ number_format($pengajuan->jumlah_diajukan, 0, ',', '.') }}</strong></td></tr>
                    <tr><th>Tujuan Penggunaan</th><td>{{ $pengajuan->tujuan_penggunaan }}</td></tr>
                    <tr><th>Status</th><td>
                        @if($pengajuan->status == 'pending')
                            <span class="badge badge-warning badge-lg">Pending</span>
                        @elseif($pengajuan->status == 'disetujui')
                            <span class="badge badge-success badge-lg">Disetujui</span>
                        @else
                            <span class="badge badge-danger badge-lg">Ditolak</span>
                        @endif
                    </td></tr>
                    <tr><th>Catatan Admin</th><td>{{ $pengajuan->catatan_admin ?? '-' }}</td></tr>
                    <tr><th>Tanggal Pengajuan</th><td>{{ $pengajuan->created_at->format('d/m/Y H:i') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-store mr-2"></i>Info Koperasi</h3></div>
            <div class="card-body">
                @if($pengajuan->koperasi)
                <p><strong>Nama:</strong> {{ $pengajuan->koperasi->nama_usaha }}</p>
                <p><strong>Pemilik:</strong> {{ $pengajuan->koperasi->nama_pemilik }}</p>
                <p><strong>Distrik:</strong> {{ $pengajuan->koperasi->distrik }}</p>
                <p><strong>Status:</strong>
                    <span class="badge badge-{{ $pengajuan->koperasi->status_verifikasi == 'diverifikasi' ? 'success' : 'warning' }}">
                        {{ $pengajuan->koperasi->status_verifikasi }}
                    </span>
                </p>
                @else
                <p class="text-muted">Data koperasi tidak ditemukan</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection