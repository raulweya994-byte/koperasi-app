@extends('layouts.anggota')

@section('title', 'Pengumuman')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Pengumuman</li>
@endsection

@section('content')
<div class="container-fluid">
    {{-- 2 Column Layout --}}
    <div class="row">
        {{-- Left Column: Detail Pengumuman Terbaru --}}
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius:12px" id="pengumumanDetail">
                @if($pengumuman->isNotEmpty())
                    @php $featured = $pengumuman->first(); @endphp
                    <div class="card-header" style="background:linear-gradient(135deg,#2c5282,#1e3a5f);color:white;border-radius:12px 12px 0 0;padding:20px">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge px-3 py-2 mb-2" style="background:#f59e0b;color:white;font-size:0.75rem;border-radius:20px">
                                    <i class="fas fa-star mr-1"></i>PENGUMUMAN TERBARU
                                </span>
                                <h4 class="mb-2 font-weight-bold" id="detailJudul">{{ $featured->judul }}</h4>
                                <div class="d-flex align-items-center" style="font-size:0.85rem;opacity:0.9">
                                    <i class="far fa-calendar mr-2"></i><span id="detailTanggal">{{ $featured->created_at->format('d M Y') }}</span>
                                    <span class="mx-2">•</span>
                                    <i class="far fa-clock mr-2"></i><span id="detailWaktu">{{ $featured->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @if($featured->is_aktif)
                            <span class="badge badge-success" style="font-size:0.75rem" id="detailBadgeAktif">
                                <i class="fas fa-check-circle mr-1"></i>AKTIF
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-4" style="min-height:400px">
                        <div id="detailIsi" style="line-height:1.8;color:#4b5563;font-size:15px">
                            {!! nl2br(e($featured->isi)) !!}
                        </div>
                    </div>
                    <div class="card-footer bg-light" style="border-radius:0 0 12px 12px">
                        <small class="text-muted">
                            <i class="fas fa-info-circle mr-1"></i>
                            Dipublikasikan <span id="detailFooterWaktu">{{ $featured->created_at->diffForHumans() }}</span>
                        </small>
                    </div>
                @else
                    <div class="card-body text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3" style="opacity:0.3"></i>
                        <h5 class="text-muted">Belum Ada Pengumuman</h5>
                        <p class="text-muted mb-0">Pengumuman akan muncul di sini ketika ada informasi baru</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Column: List Pengumuman Lainnya --}}
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-header" style="background:white;border-radius:12px 12px 0 0;border-bottom:2px solid #e5e7eb;padding:15px 20px">
                    <h6 class="mb-0 font-weight-bold" style="color:#2c5282">
                        <i class="fas fa-list mr-2"></i>Semua Pengumuman
                    </h6>
                </div>
                <div class="card-body p-0" style="max-height:600px;overflow-y:auto">
                    @forelse($pengumuman as $index => $item)
                    <div class="pengumuman-item {{ $index === 0 ? 'active' : '' }}" 
                         data-id="{{ $item->id }}"
                         data-judul="{{ $item->judul }}"
                         data-isi="{{ e($item->isi) }}"
                         data-tanggal="{{ $item->created_at->format('d M Y') }}"
                         data-waktu="{{ $item->created_at->diffForHumans() }}"
                         data-aktif="{{ $item->is_aktif ? 'true' : 'false' }}"
                         style="cursor:pointer">
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="mr-3" style="flex-shrink:0">
                                    <div style="width:45px;height:45px;background:linear-gradient(135deg,#3b82f6,#2563eb);border-radius:8px;display:flex;align-items:center;justify-content:center">
                                        <i class="fas fa-bullhorn text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1" style="min-width:0">
                                    <h6 class="mb-1 font-weight-bold" style="color:#1e3a5f;font-size:14px;line-height:1.4">
                                        {{ Str::limit($item->judul, 60) }}
                                    </h6>
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="badge badge-info mr-2" style="font-size:0.7rem">
                                            <i class="far fa-calendar mr-1"></i>{{ $item->created_at->format('d M Y') }}
                                        </span>
                                        @if($item->is_aktif)
                                        <span class="badge badge-success" style="font-size:0.7rem">
                                            <i class="fas fa-check-circle mr-1"></i>AKTIF
                                        </span>
                                        @endif
                                    </div>
                                    <p class="mb-0 text-muted" style="font-size:12px">
                                        {{ Str::limit($item->isi, 80) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3" style="opacity:0.2"></i>
                        <p class="mb-0">Tidak ada pengumuman</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Pagination --}}
            @if($pengumuman->hasPages())
            <div class="mt-3">
                {{ $pengumuman->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.pengumuman-item {
    transition: all 0.3s ease;
    position: relative;
}

.pengumuman-item:hover {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
}

.pengumuman-item.active {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
}

.pengumuman-item.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #2c5282, #1e3a5f);
}

/* Scrollbar */
.card-body::-webkit-scrollbar {
    width: 6px;
}

.card-body::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #2c5282, #1e3a5f);
    border-radius: 3px;
}

.card-body::-webkit-scrollbar-track {
    background: #f5f7fa;
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeIn 0.3s ease;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Click pengumuman item
    $('.pengumuman-item').click(function() {
        // Remove active class from all items
        $('.pengumuman-item').removeClass('active');
        
        // Add active class to clicked item
        $(this).addClass('active');
        
        // Get data
        const judul = $(this).data('judul');
        const isi = $(this).data('isi');
        const tanggal = $(this).data('tanggal');
        const waktu = $(this).data('waktu');
        const aktif = $(this).data('aktif');
        
        // Update detail with animation
        $('#pengumumanDetail').addClass('fade-in');
        
        // Update content
        $('#detailJudul').text(judul);
        $('#detailIsi').html(isi.replace(/\n/g, '<br>'));
        $('#detailTanggal').text(tanggal);
        $('#detailWaktu').text(waktu);
        $('#detailFooterWaktu').text(waktu);
        
        // Update badge aktif
        if (aktif === 'true') {
            if ($('#detailBadgeAktif').length === 0) {
                $('#pengumumanDetail .card-header > div').append('<span class="badge badge-success" style="font-size:0.75rem" id="detailBadgeAktif"><i class="fas fa-check-circle mr-1"></i>AKTIF</span>');
            }
        } else {
            $('#detailBadgeAktif').remove();
        }
        
        // Remove animation class after animation completes
        setTimeout(function() {
            $('#pengumumanDetail').removeClass('fade-in');
        }, 300);
        
        // Scroll to top of detail (for mobile)
        if ($(window).width() < 992) {
            $('html, body').animate({
                scrollTop: $('#pengumumanDetail').offset().top - 100
            }, 300);
        }
    });
});
</script>
@endpush
@endsection
