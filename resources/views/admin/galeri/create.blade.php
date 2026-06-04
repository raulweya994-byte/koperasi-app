@extends('layouts.app')
@section('title', 'Tambah Galeri')

@push('styles')
<style>
    .tipe-selector {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }
    .tipe-card {
        flex: 1;
        border: 3px solid #e5e7eb;
        border-radius: 16px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #f9fafb;
    }
    .tipe-card:hover {
        border-color: #1a3a6e;
        background: #f0f4ff;
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(26, 58, 110, 0.15);
    }
    .tipe-card.active {
        border-color: #1a3a6e;
        background: linear-gradient(135deg, #e0e7ff, #f0f4ff);
        box-shadow: 0 8px 20px rgba(26, 58, 110, 0.2);
    }
    .tipe-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }
    .tipe-card.active .tipe-icon {
        animation: bounce 0.5s;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
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
    .form-section {
        display: none;
    }
    .form-section.active {
        display: block;
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
                                <h3 class="page-header-title">Tambah Media Galeri</h3>
                                <p class="page-header-subtitle">Upload foto atau video kegiatan dan dokumentasi program</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('admin.galeri.index') }}" class="btn btn-light btn-modern">
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

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" id="formGaleri">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-layer-group"></i> Pilih Tipe Media
                        </h5>
                    </div>
                    
                    <div class="content-card-body">
                        {{-- Tipe Selector --}}
                        <div class="tipe-selector">
                            <div class="tipe-card active" onclick="selectTipe('foto')" id="cardFoto">
                                <div class="tipe-icon">📷</div>
                                <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">Foto</h5>
                                <p class="text-muted mb-0" style="font-size:13px">Upload gambar/foto kegiatan</p>
                            </div>
                            <div class="tipe-card" onclick="selectTipe('video')" id="cardVideo">
                                <div class="tipe-icon">🎥</div>
                                <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">Video</h5>
                                <p class="text-muted mb-0" style="font-size:13px">Embed video dari YouTube</p>
                            </div>
                        </div>
                        <input type="hidden" name="tipe" id="tipeInput" value="foto">
                    </div>
                </div>

                {{-- Form Foto --}}
                <div class="content-card mt-4 form-section active" id="formFoto">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-image"></i> Upload Foto
                        </h5>
                    </div>
                    
                    <div class="content-card-body">
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
                                    <li>Judul foto akan otomatis diambil dari nama file</li>
                                    <li>Gunakan foto dengan resolusi tinggi untuk hasil terbaik</li>
                                    <li>Pastikan foto tidak blur dan pencahayaan cukup</li>
                                    <li>Ukuran file maksimal 2MB</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Video --}}
                <div class="content-card mt-4 form-section" id="formVideo">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-video"></i> Embed Video YouTube
                        </h5>
                    </div>
                    
                    <div class="content-card-body">
                        {{-- Judul --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold" style="color:#1a3a6e">
                                <i class="fas fa-heading mr-2"></i>Judul Video <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="judul_video" 
                                   id="judulVideo"
                                   class="form-control form-control-lg" 
                                   placeholder="Contoh: Tutorial Pengelolaan Koperasi"
                                   style="border-radius:10px;border:2px solid #e0e7ff">
                        </div>

                        {{-- Deskripsi --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold" style="color:#1a3a6e">
                                <i class="fas fa-align-left mr-2"></i>Deskripsi (Opsional)
                            </label>
                            <textarea name="deskripsi_video" 
                                      id="deskripsiVideo"
                                      class="form-control" 
                                      rows="3"
                                      placeholder="Tambahkan deskripsi singkat tentang video ini..."
                                      style="border-radius:10px;border:2px solid #e0e7ff"></textarea>
                        </div>

                        {{-- Kategori --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold" style="color:#1a3a6e">
                                <i class="fas fa-tag mr-2"></i>Kategori
                            </label>
                            <select name="kategori_video" 
                                    id="kategoriVideo"
                                    class="form-control form-control-lg"
                                    style="border-radius:10px;border:2px solid #e0e7ff">
                                <option value="kegiatan">Kegiatan</option>
                                <option value="pelatihan">Pelatihan</option>
                                <option value="tutorial">Tutorial</option>
                                <option value="dokumentasi">Dokumentasi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        {{-- URL Video --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold" style="color:#1a3a6e">
                                <i class="fab fa-youtube mr-2"></i>URL Video YouTube <span class="text-danger">*</span>
                            </label>
                            <input type="url" 
                                   name="video_url" 
                                   id="videoUrlInput"
                                   class="form-control form-control-lg" 
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   style="border-radius:10px;border:2px solid #e0e7ff"
                                   onchange="previewVideo(this.value)">
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Salin URL video dari YouTube (contoh: https://www.youtube.com/watch?v=xxxxx)
                            </small>
                        </div>

                        {{-- Video Preview --}}
                        <div id="videoPreviewContainer" class="d-none" style="margin-top:20px">
                            <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                                <iframe id="videoPreview" 
                                        src="" 
                                        style="position:absolute;top:0;left:0;width:100%;height:100%;border:none"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="content-card mt-4">
                    <div class="content-card-body" style="background:#f8f9ff;border-top:1px solid #eef;display:flex;justify-content:space-between;align-items:center;">
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-modern">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success-modern" id="btnSubmit">
                            <i class="fas fa-save"></i> Simpan ke Galeri
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
// Select tipe
function selectTipe(tipe) {
    // Update UI
    document.getElementById('cardFoto').classList.remove('active');
    document.getElementById('cardVideo').classList.remove('active');
    document.getElementById('card' + tipe.charAt(0).toUpperCase() + tipe.slice(1)).classList.add('active');
    
    // Update hidden input
    document.getElementById('tipeInput').value = tipe;
    
    // Show/hide forms
    document.getElementById('formFoto').classList.remove('active');
    document.getElementById('formVideo').classList.remove('active');
    document.getElementById('form' + tipe.charAt(0).toUpperCase() + tipe.slice(1)).classList.add('active');
    
    // Reset forms
    if (tipe === 'foto') {
        document.getElementById('fotoInput').required = true;
        document.getElementById('videoUrlInput').required = false;
    } else {
        document.getElementById('fotoInput').required = false;
        document.getElementById('videoUrlInput').required = true;
    }
}

// Preview image
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('previewContainer');
    
    if (input.files && input.files[0]) {
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
    document.getElementById('preview').src = '#';
    document.getElementById('previewContainer').classList.add('d-none');
    document.getElementById('fotoInput').value = '';
}

// Preview video
function previewVideo(url) {
    const previewContainer = document.getElementById('videoPreviewContainer');
    const preview = document.getElementById('videoPreview');
    
    let videoId = '';
    if (url.match(/youtube\.com\/watch\?v=([^&]+)/)) {
        videoId = url.match(/youtube\.com\/watch\?v=([^&]+)/)[1];
    } else if (url.match(/youtu\.be\/([^?]+)/)) {
        videoId = url.match(/youtu\.be\/([^?]+)/)[1];
    }
    
    if (videoId) {
        preview.src = 'https://www.youtube.com/embed/' + videoId;
        previewContainer.classList.remove('d-none');
    } else {
        previewContainer.classList.add('d-none');
    }
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
    const tipe = document.getElementById('tipeInput').value;
    
    if (tipe === 'foto') {
        const fotoInput = document.getElementById('fotoInput');
        
        if (!fotoInput.files || fotoInput.files.length === 0) {
            e.preventDefault();
            alert('Silakan pilih foto terlebih dahulu!');
            return false;
        }
    } else {
        const videoUrl = document.getElementById('videoUrlInput').value;
        const judul = document.getElementById('judulVideo').value;
        
        if (!judul) {
            e.preventDefault();
            alert('Judul video harus diisi!');
            return false;
        }
        
        if (!videoUrl) {
            e.preventDefault();
            alert('URL video YouTube harus diisi!');
            return false;
        }
        
        // Create hidden inputs for video
        const form = this;
        
        // Remove old hidden inputs if exist
        const oldJudul = form.querySelector('input[name="judul"]');
        if (oldJudul) oldJudul.remove();
        const oldDeskripsi = form.querySelector('textarea[name="deskripsi"]');
        if (oldDeskripsi) oldDeskripsi.remove();
        const oldKategori = form.querySelector('select[name="kategori"]');
        if (oldKategori) oldKategori.remove();
        
        // Add new hidden inputs
        const judulInput = document.createElement('input');
        judulInput.type = 'hidden';
        judulInput.name = 'judul';
        judulInput.value = judul;
        form.appendChild(judulInput);
        
        const deskripsiInput = document.createElement('input');
        deskripsiInput.type = 'hidden';
        deskripsiInput.name = 'deskripsi';
        deskripsiInput.value = document.getElementById('deskripsiVideo').value;
        form.appendChild(deskripsiInput);
        
        const kategoriInput = document.createElement('input');
        kategoriInput.type = 'hidden';
        kategoriInput.name = 'kategori';
        kategoriInput.value = document.getElementById('kategoriVideo').value;
        form.appendChild(kategoriInput);
    }
    
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
});
</script>
@endpush
