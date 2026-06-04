@extends('layouts.anggota')
@section('title','Profil Anggota')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Data Profil</li>
@endsection

@push('styles')
<style>
.profile-hero {
    background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 50%, #3d6ab0 100%);
    padding: 40px 0;
    color: #fff;
    position: relative;
    overflow: hidden;
    border-radius: 16px 16px 0 0;
}

.profile-hero::before {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(245,166,35,0.15), transparent);
    top: -100px;
    right: -100px;
    animation: float 8s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) scale(1); }
    50% { transform: translateY(-20px) scale(1.05); }
}

.profile-avatar {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 5px solid rgba(255,255,255,0.3);
    object-fit: cover;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.profile-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
}

.profile-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    border: none;
}

.profile-card:hover {
    box-shadow: 0 15px 60px rgba(0,0,0,0.15);
}

.info-section {
    background: linear-gradient(to right, #f8f9fa, #ffffff);
    padding: 30px;
    border-radius: 12px;
    margin-bottom: 20px;
    border-left: 4px solid #1a3a6e;
    transition: all 0.3s ease;
}

.info-section:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transform: translateX(3px);
}

.info-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #6b7280;
    margin-bottom: 8px;
}

.info-value {
    font-size: 16px;
    font-weight: 600;
    color: #1a3a6e;
    margin-bottom: 0;
}

.stat-card {
    background: linear-gradient(135deg, #fff, #f8f9fa);
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    border-color: #1a3a6e;
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(26,58,110,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 15px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-label {
    font-size: 13px;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 18px;
    font-weight: 800;
    color: #1a3a6e;
}

.edit-btn {
    background: linear-gradient(135deg, #f5a623, #fdb944);
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(245,166,35,0.3);
}

.edit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(245,166,35,0.5);
    color: #fff;
}

.save-btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(16,185,129,0.3);
}

.save-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(16,185,129,0.5);
    color: #fff;
}

.cancel-btn {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(107,114,128,0.3);
}

.cancel-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(107,114,128,0.5);
    color: #fff;
}

.form-control:focus {
    border-color: #1a3a6e;
    box-shadow: 0 0 0 0.2rem rgba(26,58,110,0.15);
}

.section-title {
    font-size: 18px;
    font-weight: 800;
    color: #1a3a6e;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 3px solid #f5a623;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title i {
    color: #f5a623;
}

.badge-status {
    padding: 8px 20px;
    border-radius: 100px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.upload-photo-btn {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #f5a623, #fdb944);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(245,166,35,0.4);
    transition: all 0.3s ease;
    z-index: 2;
}

.upload-photo-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(245,166,35,0.6);
}

.upload-photo-btn i {
    color: #fff;
    font-size: 16px;
}
</style>
@endpush

@section('content')
<div class="container mt-4">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" style="border-radius:12px;border:none;border-left:5px solid #10b981">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="profile-card">
                {{-- Profile Hero --}}
                <div class="profile-hero">
                    <div class="container" style="position:relative;z-index:1">
                        <div class="text-center">
                            <div style="position:relative;display:inline-block">
                                <img src="{{ $anggota->foto_url }}" class="profile-avatar" id="profileAvatar" alt="{{ $anggota->nama }}">
                                <label for="fotoInput" class="upload-photo-btn" id="uploadBtn" style="display:none">
                                    <i class="fas fa-camera"></i>
                                </label>
                            </div>
                            <h3 class="mt-3 mb-2" style="font-weight:800;text-shadow:0 2px 10px rgba(0,0,0,0.2)">
                                {{ $anggota->nama }}
                            </h3>
                            <p class="mb-2" style="opacity:0.9;font-size:15px">
                                <i class="fas fa-id-badge mr-2"></i>{{ $anggota->no_anggota }}
                            </p>
                            <span class="badge-status badge-{{ $anggota->status === 'Aktif' ? 'success' : 'warning' }}">
                                <i class="fas fa-{{ $anggota->status === 'Aktif' ? 'check-circle' : 'clock' }} mr-1"></i>
                                {{ $anggota->status }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Profile Content --}}
                <div class="p-4">
                    <form id="profileForm" action="{{ route('anggota.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none">

                        {{-- Action Buttons --}}
                        <div class="text-right mb-4">
                            <button type="button" class="btn edit-btn" id="editBtn">
                                <i class="fas fa-edit mr-2"></i>Edit Profil
                            </button>
                            <button type="submit" class="btn save-btn" id="saveBtn" style="display:none">
                                <i class="fas fa-save mr-2"></i>Simpan Perubahan
                            </button>
                            <button type="button" class="btn cancel-btn" id="cancelBtn" style="display:none">
                                <i class="fas fa-times mr-2"></i>Batal
                            </button>
                        </div>

                        {{-- Stats Cards --}}
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon" style="background:linear-gradient(135deg,#667eea,#764ba2)">
                                        <i class="fas fa-store text-white"></i>
                                    </div>
                                    <div class="stat-label">Nama Usaha</div>
                                    <div class="stat-value">{{ $anggota->nama_usaha }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon" style="background:linear-gradient(135deg,#10b981,#059669)">
                                        <i class="fas fa-money-bill-wave text-white"></i>
                                    </div>
                                    <div class="stat-label">Modal Usaha</div>
                                    <div class="stat-value">Rp {{ number_format($anggota->modal_usaha ?? 0,0,',','.') }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="stat-card">
                                    <div class="stat-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706)">
                                        <i class="fas fa-piggy-bank text-white"></i>
                                    </div>
                                    <div class="stat-label">Total Simpanan</div>
                                    <div class="stat-value">Rp {{ number_format($anggota->total_simpanan ?? 0,0,',','.') }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Data Pribadi --}}
                        <div class="section-title">
                            <i class="fas fa-user-circle"></i>
                            <span>Data Pribadi</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">NIK</div>
                                    <input type="text" class="form-control info-value profile-input" name="nik" value="{{ $anggota->nik }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Nama Lengkap</div>
                                    <input type="text" class="form-control info-value profile-input" name="nama" value="{{ $anggota->nama }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Tempat Lahir</div>
                                    <input type="text" class="form-control info-value profile-input" name="tempat_lahir" value="{{ $anggota->tempat_lahir }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Tanggal Lahir</div>
                                    <input type="date" class="form-control info-value profile-input" name="tanggal_lahir" value="{{ $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('Y-m-d') : '' }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Jenis Kelamin</div>
                                    <select class="form-control info-value profile-input" name="jenis_kelamin" disabled style="border:none;background:transparent;padding:0">
                                        <option value="L" {{ $anggota->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ $anggota->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Agama</div>
                                    <select class="form-control info-value profile-input" name="agama" disabled style="border:none;background:transparent;padding:0">
                                        <option value="Islam" {{ $anggota->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ $anggota->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ $anggota->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ $anggota->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ $anggota->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ $anggota->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <div class="section-title mt-4">
                            <i class="fas fa-phone"></i>
                            <span>Informasi Kontak</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">No. HP / WhatsApp</div>
                                    <input type="text" class="form-control info-value profile-input" name="no_hp" value="{{ $anggota->no_hp }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Email</div>
                                    <input type="email" class="form-control info-value profile-input" name="email" value="{{ $anggota->email }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div class="section-title mt-4">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Alamat</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Distrik</div>
                                    <input type="text" class="form-control info-value profile-input" name="distrik" value="{{ $anggota->distrik }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Desa / Kampung</div>
                                    <input type="text" class="form-control info-value profile-input" name="desa" value="{{ $anggota->desa }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Alamat Lengkap</div>
                                    <textarea class="form-control info-value profile-input" name="alamat_lengkap" rows="2" readonly style="border:none;background:transparent;padding:0">{{ $anggota->alamat_lengkap }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Data Usaha --}}
                        <div class="section-title mt-4">
                            <i class="fas fa-briefcase"></i>
                            <span>Data Usaha</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Nama Usaha</div>
                                    <input type="text" class="form-control info-value profile-input" name="nama_usaha" value="{{ $anggota->nama_usaha }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Bidang Usaha</div>
                                    <input type="text" class="form-control info-value profile-input" name="bidang_usaha" value="{{ $anggota->bidang_usaha }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Modal Usaha</div>
                                    <input type="number" class="form-control info-value profile-input" name="modal_usaha" value="{{ $anggota->modal_usaha }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Omzet Per Bulan</div>
                                    <input type="number" class="form-control info-value profile-input" name="omzet_per_bulan" value="{{ $anggota->omzet_per_bulan }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Total Simpanan</div>
                                    <input type="number" class="form-control info-value profile-input" name="total_simpanan" value="{{ $anggota->total_simpanan }}" readonly style="border:none;background:transparent;padding:0">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="info-section">
                                    <div class="info-label">Keterangan Usaha</div>
                                    <textarea class="form-control info-value profile-input" name="keterangan_usaha" rows="3" readonly style="border:none;background:transparent;padding:0">{{ $anggota->keterangan_usaha }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Actions --}}
                        <div class="text-center mt-4 pt-4" style="border-top:2px solid #e5e7eb">
                            <a href="{{ route('anggota.kartu') }}" class="btn btn-lg" style="background:linear-gradient(135deg,#3b82f6,#2563eb);color:white;border:none;border-radius:12px;padding:15px 40px;font-weight:700;box-shadow:0 4px 15px rgba(59,130,246,0.3)">
                                <i class="fas fa-id-card mr-2"></i>Lihat Kartu Anggota
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let isEditing = false;
    
    // Edit Button Click
    $('#editBtn').click(function() {
        isEditing = true;
        $(this).hide();
        $('#saveBtn, #cancelBtn, #uploadBtn').show();
        
        // Enable all inputs
        $('.profile-input').each(function() {
            $(this).prop('readonly', false).prop('disabled', false);
            $(this).css({
                'border': '1px solid #d1d5db',
                'background': '#ffffff',
                'padding': '8px 12px',
                'border-radius': '8px'
            });
        });
    });
    
    // Cancel Button Click
    $('#cancelBtn').click(function() {
        if(confirm('Batalkan perubahan? Data yang belum disimpan akan hilang.')) {
            location.reload();
        }
    });
    
    // Photo Upload
    $('#fotoInput').change(function(e) {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#profileAvatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Form Submit
    $('#profileForm').submit(function(e) {
        e.preventDefault();
        
        if(!confirm('Simpan perubahan profil?')) {
            return false;
        }
        
        const formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Profil berhasil diperbarui!');
                location.reload();
            },
            error: function(xhr) {
                alert('Gagal memperbarui profil. Silakan coba lagi.');
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endpush
