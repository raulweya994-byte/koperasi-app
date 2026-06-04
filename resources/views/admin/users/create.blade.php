@extends('layouts.app')
@section('title', 'Tambah User Baru')

@push('styles')
<style>
    /* Modern Card Style */
    .card-modern {
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .card-header-modern {
        background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
        color: white;
        padding: 25px 30px;
        border: none;
    }
    
    .card-header-modern h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 800;
        color: white !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    
    .card-header-modern h3 i {
        color: white !important;
    }
    
    .card-header-modern p {
        margin: 5px 0 0 0;
        font-size: 13px;
        color: rgba(255,255,255,0.9);
        font-weight: 500;
    }
    
    .card-body-modern {
        padding: 35px;
        background: white;
    }
    
    /* Form Groups */
    .form-group-modern {
        margin-bottom: 25px;
    }
    
    .form-group-modern label {
        font-weight: 700;
        font-size: 14px;
        color: #1f2937;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-group-modern label i {
        margin-right: 8px;
        color: #2c5282;
    }
    
    .form-control-modern {
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        padding: 12px 18px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    
    .form-control-modern:focus {
        border-color: #2c5282;
        box-shadow: 0 0 0 4px rgba(44,82,130,0.1);
        outline: none;
    }
    
    .form-control-modern.is-invalid {
        border-color: #ef4444;
    }
    
    .form-control-modern.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239,68,68,0.1);
    }
    
    /* Select Dropdown */
    select.form-control-modern {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%232c5282' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }
    
    /* Invalid Feedback */
    .invalid-feedback {
        font-size: 13px;
        font-weight: 600;
        margin-top: 6px;
        color: #ef4444;
    }
    
    /* Required Star */
    .text-danger {
        color: #ef4444;
        font-weight: 700;
    }
    
    /* Buttons */
    .btn-modern {
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 700;
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
        color: white;
    }
    
    .btn-primary-modern:hover {
        background: linear-gradient(135deg, #2c5282 0%, #3b82f6 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30,58,95,0.3);
        color: white;
    }
    
    .btn-secondary-modern {
        background: #6b7280;
        color: white;
    }
    
    .btn-secondary-modern:hover {
        background: #4b5563;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(107,114,128,0.3);
        color: white;
    }
    
    /* Info Box */
    .info-box-modern {
        background: #eff6ff;
        border-left: 4px solid #2c5282;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
    }
    
    .info-box-modern i {
        color: #2c5282;
        font-size: 18px;
        margin-right: 10px;
    }
    
    .info-box-modern p {
        margin: 0;
        font-size: 13px;
        color: #1f2937;
        font-weight: 600;
    }
    
    /* Breadcrumb */
    .breadcrumb-modern {
        background: white;
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }
    
    .breadcrumb-modern .breadcrumb {
        margin: 0;
        background: transparent;
        padding: 0;
    }
    
    .breadcrumb-modern .breadcrumb-item {
        font-size: 13px;
        font-weight: 600;
    }
    
    .breadcrumb-modern .breadcrumb-item a {
        color: #2c5282;
        text-decoration: none;
    }
    
    .breadcrumb-modern .breadcrumb-item a:hover {
        color: #1e3a5f;
        text-decoration: underline;
    }
    
    .breadcrumb-modern .breadcrumb-item.active {
        color: #6b7280;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card-body-modern {
            padding: 25px 20px;
        }
        
        .btn-modern {
            padding: 10px 20px;
            font-size: 13px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Breadcrumb --}}
    <div class="breadcrumb-modern">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i> Manajemen Pengguna</a></li>
                <li class="breadcrumb-item active">Tambah User Baru</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Info Box --}}
            <div class="info-box-modern">
                <i class="fas fa-info-circle"></i>
                <p><strong>Informasi:</strong> Isi formulir di bawah ini untuk menambahkan pengguna baru ke sistem. Pastikan semua data yang diisi sudah benar.</p>
            </div>

            {{-- Form Card --}}
            <div class="card card-modern">
                <div class="card-header-modern">
                    <h3><i class="fas fa-user-plus mr-2"></i>Form Tambah User Baru</h3>
                    <p>Lengkapi semua informasi pengguna yang diperlukan</p>
                </div>
                <div class="card-body-modern">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        {{-- Nama Lengkap --}}
                        <div class="form-group-modern">
                            <label>
                                <i class="fas fa-user"></i>Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control form-control-modern @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="Masukkan nama lengkap pengguna"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group-modern">
                            <label>
                                <i class="fas fa-envelope"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control form-control-modern @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   placeholder="contoh@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="form-group-modern">
                            <label>
                                <i class="fas fa-user-tag"></i>Role / Peran <span class="text-danger">*</span>
                            </label>
                            <select name="role" 
                                    class="form-control form-control-modern @error('role') is-invalid @enderror" 
                                    required>
                                <option value="">-- Pilih Role Pengguna --</option>
                                <option value="admin" {{ old('role')==='admin'?'selected':'' }}>Admin - Akses Penuh Sistem</option>
                                <option value="petugas" {{ old('role')==='petugas'?'selected':'' }}>Petugas - Kelola Data Operasional</option>
                                <option value="pimpinan" {{ old('role')==='pimpinan'?'selected':'' }}>Pimpinan - Lihat Laporan & Dashboard</option>
                                <option value="koperasi" {{ old('role')==='koperasi'?'selected':'' }}>Koperasi - Kelola Data Koperasi</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- No. Telepon --}}
                        <div class="form-group-modern">
                            <label>
                                <i class="fas fa-phone"></i>No. Telepon
                            </label>
                            <input type="text" 
                                   name="phone" 
                                   class="form-control form-control-modern" 
                                   value="{{ old('phone') }}"
                                   placeholder="08xxxxxxxxxx">
                            <small class="text-muted" style="font-size: 12px; font-weight: 500;">
                                <i class="fas fa-info-circle mr-1"></i>Opsional - Format: 08xxxxxxxxxx
                            </small>
                        </div>

                        {{-- Password --}}
                        <div class="form-group-modern">
                            <label>
                                <i class="fas fa-lock"></i>Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control form-control-modern @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 8 karakter"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted" style="font-size: 12px; font-weight: 500;">
                                <i class="fas fa-shield-alt mr-1"></i>Gunakan kombinasi huruf, angka, dan simbol untuk keamanan
                            </small>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="form-group-modern">
                            <label>
                                <i class="fas fa-lock"></i>Konfirmasi Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="form-control form-control-modern" 
                                   placeholder="Ketik ulang password"
                                   required>
                        </div>

                        {{-- Buttons --}}
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary-modern btn-modern btn-block">
                                    <i class="fas fa-save"></i>
                                    <span>Simpan User</span>
                                </button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary-modern btn-modern btn-block">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Kembali</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Show validation errors if any
@if($errors->any())
Swal.fire({
    icon: 'error',
    title: 'Validasi Gagal!',
    html: '<ul style="text-align: left; padding-left: 20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
    confirmButtonColor: '#ef4444'
});
@endif
</script>
@endpush
