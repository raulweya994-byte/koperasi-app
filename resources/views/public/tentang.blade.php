@extends('public.layouts.app')
@section('title','Tentang - DISPERINDAGKOP Tolikara')
@section('content')
<div class="page-header">
<div class="container">
<h1><i class="fas fa-info-circle mr-3"></i>Tentang Kami</h1>
<nav><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('public.home') }}">Beranda</a></li><li class="breadcrumb-item active">Tentang</li></ol></nav>
</div>
</div>
<section class="section">
<div class="container">
<div class="row align-items-center mb-5">
<div class="col-lg-6 mb-4">
<h2 style="color:var(--primary);font-weight:700">Dinas Perindustrian, Perdagangan, Koperasi dan UMKM</h2>
<div style="width:50px;height:4px;background:var(--accent);margin:15px 0"></div>
<p>Dinas Perindustrian, Perdagangan, Koperasi dan UMKM (DISPERINDAGKOP) Kabupaten Tolikara adalah instansi pemerintah yang bertugas melaksanakan kewenangan otonomi daerah di bidang perindustrian, perdagangan, koperasi dan pemberdayaan Koperasi.</p>
<p>Kami berkomitmen untuk mendorong pertumbuhan ekonomi lokal yang inklusif dan berkelanjutan demi kesejahteraan masyarakat Kabupaten Tolikara.</p>
</div>
<div class="col-lg-6">
<div class="row">
<div class="col-6 mb-3"><div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px"><i class="fas fa-bullseye fa-2x mb-3" style="color:var(--primary)"></i><h6 class="font-weight-bold">Visi</h6><p class="text-muted" style="font-size:13px">Terwujudnya Koperasi Tolikara yang berdaya saing dan mandiri</p></div></div>
<div class="col-6 mb-3"><div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px"><i class="fas fa-tasks fa-2x mb-3" style="color:var(--secondary)"></i><h6 class="font-weight-bold">Misi</h6><p class="text-muted" style="font-size:13px">Meningkatkan kapasitas dan daya saing Koperasi lokal</p></div></div>
<div class="col-6 mb-3"><div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px"><i class="fas fa-star fa-2x mb-3" style="color:var(--accent)"></i><h6 class="font-weight-bold">Nilai</h6><p class="text-muted" style="font-size:13px">Profesional, transparan, inovatif dan berintegritas</p></div></div>
<div class="col-6 mb-3"><div class="card border-0 shadow-sm text-center p-4" style="border-radius:12px"><i class="fas fa-handshake fa-2x mb-3" style="color:#28a745"></i><h6 class="font-weight-bold">Komitmen</h6><p class="text-muted" style="font-size:13px">Pelayanan prima untuk seluruh pelaku Koperasi</p></div></div>
</div>
</div>
</div>
<div class="row mt-3">
<div class="col-12"><h4 class="font-weight-bold mb-4" style="color:var(--primary)">Tugas Pokok & Fungsi</h4></div>
<div class="col-md-4 mb-3"><div class="card border-0 shadow-sm h-100 p-4" style="border-radius:12px;border-left:4px solid var(--primary)!important"><h6 class="font-weight-bold" style="color:var(--primary)"><i class="fas fa-industry mr-2"></i>Perindustrian</h6><p class="text-muted" style="font-size:13px">Pembinaan dan pengembangan industri kecil dan menengah, fasilitasi perizinan, dan peningkatan daya saing produk industri lokal.</p></div></div>
<div class="col-md-4 mb-3"><div class="card border-0 shadow-sm h-100 p-4" style="border-radius:12px;border-left:4px solid var(--secondary)!important"><h6 class="font-weight-bold" style="color:var(--secondary)"><i class="fas fa-shopping-cart mr-2"></i>Perdagangan</h6><p class="text-muted" style="font-size:13px">Pengembangan pasar, perlindungan konsumen, pengawasan barang beredar, dan peningkatan akses pasar bagi pelaku usaha lokal.</p></div></div>
<div class="col-md-4 mb-3"><div class="card border-0 shadow-sm h-100 p-4" style="border-radius:12px;border-left:4px solid #28a745!important"><h6 class="font-weight-bold" style="color:#28a745"><i class="fas fa-users mr-2"></i>Koperasi & Koperasi</h6><p class="text-muted" style="font-size:13px">Pendaftaran, pembinaan, dan pengembangan koperasi dan Koperasi, fasilitasi akses permodalan, dan pelatihan kewirausahaan.</p></div></div>
</div>
</div>
</section>

{{-- ═══════════ PETA LEAFLET ═══════════ --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<section style="padding:0">
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
