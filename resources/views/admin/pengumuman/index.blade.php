
@extends("layouts.app")
@section("title","Manajemen Pengumuman")
@section("page-title","Pengumuman")
@section("breadcrumb")
<li class="breadcrumb-item active">Pengumuman</li>
@endsection

@push('styles')
<style>
    /* Tombol Aksi Custom */
    .btn-group .btn-sm {
        padding: 6px 12px;
        border-radius: 0;
    }
    
    .btn-group .btn-sm:first-child {
        border-radius: 6px 0 0 6px;
    }
    
    .btn-group .btn-sm:last-child {
        border-radius: 0 6px 6px 0;
    }
    
    /* Tombol Detail - Cyan */
    .btn-group .btn-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-color: #06b6d4;
        color: white;
    }
    
    .btn-group .btn-info:hover {
        background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
        border-color: #0891b2;
    }
    
    /* Tombol Edit - Navy Blue */
    .btn-group .btn-primary {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        border-color: #1e3a8a;
        color: white;
    }
    
    .btn-group .btn-primary:hover {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        border-color: #1e40af;
    }
    
    /* Tombol Hapus - MERAH */
    .btn-group .btn-danger,
    .btn-group button.btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        border-color: #ef4444 !important;
        color: white !important;
    }
    
    .btn-group .btn-danger:hover,
    .btn-group button.btn-danger:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
        border-color: #dc2626 !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
    }
    
    /* Tombol Lock - Abu-abu */
    .btn-group .btn-secondary {
        background: #6b7280;
        border-color: #6b7280;
    }
</style>
@endpush

@section("content")
@if(session("success"))
<div class="alert alert-success alert-dismissible fade show">
    <i class="fas fa-check-circle mr-2"></i>{{ session("success") }}
    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
</div>
@endif
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0"><i class="fas fa-bullhorn mr-2 text-warning"></i>Daftar Pengumuman</h3>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Pengumuman
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="40">#</th>
                        <th>Judul</th>
                        <th>Jenis</th>
                        <th>Tampil Di</th>
                        <th>Status</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($data as $i => $p)
                <tr>
                    <td>{{ $data->firstItem()+$i }}</td>
                    <td>
                        <strong>{{ $p->judul }}</strong>
                        <small class="d-block text-muted">{{ Str::limit($p->isi, 60) }}</small>
                        @if($p->foto)<small class="text-success"><i class="fas fa-image mr-1"></i>Ada foto</small>@endif
                        @if($p->video)<small class="text-info ml-2"><i class="fas fa-video mr-1"></i>Ada video</small>@endif
                    </td>
                    <td>
                        @php $w=(["info"=>"primary","warning"=>"warning","success"=>"success","danger"=>"danger","penting"=>"danger"])[$p->jenis] ?? "secondary" @endphp
                        <span class="badge badge-{{ $w }}">{{ ucfirst($p->jenis) }}</span>
                    </td>
                    <td><span class="badge badge-secondary">{{ ucfirst($p->tampil_di) }}</span></td>
                    <td>
                        <form action="{{ route('admin.pengumuman.toggle', $p) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-{{ $p->is_aktif ? 'success' : 'secondary' }}">
                                <i class="fas fa-{{ $p->is_aktif ? 'eye' : 'eye-slash' }}"></i>
                                {{ $p->is_aktif ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.pengumuman.show', $p) }}" class="btn btn-sm btn-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($p->user && $p->user->role == 'admin')
                            <a href="{{ route('admin.pengumuman.edit', $p) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pengumuman.destroy', $p) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                            @else
                            <button class="btn btn-sm btn-secondary disabled" title="Dibuat oleh {{ ucfirst($p->user->role ?? 'user lain') }}">
                                <i class="fas fa-lock"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-muted">
                    <i class="fas fa-bullhorn fa-3x d-block mb-2" style="opacity:.2"></i>
                    Belum ada pengumuman
                </td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">{{ $data->links("pagination::bootstrap-4") }}</div>
</div>
@endsection
