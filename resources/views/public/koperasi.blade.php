@extends('public.layouts.app')
@section('title','Direktori Koperasi - DISPERINDAGKOP Tolikara')

@section('content')
<div class="page-header">
<div class="container">
<h1><i class="fas fa-store mr-3"></i>Direktori Koperasi</h1>
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="{{ route('public.home') }}">Beranda</a></li>
<li class="breadcrumb-item active">Direktori Koperasi</li>
</ol>
</nav>
</div>
</div>

<section class="section">
<div class="container">

<!-- Search & Filter -->
<div class="card border-0 shadow-sm mb-4" style="border-radius:12px">
<div class="card-body p-4">
<form method="GET">
<div class="row">
<div class="col-md-5 mb-3 mb-md-0">
<div class="input-group">
<div class="input-group-prepend"><span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span></div>
<input type="text" name="search" class="form-control border-left-0" placeholder="Cari nama usaha, jenis, pemilik..." value="{{ request('search') }}">
</div>
</div>
<div class="col-md-3 mb-3 mb-md-0">
<select name="kategori" class="form-control">
<option value="">Semua Kategori</option>
<option value="mikro" {{ request('kategori')==='mikro'?'selected':'' }}>Usaha Mikro</option>
<option value="kecil" {{ request('kategori')==='kecil'?'selected':'' }}>Usaha Kecil</option>
<option value="menengah" {{ request('kategori')==='menengah'?'selected':'' }}>Usaha Menengah</option>
</select>
</div>
<div class="col-md-2 mb-3 mb-md-0">
<select name="distrik" class="form-control">
<option value="">Semua Distrik</option>
@foreach($distrik as $d)
<option value="{{ $d }}" {{ request('distrik')===$d?'selected':'' }}>{{ $d }}</option>
@endforeach
</select>
</div>
<div class="col-md-1">
<button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i></button>
</div>
<div class="col-md-1">
<a href="{{ route('public.koperasi') }}" class="btn btn-secondary w-100"><i class="fas fa-times"></i></a>
</div>
</div>
</form>
</div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
<p class="text-muted mb-0">Menampilkan <strong>{{ $koperasi->total() }}</strong> Koperasi terdaftar</p>
</div>

<div class="row">
@forelse($koperasi as $u)
<div class="col-md-4 col-sm-6 mb-4">
<div class="card-koperasi h-100">
<div class="card-icon">
<img src="{{ $u->foto_usaha ? asset('storage/'.$u->foto_usaha) : 'https://via.placeholder.com/400x200/1a3a6e/f5a623?text=Koperasi+Tolikara' }}" style="width:100%;height:100%;object-fit:cover;">
</div>
<div class="card-body">
<div class="d-flex justify-content-between align-items-start mb-2">
<span class="badge badge-{{ $u->kategori==='mikro'?'primary':($u->kategori==='kecil'?'success':'warning') }}">{{ ucfirst($u->kategori) }}</span>
<small class="text-muted">{{ $u->no_registrasi }}</small>
</div>
<h5>{{ $u->nama_usaha }}</h5>
<p class="text-distrik mb-1"><i class="fas fa-tag mr-1"></i>{{ $u->jenis_usaha }}</p>
<p class="text-distrik mb-2"><i class="fas fa-map-marker-alt mr-1" style="color:var(--secondary)"></i>{{ $u->distrik }}, {{ $u->kelurahan }}</p>
@if($u->jumlah_karyawan > 0)
<p class="text-distrik mb-2"><i class="fas fa-users mr-1"></i>{{ $u->jumlah_karyawan }} karyawan</p>
@endif
<a href="{{ route('public.koperasi.detail', $u) }}" class="btn btn-sm btn-primary w-100 mt-2">
<i class="fas fa-eye mr-1"></i>Lihat Detail
</a>
</div>
</div>
</div>
@empty
<div class="col-12">
<div class="text-center py-5">
<i class="fas fa-store fa-4x text-muted mb-3 d-block"></i>
<h5 class="text-muted">Koperasi tidak ditemukan</h5>
<p class="text-muted">Coba ubah kata kunci atau filter pencarian</p>
<a href="{{ route('public.koperasi') }}" class="btn btn-primary">Reset Pencarian</a>
</div>
</div>
@endforelse
</div>

<div class="d-flex justify-content-center mt-4">
{{ $koperasi->links('pagination::bootstrap-4') }}
</div>

</div>
</section>
@endsection
