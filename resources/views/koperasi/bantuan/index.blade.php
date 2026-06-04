@extends('layouts.app')
@section('title','Program Bantuan')
@section('page-title','Program Bantuan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('koperasi.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Program Bantuan</li>
@endsection
@section('content')
<div class="row">
@forelse($bantuan as $b)
<div class="col-md-6 mb-4">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <h5 class="card-title font-weight-bold text-primary">{{ $b->nama_bantuan }}</h5>
                <span class="badge badge-{{ $b->status === 'aktif' ? 'success' : 'secondary' }}">{{ ucfirst($b->status) }}</span>
            </div>
            <p class="text-muted small mb-2"><i class="fas fa-calendar mr-1"></i>{{ $b->tahun }} • {{ $b->periode }}</p>
            <p class="card-text">{{ Str::limit($b->deskripsi, 100) }}</p>
            <div class="row text-center mt-3 mb-3">
                <div class="col-4">
                    <strong class="d-block text-primary">{{ $b->kuota }}</strong>
                    <small class="text-muted">Kuota</small>
                </div>
                <div class="col-4">
                    <strong class="d-block text-success">Rp {{ number_format($b->anggaran,0,',','.') }}</strong>
                    <small class="text-muted">Anggaran</small>
                </div>
                <div class="col-4">
                    <strong class="d-block text-info">{{ $b->penerima->count() }}</strong>
                    <small class="text-muted">Pendaftar</small>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <a href="{{ route('koperasi.bantuan.show', $b) }}" class="btn btn-primary btn-sm btn-block">
                <i class="fas fa-eye mr-1"></i> Lihat Detail & Daftar
            </a>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="text-center py-5">
        <i class="fas fa-hand-holding-usd fa-4x d-block mb-3" style="opacity:.15"></i>
        <h5 class="text-muted">Belum ada program bantuan aktif</h5>
    </div>
</div>
@endforelse
</div>
@if($bantuan->count())
<div class="d-flex justify-content-center">{{ $bantuan->links('pagination::bootstrap-4') }}</div>
@endif
@endsection
