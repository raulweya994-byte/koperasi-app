@extends('layouts.app')
@section('title', 'Halaman Statis')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div class="page-header-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Halaman Statis</h3>
                                <p class="page-header-subtitle">Kelola halaman profil dan informasi website</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.halaman-statis.create') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-plus"></i> Tambah Halaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success-modern alert-dismissible fade show">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    {{-- Data Table --}}
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="fas fa-list"></i> Daftar Halaman Profil
                    </h5>
                </div>
                <div class="content-card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th width="40">#</th>
                                    <th>Slug</th>
                                    <th>Judul</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th width="160">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($halamanList as $i => $h)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>
                                        <code style="background:#f0f4ff;color:#1a3a6e;padding:4px 8px;border-radius:6px;font-size:12px">{{ $h->slug }}</code>
                                    </td>
                                    <td>
                                        <strong style="color:#1a3a6e">{{ $h->judul }}</strong>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#3b82f6,#2563eb);display:flex;align-items:center;justify-content:center;color:white;margin-right:8px">
                                                <i class="{{ $h->icon }}"></i>
                                            </div>
                                            <small class="text-muted">{{ $h->icon }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($h->status === 'aktif')
                                        <span class="status-badge status-active">
                                            <i class="fas fa-check-circle"></i> Aktif
                                        </span>
                                        @else
                                        <span class="status-badge status-inactive">
                                            <i class="fas fa-times-circle"></i> Nonaktif
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('public.halaman', $h->slug) }}" 
                                               target="_blank"
                                               class="btn btn-sm btn-info-modern" 
                                               title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('petugas.halaman-statis.edit', $h) }}" 
                                               class="btn btn-sm btn-warning-modern" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('petugas.halaman-statis.destroy', $h) }}" 
                                                  style="display:inline" 
                                                  onsubmit="return confirmDelete(event)">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-modern" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-file-alt"></i>
                                            <h5>Belum Ada Halaman</h5>
                                            <p>Mulai tambahkan halaman profil dan informasi website</p>
                                            <a href="{{ route('petugas.halaman-statis.create') }}" class="btn btn-primary-modern">
                                                <i class="fas fa-plus"></i> Tambah Halaman Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Box --}}
    @if($halamanList->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info-modern">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Informasi:</strong>
                    <p class="mb-0" style="font-size:13px">
                        Halaman statis digunakan untuk menampilkan informasi profil seperti Visi & Misi, Struktur Organisasi, dan lainnya. 
                        Pastikan slug yang digunakan sesuai dengan menu navigasi website.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(event) {
    event.preventDefault();
    const form = event.target;
    
    Swal.fire({
        title: 'Hapus Halaman?',
        text: "Halaman akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    
    return false;
}
</script>
@endpush

