@extends('layouts.app')
@section('title', 'Tambah Galeri')

@push('styles')
<style>
    .upload-area {
        border: 3px dashed #e5e7eb;
        border-radius: 12px;
        padding: 60px 40px;
        text-align: center;
        transition: all 0.3s;
        background: #f9fafb;
        cursor: pointer;
        position: relative;
    }
    .upload-area:hover {
        border-color: #1a3a6e;
        background: #f0f4ff;
    }
    .upload-area.dragover {
        border-color: #1a3a6e;
        background: #e0e7ff;
    }
    .upload-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
    }
    .preview-container {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-top: 20px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .preview-image {
        width: 100%;
        max-height: 500px;
        object-fit: contain;
        background: #f3f4f6;
    }
    .preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .preview-container:hover .preview-overlay {
        opacity: 1;
    }
    .btn-remove-preview {
        background: white;
        color: #ef4444;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-remove-preview:hover {
        transform: scale(1.1);
        background: #ef4444;
        color: white;
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
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Tambah Foto Galeri</h3>
                                <p class="page-header-subtitle">Upload foto kegiatan atau dokumentasi program</p>
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

    <form action="{{ route('petugas.galeri.store') }}" method="POST" enctype="multipart/form-data" id="formGaleri">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-image"></i> Upload Foto
                        </h5>
                    </div>
                    
                    <div class="content-card-body">
                        {{-- Hidden input for tipe (always foto) --}}
                        <input type="hidden" name="tipe" value="foto">

                        {{-- Upload Foto --}}
                        <div class="upload-area" onclick="document.getElementById('fotoInput').click()">
                            <div class="upload-icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">Klik untuk upload foto</h5>
                            <p class="text-muted mb-2" style="font-size:14px">atau drag & drop file di sini</p>
                            <small class="text-muted">Format: JPG, PNG, GIF • Maksimal: 2MB</small>
                        </div>
                        <input type="file" 
                               name="foto" 
                               id="fotoInput"
                               accept="image/*"
                               class="d-none"
                               onchange="previewImage(this)"
                               required>
                        
                        <div id="previewContainer" class="preview-container d-none">
                            <img id="preview" src="#" class="preview-image">
                            <div class="preview-overlay">
                                <button type="button" class="btn-remove-preview" onclick="removePreview()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Info Box --}}
                        <div class="alert alert-info-modern mt-4">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <strong>Tips Upload Foto:</strong>
                                <ul class="mb-0 pl-3 mt-2" style="font-size:13px">
                                    <li>Gunakan foto dengan resolusi tinggi untuk hasil terbaik</li>
                                    <li>Pastikan foto tidak blur dan pencahayaan cukup</li>
                                    <li>Ukuran file maksimal 2MB</li>
                                    <li>Format yang didukung: JPG, PNG, GIF</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="content-card-body" style="background:#f8f9ff;border-top:1px solid #eef;display:flex;justify-content:space-between;align-items:center;">
                        <a href="{{ route('petugas.galeri.index') }}" class="btn btn-secondary btn-modern">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success-modern" id="btnSubmit">
                            <i class="fas fa-save"></i> Simpan Galeri
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
// Preview image
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('previewContainer');
    
    if (input.files && input.files[0]) {
        // Check file size (2MB = 2097152 bytes)
        if (input.files[0].size > 2097152) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Remove preview
function removePreview() {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('previewContainer');
    const fotoInput = document.getElementById('fotoInput');
    
    preview.src = '#';
    previewContainer.classList.add('d-none');
    fotoInput.value = '';
}

// Drag and drop
const uploadArea = document.querySelector('.upload-area');

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('dragover');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('dragover');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        const fotoInput = document.getElementById('fotoInput');
        fotoInput.files = files;
        previewImage(fotoInput);
    }
});

// Form validation
document.getElementById('formGaleri').addEventListener('submit', function(e) {
    const fotoInput = document.getElementById('fotoInput');
    
    if (!fotoInput.files || fotoInput.files.length === 0) {
        e.preventDefault();
        alert('Silakan pilih foto terlebih dahulu!');
        return false;
    }
    
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
});
</script>
@endpush
