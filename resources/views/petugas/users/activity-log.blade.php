@extends('layouts.app')
@section('title', 'Activity Log')

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
                                <i class="fas fa-history"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Activity Log</h3>
                                <p class="page-header-subtitle">Riwayat aktivitas pengguna dalam sistem</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="filter-box">
                <form method="GET">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User</label>
                                <select name="user_id" class="form-control">
                                    <option value="">Semua User</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}" {{ request('user_id')==$u->id?'selected':'' }}>
                                            {{ $u->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Module</label>
                                <select name="module" class="form-control">
                                    <option value="">Semua Module</option>
                                    @foreach($modules as $m)
                                        <option value="{{ $m }}" {{ request('module')===$m?'selected':'' }}>
                                            {{ $m }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary-modern btn-block">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <a href="{{ route('petugas.users.activityLog') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-redo"></i>
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
                <i class="fas fa-list"></i> Log Aktivitas
                <span class="badge badge-custom badge-purple ml-2">{{ $logs->total() }}</span>
            </h5>
        </div>
        
        <div class="content-card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Waktu</th>
                            <th width="13%">User</th>
                            <th width="10%">Aksi</th>
                            <th width="10%">Module</th>
                            <th width="30%">Keterangan</th>
                            <th width="10%">IP Address</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $i => $l)
                        <tr>
                            <td>{{ $logs->firstItem() + $i }}</td>
                            <td>
                                <small class="text-muted">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $l->created_at->format('d/m/Y H:i') }}
                                </small>
                            </td>
                            <td>
                                <strong style="color:#1a3a6e">{{ $l->user->name ?? '-' }}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-user-tag mr-1"></i>{{ $l->user->role ?? '' }}
                                </small>
                            </td>
                            <td>
                                @if($l->action === 'create')
                                    <span class="badge badge-success-modern">
                                        <i class="fas fa-plus"></i> CREATE
                                    </span>
                                @elseif($l->action === 'update')
                                    <span class="badge badge-warning-modern">
                                        <i class="fas fa-edit"></i> UPDATE
                                    </span>
                                @elseif($l->action === 'delete')
                                    <span class="badge badge-danger-modern">
                                        <i class="fas fa-trash"></i> DELETE
                                    </span>
                                @else
                                    <span class="badge badge-info-modern">
                                        <i class="fas fa-info-circle"></i> {{ strtoupper($l->action) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-custom badge-purple">
                                    <i class="fas fa-cube mr-1"></i>{{ $l->module }}
                                </span>
                            </td>
                            <td>
                                <small>{{ Str::limit($l->description, 80) }}</small>
                            </td>
                            <td>
                                <small class="text-muted">
                                    <i class="fas fa-network-wired mr-1"></i>{{ $l->ip_address }}
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" 
                                            class="btn btn-info btn-sm" 
                                            onclick="showDetail({{ $l->id }})"
                                            title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete({{ $l->id }}, '{{ $l->user->name ?? 'User' }}', '{{ $l->action }}')"
                                            title="Hapus Log">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-history"></i>
                                    <h5>Belum Ada Log Aktivitas</h5>
                                    <p>Aktivitas pengguna akan tercatat di sini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($logs->hasPages())
        <div class="content-card-body">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    Menampilkan {{ $logs->firstItem() }}–{{ $logs->lastItem() }} dari {{ $logs->total() }} log
                </small>
                <div>
                    {{ $logs->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modal Detail --}}
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-info-circle me-2"></i>Detail Activity Log</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <div class="text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                    <p class="mt-3">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-trash me-2"></i>Hapus Activity Log</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <p>Apakah Anda yakin ingin menghapus log aktivitas ini?</p>
                    <div class="card bg-light">
                        <div class="card-body">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="100"><strong>User:</strong></td>
                                    <td id="deleteUser"></td>
                                </tr>
                                <tr>
                                    <td><strong>Aksi:</strong></td>
                                    <td id="deleteAction"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="btnConfirmDelete">
                        <i class="fas fa-trash me-1"></i> Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showDetail(id) {
    $('#modalDetail').modal('show');
    $('#detailContent').html(`
        <div class="text-center py-5">
            <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
            <p class="mt-3">Memuat data...</p>
        </div>
    `);
    
    $.ajax({
        url: '/admin/activity-log/' + id,
        method: 'GET',
        success: function(response) {
            let actionBadge = '';
            if(response.action === 'create') {
                actionBadge = '<span class="badge badge-success"><i class="fas fa-plus"></i> CREATE</span>';
            } else if(response.action === 'update') {
                actionBadge = '<span class="badge badge-warning"><i class="fas fa-edit"></i> UPDATE</span>';
            } else if(response.action === 'delete') {
                actionBadge = '<span class="badge badge-danger"><i class="fas fa-trash"></i> DELETE</span>';
            } else {
                actionBadge = '<span class="badge badge-info"><i class="fas fa-info-circle"></i> ' + response.action.toUpperCase() + '</span>';
            }
            
            let html = `
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">Waktu</label>
                        <div class="font-weight-600">
                            <i class="far fa-clock text-primary mr-1"></i>
                            ${response.created_at}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">User</label>
                        <div class="font-weight-600">
                            <i class="fas fa-user text-success mr-1"></i>
                            ${response.user_name}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">Role</label>
                        <div class="font-weight-600">
                            <i class="fas fa-user-tag text-info mr-1"></i>
                            ${response.user_role}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">Aksi</label>
                        <div>${actionBadge}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">Module</label>
                        <div>
                            <span class="badge badge-purple">
                                <i class="fas fa-cube mr-1"></i>${response.module}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">IP Address</label>
                        <div class="font-weight-600">
                            <i class="fas fa-network-wired text-danger mr-1"></i>
                            ${response.ip_address}
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">User Agent</label>
                        <div class="font-weight-600">
                            <small>${response.user_agent || '-'}</small>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:0.85rem">Keterangan</label>
                        <div class="alert alert-info mb-0">
                            ${response.description}
                        </div>
                    </div>
                </div>
            `;
            $('#detailContent').html(html);
        },
        error: function() {
            $('#detailContent').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Gagal memuat data. Silakan coba lagi.
                </div>
            `);
        }
    });
}

function confirmDelete(id, userName, action) {
    $('#deleteUser').text(userName);
    $('#deleteAction').html(action.toUpperCase());
    $('#formHapus').attr('action', '/admin/activity-log/' + id);
    $('#modalHapus').modal('show');
}

// Handle form submit dengan AJAX
$(document).ready(function() {
    $('#formHapus').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let url = form.attr('action');
        let btn = $('#btnConfirmDelete');
        
        // Disable button dan tampilkan loading
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menghapus...');
        
        $.ajax({
            url: url,
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                // Tutup modal
                $('#modalHapus').modal('hide');
                
                // Tampilkan notifikasi sukses
                showNotification('success', 'Berhasil!', 'Activity log berhasil dihapus.');
                
                // Reload halaman setelah 1 detik
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            },
            error: function(xhr) {
                // Enable button kembali
                btn.prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Ya, Hapus');
                
                // Tampilkan notifikasi error
                showNotification('error', 'Gagal!', 'Terjadi kesalahan saat menghapus data.');
            }
        });
    });
});

// Fungsi untuk menampilkan notifikasi
function showNotification(type, title, message) {
    let bgColor = type === 'success' ? '#28a745' : '#dc3545';
    let icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    
    // Hapus notifikasi lama jika ada
    $('.custom-notification').remove();
    
    // Buat notifikasi baru
    let notification = $(`
        <div class="custom-notification" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${bgColor};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
        ">
            <div style="display: flex; align-items: center;">
                <i class="fas ${icon}" style="font-size: 24px; margin-right: 15px;"></i>
                <div>
                    <strong style="display: block; font-size: 16px;">${title}</strong>
                    <span style="font-size: 14px;">${message}</span>
                </div>
            </div>
        </div>
    `);
    
    $('body').append(notification);
    
    // Hapus notifikasi setelah 3 detik
    setTimeout(function() {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}
</script>

<style>
.badge-purple {
    background-color: #6f42c1;
    color: white;
}
.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>

@endsection

