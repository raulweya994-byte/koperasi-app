@extends('layouts.app')
@section('title', 'Pesan Masuk')

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
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Pesan Masuk</h3>
                                <p class="page-header-subtitle">Kelola pesan dan pertanyaan dari pengunjung website</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <div style="background:rgba(255,255,255,.15);border-radius:10px;padding:8px 16px;font-size:13px;">
                                <i class="fas fa-inbox mr-1"></i>{{ $pesanList->total() }} Pesan
                            </div>
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
                        <i class="fas fa-list"></i> Daftar Pesan
                    </h5>
                </div>
                <div class="content-card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th width="40">#</th>
                                    <th>Pengirim</th>
                                    <th>Subjek</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesanList as $i => $p)
                                <tr style="{{ !$p->dibaca ? 'background:#f0f9ff' : '' }}">
                                    <td>{{ $pesanList->firstItem() + $i }}</td>
                                    <td>
                                        <strong style="{{ !$p->dibaca ? 'color:#1a3a6e' : '' }}">{{ $p->nama }}</strong><br>
                                        <small class="text-muted"><i class="fas fa-envelope mr-1"></i>{{ $p->email }}</small>
                                    </td>
                                    <td>
                                        <span style="{{ !$p->dibaca ? 'font-weight:700;color:#1a3a6e' : '' }}">
                                            {{ Str::limit($p->subjek, 50) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y H:i') }}</small>
                                    </td>
                                    <td>
                                        @if(!$p->dibaca)
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-circle"></i> Baru
                                        </span>
                                        @else
                                        <span class="status-badge status-active">
                                            <i class="fas fa-check-circle"></i> Dibaca
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('petugas.kontak.show', $p->id) }}" 
                                               class="btn btn-sm btn-info-modern" 
                                               title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form method="POST" action="{{ route('petugas.kontak.destroy', $p->id) }}" 
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
                                            <i class="fas fa-inbox"></i>
                                            <h5>Tidak Ada Pesan</h5>
                                            <p>Belum ada pesan masuk dari pengunjung</p>
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

    {{-- Pagination --}}
    @if($pesanList->hasPages())
    <div class="row mt-3">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $pesanList->links('pagination::bootstrap-4', ['class' => 'pagination-modern']) }}
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
        title: 'Hapus Pesan?',
        text: "Pesan akan dihapus permanen!",
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
