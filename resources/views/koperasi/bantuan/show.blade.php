@extends('layouts.app')
@section('title','Detail Bantuan')
@section('page-title','Detail Program Bantuan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('koperasi.bantuan.index') }}">Program Bantuan</a></li>
<li class="breadcrumb-item active">{{ $bantuan->nama_bantuan }}</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="font-weight-bold text-primary mb-1">{{ $bantuan->nama_bantuan }}</h4>
                <p class="text-muted mb-3"><i class="fas fa-calendar mr-1"></i>{{ $bantuan->tahun }} • {{ $bantuan->periode }}</p>
                <hr>
                <p>{{ $bantuan->deskripsi }}</p>
                @if($bantuan->syarat)
                <h6 class="font-weight-bold mt-4">Syarat & Ketentuan:</h6>
                <p>{{ $bantuan->syarat }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <span class="badge badge-{{ $bantuan->status === 'aktif' ? 'success' : 'secondary' }} px-3 py-2">
                        {{ ucfirst($bantuan->status) }}
                    </span>
                </div>
                <div class="mb-2"><strong>Kuota:</strong> {{ $bantuan->kuota }} Koperasi</div>
                <div class="mb-2"><strong>Anggaran:</strong> Rp {{ number_format($bantuan->anggaran,0,',','.') }}</div>
                <div class="mb-3"><strong>Pendaftar:</strong> {{ $bantuan->penerima->count() }}</div>
                <hr>
                @if($sudahDaftar)
                <div class="alert alert-success py-2">
                    <i class="fas fa-check-circle mr-1"></i> Sudah terdaftar
                </div>
                @elseif($bantuan->status === 'aktif')
                <p class="text-muted small">Pastikan data Koperasi Anda sudah lengkap sebelum mendaftar.</p>
                @else
                <div class="alert alert-warning py-2">
                    <i class="fas fa-info-circle mr-1"></i> Pendaftaran ditutup
                </div>
                @endif
                <a href="{{ route('koperasi.bantuan.index') }}" class="btn btn-secondary btn-sm btn-block mt-2">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
