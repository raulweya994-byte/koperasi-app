@extends('layouts.app')
@section('title', 'Manajemen User')

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
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Manajemen User</h3>
                                <p class="page-header-subtitle">Kelola akun pengguna dan hak akses sistem</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.users.create') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-plus"></i> Tambah User
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="alert alert-success-modern alert-dismissible fade show">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    {{-- Filter --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-box">
                <form method="GET" action="{{ route('petugas.users.index') }}">
                    <div class="row align-items-end">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Cari User</label>
                                <div class="search-box-modern">
                                    <i class="fas fa-search"></i>
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari nama atau email..." 
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role')==='admin'?'selected':'' }}>Admin</option>
                                    <option value="petugas" {{ request('role')==='petugas'?'selected':'' }}>Petugas</option>
                                    <option value="pimpinan" {{ request('role')==='pimpinan'?'selected':'' }}>Pimpinan</option>
                                    <option value="koperasi" {{ request('role')==='koperasi'?'selected':'' }}>Koperasi</option>
                                    <option value="anggota" {{ request('role')==='anggota'?'selected':'' }}>Anggota</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary-modern btn-block">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <a href="{{ route('petugas.users.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="content-card">
        <div class="content-card-header">
            <h5 class="content-card-title">
                <i class="fas fa-list"></i> Daftar User
                <span class="badge badge-custom badge-blue ml-2">{{ $users->total() }}</span>
            </h5>
        </div>
        
        <div class="content-card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Email</th>
                            <th width="12%">Role</th>
                            <th width="10%">Status</th>
                            <th width="13%">Terdaftar</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $u)
                        <tr>
                            <td>{{ $users->firstItem() + $i }}</td>
                            <td>
                                <strong style="color:#1a3a6e">{{ $u->name }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="fas fa-envelope mr-1"></i>{{ $u->email }}
                                </small>
                            </td>
                            <td>
                                @if($u->role === 'admin')
                                    <span class="badge badge-danger-modern">
                                        <i class="fas fa-user-shield"></i> Admin
                                    </span>
                                @elseif($u->role === 'petugas')
                                    <span class="badge badge-warning-modern">
                                        <i class="fas fa-user-tie"></i> Petugas
                                    </span>
                                @elseif($u->role === 'pimpinan')
                                    <span class="badge badge-info-modern">
                                        <i class="fas fa-user-crown"></i> Pimpinan
                                    </span>
                                @elseif($u->role === 'koperasi')
                                    <span class="badge badge-success-modern">
                                        <i class="fas fa-store"></i> Koperasi
                                    </span>
                                @else
                                    <span class="badge badge-custom badge-purple">
                                        <i class="fas fa-user"></i> {{ ucfirst($u->role) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($u->is_active)
                                    <span class="status-badge status-active">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="status-badge status-inactive">
                                        <i class="fas fa-ban"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="far fa-calendar mr-1"></i>
                                    {{ $u->created_at->format('d M Y') }}
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('petugas.users.edit', $u) }}" 
                                       class="btn btn-sm btn-warning-modern" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form method="POST" 
                                          action="{{ route('petugas.users.toggleActive', $u) }}" 
                                          style="display:inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm {{ $u->is_active ? 'btn-secondary' : 'btn-success-modern' }}" 
                                                title="{{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas fa-{{ $u->is_active ? 'ban' : 'check' }}"></i>
                                        </button>
                                    </form>
                                    
                                    @if($u->id !== auth()->id())
                                    <button type="button" 
                                            class="btn btn-sm btn-danger-modern" 
                                            onclick="deleteUser({{ $u->id }})"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-users"></i>
                                    <h5>Belum Ada User</h5>
                                    <p>Mulai tambahkan user untuk mengelola sistem</p>
                                    <a href="{{ route('petugas.users.create') }}" class="btn btn-primary-modern">
                                        <i class="fas fa-plus"></i> Tambah User Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($users->hasPages())
        <div class="content-card-body">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} user
                </small>
                <div>
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Delete Form (Hidden) --}}
    <form id="deleteForm" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteUser(id) {
    Swal.fire({
        title: 'Hapus User?',
        text: "User akan dihapus permanen dari sistem!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('deleteForm');
            form.action = '/admin/users/' + id;
            form.submit();
        }
    });
}
</script>
@endpush

