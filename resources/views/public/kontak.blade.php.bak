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

{{-- ═══════════ PETA LEAFLET ═══════════ --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<section style="padding:30px 0;background:#1a2942;">
<div id="peta-disperindagkop" style="height:420px;width:100%;z-index:1"></div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Koordinat Kantor DISPERINDAGKOP Tolikara (Karubaga)
    var kantorLat = -3.610, kantorLng = 138.462;

    var map = L.map('peta-disperindagkop').setView([kantorLat, kantorLng], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 18
    }).addTo(map);

    // Icon kantor (biru)
    var iconKantor = L.divIcon({
        className: '',
        html: '<div style="background:#1a3a6e;color:#fff;padding:6px 10px;border-radius:8px;font-size:11px;font-weight:700;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,0,0.3)"><i class="fas fa-building"></i> DISPERINDAGKOP</div>',
        iconAnchor: [75, 30]
    });

    // Icon Koperasi (kuning)
    var iconKoperasi = L.divIcon({
        className: '',
        html: '<div style="background:#f5a623;color:#fff;width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;box-shadow:0 2px 6px rgba(0,0,0,0.3);border:2px solid #fff"><i class="fas fa-store"></i></div>',
        iconAnchor: [14, 14]
    });

    // Marker Kantor
    L.marker([kantorLat, kantorLng], {icon: iconKantor})
        .addTo(map)
        .bindPopup('<b>Kantor DISPERINDAGKOP</b><br>Jl. Raya Karubaga, Kab. Tolikara<br>Papua Pegunungan<br><small>Senin-Jumat: 08.00-16.00 WIT</small>');

    // Sebaran Koperasi per distrik Tolikara
    var distrikKoperasi = [
        {nama:'Bokondini',      lat:-3.648, lng:138.672, jml:5},
        {nama:'Karubaga',       lat:-3.610, lng:138.462, jml:4},
        {nama:'Kembu',          lat:-3.580, lng:138.520, jml:2},
        {nama:'Bewani',         lat:-3.700, lng:138.395, jml:1},
        {nama:'Kanggime',       lat:-3.540, lng:138.340, jml:1},
        {nama:'Bokoneri',       lat:-3.670, lng:138.500, jml:1},
        {nama:'Nunggawi',       lat:-3.625, lng:138.580, jml:1},
        {nama:'Goyage',         lat:-3.590, lng:138.430, jml:1},
    ];

    distrikKoperasi.forEach(function(d) {
        var marker = L.marker([d.lat, d.lng], {icon: iconKoperasi}).addTo(map);
        marker.bindPopup(
            '<b>Distrik ' + d.nama + '</b><br>' +
            '<i class="fas fa-store mr-1"></i><b>' + d.jml + ' Koperasi</b> terdaftar<br>' +
            '<small>Kabupaten Tolikara</small>'
        );
    });

    // Legenda
    var legenda = L.control({position: 'bottomright'});
    legenda.onAdd = function() {
        var div = L.DomUtil.create('div');
        div.style.cssText = 'background:#fff;padding:10px 14px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.2);font-size:12px;line-height:1.8';
        div.innerHTML = '<b style="color:#1a3a6e">Keterangan</b><br>' +
            '<span style="background:#1a3a6e;color:#fff;padding:2px 7px;border-radius:4px;font-size:11px">&#9632;</span> Kantor DISPERINDAGKOP<br>' +
            '<span style="background:#f5a623;color:#fff;padding:2px 7px;border-radius:4px;font-size:11px">&#9632;</span> Sebaran Koperasi';
        return div;
    };
    legenda.addTo(map);
});
</script>
@endpush
@endsection
