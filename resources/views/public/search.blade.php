@extends('public.layouts.app')
@section('title','Hasil Pencarian')
@section('content')
<div class="container py-5">
    <h3 class="font-weight-bold mb-4"><i class="fas fa-search mr-2"></i>Hasil Pencarian: <strong>"{{ $q }}"</strong></h3>

    {{-- Koperasi --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-store mr-2 text-primary"></i>Koperasi ({{ $koperasi->count() }})</h5></div>
        <div class="card-body">
            @if($koperasi->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light"><tr><th>Nama Koperasi</th><th>Distrik</th><th>Status</th></tr></thead>
                    <tbody>
                    @foreach($koperasi as $k)
                    <tr>
                        <td><a href="{{ route('public.koperasi.detail', $k->id) }}"><strong>{{ $k->nama_usaha }}</strong></a></td>
                        <td>{{ $k->distrik }}</td>
                        <td><span class="badge badge-success">Terverifikasi</span></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else<p class="text-muted">Tidak ada koperasi ditemukan.</p>@endif
        </div>
    </div>

    {{-- Berita --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-newspaper mr-2 text-info"></i>Berita ({{ $berita->count() }})</h5></div>
        <div class="card-body">
            @if($berita->count())
            @foreach($berita as $b)
            <div class="mb-3 pb-3 border-bottom">
                <a href="{{ route('public.berita.detail', $b->slug ?? $b->id) }}"><strong>{{ $b->judul }}</strong></a>
                <small class="text-muted d-block">{{ $b->created_at->format('d M Y') }}</small>
            </div>
            @endforeach
            @else<p class="text-muted">Tidak ada berita ditemukan.</p>@endif
        </div>
    </div>

    {{-- Pengumuman --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-bullhorn mr-2 text-warning"></i>Pengumuman ({{ $pengumuman->count() }})</h5></div>
        <div class="card-body">
            @if($pengumuman->count())
            @foreach($pengumuman as $p)
            <div class="mb-3 pb-3 border-bottom">
                <strong>{{ $p->judul }}</strong>
                <small class="text-muted d-block">{{ $p->created_at->format('d M Y') }}</small>
            </div>
            @endforeach
            @else<p class="text-muted">Tidak ada pengumuman ditemukan.</p>@endif
        </div>
    </div>

    {{-- Jadwal --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header"><h5 class="mb-0"><i class="fas fa-calendar mr-2 text-success"></i>Jadwal ({{ $jadwal->count() }})</h5></div>
        <div class="card-body">
            @if($jadwal->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light"><tr><th>Judul</th><th>Tanggal</th><th>Lokasi</th></tr></thead>
                    <tbody>
                    @foreach($jadwal as $j)
                    <tr>
                        <td><strong>{{ $j->judul }}</strong></td>
                        <td>{{ $j->tanggal->format('d M Y') }}</td>
                        <td>{{ $j->lokasi ?? '-' }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else<p class="text-muted">Tidak ada jadwal ditemukan.</p>@endif
        </div>
    </div>
</div>
@endsection
