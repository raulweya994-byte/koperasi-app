@extends('layouts.app')
@section('title', 'Edit Galeri')

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
                                <i class="fas fa-edit"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Edit Media Galeri</h3>
                                <p class="page-header-subtitle">Update foto atau video galeri</p>
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

    <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" id="formEdit">
        @csrf
        @method('PUT')
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                {{-- Tipe Selector --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-layer-group"></i> Tipe Media
                        </h5>
                    </div>
                    
                    <div class="content-card-body">
                        <div class="tipe-selector">
                            <div class="tipe-card {{ $galeri->tipe === 'foto' ? 'active' : '' }}" onclick="selectTipe('foto')" id="cardFoto">
                                <div class="tipe-icon">📷</div>
                                <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">Foto</h5>
                                <p class="text-muted mb-0" style="font-size:13px">Upload gambar/foto kegiatan</p>
                            </div>
                            <div class="tipe-card {{ $galeri->tipe === 'video' ? 'active' : '' }}" onclick="selectTipe('video')" id="cardVideo">
                                <div class="tipe-icon">🎥</div>
                                <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">Video</h5>
                                <p class="text-muted mb-0" style="font-size:13px">Embed video dari YouTube</p>
                            </div>
                        </div>
                        <input type="hidden" name="tipe" id="tipeInput" value="{{ $galeri->tipe }}">
                    </div>
                </div>

                {{-- Form Foto --}}
                <div class="content-card mt-4 form-section {{ $galeri->tipe === 'foto' ? 'active' : '' }}" id="formFoto">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-image"></i> Ganti Foto
                        </h5>
                    </div>
                    
                    <div class="content-card-body" style="padding: 40px;">
                        {{-- Foto Saat Ini --}}
                        @if($galeri->tipe === 'foto')
                        <div class="mb-4">
                            <div class="current-photo-label">
                                <i class="fas fa-image"></i>
                                <span>Foto Saat Ini: {{ $galeri->judul }}</span>
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
                                       onchange="previewNewImage(this)"
                                       required>
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

                        {{-- Info Box --}}
                        <div class="alert alert-info-modern mt-4">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <strong>Catatan:</strong>
                                <ul class="mb-0 pl-3 mt-2" style="font-size:13px">
                                    <li>Judul foto akan otomatis diambil dari nama file baru</li>
                                    <li>Foto lama akan diganti dengan foto baru</li>
                                    <li>Ukuran file maksimal 2MB</li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Form Video --}}
                <div class="content-card mt-4 form-section {{ $galeri->tipe === 'video' ? 'active' : '' }}" id="formVideo">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-video"></i> Edit Video
                        </h5>
                    </div>
                    
                    <div class="content-card-body" style="padding: 40px;">
                        {{-- Judul --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold" style="color:#1a3a6e">
                                <i class="fas fa-heading mr-2"></i>Judul Video <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="judul_video" 
                                   id="judulVideo"
                                   class="form-control form-control-lg" 
                                   value="{{ $galeri->judul }}"
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
                                      placeholder="Tambahkan deskripsi singkat..."
                                      style="border-radius:10px;border:2px solid #e0e7ff">{{ $galeri->deskripsi }}</textarea>
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
                                <option value="kegiatan" {{ $galeri->kategori === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="pelatihan" {{ $galeri->kategori === 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                                <option value="tutorial" {{ $galeri->kategori === 'tutorial' ? 'selected' : '' }}>Tutorial</option>
                                <option value="dokumentasi" {{ $galeri->kategori === 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                                <option value="lainnya" {{ $galeri->kategori === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                   value="{{ $galeri->video_url }}"
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   style="border-radius:10px;border:2px solid #e0e7ff"
                                   onchange="previewVideo(this.value)">
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Salin URL video dari YouTube
                            </small>
                        </div>

                        {{-- Video Preview --}}
                        @if($galeri->tipe === 'video' && $galeri->video_url)
                        <div id="videoPreviewContainer" style="margin-top:20px">
                            <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                                @php
                                    $videoId = '';
                                    if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $galeri->video_url, $matches)) {
                                        $videoId = $matches[1];
                                    } elseif (preg_match('/youtu\.be\/([^?]+)/', $galeri->video_url, $matches)) {
                                        $videoId = $matches[1];
                                    }
                                @endphp
                                <iframe id="videoPreview" 
                                        src="https://www.youtube.com/embed/{{ $videoId }}" 
                                        style="position:absolute;top:0;left:0;width:100%;height:100%;border:none"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        @else
                        <div id="videoPreviewContainer" class="d-none" style="margin-top:20px">
                            <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                                <iframe id="videoPreview" 
                                        src="" 
                                        style="position:absolute;top:0;left:0;width:100%;height:100%;border:none"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="content-card mt-4">
                    <div class="content-card-body" style="background:#f8f9ff;border-top:2px solid #e0e7ff;display:flex;justify-content:space-between;align-items:center;padding:25px 40px;">
                        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary btn-modern">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success-modern" id="btnSubmit">
                            <i class="fas fa-check-circle"></i> Update Media
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
    document.getElementById('cardFoto').classList.remove('active');
    document.getElementById('cardVideo').classList.remove('active');
    document.getElementById('card' + tipe.charAt(0).toUpperCase() + tipe.slice(1)).classList.add('active');
    
    document.getElementById('tipeInput').value = tipe;
    
    document.getElementById('formFoto').classList.remove('active');
    document.getElementById('formVideo').classList.remove('active');
    document.getElementById('form' + tipe.charAt(0).toUpperCase() + tipe.slice(1)).classList.add('active');
}

// Preview new image
function previewNewImage(input) {
    if (input.files && input.files[0]) {
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

// Form validation
document.getElementById('formEdit').addEventListener('submit', function(e) {
    const tipe = document.getElementById('tipeInput').value;
    
    if (tipe === 'video') {
        const videoUrl = document.getElementById('videoUrlInput').value;
        const judul = document.getElementById('judulVideo').value;
        
        if (!judul || !videoUrl) {
            e.preventDefault();
            alert('Judul dan URL video harus diisi!');
            return false;
        }
        
        // Copy video values to main form
        const form = this;
        const oldJudul = form.querySelector('input[name="judul"]');
        if (oldJudul) oldJudul.value = judul;
        else {
            const judulInput = document.createElement('input');
            judulInput.type = 'hidden';
            judulInput.name = 'judul';
            judulInput.value = judul;
            form.appendChild(judulInput);
        }
        
        const oldDeskripsi = form.querySelector('textarea[name="deskripsi"]');
        if (oldDeskripsi) oldDeskripsi.value = document.getElementById('deskripsiVideo').value;
        else {
            const deskripsiInput = document.createElement('input');
            deskripsiInput.type = 'hidden';
            deskripsiInput.name = 'deskripsi';
            deskripsiInput.value = document.getElementById('deskripsiVideo').value;
            form.appendChild(deskripsiInput);
        }
        
        const oldKategori = form.querySelector('select[name="kategori"]');
        if (oldKategori) oldKategori.value = document.getElementById('kategoriVideo').value;
        else {
            const kategoriInput = document.createElement('input');
            kategoriInput.type = 'hidden';
            kategoriInput.name = 'kategori';
            kategoriInput.value = document.getElementById('kategoriVideo').value;
            form.appendChild(kategoriInput);
        }
    }
    
    const btnSubmit = document.getElementById('btnSubmit');
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengupdate...';
});
</script>
@endpush
