@extends('public.layouts.app')
@section('title','Pelatihan')
@section('content')
<section style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0 40px;color:white;">
    <div class="container text-center">
        <i class="fas fa-chalkboard-teacher fa-2x mb-3 d-block" style="opacity:.8"></i>
        <h2 class="font-weight-bold mb-2">Program Pelatihan</h2>
        <p style="opacity:.75">Tingkatkan kapasitas usaha Anda melalui program pelatihan DISPERINDAGKOP</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row">
            @forelse($pelatihan as $p)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius:12px;overflow:hidden;">
                    @if($p->foto_url)
                    <img src="{{ $p->foto_url }}" style="height:180px;object-fit:cover;">
                    @else
                    <div style="height:180px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-chalkboard-teacher fa-3x text-white" style="opacity:.5"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        @php
                    $badgeColor = match($p->status) {
                        'dibuka'     => 'success',
                        'berlangsung'=> 'primary',
                        'selesai'    => 'secondary',
                        'ditutup'    => 'danger',
                        default      => 'info',
                    };
                    $badgeLabel = match($p->status) {
                        'dibuka'     => 'Pendaftaran Dibuka',
                        'berlangsung'=> 'Sedang Berlangsung',
                        'selesai'    => 'Selesai',
                        'ditutup'    => 'Ditutup',
                        default      => ucfirst($p->status),
                    };
                @endphp
                <span class="badge badge-{{ $badgeColor }} mb-2">{{ $badgeLabel }}</span>
                        <h5 class="font-weight-bold">{{ $p->judul }}</h5>
                        <p class="text-muted small">{{ Str::limit($p->deskripsi,100) }}</p>
                        <div class="mt-3" style="font-size:13px;">
                            <div class="mb-1"><i class="fas fa-calendar-alt mr-2 text-primary"></i>{{ $p->tanggal_mulai->format('d M Y') }}@if($p->tanggal_selesai) — {{ $p->tanggal_selesai->format('d M Y') }}@endif</div>
                            <div class="mb-1"><i class="fas fa-map-marker-alt mr-2 text-danger"></i>{{ $p->lokasi ?? '-' }}</div>
                            <div class="mb-1"><i class="fas fa-users mr-2 text-success"></i>Kuota: {{ $p->kuota }} peserta</div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pb-3">
                        @if($p->status === 'dibuka')
                        <a href="{{ route('pelatihan.daftar', $p) }}" class="btn btn-primary btn-block btn-sm">
                            <i class="fas fa-user-plus mr-1"></i>Daftar Sekarang
                        </a>
                        @elseif($p->status === 'berlangsung')
                        <button class="btn btn-info btn-block btn-sm" disabled>Sedang Berlangsung</button>
                        @else
                        <button class="btn btn-secondary btn-block btn-sm" disabled>Pendaftaran Ditutup</button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-muted">
                <i class="fas fa-chalkboard-teacher fa-3x mb-3 d-block" style="opacity:.2"></i>
                <p>Belum ada program pelatihan tersedia</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection