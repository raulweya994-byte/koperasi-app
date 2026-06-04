@extends('layouts.app')
@section('title', 'Berita')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#f59e0b,#d97706)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                                <i class="fas fa-newspaper fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="mb-1 font-weight-bold">Berita</h3>
                                <p class="mb-0" style="opacity:0.9">Berita dan artikel terbaru</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('petugas.berita.create') }}" class="btn btn-light mb-2" style="border-radius:8px;font-weight:600">
                                <i class="fas fa-plus mr-2"></i>Buat Berita
                            </a>
                            <div>
                                <h2 class="mb-0 font-weight-bold">{{ $berita->total() }}</h2>
                                <small style="opacity:0.9">Total Berita</small>
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
                    <form method="GET" action="{{ route('petugas.berita.index') }}" class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="border-radius:8px 0 0 8px;background:#f8f9fa;border:1px solid #e5e7eb">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                </div>
                                <input type="text" name="search" class="form-control" placeholder="Cari berita..." value="{{ request('search') }}" style="border-radius:0 8px 8px 0;border-left:none">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="kategori" class="form-control" style="border-radius:8px">
                                <option value="">Semua Kategori</option>
                                <option value="umum" {{ request('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                                <option value="koperasi" {{ request('kategori') == 'koperasi' ? 'selected' : '' }}>Koperasi</option>
                                <option value="pelatihan" {{ request('kategori') == 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                                <option value="bantuan" {{ request('kategori') == 'bantuan' ? 'selected' : '' }}>Bantuan</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-warning btn-block text-white" style="border-radius:8px">
                                <i class="fas fa-filter mr-1"></i>Filter
                            </button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('petugas.berita.index') }}" class="btn btn-secondary btn-block" style="border-radius:8px">
                                <i class="fas fa-redo mr-1"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Berita List --}}
    <div class="row">
        @forelse($berita as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card berita-card shadow-sm h-100" style="border-radius:16px;border:none;overflow:hidden;transition:all 0.3s">
                {{-- Thumbnail --}}
                @if($item->thumbnail)
                <div class="berita-thumbnail" style="height:200px;background:url('{{ asset('storage/'.$item->thumbnail) }}') center/cover;position:relative">
                    <div style="position:absolute;top:15px;right:15px">
                        <span class="badge badge-warning text-white" style="font-size:11px;padding:6px 12px;border-radius:20px">
                            {{ strtoupper($item->kategori) }}
                        </span>
                    </div>
                </div>
                @else
                <div class="berita-thumbnail" style="height:200px;background:linear-gradient(135deg,#f59e0b,#d97706);position:relative;display:flex;align-items:center;justify-content:center">
                    <i class="fas fa-newspaper fa-4x text-white" style="opacity:0.3"></i>
                    <div style="position:absolute;top:15px;right:15px">
                        <span class="badge badge-light" style="font-size:11px;padding:6px 12px;border-radius:20px">
                            {{ strtoupper($item->kategori) }}
                        </span>
                    </div>
                </div>
                @endif

                <div class="card-body p-4">
                    <h5 class="card-title font-weight-bold mb-3" style="color:#1f2937;line-height:1.4">
                        {{ Str::limit($item->judul, 60) }}
                    </h5>
                    <p class="card-text text-muted mb-3" style="font-size:14px;line-height:1.6">
                        {{ Str::limit(strip_tags($item->konten), 120) }}
                    </p>
                    
                    {{-- Info --}}
                    <div class="d-flex align-items-center justify-content-between mb-3" style="font-size:13px;color:#6b7280">
                        <div>
                            <i class="far fa-calendar mr-1"></i>
                            {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                        </div>
                        <div>
                            <i class="far fa-user mr-1"></i>
                            {{ $item->createdBy->name ?? 'Admin' }}
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="btn-group btn-block" role="group">
                        @canView('berita')
                            <a href="{{ route('petugas.berita.show', $item->id) }}" class="btn btn-outline-warning text-warning" style="border-radius:8px 0 0 8px;font-weight:600;flex:1;border-width:2px">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endcanView
                        
                        @canEdit('berita')
                            <a href="{{ route('petugas.berita.edit', $item->id) }}" class="btn btn-outline-info" style="font-weight:600;flex:1;border-width:2px">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endcanEdit
                        
                        @canDelete('berita')
                            <button type="button" class="btn btn-outline-danger" style="border-radius:0 8px 8px 0;font-weight:600;flex:1;border-width:2px" onclick="confirmDelete({{ $item->id }})">
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
                    <h5 class="text-muted">Tidak ada berita</h5>
                    <p class="text-muted mb-0">Belum ada berita yang tersedia saat ini</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($berita->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $berita->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<style>
.berita-card {
    cursor: pointer;
}

.berita-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.berita-card:hover .berita-thumbnail {
    transform: scale(1.05);
}

.berita-thumbnail {
    transition: transform 0.3s;
}

.berita-card .card-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.berita-card .card-text {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.btn-outline-warning {
    transition: all 0.3s;
}

.btn-outline-warning:hover {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border-color: #f59e0b;
    color: white !important;
    transform: translateY(-2px);
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Berita?',
        text: 'Berita yang dihapus tidak dapat dikembalikan!',
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
            form.action = `/petugas/berita/${id}`;
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
