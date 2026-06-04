@extends('public.layouts.app')
@section('title', $halaman->judul . ' - DISPERINDAGKOP Tolikara')
@section('content')

<div class="page-header">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h1><i class="{{ $halaman->icon }} mr-3"></i>{{ $halaman->judul }}</h1>
      </div>
      <div class="col-md-4">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="{{ route('public.home') }}">Beranda</a></li>
          <li class="breadcrumb-item active">{{ $halaman->judul }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="section">
  <div class="container">
    @if($halaman->gambar)
    <img src="{{ Storage::url($halaman->gambar) }}" class="img-fluid rounded float-left mr-4 mb-3"
         style="max-height:220px;width:280px;object-fit:cover;object-position:top">
    @endif
    <div class="row">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded">
          <div class="card-body p-4" style="line-height:1.9;font-size:15px">
            @if($halaman->konten)
              {!! nl2br(e($halaman->konten)) !!}
            @else
              <p class="text-muted text-center py-4"><i class="fas fa-file-alt fa-2x mb-3 d-block"></i>Konten belum tersedia.</p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="card border-0 shadow-sm rounded">
          <div class="card-header" style="background:var(--primary);color:#fff;border-radius:8px 8px 0 0">
            <h6 class="mb-0"><i class="fas fa-building mr-2"></i>Menu Profil</h6>
          </div>
          <div class="list-group list-group-flush">
            @php
            $menuProfil = [
              ['visi-misi','fas fa-bullseye','Visi & Misi'],
              ['perindustrian','fas fa-industry','Perindustrian'],
              ['perdagangan','fas fa-shopping-cart','Perdagangan'],
              ['profil-koperasi','fas fa-handshake','Koperasi'],
              ['nilai','fas fa-star','Nilai'],
              ['komitmen','fas fa-award','Komitmen'],
              ['struktur-organisasi','fas fa-sitemap','Struktur Organisasi'],
            ];
            @endphp
            @foreach($menuProfil as $m)
            <a href="{{ route('public.halaman', $m[0]) }}"
               class="list-group-item list-group-item-action d-flex align-items-center
               {{ $halaman->slug === $m[0] ? 'active' : '' }}"
               style="{{ $halaman->slug === $m[0] ? 'background:var(--primary);color:#fff;border-color:var(--primary);' : '' }}">
              <i class="{{ $m[1] }} mr-3"
                 style="width:18px;color:{{ $halaman->slug === $m[0] ? '#f5a623' : 'var(--accent)' }}"></i>
              {{ $m[2] }}
            </a>
            @endforeach
          </div>
        </div>
        <div class="card border-0 shadow-sm rounded mt-3"
             style="background:var(--primary);color:#fff">
          <div class="card-body p-4">
            <h6 class="font-weight-bold mb-3">
              <i class="fas fa-phone-alt mr-2" style="color:#f5a623"></i>Hubungi Kami
            </h6>
            <p class="mb-1" style="font-size:13px;opacity:.9">
              <i class="fas fa-map-marker-alt mr-2"></i>Jl. Raya Karubaga, Tolikara
            </p>
            <p class="mb-1" style="font-size:13px;opacity:.9">
              <i class="fas fa-phone mr-2"></i>(0964) 123456
            </p>
            <p class="mb-3" style="font-size:13px;opacity:.9">
              <i class="fas fa-envelope mr-2"></i>info@disperindagkop.tolikara.go.id
            </p>
            <a href="{{ route('public.kontak') }}" class="btn btn-sm btn-warning font-weight-bold">
              <i class="fas fa-envelope mr-1"></i> Kirim Pesan
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
