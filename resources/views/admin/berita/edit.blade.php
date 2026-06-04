@extends('layouts.app')
@section('title', 'Edit Berita')

@push('styles')
<style>
    /* Header Card Modern */
    .edit-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 25px 30px;
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .edit-header-modern::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .edit-header-modern h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .btn-back-header {
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .btn-back-header:hover {
        background: rgba(255,255,255,0.3);
        color: white;
        transform: translateY(-2px);
    }

    /* Form Card Modern */
    .form-card-modern {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: none;
        overflow: hidden;
    }

    .form-card-body-modern {
        padding: 30px;
    }

    /* Form Label Modern */
    .form-label-modern {
        font-weight: 600;
        color: #495057;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .form-label-modern i {
        color: #667eea;
        margin-right: 5px;
    }

    /* Form Control Modern */
    .form-control-modern,
    .form-select-modern {
        border-radius: 10px;
        border: 1.5px solid #dee2e6;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control-modern:focus,
    .form-select-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    textarea.form-control-modern {
        min-height: 250px;
        line-height: 1.6;
    }

    /* Preview Image Modern */
    .preview-container-modern {
        position: relative;
        display: inline-block;
        margin-bottom: 15px;
    }

    .preview-image-modern {
        max-height: 150px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 2px solid #e5e7eb;
    }

    /* File Input Modern */
    .file-input-modern {
        border-radius: 10px;
        border: 1.5px dashed #dee2e6;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-input-modern:hover {
        border-color: #667eea;
        background: #f8f9ff;
    }

    /* Form Text Modern */
    .form-text-modern {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }

    .form-text-modern i {
        color: #667eea;
        margin-right: 3px;
    }

    /* Alert Modern */
    .alert-modern {
        border-radius: 12px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .alert-danger-modern {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .alert-danger-modern ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert-danger-modern li {
        margin-bottom: 5px;
    }

    /* Button Modern */
    .btn-save-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-save-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel-modern {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        padding: 12px 28px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-cancel-modern:hover {
        background: #e5e7eb;
        color: #374151;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-header-modern {
            padding: 20px 25px;
        }

        .edit-header-modern h1 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .form-card-body-modern {
            padding: 20px;
        }

        .btn-save-modern,
        .btn-cancel-modern {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="edit-header-modern">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1><i class="fas fa-edit mr-2"></i>Edit Berita</h1>
            <a href="{{ route('admin.berita.index') }}" class="btn-back-header">
                <i class="fas fa-arrow-left mr-1"></i>Kembali
            </a>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card-modern">
        <div class="form-card-body-modern">
            {{-- Alert Errors --}}
            @if ($errors->any())
                <div class="alert-modern alert-danger-modern">
                    <strong><i class="fas fa-exclamation-triangle mr-2"></i>Terdapat kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Judul --}}
                    <div class="col-md-8 mb-4">
                        <label class="form-label-modern">
                            <i class="fas fa-heading"></i>Judul <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul"
                            class="form-control form-control-modern @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $berita->judul) }}" 
                            placeholder="Masukkan judul berita..."
                            required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Thumbnail --}}
                    <div class="col-md-4 mb-4">
                        <label class="form-label-modern">
                            <i class="fas fa-image"></i>Thumbnail
                        </label>
                        @if ($berita->thumbnail)
                            <div class="preview-container-modern">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}"
                                    id="preview" class="preview-image-modern d-block">
                            </div>
                        @else
                            <img id="preview" src="#" class="preview-image-modern d-none">
                        @endif
                        <input type="file" name="thumbnail" accept="image/*"
                            class="form-control file-input-modern @error('thumbnail') is-invalid @enderror"
                            onchange="previewImage(this)">
                        <div class="form-text-modern">
                            <i class="fas fa-info-circle"></i>Kosongkan jika tidak ingin mengganti gambar
                        </div>
                        @error('thumbnail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Konten --}}
                <div class="mb-4">
                    <label class="form-label-modern">
                        <i class="fas fa-align-left"></i>Konten <span class="text-danger">*</span>
                    </label>
                    <textarea name="konten" id="konten"
                        class="form-control form-control-modern @error('konten') is-invalid @enderror"
                        placeholder="Tulis konten berita di sini..."
                        required>{{ old('konten', $berita->konten) }}</textarea>
                    @error('konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn-save-modern">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.berita.index') }}" class="btn-cancel-modern">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection