@extends('public.layouts.app')
@section('title','Kontak - DISPERINDAGKOP Tolikara')
@section('content')
<div class="page-header">
<div class="container">
<h1><i class="fas fa-envelope mr-3"></i>Hubungi Kami</h1>
<nav><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('public.home') }}">Beranda</a></li><li class="breadcrumb-item active">Kontak</li></ol></nav>
</div>
</div>
<section class="section">
<div class="container">
<div class="row">
<div class="col-lg-4 mb-4">
<div class="card border-0 shadow-sm h-100" style="border-radius:12px">
<div class="card-body p-4">
<h5 class="font-weight-bold mb-4" style="color:var(--primary)">Informasi Kontak</h5>
<div class="d-flex mb-4">
<div style="width:45px;height:45px;background:#e8f0ff;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-right:15px"><i class="fas fa-map-marker-alt" style="color:var(--primary)"></i></div>
<div><strong>Alamat</strong><p class="text-muted mb-0" style="font-size:13px">Jl. Raya Karubaga, Kecamatan Kanggime, Kabupaten Tolikara, Papua Pegunungan 99551</p></div>
</div>
<div class="d-flex mb-4">
<div style="width:45px;height:45px;background:#fff3e0;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-right:15px"><i class="fas fa-phone" style="color:#f57c00"></i></div>
<div><strong>Telepon</strong><p class="text-muted mb-0" style="font-size:13px">(0964) 123456</p></div>
</div>
<div class="d-flex mb-4">
<div style="width:45px;height:45px;background:#e8f5e9;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-right:15px"><i class="fas fa-envelope" style="color:#2e7d32"></i></div>
<div><strong>Email</strong><p class="text-muted mb-0" style="font-size:13px">info@disperindagkop.tolikara.go.id</p></div>
</div>
<div class="d-flex">
<div style="width:45px;height:45px;background:#fce4ec;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-right:15px"><i class="fas fa-clock" style="color:#c62828"></i></div>
<div><strong>Jam Layanan</strong><p class="text-muted mb-0" style="font-size:13px">Senin - Jumat: 08.00 - 16.00 WIT<br>Sabtu - Minggu: Tutup</p></div>
</div>
</div>
</div>
</div>
<div class="col-lg-8">
<div class="card border-0 shadow-sm" style="border-radius:12px">
<div class="card-header bg-white border-bottom p-4">
<h5 class="mb-0 font-weight-bold" style="color:var(--primary)"><i class="fas fa-paper-plane mr-2"></i>Kirim Pesan</h5>
</div>
<div class="card-body p-4">
@if(session("success"))
<div class="alert alert-success alert-dismissible" role="alert" style="border-radius:12px;border:none;background:linear-gradient(135deg,#d1fae5,#a7f3d0);color:#065f46;font-weight:600">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2" style="color:#059669"></i>
    {{ session("success") }}
</div>
@endif
@if(session("error"))
<div class="alert alert-danger alert-dismissible" role="alert" style="border-radius:12px;border:none">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-exclamation-circle mr-2"></i>
    {{ session("error") }}
</div>
@endif
<div class="alert alert-info"><i class="fas fa-info-circle mr-2"></i>Untuk layanan lebih cepat, hubungi kami melalui telepon atau email langsung.</div>
<form method="POST" action="{{ route('public.kontak.store') }}">
@csrf
<div class="row">
<div class="col-md-6 mb-3">
    <label>Nama Lengkap <span class="text-danger">*</span></label>
    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
           placeholder="Nama Anda" value="{{ old('nama') }}" required minlength="3">
    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-6 mb-3">
    <label>Email <span class="text-danger">*</span></label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           placeholder="email@anda.com" value="{{ old('email') }}" required>
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
</div>
<div class="mb-3">
    <label>No. Telepon <small class="text-muted">(min. 10 digit)</small></label>
    <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
           placeholder="08xx-xxxx-xxxx" value="{{ old('telepon') }}" minlength="10">
    @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label>Subjek <span class="text-danger">*</span></label>
    <input type="text" name="subjek" class="form-control @error('subjek') is-invalid @enderror"
           placeholder="Perihal pesan Anda" value="{{ old('subjek') }}" required>
    @error('subjek')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label>Pesan <span class="text-danger">*</span></label>
    <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror"
              rows="5" placeholder="Tulis pesan Anda di sini... (min. 10 karakter)"
              required minlength="10">{{ old('pesan') }}</textarea>
    @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<button type="submit" class="btn btn-primary btn-block py-2">
    <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
</button>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
