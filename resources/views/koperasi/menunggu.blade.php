@extends('layouts.app')
@section('title','Menunggu Verifikasi')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm text-center" style="border-radius:20px">
                <div class="card-body p-5">
                    <div style="width:90px;height:90px;background:#fff8e1;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px">
                        <i class="fas fa-clock fa-3x" style="color:#f5a623"></i>
                    </div>
                    <h3 class="font-weight-bold" style="color:#1a3a6e">Menunggu Verifikasi</h3>
                    <p class="text-muted mt-3" style="font-size:15px;line-height:1.8">
                        Pendaftaran Anda sedang dalam proses verifikasi oleh admin DISPERINDAGKOP Kabupaten Tolikara.
                        Proses verifikasi membutuhkan waktu <strong>1-3 hari kerja</strong>.
                    </p>
                    <div class="card mt-4 mb-4" style="background:#f8f9fa;border-radius:12px;border:none">
                        <div class="card-body">
                            <div class="row text-left">
                                <div class="col-5 text-muted">Nama Usaha</div>
                                <div class="col-7 font-weight-bold">{{ $koperasi->nama_usaha }}</div>
                                <div class="col-5 text-muted mt-2">No. Registrasi</div>
                                <div class="col-7 font-weight-bold mt-2">{{ $koperasi->no_registrasi }}</div>
                                <div class="col-5 text-muted mt-2">Status</div>
                                <div class="col-7 mt-2">
                                    <span class="badge badge-warning px-3 py-2">Menunggu Verifikasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted" style="font-size:13px">
                        <i class="fas fa-info-circle mr-1"></i>
                        Anda akan mendapat notifikasi setelah admin memverifikasi pendaftaran Anda.
                    </p>
                    <div class="mt-3">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
