@extends('layouts.app')
@section('title', 'Pengumuman')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#8b5cf6,#7c3aed)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                                <i class="fas fa-bullhorn fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="mb-1 font-weight-bold">Pengumuman</h3>
                                <p class="mb-0" style="opacity:0.9">Informasi dan pengumuman terbaru</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('petugas.pengumuman.create') }}" class="btn btn-light mb-2" style="border-radius:8px;font-weight:600">
                                <i class="fas fa-plus mr-2"></i>Buat Pengumuman
                            </a>
                            <div>
                                <h2 class="mb-0 font-weight-bold">{{ $pengumuman->total() }}</h2>
                                <small style="opacity:0.9">Total Pengumuman</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:12px;border:none">
                <div class="card-body">
                    <form method="GET" action="{{ route('petugas.pengumuman.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border-radius:8px 0 0 8px;background:#f8f9fa;border:1px solid #e5e7eb">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="Cari pengumuman..." value="{{ request('search') }}" style="border-radius:0 8px 8px 0;border-left:none">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="jenis" class="form-control" style="border-radius:8px">
                                <option value="">Semua Jenis</option>
                                <option value="info" {{ request('jenis') == 'info' ? 'selected' : '' }}>Info</option>
                                <option value="warning" {{ request('jenis') == 'warning' ? 'selected' : '' }}>Peringatan</option>
                                <option value="success" {{ request('jenis') == 'success' ? 'selected' : '' }}>Sukses</option>
                                <option value="danger" {{ request('jenis') == 'danger' ? 'selected' : '' }}>Penting</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block" style="border-radius:8px">
                                <i class="fas fa-filter mr-1"></i>Filter
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('petugas.pengumuman.index') }}" class="btn btn-secondary btn-block" style="border-radius:8px">
                                <i class="fas fa-redo mr-1"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengumuman List --}}
    <div class="row">
        @forelse($pengumuman as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card pengumuman-card shadow-sm h-100" style="border-radius:16px;border:none;overflow:hidden;transition:all 0.3s">
                {{-- Badge Jenis --}}
                <div class="card-header border-0" style="background:{{ $item->jenis == 'info' ? 'linear-gradient(135deg,#3b82f6,#2563eb)' : ($item->jenis == 'warning' ? 'linear-gradient(135deg,#f59e0b,#d97706)' : ($item->jenis == 'success' ? 'linear-gradient(135deg,#10b981,#059669)' : 'linear-gradient(135deg,#ef4444,#dc2626)')) }};padding:15px 20px">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div>
                            <i class="fas {{ $item->jenis == 'info' ? 'fa-info-circle' : ($item->jenis == 'warning' ? 'fa-exclamation-triangle' : ($item->jenis == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle')) }} mr-2"></i>
                            <span class="font-weight-bold">{{ strtoupper($item->jenis) }}</span>
                        </div>
                        <small style="opacity:0.9">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small>
                    </div>
                </div>

                <div class="card-body p-4">
                    <h5 class="card-title font-weight-bold mb-3" style="color:#1f2937;line-height:1.4">
                        {{ Str::limit($item->judul, 60) }}
                    </h5>
                    <p class="card-text text-muted mb-3" style="font-size:14px;line-height:1.6">
                        {{ Str::limit(strip_tags($item->isi), 100) }}
                    </p>
                    
                    {{-- Info --}}
                    <div class="d-flex align-items-center justify-content-between mb-3" style="font-size:13px;color:#6b7280">
                        <div>
                            <i class="far fa-calendar mr-1"></i>
                            {{ $item->hari }}, {{ $item->jam }}
                        </div>
                        <div>
                            <i class="far fa-user mr-1"></i>
                            {{ $item->user->name ?? 'Admin' }}
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="btn-group btn-block" role="group">
                        @canView('pengumuman')
                            <a href="{{ route('petugas.pengumuman.show', $item->id) }}" class="btn btn-outline-primary" style="border-radius:8px 0 0 8px;font-weight:600;flex:1">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endcanView
                        
                        @canEdit('pengumuman')
                            <a href="{{ route('petugas.pengumuman.edit', $item->id) }}" class="btn btn-outline-warning" style="font-weight:600;flex:1">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endcanEdit
                        
                        @canDelete('pengumuman')
                            <button type="button" class="btn btn-outline-danger" style="border-radius:0 8px 8px 0;font-weight:600;flex:1" onclick="confirmDelete({{ $item->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endcanDelete
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Tidak ada pengumuman</h5>
                    <p class="text-muted mb-0">Belum ada pengumuman yang tersedia saat ini</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($pengumuman->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $pengumuman->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.pengumuman-card {
    cursor: pointer;
}

.pengumuman-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.pengumuman-card .card-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.pengumuman-card .card-text {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.btn-outline-primary {
    border: 2px solid #3b82f6;
    color: #3b82f6;
    transition: all 0.3s;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border-color: #3b82f6;
    color: white;
    transform: translateY(-2px);
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Pengumuman?',
        text: 'Pengumuman yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-trash mr-1"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => { Swal.showLoading(); }
            });
            
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/petugas/pengumuman/${id}`;
            form.innerHTML = `@csrf @method('DELETE')`;
            document.body.appendChild(form);
            form.submit();
        }
    });
}

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif
</script>
@endpush
@endsection
