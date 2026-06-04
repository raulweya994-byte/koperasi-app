@extends('layouts.app')
@section('title', 'Kelola Izin Akses - ' . $roleName)

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
    
    /* Module Card */
    .module-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .module-card:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    }
    
    .module-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .module-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .module-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1e40af;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    
    .module-name {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }
    
    .module-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .toggle-all-label {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
    }
    
    /* Permission Grid */
    .permission-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
    }
    
    .permission-item {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .permission-item:hover {
        border-color: #667eea;
        background: #f3f4ff;
    }
    
    .permission-item.active {
        border-color: #667eea;
        background: linear-gradient(135deg, #ede9fe, #ddd6fe);
    }
    
    .permission-checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }
    
    .permission-checkbox input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #667eea;
    }
    
    .permission-label {
        display: flex;
        flex-direction: column;
        gap: 3px;
        flex: 1;
    }
    
    .permission-title {
        font-size: 14px;
        font-weight: 700;
        color: #1f2937;
    }
    
    .permission-desc {
        font-size: 11px;
        color: #6b7280;
    }
    
    .permission-icon {
        font-size: 18px;
        color: #667eea;
    }
    
    /* Action Buttons */
    .action-buttons {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        position: sticky;
        top: 20px;
    }
    
    .btn-action {
        width: 100%;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        border: none;
        transition: all 0.3s ease;
        margin-bottom: 12px;
    }
    
    .btn-action:last-child {
        margin-bottom: 0;
    }
    
    .btn-action.primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
    }
    
    .btn-action.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }
    
    .btn-action.secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-action.secondary:hover {
        background: #e5e7eb;
        color: #1f2937;
    }
    
    .btn-action.success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .btn-action.success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        color: white;
    }
    
    /* Stats Box */
    .stats-box {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .stats-title {
        font-size: 13px;
        font-weight: 600;
        color: #1e40af;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stats-value {
        font-size: 28px;
        font-weight: 800;
        color: #1e3a8a;
    }
    
    .stats-label {
        font-size: 12px;
        color: #1e40af;
        margin-top: 5px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .header-card-body {
            padding: 25px;
        }
        
        .header-title {
            font-size: 24px;
        }
        
        .permission-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            position: static;
            margin-top: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header Card --}}
    <div class="header-card-permission">
        <div class="header-card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <div class="header-icon-wrapper">
                        <i class="fas fa-shield-alt fa-3x"></i>
                    </div>
                    <div>
                        <h1 class="header-title mb-0">Kelola Izin Akses</h1>
                        <p class="header-subtitle mb-0">Role: {{ $roleName }}</p>
                    </div>
                </div>
                <a href="{{ route('admin.izin-akses.index') }}" class="btn btn-light" style="border-radius:12px;padding:12px 24px;font-weight:600;">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
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

    <form action="{{ route('admin.izin-akses.update', $role) }}" method="POST" id="permissionForm">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-8">
                {{-- Module Cards --}}
                @foreach($modules as $moduleKey => $moduleName)
                @php
                    $perm = $permissions->get($moduleKey);
                    $hasAnyPermission = $perm && ($perm->can_view || $perm->can_create || $perm->can_edit || $perm->can_delete || $perm->can_export || $perm->can_approve);
                @endphp
                
                <div class="module-card">
                    <div class="module-header">
                        <div class="module-info">
                            <div class="module-icon">
                                @if($moduleKey === 'koperasi')
                                    <i class="fas fa-store"></i>
                                @elseif($moduleKey === 'anggota')
                                    <i class="fas fa-users"></i>
                                @elseif($moduleKey === 'bantuan')
                                    <i class="fas fa-hands-helping"></i>
                                @elseif($moduleKey === 'berita')
                                    <i class="fas fa-newspaper"></i>
                                @elseif($moduleKey === 'pengumuman')
                                    <i class="fas fa-bullhorn"></i>
                                @elseif($moduleKey === 'galeri')
                                    <i class="fas fa-images"></i>
                                @elseif($moduleKey === 'jadwal')
                                    <i class="fas fa-calendar-alt"></i>
                                @elseif($moduleKey === 'pelatihan')
                                    <i class="fas fa-chalkboard-teacher"></i>
                                @elseif($moduleKey === 'laporan')
                                    <i class="fas fa-chart-bar"></i>
                                @elseif($moduleKey === 'user')
                                    <i class="fas fa-user-cog"></i>
                                @elseif($moduleKey === 'setting')
                                    <i class="fas fa-cog"></i>
                                @elseif($moduleKey === 'chat')
                                    <i class="fas fa-comments"></i>
                                @elseif($moduleKey === 'kontak')
                                    <i class="fas fa-envelope"></i>
                                @elseif($moduleKey === 'struktur')
                                    <i class="fas fa-sitemap"></i>
                                @elseif($moduleKey === 'halaman_statis')
                                    <i class="fas fa-file-alt"></i>
                                @else
                                    <i class="fas fa-cube"></i>
                                @endif
                            </div>
                            <div class="module-name">{{ $moduleName }}</div>
                        </div>
                        <div class="module-toggle">
                            <span class="toggle-all-label">Pilih Semua</span>
                            <input type="checkbox" class="toggle-all-checkbox" data-module="{{ $moduleKey }}" 
                                   style="width:20px;height:20px;cursor:pointer;accent-color:#667eea;"
                                   {{ $hasAnyPermission ? 'checked' : '' }}>
                        </div>
                    </div>
                    
                    <div class="permission-grid">
                        {{-- View Permission --}}
                        <div class="permission-item {{ $perm && $perm->can_view ? 'active' : '' }}" onclick="toggleCheckbox(this)">
                            <label class="permission-checkbox">
                                <input type="checkbox" 
                                       name="permissions[{{ $moduleKey }}][can_view]" 
                                       value="1"
                                       data-module="{{ $moduleKey }}"
                                       {{ $perm && $perm->can_view ? 'checked' : '' }}>
                                <div class="permission-label">
                                    <span class="permission-title">Lihat</span>
                                    <span class="permission-desc">Dapat melihat data</span>
                                </div>
                                <i class="fas fa-eye permission-icon"></i>
                            </label>
                        </div>
                        
                        {{-- Create Permission --}}
                        <div class="permission-item {{ $perm && $perm->can_create ? 'active' : '' }}" onclick="toggleCheckbox(this)">
                            <label class="permission-checkbox">
                                <input type="checkbox" 
                                       name="permissions[{{ $moduleKey }}][can_create]" 
                                       value="1"
                                       data-module="{{ $moduleKey }}"
                                       {{ $perm && $perm->can_create ? 'checked' : '' }}>
                                <div class="permission-label">
                                    <span class="permission-title">Tambah</span>
                                    <span class="permission-desc">Dapat menambah data</span>
                                </div>
                                <i class="fas fa-plus permission-icon"></i>
                            </label>
                        </div>
                        
                        {{-- Edit Permission --}}
                        <div class="permission-item {{ $perm && $perm->can_edit ? 'active' : '' }}" onclick="toggleCheckbox(this)">
                            <label class="permission-checkbox">
                                <input type="checkbox" 
                                       name="permissions[{{ $moduleKey }}][can_edit]" 
                                       value="1"
                                       data-module="{{ $moduleKey }}"
                                       {{ $perm && $perm->can_edit ? 'checked' : '' }}>
                                <div class="permission-label">
                                    <span class="permission-title">Ubah</span>
                                    <span class="permission-desc">Dapat mengubah data</span>
                                </div>
                                <i class="fas fa-edit permission-icon"></i>
                            </label>
                        </div>
                        
                        {{-- Delete Permission --}}
                        <div class="permission-item {{ $perm && $perm->can_delete ? 'active' : '' }}" onclick="toggleCheckbox(this)">
                            <label class="permission-checkbox">
                                <input type="checkbox" 
                                       name="permissions[{{ $moduleKey }}][can_delete]" 
                                       value="1"
                                       data-module="{{ $moduleKey }}"
                                       {{ $perm && $perm->can_delete ? 'checked' : '' }}>
                                <div class="permission-label">
                                    <span class="permission-title">Hapus</span>
                                    <span class="permission-desc">Dapat menghapus data</span>
                                </div>
                                <i class="fas fa-trash permission-icon"></i>
                            </label>
                        </div>
                        
                        {{-- Export Permission --}}
                        <div class="permission-item {{ $perm && $perm->can_export ? 'active' : '' }}" onclick="toggleCheckbox(this)">
                            <label class="permission-checkbox">
                                <input type="checkbox" 
                                       name="permissions[{{ $moduleKey }}][can_export]" 
                                       value="1"
                                       data-module="{{ $moduleKey }}"
                                       {{ $perm && $perm->can_export ? 'checked' : '' }}>
                                <div class="permission-label">
                                    <span class="permission-title">Ekspor</span>
                                    <span class="permission-desc">Dapat ekspor data</span>
                                </div>
                                <i class="fas fa-file-export permission-icon"></i>
                            </label>
                        </div>
                        
                        {{-- Approve Permission --}}
                        <div class="permission-item {{ $perm && $perm->can_approve ? 'active' : '' }}" onclick="toggleCheckbox(this)">
                            <label class="permission-checkbox">
                                <input type="checkbox" 
                                       name="permissions[{{ $moduleKey }}][can_approve]" 
                                       value="1"
                                       data-module="{{ $moduleKey }}"
                                       {{ $perm && $perm->can_approve ? 'checked' : '' }}>
                                <div class="permission-label">
                                    <span class="permission-title">Setujui</span>
                                    <span class="permission-desc">Dapat menyetujui data</span>
                                </div>
                                <i class="fas fa-check-circle permission-icon"></i>
                            </label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="col-lg-4">
                <div class="action-buttons">
                    {{-- Stats --}}
                    <div class="stats-box">
                        <div class="stats-title">Total Izin Aktif</div>
                        <div class="stats-value" id="totalPermissions">0</div>
                        <div class="stats-label">izin dari {{ count($modules) * 6 }} tersedia</div>
                    </div>
                    
                    {{-- Action Buttons --}}
                    <button type="submit" class="btn btn-action primary">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                    
                    <button type="button" class="btn btn-action success" onclick="selectAllPermissions()">
                        <i class="fas fa-check-double mr-2"></i>Pilih Semua Izin
                    </button>
                    
                    <button type="button" class="btn btn-action secondary" onclick="clearAllPermissions()">
                        <i class="fas fa-times mr-2"></i>Hapus Semua Pilihan
                    </button>
                    
                    <a href="{{ route('admin.izin-akses.index') }}" class="btn btn-action secondary">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Toggle checkbox when clicking on permission item
function toggleCheckbox(element) {
    const checkbox = element.querySelector('input[type="checkbox"]');
    if (checkbox) {
        checkbox.checked = !checkbox.checked;
        updatePermissionItem(element, checkbox.checked);
        updateStats();
        updateToggleAll(checkbox.dataset.module);
    }
}

// Update permission item styling
function updatePermissionItem(element, isChecked) {
    if (isChecked) {
        element.classList.add('active');
    } else {
        element.classList.remove('active');
    }
}

// Update stats
function updateStats() {
    const totalChecked = document.querySelectorAll('input[type="checkbox"][name^="permissions"]:checked').length;
    document.getElementById('totalPermissions').textContent = totalChecked;
}

// Update toggle all checkbox
function updateToggleAll(module) {
    const moduleCheckboxes = document.querySelectorAll(`input[type="checkbox"][data-module="${module}"]`);
    const toggleAllCheckbox = document.querySelector(`.toggle-all-checkbox[data-module="${module}"]`);
    
    if (toggleAllCheckbox) {
        const allChecked = Array.from(moduleCheckboxes).every(cb => cb.checked);
        toggleAllCheckbox.checked = allChecked;
    }
}

// Toggle all checkboxes for a module
document.querySelectorAll('.toggle-all-checkbox').forEach(toggle => {
    toggle.addEventListener('change', function() {
        const module = this.dataset.module;
        const isChecked = this.checked;
        
        document.querySelectorAll(`input[type="checkbox"][data-module="${module}"]`).forEach(checkbox => {
            checkbox.checked = isChecked;
            const permissionItem = checkbox.closest('.permission-item');
            updatePermissionItem(permissionItem, isChecked);
        });
        
        updateStats();
    });
});

// Select all permissions
function selectAllPermissions() {
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = true;
        const permissionItem = checkbox.closest('.permission-item');
        if (permissionItem) {
            updatePermissionItem(permissionItem, true);
        }
    });
    updateStats();
}

// Clear all permissions
function clearAllPermissions() {
    Swal.fire({
        title: 'Hapus Semua Pilihan?',
        text: "Semua izin yang dipilih akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = false;
                const permissionItem = checkbox.closest('.permission-item');
                if (permissionItem) {
                    updatePermissionItem(permissionItem, false);
                }
            });
            updateStats();
        }
    });
}

// Update stats on page load
document.addEventListener('DOMContentLoaded', function() {
    updateStats();
    
    // Add change event to all checkboxes
    document.querySelectorAll('input[type="checkbox"][name^="permissions"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const permissionItem = this.closest('.permission-item');
            updatePermissionItem(permissionItem, this.checked);
            updateStats();
            updateToggleAll(this.dataset.module);
        });
    });
});

// Prevent label click from double-toggling
document.querySelectorAll('.permission-checkbox').forEach(label => {
    label.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
@endpush
