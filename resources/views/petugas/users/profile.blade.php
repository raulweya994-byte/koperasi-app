@extends('layouts.app')
@section('title', 'Profil Saya')

@push('styles')
<style>
    /* Profile Card Modern */
    .profile-card-modern {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .profile-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 30px 80px;
        position: relative;
        text-align: center;
    }

    .profile-header-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
        background-size: cover;
        opacity: 0.3;
    }

    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
        margin-top: -60px;
        z-index: 10;
    }

    .profile-avatar-modern {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 6px solid white;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        object-fit: cover;
        background: white;
    }

    .avatar-initial-modern {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 6px solid white;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 56px;
        font-weight: 800;
        color: white;
    }

    .camera-btn-modern {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: 4px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .camera-btn-modern:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.6);
    }

    .camera-btn-modern i {
        color: white;
        font-size: 18px;
    }

    .profile-info-modern {
        padding: 30px;
        text-align: center;
    }

    .profile-name-modern {
        font-size: 26px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .profile-role-badge {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    .role-admin {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .role-petugas {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .role-pimpinan {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }

    .profile-meta-modern {
        display: flex;
        justify-content: center;
        gap: 30px;
        padding: 20px 0;
        border-top: 2px solid #f3f4f6;
        border-bottom: 2px solid #f3f4f6;
        margin: 20px 0;
    }

    .meta-item-modern {
        text-align: center;
    }

    .meta-item-modern i {
        font-size: 20px;
        color: #667eea;
        margin-bottom: 8px;
        display: block;
    }

    .meta-item-modern .label {
        font-size: 12px;
        color: #9ca3af;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .meta-item-modern .value {
        font-size: 14px;
        color: #374151;
        font-weight: 600;
        margin-top: 4px;
    }

    .form-card-modern {
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .form-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 24px 30px;
        color: white;
    }

    .form-header-modern h5 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-body-modern {
        padding: 35px;
    }

    .form-group-modern {
        margin-bottom: 24px;
    }

    .form-label-modern {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-modern {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-control-modern.is-invalid {
        border-color: #ef4444;
    }

    .section-divider-modern {
        margin: 30px 0;
        border: 0;
        border-top: 2px solid #f3f4f6;
        position: relative;
    }

    .section-divider-modern::after {
        content: 'GANTI PASSWORD';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        padding: 0 15px;
        font-size: 12px;
        font-weight: 700;
        color: #9ca3af;
        letter-spacing: 1px;
    }

    .btn-save-modern {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-save-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .alert-modern {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideDown 0.3s ease;
    }

    .alert-success-modern {
        background: #d1fae5;
        border-left: 4px solid #10b981;
        color: #065f46;
    }

    .alert-success-modern i {
        color: #10b981;
        font-size: 20px;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .file-upload-modern {
        position: relative;
        display: block;
        padding: 16px;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .file-upload-modern:hover {
        border-color: #667eea;
        background: #f3f4f6;
    }

    .file-upload-modern input[type="file"] {
        display: none;
    }

    .file-upload-label {
        font-size: 14px;
        color: #6b7280;
        font-weight: 600;
    }

    .file-upload-hint {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .profile-header-modern {
            padding: 30px 20px 70px;
        }

        .profile-avatar-modern,
        .avatar-initial-modern {
            width: 110px;
            height: 110px;
        }

        .avatar-initial-modern {
            font-size: 44px;
        }

        .profile-name-modern {
            font-size: 22px;
        }

        .profile-meta-modern {
            flex-direction: column;
            gap: 15px;
        }

        .form-body-modern {
            padding: 25px 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    @if(session('success'))
    <div class="alert-modern alert-success-modern">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="profile-card-modern">
                <div class="profile-header-modern"></div>
                
                <div class="profile-info-modern">
                    <div class="profile-avatar-wrapper">
                        @if($user->profile_photo)
                        <img src="{{ asset('storage/'.$user->profile_photo) }}" 
                             id="previewFoto" 
                             class="profile-avatar-modern" 
                             alt="{{ $user->name }}">
                        <div id="avatarInisial" class="avatar-initial-modern" style="display:none;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        @else
                        <div id="avatarInisial" class="avatar-initial-modern">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <img src="" 
                             id="previewFoto" 
                             class="profile-avatar-modern" 
                             style="display:none;" 
                             alt="{{ $user->name }}">
                        @endif
                        
                        <label for="inputFoto" class="camera-btn-modern" title="Ganti Foto">
                            <i class="fas fa-camera"></i>
                        </label>
                    </div>

                    <h3 class="profile-name-modern">{{ $user->name }}</h3>
                    
                    <span class="profile-role-badge role-{{ $user->role }}">
                        {{ ucfirst($user->role) }}
                    </span>

                    <div class="profile-meta-modern">
                        <div class="meta-item-modern">
                            <i class="fas fa-envelope"></i>
                            <div class="label">Email</div>
                            <div class="value">{{ $user->email }}</div>
                        </div>
                        
                        @if($user->phone)
                        <div class="meta-item-modern">
                            <i class="fas fa-phone"></i>
                            <div class="label">Telepon</div>
                            <div class="value">{{ $user->phone }}</div>
                        </div>
                        @endif
                    </div>

                    <div class="meta-item-modern">
                        <i class="fas fa-calendar-alt"></i>
                        <div class="label">Bergabung Sejak</div>
                        <div class="value">{{ $user->created_at->format('d F Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Edit Profile -->
        <div class="col-lg-8 mb-4">
            <div class="form-card-modern">
                <div class="form-header-modern">
                    <h5>
                        <i class="fas fa-user-edit"></i>
                        Edit Profil
                    </h5>
                </div>

                <div class="form-body-modern">
                    <form action="{{ route('petugas.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <!-- Upload Foto -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-image mr-2"></i>Foto Profil
                            </label>
                            <label for="inputFoto" class="file-upload-modern">
                                <input type="file" 
                                       id="inputFoto" 
                                       name="profile_photo" 
                                       accept="image/jpeg,image/jpg,image/png" 
                                       onchange="previewGambar(this)">
                                <div class="file-upload-label" id="labelFoto">
                                    <i class="fas fa-cloud-upload-alt mr-2"></i>
                                    Klik untuk upload foto
                                </div>
                                <div class="file-upload-hint">JPG, PNG (Maks. 2MB)</div>
                            </label>
                            @error('profile_photo')
                            <small class="text-danger d-block mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-user mr-2"></i>Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   class="form-control-modern @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}" 
                                   required 
                                   placeholder="Masukkan nama lengkap">
                            @error('name')
                            <small class="text-danger d-block mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-envelope mr-2"></i>Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control-modern @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}" 
                                   required 
                                   placeholder="email@example.com">
                            @error('email')
                            <small class="text-danger d-block mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-phone mr-2"></i>No. Telepon
                            </label>
                            <input type="text" 
                                   name="phone" 
                                   class="form-control-modern" 
                                   value="{{ old('phone', $user->phone) }}" 
                                   placeholder="08xxxxxxxxxx">
                        </div>

                        <!-- Divider -->
                        <hr class="section-divider-modern">

                        <!-- Password Baru -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-lock mr-2"></i>Password Baru
                            </label>
                            <input type="password" 
                                   name="password" 
                                   class="form-control-modern @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 8 karakter (kosongkan jika tidak diubah)">
                            @error('password')
                            <small class="text-danger d-block mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </small>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-lock mr-2"></i>Konfirmasi Password Baru
                            </label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   class="form-control-modern" 
                                   placeholder="Ulangi password baru">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-save-modern">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewGambar(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB
        
        // Validasi ukuran file
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            input.value = '';
            return;
        }
        
        // Validasi tipe file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak didukung! Gunakan JPG atau PNG');
            input.value = '';
            return;
        }
        
        // Preview gambar
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('previewFoto');
            const inisial = document.getElementById('avatarInisial');
            
            preview.src = e.target.result;
            preview.style.display = 'inline-block';
            if (inisial) {
                inisial.style.display = 'none';
            }
            
            // Update label dengan nama file
            document.getElementById('labelFoto').innerHTML = 
                '<i class="fas fa-check-circle mr-2"></i>' + file.name;
        };
        reader.readAsDataURL(file);
    }
}

// Auto-hide alert after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert-modern');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.animation = 'slideUp 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
</script>
@endpush

