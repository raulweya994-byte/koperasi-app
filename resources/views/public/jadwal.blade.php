
@extends("public.layouts.app")
@section("title","Jadwal Kegiatan")
@section("content")
<section style="background:linear-gradient(135deg,#0d2240,#1a3a6e);padding:60px 0;">
    <div class="container text-white text-center">
        <h1 class="font-weight-bold"><i class="fas fa-calendar-alt mr-3"></i>Jadwal Kegiatan</h1>
        <p class="mb-0">Jadwal kegiatan DISPERINDAGKOP Kabupaten Tolikara</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        @forelse($jadwal as $j)
        <div class="card shadow-sm mb-3" style="border-left:4px solid #1a3a6e;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <div style="background:#f8f9fa;border-radius:12px;padding:15px;">
                            <div style="font-size:28px;font-weight:900;color:#1a3a6e;">{{ $j->tanggal->format("d") }}</div>
                            <div style="font-size:12px;color:#666;">{{ $j->tanggal->format("M Y") }}</div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5 class="font-weight-bold mb-1">{{ $j->judul }}</h5>
                        <span class="badge badge-{{ $j->jenis_color }} mr-1">{{ $j->jenis_label }}</span>
                        <span class="badge badge-{{ $j->status_color }}">{{ $j->status_label }}</span>
                        @if($j->lokasi)<small class="d-block mt-1 text-muted"><i class="fas fa-map-marker-alt mr-1"></i>{{ $j->lokasi }}</small>@endif
                        @if($j->deskripsi)<p class="mb-0 mt-1 small text-muted">{{ Str::limit($j->deskripsi,120) }}</p>@endif
                    </div>
                    <div class="col-md-2 text-right">
                        <small class="text-muted d-block"><i class="fas fa-clock mr-1"></i>{{ substr($j->jam_mulai,0,5) }}</small>
                        @if($j->jam_selesai)<small class="text-muted">s/d {{ substr($j->jam_selesai,0,5) }}</small>@endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="fas fa-calendar-times fa-3x d-block mb-3" style="opacity:.2"></i>
            <p>Belum ada jadwal yang dipublikasikan</p>
        </div>
        @endforelse
        <div class="mt-3">{{ $jadwal->links("pagination::bootstrap-4") }}</div>
    </div>
</section>
@endsection
