@extends('layouts.app')
@section('title','Pendaftaran Ditolak')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm text-center" style="border-radius:20px">
                <div class="card-body p-5">
                    <div style="width:90px;height:90px;background:#fff5f5;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px">
                        <i class="fas fa-times-circle fa-3x text-danger"></i>
                    </div>
                    <h3 class="font-weight-bold text-danger">Pendaftaran Ditolak</h3>
                    <p class="text-muted mt-3" style="font-size:15px;line-height:1.8">
                        Maaf, pendaftaran Anda ditolak oleh admin DISPERINDAGKOP.
                    </p>
                    @if($koperasi->catatan_verifikasi)
                    <div class="alert alert-danger mt-3 text-left">
                        <strong><i class="fas fa-exclamation-circle mr-1"></i>Alasan:</strong><br>
                        {{ $koperasi->catatan_verifikasi }}
                    </div>
                    @endif
                    <p class="text-muted mt-3" style="font-size:13px">
                        Silakan hubungi admin DISPERINDAGKOP untuk informasi lebih lanjut.
                    </p>
                    <p style="font-size:13px">
                        <i class="fas fa-phone mr-1"></i> (0964) 123456 &nbsp;|&nbsp;
                        <i class="fas fa-envelope mr-1"></i> info@disperindagkop.tolikara.go.id
                    </p>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm mt-2">
                            <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
