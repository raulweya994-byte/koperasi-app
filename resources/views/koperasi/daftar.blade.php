@extends('layouts.app')

@section('title', 'Daftar Koperasi')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-store mr-2"></i>Daftarkan Usaha Anda</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i>
                        Akun Anda belum terdaftar sebagai koperasi. Silakan hubungi admin.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
