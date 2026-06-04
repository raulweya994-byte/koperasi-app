@extends('layouts.app')
@section('title', 'Tulis Berita Baru')

@push('styles')
<style>
    /* Page Header Card */
    .page-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        overflow: hidden;
        position: relative;
        margin-bottom: 24px;
    }

    .page-header-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .page-header-card .card-body {
        padding: 28px 30px;
        position: relative;
        z-index: 1;
    }

    .page-header-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.25);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .page-header-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 5px;
        line-height: 1.2;
    }

    .page-header-subtitle {
        font-size: 14px;
        opacity: 0.95;
        margin: 0;
    }

    .btn-modern {
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .btn-light.btn-modern {
        background: white;
        color: #667eea;
    }

    .btn-light.btn-modern:hover {
        background: #f8f9fa;
        color: #667eea;
    }

    /* Alert Info */
    .alert-info-modern {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1e40af;
        border: none;
        border-left: 4px solid #3b82f6;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 24px;
    }

    .alert-info-modern i {
        font-size: 20px;
        margin-top: 2px;
    }

    /* Content Card */
    .content-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .content-card-header {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        padding: 18px 24px;
        border-bottom: 2px solid #e8ebf7;
    }

    .content-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #495057;
        margin: 0;
    }

    .content-card-title i {
        color: #667eea;
        margin-right: 8px;
    }

    .content-card-body {
        padding: 24px;
    }

    /* Form Modern */
    .form-group-modern {
        margin-bottom: 0;
    }

    .form-label-modern {
        font-weight: 600;
        color: #374151;
        font-size: 14px;
        margin-bottom: 10px;
        display: block;
    }

    .form-control-modern {
        width: 100%;
        border-radius: 10px;
        border: 1.5px solid #dee2e6;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .form-control-modern.is-invalid {
        border-color: #ef4444;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 13px;
        margin-top: 6px;
        display: block;
    }

    textarea.form-control-modern {
        min-height: 400px;
        line-height: 1.7;
        resize: vertical;
    }

    /* Buttons */
    .btn-secondary {
        background: #6b7280;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background: #4b5563;
        color: white;
    }

    .btn-success-modern {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 28px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-success-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        color: white;
    }

    /* Preview Image */
    #preview-container {
        background: #f9fafb;
        padding: 20px;
        border-radius: 12px;
        border: 2px dashed #e5e7eb;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header-card .card-body {
            padding: 20px;
        }

        .page-header-icon {
            width: 60px;
            height: 60px;
            font-size: 28px;
            margin-right: 15px;
        }

        .page-header-title {
            font-size: 20px;
        }

        .page-header-subtitle {
            font-size: 13px;
        }

        .content-card-body {
            padding: 20px;
        }

        textarea.form-control-modern {
            min-height: 300px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between text-white flex-wrap">
                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <div class="page-header-icon">
                                <i class="fas fa-pen"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Tulis Berita Baru</h3>
                                <p class="page-header-subtitle">Buat berita atau artikel untuk dipublikasikan</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Info --}}
    <div class="row">
        <div class="col-12">
            <div class="alert-info-modern">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Tips Menulis Berita:</strong> Tulis judul yang menarik, gunakan gambar yang relevan, 
                    dan pastikan konten mudah dipahami pembaca.
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                {{-- Informasi Berita --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-file-alt"></i> Informasi Berita
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-heading mr-1"></i>
                                Judul Berita <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="judul" 
                                   class="form-control-modern @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}" 
                                   placeholder="Masukkan judul berita yang menarik..."
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Gambar Thumbnail --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-image"></i> Gambar Thumbnail
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-upload mr-1"></i>
                                Upload Gambar
                            </label>
                            <input type="file" name="thumbnail" accept="image/*" 
                                   class="form-control-modern @error('thumbnail') is-invalid @enderror"
                                   onchange="previewImage(this)">
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Format: JPG, PNG, WEBP. Maksimal 2MB
                            </small>
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="preview-container" style="display:none;margin-top:20px">
                            <label class="form-label-modern">
                                <i class="fas fa-eye mr-1"></i>
                                Preview Gambar:
                            </label>
                            <img id="preview" src="" class="rounded" 
                                 style="max-width:100%;max-height:350px;display:block;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                        </div>
                    </div>
                </div>

                {{-- Konten Berita --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-align-left"></i> Konten Berita
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-paragraph mr-1"></i>
                                Isi Berita <span class="text-danger">*</span>
                            </label>
                            <textarea name="konten" id="konten"
                                      class="form-control-modern @error('konten') is-invalid @enderror"
                                      placeholder="Tulis konten berita di sini..." 
                                      required>{{ old('konten') }}</textarea>
                            @error('konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="content-card">
                    <div class="content-card-body" style="background:#f8f9ff;border-top:2px solid #e8ebf7;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn-success-modern">
                                <i class="fas fa-save mr-1"></i> Simpan & Publikasikan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Preview Image
function previewImage(input) {
    const preview = document.getElementById('preview');
    const container = document.getElementById('preview-container');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        container.style.display = 'none';
    }
}
</script>
@endpush
