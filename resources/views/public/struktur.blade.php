@extends('public.layouts.app')
@section('title', 'Struktur Organisasi')

@section('content')
<section style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0 40px;color:white;">
    <div class="container text-center">
        <i class="fas fa-sitemap fa-2x mb-3 d-block" style="opacity:.8"></i>
        <h2 class="font-weight-bold mb-2">Struktur Organisasi</h2>
        <p class="mb-0" style="opacity:.75">Dinas Perindustrian, Perdagangan, Koperasi dan UMKM<br>Kabupaten Tolikara</p>
    </div>
</section>

<section class="py-5" style="background:#f8f9fa;">

@php
$bagan = \App\Models\Setting::where('key','struktur_bagan')->first();
@endphp

@if($bagan && $bagan->value)
<div class="container mb-5">
    <div class="card border-0 shadow" style="border-radius:16px;overflow:hidden;">
        <div class="card-header text-white text-center py-3" style="background:#1a3a6e;">
            <h5 class="mb-0 font-weight-bold"><i class="fas fa-sitemap mr-2"></i>Bagan Struktur Organisasi</h5>
        </div>
        <div class="card-body text-center p-3">
            <img src="{{ asset('storage/'.$bagan->value) }}" class="img-fluid rounded" style="max-height:500px;cursor:pointer;" onclick="window.open(this.src)" title="Klik untuk perbesar">
            <p class="text-muted small mt-2"><i class="fas fa-search-plus mr-1"></i>Klik gambar untuk perbesar</p>
        </div>
    </div>
</div>
@endif
<div class="container">

@php
use App\Models\StrukturOrganisasi;
$struktur = StrukturOrganisasi::where('is_active',1)->orderBy('urutan')->get()->groupBy('bidang');
$bidangConfig = [
    'kepala_dinas'  => ['label'=>'Kepala Dinas','color'=>'#1a3a6e','icon'=>'fas fa-user-tie'],
    'sekretariat'   => ['label'=>'Sekretariat','color'=>'#2d5aa0','icon'=>'fas fa-building'],
    'perindustrian' => ['label'=>'Bidang Perindustrian','color'=>'#dc3545','icon'=>'fas fa-industry'],
    'perdagangan'   => ['label'=>'Bidang Perdagangan','color'=>'#28a745','icon'=>'fas fa-shopping-cart'],
    'koperasi'      => ['label'=>'Bidang Koperasi','color'=>'#f5a623','icon'=>'fas fa-handshake'],
    'koperasi'          => ['label'=>'Bidang Koperasi','color'=>'#8e44ad','icon'=>'fas fa-store'],
    'uptd'          => ['label'=>'UPTD','color'=>'#6c757d','icon'=>'fas fa-network-wired'],
];
@endphp

@foreach($bidangConfig as $key => $cfg)
@if(isset($struktur[$key]))
@php $items = $struktur[$key]; @endphp

<div class="mb-5">
    <div class="d-flex align-items-center mb-4">
        <div style="width:45px;height:45px;border-radius:50%;background:{{ $cfg['color'] }};display:flex;align-items:center;justify-content:center;margin-right:15px;flex-shrink:0;">
            <i class="{{ $cfg['icon'] }} text-white"></i>
        </div>
        <h5 class="font-weight-bold mb-0" style="color:{{ $cfg['color'] }}">{{ $cfg['label'] }}</h5>
        <hr class="flex-grow-1 ml-3" style="border-color:{{ $cfg['color'] }};opacity:.3;">
    </div>

    <div class="row">
        @foreach($items as $s)
        <div class="col-lg-3 col-md-4 col-6 mb-4">
            <div class="card border-0 shadow-sm text-center h-100" style="border-radius:12px;border-top:4px solid {{ $cfg['color'] }}!important;transition:.2s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="card-body p-3">
                    <div class="mb-3 d-flex justify-content-center">
                        <img src="{{ $s->foto_url }}"
                             class="border shadow-sm"
                             style="width:160px;height:220px;object-fit:cover;object-position:center;border-color:{{ $cfg['color'] }}!important;border-width:3px!important;border-radius:8px;">
                    </div>
                    <h6 class="font-weight-bold mb-1" style="font-size:13px;color:#333;">
                        {{ $s->nama ?? '( - )' }}
                    </h6>
                    @if($s->nip)
                    <small class="text-muted d-block mb-1">{{ $s->nip }}</small>
                    @endif
                    <span class="badge" style="background:{{ $cfg['color'] }};color:white;font-size:11px;white-space:normal;line-height:1.4;padding:4px 8px;">
                        {{ $s->jabatan }}
                    </span>
                    @if($s->sub_jabatan)
                    <div class="mt-1"><small class="text-muted">{{ $s->sub_jabatan }}</small></div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endforeach

</div>
</section>
@endsection