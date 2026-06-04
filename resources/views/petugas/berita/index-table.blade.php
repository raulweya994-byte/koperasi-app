@extends('layouts.app')
@section('title', 'Berita')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#10b981,#059669)">
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
                            @canCreate('berita')
                                <a href="{{ route('petugas.berita.create') }}" class="btn btn-light mb-2" style="border-radius:8px;font-weight:600">
                                    <i class="fas fa-plus mr-2"></i>Buat Berita
                                </a>
                            @endcanCreate
                            
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
                            <button type="submit" class="btn btn-success btn-block" style="border-radius:8px">
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

    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-radius:16px;overflow:hidden">
                            <thead style="background:linear-gradient(135deg,#34495e,#2c3e50)">
                                <tr>
                                    <th style="padding:20px;border:none;width:50px;text-align:center;color:#ffffff !important;font-weight:700">
                                        <i class="fas fa-hashtag"></i>
                                    </th>
                                    <th style="padding:20px;border:none;width:100px;text-align:center;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-image mr-2"></i>Thumbnail
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-heading mr-2"></i>Judul Berita
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-tag mr-2"></i>Kategori
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-calendar mr-2"></i>Tanggal
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-user mr-2"></i>Penulis
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important;text-align:center">
                                        <i class="fas fa-cog mr-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($berita as $index => $item)
                                <tr style="border-bottom:1px solid #f3f4f6">
                                    <td style="padding:20px;text-align:center;color:#6b7280;font-weight:600">
                                        {{ $berita->firstItem() + $index }}
                                    </td>
                                    <td style="padding:20px;text-align:center">
                                        @if($item->thumbnail)
                                        <img src="{{ asset('storage/'.$item->thumbnail) }}" 
                                             alt="Thumbnail" 
                                             style="width:80px;height:60px;object-fit:cover;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1)">
                                        @else
                                        <div style="width:80px;height:60px;background:linear-gradient(135deg,#10b981,#059669);border-radius:8px;display:flex;align-items:center;justify-content:center">
                                            <i class="fas fa-newspaper fa-2x text-white" style="opacity:0.5"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td style="padding:20px">
                                        <div style="max-width:350px">
                                            <h6 class="mb-1 font-weight-bold" style="color:#1f2937">
                                                {{ Str::limit($item->judul, 50) }}
                                            </h6>
                                            <p class="mb-0 text-muted" style="font-size:13px">
                                                {{ Str::limit(strip_tags($item->konten), 70) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td style="padding:20px">
                                        <span class="badge badge-success text-white" 
                                              style="padding:8px 16px;border-radius:20px;font-size:12px;font-weight:600">
                                            <i class="fas fa-folder mr-1"></i>
                                            {{ strtoupper($item->kategori) }}
                                        </span>
                                    </td>
                                    <td style="padding:20px">
                                        <div style="font-size:14px">
                                            <div class="font-weight-bold" style="color:#1f2937">
                                                {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                                            </div>
                                            <div class="text-muted" style="font-size:12px">
                                                <i class="fas fa-eye mr-1"></i>{{ $item->views ?? 0 }} views
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:20px">
                                        <div style="font-size:14px">
                                            <div class="font-weight-bold" style="color:#1f2937">
                                                {{ $item->createdBy->name ?? 'Admin' }}
                                            </div>
                                            <div class="text-muted" style="font-size:12px">
                                                <i class="fas fa-user-tag mr-1"></i>{{ ucfirst($item->createdBy->role ?? 'admin') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:20px;text-align:center">
                                        <div class="btn-group" role="group">
                                            {{-- Tombol Detail - Tampil jika ada izin view --}}
                                            @canView('berita')
                                                <a href="{{ route('petugas.berita.show', $item->id) }}" 
                                                   class="btn btn-sm btn-outline-success" 
                                                   style="border-radius:6px;padding:8px 12px;margin-right:4px"
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcanView
                                            
                                            {{-- Tombol Edit - Tampil jika ada izin edit --}}
                                            @canEdit('berita')
                                                <a href="{{ route('petugas.berita.edit', $item->id) }}" 
                                                   class="btn btn-sm btn-outline-info" 
                                                   style="border-radius:6px;padding:8px 12px;margin-right:4px"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcanEdit
                                            
                                            {{-- Tombol Hapus - Tampil jika ada izin delete --}}
                                            @canDelete('berita')
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger" 
                                                        style="border-radius:6px;padding:8px 12px"
                                                        onclick="confirmDelete({{ $item->id }})"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endcanDelete
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="padding:60px;text-align:center">
                                        <i class="fas fa-inbox fa-4x text-muted mb-3" style="display:block"></i>
                                        <h5 class="text-muted">Tidak ada berita</h5>
                                        <p class="text-muted mb-0">Belum ada berita yang tersedia saat ini</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                {{-- Pagination --}}
                @if($berita->hasPages())
                <div class="card-footer" style="background:#f8f9fa;border:none;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted" style="font-size:14px">
                            Menampilkan {{ $berita->firstItem() }} - {{ $berita->lastItem() }} dari {{ $berita->total() }} berita
                        </div>
                        <div>
                            {{ $berita->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    transform: scale(1.01);
    transition: all 0.2s;
}

.btn-group .btn {
    transition: all 0.2s;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.badge {
    transition: all 0.2s;
}

tr:hover .badge {
    transform: scale(1.05);
}

tr:hover img {
    transform: scale(1.1);
    transition: all 0.3s;
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
        reverseButtons: true,
        customClass: {
            popup: 'swal-modern',
            confirmButton: 'btn-modern',
            cancelButton: 'btn-modern'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit delete form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/petugas/berita/${id}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Success message
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false,
        customClass: {
            popup: 'swal-modern'
        }
    });
@endif

// Error message
@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
        confirmButtonColor: '#10b981',
        customClass: {
            popup: 'swal-modern'
        }
    });
@endif
</script>

<style>
.swal-modern {
    border-radius: 16px;
    padding: 20px;
}
.swal2-title {
    color: #1f2937;
    font-size: 22px;
    font-weight: 700;
}
.swal2-html-container {
    font-size: 14px;
    color: #64748b;
}
.btn-modern {
    border-radius: 8px;
    padding: 10px 24px;
    font-weight: 600;
    font-size: 14px;
}
</style>
@endpush
@endsection
