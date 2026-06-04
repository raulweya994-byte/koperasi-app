@extends('layouts.app')
@section('title', 'Update Foto Galeri')

@push('styles')
<style>
    .preview-container {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(26, 58, 110, 0.12);
        margin: 0 auto 30px;
        max-width: 700px;
        background: #f8f9ff;
    }
    .preview-image {
        width: 100%;
        max-height: 500px;
        object-fit: contain;
        display: block;
    }
    .upload-area {
        border: 3px dashed #cbd5e1;
        background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
        padding: 60px 30px;
        border-radius: 16px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }
    .upload-area:hover {
        border-color: #1a3a6e;
        background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26, 58, 110, 0.1);
    }
    .upload-area input[type=file] {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .upload-icon {
        font-size: 64px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
    }
    .change-photo-btn {
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 15px;
    }
    .change-photo-btn:hover {
        background: linear-gradient(135deg, #2d5aa0, #4a7bc8);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(26, 58, 110, 0.3);
    }
    .current-photo-label {
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        color: white;
        padding: 12px 20px;
        border-radius: 12px 12px 0 0;
        font-weight: 600;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>
@endpush

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
                                <i class="fas fa-image"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Update Foto Galeri</h3>
                                <p class="page-header-subtitle">Ganti foto galeri dengan foto baru</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.galeri.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
    <div class="alert alert-danger-modern alert-dismissible fade show">
        <i class="fas fa-exclamation-circle"></i>
        <div>
            <strong>Terdapat kesalahan:</strong>
            <ul class="mb-0 pl-3 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('petugas.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" id="formEdit">
        @csrf
        @method('PUT')
        
        {{-- Hidden fields untuk data yang tidak berubah --}}
        <input type="hidden" name="judul" value="{{ $galeri->judul }}">
        <input type="hidden" name="deskripsi" value="{{ $galeri->deskripsi }}">
        <input type="hidden" name="kategori" value="{{ $galeri->kategori }}">
        <input type="hidden" name="urutan" value="{{ $galeri->urutan }}">
        <input type="hidden" name="is_active" value="{{ $galeri->is_active }}">
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="content-card">
                    <div class="content-card-body" style="padding: 40px;">
                        
                        {{-- Foto Saat Ini --}}
                        <div class="mb-4">
                            <div class="current-photo-label">
                                <i class="fas fa-image"></i>
                                <span>Foto Saat Ini</span>
                            </div>
                            <div class="preview-container" id="currentPhotoContainer">
                                <img src="{{ asset('storage/' . $galeri->foto) }}" 
                                     class="preview-image" 
                                     id="currentImage"
                                     alt="Foto Galeri">
                            </div>
                        </div>

                        {{-- Upload Foto Baru --}}
                        <div class="mb-4" id="uploadSection">
                            <div class="upload-area" onclick="document.getElementById('fotoInput').click()">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <h5 style="color: #1a3a6e; font-weight: 700; margin-bottom: 10px;">
                                    Pilih Foto Baru
                                </h5>
                                <p style="color: #64748b; font-size: 14px; margin-bottom: 5px;">
                                    Klik atau drag & drop foto di sini
                                </p>
                                <small style="color: #94a3b8; font-size: 13px;">
                                    Format: JPG, PNG, GIF • Maksimal: 2MB
                                </small>
                                <input type="file" 
                                       name="foto" 
                                       id="fotoInput"
                                       accept="image/*"
                                       onchange="previewNewImage(this)">
                            </div>
                        </div>

                        {{-- Preview Foto Baru --}}
                        <div id="newPreviewSection" class="d-none">
                            <div class="current-photo-label" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="fas fa-check-circle"></i>
                                <span>Foto Baru (Preview)</span>
                            </div>
                            <div class="preview-container">
                                <img id="newPreview" src="#" class="preview-image" alt="Preview Foto Baru">
                            </div>
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-danger btn-modern" onclick="cancelNewPhoto()">
                                    <i class="fas fa-times"></i> Batalkan & Pilih Ulang
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="content-card-body" style="background:#f8f9ff;border-top:2px solid #e0e7ff;display:flex;justify-content:space-between;align-items:center;padding:25px 40px;">
                        <a href="{{ route('petugas.galeri.index') }}" class="btn btn-secondary btn-modern">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success-modern" id="btnSubmit">
                            <i class="fas fa-check-circle"></i> Update Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Preview new image
function previewNewImage(input) {
    if (input.files && input.files[0]) {
        // Check file size (2MB = 2097152 bytes)
        if (input.files[0].size > 2097152) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('newPreview').src = e.target.result;
            document.getElementById('newPreviewSection').classList.remove('d-none');
            document.getElementById('currentPhotoContainer').classList.add('d-none');
            document.getElementById('uploadSection').classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Cancel new photo
function cancelNewPhoto() {
    document.getElementById('fotoInput').value = '';
    document.getElementById('newPreview').src = '#';
    document.getElementById('newPreviewSection').classList.add('d-none');
    document.getElementById('currentPhotoContainer').classList.remove('d-none');
    document.getElementById('uploadSection').classList.remove('d-none');
}

// Form validation
document.getElementById('formEdit').addEventListener('submit', function(e) {
    const fotoInput = document.getElementById('fotoInput');
    
    if (!fotoInput.files || fotoInput.files.length === 0) {
        e.preventDefault();
        alert('Silakan pilih foto baru untuk diupload!');
        return false;
    }
    
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengupload...';
});

// Drag & drop functionality
const uploadArea = document.querySelector('.upload-area');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    uploadArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    uploadArea.style.borderColor = '#1a3a6e';
    uploadArea.style.background = 'linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%)';
}

function unhighlight(e) {
    uploadArea.style.borderColor = '#cbd5e1';
    uploadArea.style.background = 'linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%)';
}

uploadArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    document.getElementById('fotoInput').files = files;
    previewNewImage(document.getElementById('fotoInput'));
}
</script>
@endpush