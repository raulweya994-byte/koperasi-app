@extends('layouts.app')
@section('title', 'Manajemen Izin Akses')

@push('styles')
<style>
    /* Header Card */
    .header-card-permission {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        border: none;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
        margin-bottom: 30px;
        overflow: hidden;
    }
    
    .header-card-body {
        padding: 35px;
        color: white;
        position: relative;
    }
    
    .header-icon-wrapper {
        width: 90px;
        height: 90px;
        background: rgba(255,255,255,0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 25px;
        backdrop-filter: blur(10px);
    }
    
    .header-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .header-subtitle {
        font-size: 16px;
        opacity: 0.95;
        font-weight: 500;
    }
    
    /* Role Cards */
    .role-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
    }
    
    .role-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .role-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
    }
    
    .role-card.admin::before { background: linear-gradient(135deg, #667eea, #764ba2); }
    .role-card.petugas::before { background: linear-gradient(135deg, #10b981, #059669); }
    .role-card.pimpinan::before { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .role-card.koperasi::before { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .role-card.anggota::before { background: linear-gradient(135deg, #ec4899, #db2777); }
    
    .role-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 15px;
    }
    
    .role-card.admin .role-icon { background: linear-gradient(135deg, #ede9fe, #ddd6fe); color: #5b21b6; }
    .role-card.petugas .role-icon { background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #065f46; }
    .role-card.pimpinan .role-icon { background: linear-gradient(135deg, #fef3c7, #fde68a); color: #92400e; }
    .role-card.koperasi .role-icon { background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #1e40af; }
    .role-card.anggota .role-icon { background: linear-gradient(135deg, #fce7f3, #fbcfe8); color: #9f1239; }
    
    .role-name {
        font-size: 22px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
    }
    
    .role-description {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 20px;
        line-height: 1.6;
    }
    
    .permission-summary {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .permission-badge {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        background: #f3f4f6;
        color: #374151;
    }
    
    .permission-badge i {
        font-size: 14px;
    }
    
    .permission-badge.active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .role-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .btn-manage {
        flex: 1;
        min-width: 120px;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-manage.primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    
    .btn-manage.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-manage.secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-manage.secondary:hover {
        background: #e5e7eb;
        color: #1f2937;
    }
    
    .btn-manage.danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }
    
    .btn-manage.danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        color: white;
    }
    
    /* Info Box */
    .info-box {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        border-left: 4px solid #3b82f6;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .info-box h5 {
        color: #1e40af;
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 16px;
    }
    
    .info-box p {
        color: #1e3a8a;
        margin: 0;
        font-size: 14px;
        line-height: 1.6;
    }
    
    .info-box ul {
        margin: 10px 0 0 20px;
        color: #1e3a8a;
    }
    
    .info-box ul li {
        margin-bottom: 5px;
        font-size: 14px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .header-card-body {
            padding: 25px;
        }
        
        .header-title {
            font-size: 24px;
        }
        
        .role-card {
            padding: 20px;
        }
        
        .permission-summary {
            gap: 8px;
        }
        
        .role-actions {
            flex-direction: column;
        }
        
        .btn-manage {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header Card --}}
    <div class="header-card-permission">
        <div class="header-card-body">
            <div class="d-flex align-items-center">
                <div class="header-icon-wrapper">
                    <i class="fas fa-shield-alt fa-3x"></i>
                </div>
                <div>
                    <h1 class="header-title mb-0">Manajemen Izin Akses</h1>
                    <p class="header-subtitle mb-0">Kelola hak akses untuk setiap role pengguna sistem</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(16,185,129,0.2)">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(239,68,68,0.2)">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    {{-- Info Box --}}
    <div class="info-box">
        <h5><i class="fas fa-info-circle mr-2"></i>Tentang Sistem Izin Akses</h5>
        <p>Sistem izin akses memungkinkan Anda mengontrol apa yang dapat dilakukan setiap role pengguna:</p>
        <ul>
            <li><strong>View (Lihat):</strong> Dapat melihat dan membaca data</li>
            <li><strong>Create (Tambah):</strong> Dapat menambahkan data baru</li>
            <li><strong>Edit (Ubah):</strong> Dapat mengubah data yang ada</li>
            <li><strong>Delete (Hapus):</strong> Dapat menghapus data</li>
            <li><strong>Export (Ekspor):</strong> Dapat mengekspor data ke Excel/PDF</li>
            <li><strong>Approve (Setujui):</strong> Dapat menyetujui/verifikasi data</li>
        </ul>
    </div>

    {{-- Role Cards --}}
    <div class="row">
        @foreach($roles as $roleKey => $roleName)
        @php
            $rolePermissions = $permissions->get($roleKey, collect());
            $totalModules = count($modules);
            $activeModules = $rolePermissions->count();
            
            $totalPermissions = $rolePermissions->sum(function($perm) {
                return ($perm->can_view ? 1 : 0) + 
                       ($perm->can_create ? 1 : 0) + 
                       ($perm->can_edit ? 1 : 0) + 
                       ($perm->can_delete ? 1 : 0) + 
                       ($perm->can_export ? 1 : 0) + 
                       ($perm->can_approve ? 1 : 0);
            });
            
            $canView = $rolePermissions->where('can_view', true)->count();
            $canCreate = $rolePermissions->where('can_create', true)->count();
            $canEdit = $rolePermissions->where('can_edit', true)->count();
            $canDelete = $rolePermissions->where('can_delete', true)->count();
            $canExport = $rolePermissions->where('can_export', true)->count();
            $canApprove = $rolePermissions->where('can_approve', true)->count();
        @endphp
        
        <div class="col-lg-6 col-xl-4">
            <div class="role-card {{ $roleKey }}">
                <div class="role-icon">
                    @if($roleKey === 'admin')
                        <i class="fas fa-user-shield"></i>
                    @elseif($roleKey === 'petugas')
                        <i class="fas fa-user-tie"></i>
                    @elseif($roleKey === 'pimpinan')
                        <i class="fas fa-user-crown"></i>
                    @elseif($roleKey === 'koperasi')
                        <i class="fas fa-store"></i>
                    @else
                        <i class="fas fa-users"></i>
                    @endif
                </div>
                
                <div class="role-name">{{ $roleName }}</div>
                <div class="role-description">
                    {{ $activeModules }} dari {{ $totalModules }} modul aktif • {{ $totalPermissions }} izin diberikan
                </div>
                
                <div class="permission-summary">
                    <div class="permission-badge {{ $canView > 0 ? 'active' : '' }}">
                        <i class="fas fa-eye"></i>
                        <span>Lihat: {{ $canView }}</span>
                    </div>
                    <div class="permission-badge {{ $canCreate > 0 ? 'active' : '' }}">
                        <i class="fas fa-plus"></i>
                        <span>Tambah: {{ $canCreate }}</span>
                    </div>
                    <div class="permission-badge {{ $canEdit > 0 ? 'active' : '' }}">
                        <i class="fas fa-edit"></i>
                        <span>Ubah: {{ $canEdit }}</span>
                    </div>
                    <div class="permission-badge {{ $canDelete > 0 ? 'active' : '' }}">
                        <i class="fas fa-trash"></i>
                        <span>Hapus: {{ $canDelete }}</span>
                    </div>
                    <div class="permission-badge {{ $canExport > 0 ? 'active' : '' }}">
                        <i class="fas fa-file-export"></i>
                        <span>Ekspor: {{ $canExport }}</span>
                    </div>
                    <div class="permission-badge {{ $canApprove > 0 ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i>
                        <span>Setujui: {{ $canApprove }}</span>
                    </div>
                </div>
                
                <div class="role-actions">
                    <a href="{{ route('admin.izin-akses.edit', $roleKey) }}" class="btn btn-manage primary">
                        <i class="fas fa-cog mr-2"></i>Kelola Izin
                    </a>
                    <button type="button" class="btn btn-manage secondary" onclick="setDefault('{{ $roleKey }}')">
                        <i class="fas fa-undo mr-2"></i>Set Default
                    </button>
                    @if($activeModules > 0)
                    <button type="button" class="btn btn-manage danger" onclick="resetPermissions('{{ $roleKey }}')">
                        <i class="fas fa-times-circle mr-2"></i>Reset
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function setDefault(role) {
    Swal.fire({
        title: 'Set Izin Default?',
        text: "Izin akses akan diatur ke pengaturan default untuk role ini.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#667eea',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Set Default!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/admin/izin-akses/${role}/set-default`;
        }
    });
}

function resetPermissions(role) {
    Swal.fire({
        title: 'Reset Semua Izin?',
        text: "Semua izin akses untuk role ini akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Reset!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/izin-akses/${role}/reset`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endpush
