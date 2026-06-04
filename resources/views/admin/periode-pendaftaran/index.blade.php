@extends('layouts.app')
@section('title', 'Periode Pendaftaran Anggota')
@section('page-title', 'Periode Pendaftaran Anggota')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
    <li class="breadcrumb-item active">Periode Pendaftaran</li>
@endsection

@push('styles')
<style>
.periode-item {
    position: relative;
}
.toggle-btn:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 20px rgba(0,0,0,.3) !important;
}
.toggle-btn:active {
    transform: translateY(-1px) scale(0.98);
}
.btn-primary:hover {
    background: #0d2240 !important;
    transform: translateY(-2px);
}
.btn-danger:hover {
    background: #c82333 !important;
    transform: translateY(-2px);
}
.btn-sm {
    transition: all .2s;
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}
.periode-item:hover .toggle-btn {
    animation: pulse 2s infinite;
}
</style>
@endpush

@section('content')
{{-- Header Actions --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.periode-pendaftaran.create') }}" class="btn btn-success" style="background:linear-gradient(135deg,#10b981,#059669);border:none;border-radius:10px;padding:10px 24px;font-weight:700;box-shadow:0 4px 15px rgba(16,185,129,.3)">
        <i class="fas fa-plus-circle mr-1"></i> Buat Periode Baru
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="border-radius:12px;border-left:4px solid #10b981">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" style="border-radius:12px;border-left:4px solid #dc3545">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
</div>
@endif

<div class="card" style="border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,.08);border:none">
    <div class="card-header" style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:16px 16px 0 0;padding:20px">
        <h3 class="card-title" style="color:#fff;font-weight:700;font-size:18px">
            <i class="fas fa-list mr-2" style="color:#f5a623"></i>Daftar Periode Pendaftaran
        </h3>
        <div class="card-tools">
            <span class="badge badge-light" style="font-size:13px;padding:8px 16px">
                Total: {{ $periode->total() }} Periode
            </span>
        </div>
    </div>
    
    <div class="card-body" style="padding:0">
        @if($periode->count() > 0)
            @foreach($periode as $item)
            <div class="periode-item" style="padding:24px;border-bottom:1px solid #e9ecef;background:#fff;transition:all .2s" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='#fff'">
                <div class="row align-items-center">
                    {{-- Icon & Info --}}
                    <div class="col-lg-6 col-md-6">
                        <div style="display:flex;align-items:center;gap:16px">
                            {{-- Icon Calendar --}}
                            <div style="width:64px;height:64px;background:linear-gradient(135deg,{{ $item->status === 'aktif' ? '#10b981,#059669' : '#fbbf24,#f59e0b' }});border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 6px 16px rgba({{ $item->status === 'aktif' ? '16,185,129' : '251,191,36' }},.45);position:relative">
                                @if($item->status === 'aktif')
                                    <i class="fas fa-calendar-check" style="font-size:28px;color:#fff"></i>
                                @else
                                    <i class="fas fa-calendar-times" style="font-size:28px;color:#fff"></i>
                                @endif
                                <div style="position:absolute;top:-6px;right:-6px;width:24px;height:24px;background:{{ $item->status === 'aktif' ? '#10b981' : '#f59e0b' }};border-radius:50%;display:flex;align-items:center;justify-content:center;border:3px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.2)">
                                    <i class="fas {{ $item->status === 'aktif' ? 'fa-unlock' : 'fa-lock' }}" style="font-size:10px;color:#fff"></i>
                                </div>
                            </div>
                            
                            {{-- Info --}}
                            <div style="flex:1">
                                <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
                                    <h5 style="color:#1a3a6e;font-weight:800;font-size:17px;margin:0">
                                        {{ $item->nama_periode }}
                                    </h5>
                                    @if($item->status === 'aktif')
                                        <span class="badge" style="background:linear-gradient(135deg,#10b981,#059669);color:#fff;font-size:11px;padding:6px 14px;border-radius:20px;font-weight:700;box-shadow:0 2px 8px rgba(16,185,129,.3)">
                                            <i class="fas fa-unlock mr-1"></i>BUKA
                                        </span>
                                    @else
                                        <span class="badge" style="background:linear-gradient(135deg,#fbbf24,#f59e0b);color:#fff;font-size:11px;padding:6px 14px;border-radius:20px;font-weight:700;box-shadow:0 2px 8px rgba(251,191,36,.3)">
                                            <i class="fas fa-lock mr-1"></i>TUTUP
                                        </span>
                                    @endif
                                </div>
                                <div style="display:flex;flex-wrap:wrap;gap:16px;font-size:13px;color:#6c757d;margin-bottom:6px">
                                    <span>
                                        <i class="fas fa-graduation-cap mr-1" style="color:#f5a623"></i>
                                        <strong>{{ $item->tahun_ajaran }}</strong>
                                    </span>
                                    <span>
                                        <i class="fas fa-calendar mr-1" style="color:#1a3a6e"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                    </span>
                                </div>
                                @if($item->deskripsi)
                                <p style="color:#6c757d;font-size:13px;margin:0;line-height:1.6">
                                    {{ Str::limit($item->deskripsi, 100) }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="col-lg-3 col-md-3">
                        <div class="row">
                            <div class="col-6">
                                <div style="text-align:center;padding:16px 12px;background:linear-gradient(135deg,#f0f4ff,#e8f0fe);border-radius:12px">
                                    <div style="font-size:32px;font-weight:800;color:#1a3a6e;line-height:1">{{ $item->jumlah_pendaftar ?? 0 }}</div>
                                    <div style="font-size:11px;color:#6c757d;font-weight:600;margin-top:6px">Pendaftar</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div style="text-align:center;padding:16px 12px;background:linear-gradient(135deg,#fff8f0,#fef3e8);border-radius:12px">
                                    <div style="font-size:32px;font-weight:800;color:#f5a623;line-height:1">{{ $item->kuota ?? '∞' }}</div>
                                    <div style="font-size:11px;color:#6c757d;font-weight:600;margin-top:6px">Kuota</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="col-lg-3 col-md-3">
                        <div style="display:flex;flex-direction:column;gap:10px">
                            {{-- Toggle Button --}}
                            <form action="{{ route('admin.periode-pendaftaran.toggle', $item) }}" method="POST" style="margin:0">
                                @csrf
                                @if($item->status === 'aktif')
                                    <button type="button" 
                                            class="btn btn-block toggle-btn" 
                                            style="background:linear-gradient(135deg,#fbbf24,#f59e0b);border:none;border-radius:10px;padding:12px 16px;font-weight:700;color:#fff;box-shadow:0 4px 14px rgba(251,191,36,.4);transition:all .2s;font-size:14px;position:relative;overflow:hidden"
                                            onclick="confirmToggle(this, 'Tutup Pendaftaran', 'Apakah Anda yakin ingin menutup periode pendaftaran ini?')">
                                        <i class="fas fa-lock mr-2"></i> Tutup Pendaftaran
                                        <div style="position:absolute;top:0;right:0;width:40px;height:100%;background:rgba(255,255,255,.1);transform:skewX(-15deg);margin-right:-10px"></div>
                                    </button>
                                @else
                                    <button type="button" 
                                            class="btn btn-block toggle-btn" 
                                            style="background:linear-gradient(135deg,#10b981,#059669);border:none;border-radius:10px;padding:12px 16px;font-weight:700;color:#fff;box-shadow:0 4px 14px rgba(16,185,129,.4);transition:all .2s;font-size:14px;position:relative;overflow:hidden"
                                            onclick="confirmToggle(this, 'Buka Pendaftaran', 'Apakah Anda yakin ingin membuka periode pendaftaran ini? Periode lain yang aktif akan ditutup otomatis.')">
                                        <i class="fas fa-unlock mr-2"></i> Buka Pendaftaran
                                        <div style="position:absolute;top:0;right:0;width:40px;height:100%;background:rgba(255,255,255,.1);transform:skewX(-15deg);margin-right:-10px"></div>
                                    </button>
                                @endif
                            </form>

                            {{-- Action Buttons --}}
                            <div style="display:flex;gap:8px">
                                <a href="{{ route('admin.periode-pendaftaran.edit', $item) }}" 
                                   class="btn btn-primary btn-sm" 
                                   style="flex:1;background:#1a3a6e;border:none;border-radius:8px;padding:10px;font-weight:600;font-size:13px"
                                   title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-danger btn-sm" 
                                        style="flex:1;border-radius:8px;padding:10px;font-weight:600;font-size:13px"
                                        onclick="confirmDelete({{ $item->id }}, '{{ $item->nama_periode }}')"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div style="padding:60px 20px;text-align:center">
                <i class="fas fa-calendar-times" style="font-size:64px;color:#e9ecef;margin-bottom:16px"></i>
                <h5 style="color:#6c757d;font-weight:600">Belum Ada Periode Pendaftaran</h5>
                <p style="color:#adb5bd;font-size:14px">Klik tombol "Buat Periode Baru" untuk menambahkan periode pendaftaran</p>
            </div>
        @endif
    </div>

    @if($periode->hasPages())
    <div class="card-footer" style="background:#f8f9fa;border-radius:0 0 16px 16px;padding:20px">
        {{ $periode->links() }}
    </div>
    @endif
</div>

{{-- Form Delete Hidden --}}
<form id="delete-form" method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmToggle(button, title, text) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1a3a6e',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $(button).closest('form').submit();
        }
    });
}

function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Periode?',
        html: `Apakah Anda yakin ingin menghapus periode <strong>${nama}</strong>?<br><small class="text-danger">Periode yang sudah memiliki pendaftar tidak dapat dihapus!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('delete-form');
            form.action = `/admin/periode-pendaftaran/${id}`;
            form.submit();
        }
    });
}

// Auto dismiss alerts
setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);
</script>
@endpush
