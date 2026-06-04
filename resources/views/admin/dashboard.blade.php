

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>
<script>
$(function(){
var koperasi=@json(App\Models\Koperasi::select('distrik','status_verifikasi')->whereNotNull('distrik')->get()->groupBy('distrik')->map(function($g,$k){return['distrik'=>$k,'total'=>$g->count(),'tv'=>$g->where('status_verifikasi','terverifikasi')->count(),'mn'=>$g->where('status_verifikasi','menunggu_verifikasi')->count(),'dk'=>$g->where('status_verifikasi','ditolak')->count()];})->values());
var koord={'Karubaga':[-3.610,138.462],'Bokondini':[-3.648,138.672],'Tiom':[-3.680,138.395],'Kembu':[-3.580,138.520],'Bewani':[-3.700,138.395],'Bokoneri':[-3.670,138.500],'Geya':[-3.550,138.560],'Nabunage':[-3.720,138.440],'Kanggime':[-3.540,138.340]};
var map=L.map('peta-admin').setView([-3.620,138.480],9);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{attribution:'OpenStreetMap'}).addTo(map);
L.marker([-3.610,138.462],{icon:L.divIcon({className:'',html:'<div style="background:#1a3a6e;color:#fff;padding:5px 9px;border-radius:6px;font-size:11px;font-weight:700">DISPERINDAGKOP</div>',iconAnchor:[75,14]})}).addTo(map).bindPopup('<b>Kantor DISPERINDAGKOP</b>');
$.each(koperasi,function(i,v){var c=koord[v.distrik];if(!c)return;var clr=v.tv===v.total?'#1a3a6e':v.dk===v.total?'#dc3545':v.mn===v.total?'#f5a623':'#28a745';L.marker(c,{icon:L.divIcon({className:'',html:'<div style="background:'+clr+';color:#fff;width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:800;border:3px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,0.3)">'+v.total+'</div>',iconAnchor:[18,18]})}).addTo(map).bindPopup('<b>Distrik '+v.distrik+'</b><br>Total: '+v.total+' Koperasi<br>Verif: '+v.tv+' | Tunggu: '+v.mn);});
var leg=L.control({position:'bottomright'});leg.onAdd=function(){var e=L.DomUtil.create('div');e.style.cssText='background:#fff;padding:10px;border-radius:8px;font-size:12px;line-height:2;box-shadow:0 2px 8px rgba(0,0,0,0.2)';e.innerHTML='<b>Keterangan</b><br><span style="color:#1a3a6e">&#9679;</span> Terverifikasi<br><span style="color:#f5a623">&#9679;</span> Menunggu<br><span style="color:#28a745">&#9679;</span> Campuran';return e;};leg.addTo(map);
});
</script>
@endpush
