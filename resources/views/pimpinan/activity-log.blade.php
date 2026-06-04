@extends('layouts.app')
@section('title','Log Aktivitas')
@section('page-title','Log Aktivitas Sistem')
@section('breadcrumb')
<li class="breadcrumb-item active">Log Aktivitas</li>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#667eea,#764ba2)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-history fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ number_format($stats['total']) }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Total Aktivitas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#11998e,#38ef7d)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-calendar-day fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ number_format($stats['today']) }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Hari Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#f093fb,#f5576c)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-calendar-week fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ number_format($stats['this_week']) }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Minggu Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm animate-card" style="border-radius:16px;border:none;background:linear-gradient(135deg,#fa709a,#fee140)">
                <div class="card-body p-4 text-white">
                    <div class="d-flex align-items-center">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold">{{ number_format($stats['this_month']) }}</h3>
                            <p class="mb-0" style="opacity:0.9;font-size:13px">Bulan Ini</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                            <i class="fas fa-filter mr-2"></i>Filter & Pencarian
                        </h5>
                        @if($logs->total() > 0)
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteAllLogs()" style="border-radius:10px">
                            <i class="fas fa-trash-alt mr-1"></i>Hapus Semua Log
                        </button>
                        @endif
                    </div>
                    <form method="GET" action="{{ route('pimpinan.activity.log') }}" id="filterForm">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-user-tag mr-1"></i>Role Pengguna
                                </label>
                                <select name="role" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Role</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                    <option value="koperasi" {{ request('role') == 'koperasi' ? 'selected' : '' }}>Koperasi</option>
                                    <option value="anggota" {{ request('role') == 'anggota' ? 'selected' : '' }}>Anggota</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-cube mr-1"></i>Module
                                </label>
                                <select name="module" class="form-control" style="border-radius:10px">
                                    <option value="">Semua Module</option>
                                    @foreach($modules as $module)
                                    <option value="{{ $module }}" {{ request('module') == $module ? 'selected' : '' }}>
                                        {{ ucfirst($module) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-calendar mr-1"></i>Dari Tanggal
                                </label>
                                <input type="date" name="date_from" class="form-control" style="border-radius:10px" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="font-weight-600 mb-2">
                                    <i class="fas fa-calendar mr-1"></i>Sampai Tanggal
                                </label>
                                <input type="date" name="date_to" class="form-control" style="border-radius:10px" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="font-weight-600 mb-2" style="opacity:0">Action</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary flex-fill" style="border-radius:10px">
                                        <i class="fas fa-filter mr-1"></i>Filter
                                    </button>
                                    @if(request()->hasAny(['role', 'module', 'date_from', 'date_to', 'search']))
                                    <a href="{{ route('pimpinan.activity.log') }}" class="btn btn-secondary" style="border-radius:10px">
                                        <i class="fas fa-redo"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari aktivitas, user, atau deskripsi..." style="border-radius:10px 0 0 10px" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" style="border-radius:0 10px 10px 0">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Activity Timeline --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                            <i class="fas fa-stream mr-2"></i>Timeline Aktivitas
                        </h5>
                        <span class="badge badge-primary" style="font-size:13px;padding:8px 16px">
                            {{ $logs->total() }} Aktivitas
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    @forelse($logs as $log)
                    <div class="activity-item" style="position:relative;padding-left:50px;padding-bottom:30px;border-left:3px solid #e5e7eb;margin-left:20px">
                        {{-- Icon --}}
                        <div class="activity-icon" style="position:absolute;left:-15px;top:0;width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;
                            @if($log->action == 'create') background:linear-gradient(135deg,#11998e,#38ef7d);
                            @elseif($log->action == 'update') background:linear-gradient(135deg,#667eea,#764ba2);
                            @elseif($log->action == 'delete') background:linear-gradient(135deg,#f093fb,#f5576c);
                            @elseif($log->action == 'login') background:linear-gradient(135deg,#4facfe,#00f2fe);
                            @else background:linear-gradient(135deg,#fa709a,#fee140);
                            @endif
                            color:white;box-shadow:0 2px 8px rgba(0,0,0,0.15)">
                            @if($log->action == 'create')
                                <i class="fas fa-plus"></i>
                            @elseif($log->action == 'update')
                                <i class="fas fa-edit"></i>
                            @elseif($log->action == 'delete')
                                <i class="fas fa-trash"></i>
                            @elseif($log->action == 'login')
                                <i class="fas fa-sign-in-alt"></i>
                            @elseif($log->action == 'logout')
                                <i class="fas fa-sign-out-alt"></i>
                            @elseif($log->action == 'view')
                                <i class="fas fa-eye"></i>
                            @elseif($log->action == 'download')
                                <i class="fas fa-download"></i>
                            @else
                                <i class="fas fa-cog"></i>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="activity-content" style="background:#f8f9fa;padding:15px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.05)">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <span class="badge badge-{{ $log->action == 'create' ? 'success' : ($log->action == 'update' ? 'primary' : ($log->action == 'delete' ? 'danger' : 'info')) }}" 
                                          style="font-size:11px;padding:5px 10px;margin-right:8px">
                                        {{ strtoupper($log->action) }}
                                    </span>
                                    <span class="badge badge-secondary" style="font-size:11px;padding:5px 10px">
                                        {{ ucfirst($log->module) }}
                                    </span>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-clock mr-1"></i>{{ $log->created_at->diffForHumans() }}
                                </small>
                            </div>
                            
                            <div class="mb-2">
                                <strong style="color:#1a3a6e;font-size:15px">{{ $log->description }}</strong>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-user mr-1 text-primary"></i>
                                    <strong>{{ $log->user->name ?? 'System' }}</strong>
                                    @if($log->user)
                                    <span class="badge badge-light ml-2" style="font-size:10px">
                                        {{ strtoupper($log->user->role) }}
                                    </span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="text-right mr-3">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-network-wired mr-1"></i>{{ $log->ip_address }}
                                        </small>
                                        <small class="text-muted" style="font-size:10px">
                                            {{ $log->created_at->format('d M Y, H:i:s') }}
                                        </small>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-info" onclick="showDetail({{ $log->id }})" style="border-radius:8px;padding:4px 12px">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteLog({{ $log->id }})" style="border-radius:8px;padding:4px 12px">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block" style="opacity:0.3"></i>
                        <p class="text-muted mb-0">Tidak ada aktivitas ditemukan</p>
                    </div>
                    @endforelse
                </div>
                @if($logs->hasPages())
                <div class="card-footer" style="background:white;border-radius:0 0 16px 16px;padding:20px">
                    {{ $logs->links('pagination::bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Detail Modal --}}
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none">
                <h5 class="modal-title text-white font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Detail Log Aktivitas
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="detailContent">
                <div class="text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                    <p class="mt-3 text-muted">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer" style="border:none;padding:20px">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:10px">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.animate-card {
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.activity-item:last-child {
    border-left-color: transparent;
    padding-bottom: 0;
}

.activity-item:hover .activity-content {
    transform: translateX(5px);
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    border-radius: 8px;
    margin: 0 3px;
    border: none;
    color: #1a3a6e;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
}

.gap-2 {
    gap: 8px;
}

.btn-sm {
    transition: all 0.3s ease;
}

.btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
</style>

<script>
// Show detail modal
function showDetail(id) {
    $('#detailModal').modal('show');
    $('#detailContent').html(`
        <div class="text-center py-5">
            <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
            <p class="mt-3 text-muted">Memuat data...</p>
        </div>
    `);
    
    fetch(`{{ route('pimpinan.activity.log.detail', '') }}/${id}`)
        .then(response => response.json())
        .then(data => {
            const actionColors = {
                'create': 'success',
                'update': 'primary',
                'delete': 'danger',
                'login': 'info',
                'logout': 'warning',
                'view': 'secondary',
                'download': 'dark'
            };
            
            const actionColor = actionColors[data.action] || 'secondary';
            const createdAt = new Date(data.created_at);
            
            $('#detailContent').html(`
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">ID Log</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">#${data.id}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Waktu</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-clock mr-1 text-primary"></i>${createdAt.toLocaleString('id-ID')}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Action</label>
                        <p class="mb-0">
                            <span class="badge badge-${actionColor}" style="font-size:13px;padding:6px 14px">
                                ${data.action.toUpperCase()}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Module</label>
                        <p class="mb-0">
                            <span class="badge badge-secondary" style="font-size:13px;padding:6px 14px">
                                ${data.module}
                            </span>
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Deskripsi</label>
                        <div class="alert alert-info mb-0" style="border-radius:10px">
                            <strong>${data.description}</strong>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">User</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-user mr-1 text-primary"></i>${data.user ? data.user.name : 'System'}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Role</label>
                        <p class="mb-0">
                            <span class="badge badge-light" style="font-size:13px;padding:6px 14px">
                                ${data.user ? data.user.role.toUpperCase() : 'SYSTEM'}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">IP Address</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-network-wired mr-1 text-success"></i>${data.ip_address}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">User Agent</label>
                        <p class="mb-0" style="font-size:12px;word-break:break-all">
                            ${data.user_agent || '-'}
                        </p>
                    </div>
                </div>
            `);
        })
        .catch(error => {
            $('#detailContent').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Gagal memuat data: ${error.message}
                </div>
            `);
        });
}

// Delete single log
function deleteLog(id) {
    Swal.fire({
        title: 'Hapus Log?',
        text: "Log aktivitas ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`{{ route('pimpinan.activity.log.delete', '') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan: ' + error.message, 'error');
            });
        }
    });
}

// Delete all logs
function deleteAllLogs() {
    const filters = {
        role: document.querySelector('select[name="role"]').value,
        module: document.querySelector('select[name="module"]').value,
        date_from: document.querySelector('input[name="date_from"]').value,
        date_to: document.querySelector('input[name="date_to"]').value
    };
    
    const hasFilters = Object.values(filters).some(v => v);
    const message = hasFilters 
        ? "Semua log yang sesuai dengan filter akan dihapus permanen!" 
        : "SEMUA log aktivitas akan dihapus permanen!";
    
    Swal.fire({
        title: 'Hapus Semua Log?',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus Semua!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            Object.keys(filters).forEach(key => {
                if (filters[key]) formData.append(key, filters[key]);
            });
            
            fetch('{{ route('pimpinan.activity.log.deleteAll') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error!', 'Terjadi kesalahan: ' + error.message, 'error');
            });
        }
    });
}

// Auto refresh every 30 seconds
setInterval(function() {
    if (!document.querySelector('input[name="search"]').value && 
        !document.querySelector('select[name="role"]').value && 
        !document.querySelector('select[name="module"]').value) {
        // Only auto refresh if no filters applied
        // location.reload();
    }
}, 30000);
</script>
@endsection
