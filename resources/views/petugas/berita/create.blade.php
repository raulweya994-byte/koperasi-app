@extends("layouts.app")
@section("title","Buat Berita")

@section("content")
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Header Card --}}
            <div class="card shadow-sm mb-4" style="border:none;border-radius:16px;background:linear-gradient(135deg,#f59e0b,#d97706)">
                <div class="card-body text-center text-white py-4">
                    <div style="width:80px;height:80px;margin:0 auto 15px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center">
                        <i class="fas fa-newspaper fa-3x"></i>
                    </div>
                    <h3 class="font-weight-bold mb-2">Buat Berita Baru</h3>
                    <p class="mb-0" style="opacity:0.9">Tulis berita atau artikel untuk dipublikasikan</p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="card shadow-sm" style="border:none;border-radius:16px">
                <div class="card-body p-4">
                    <form action="{{ route('petugas.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Judul --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-heading mr-2"></i>Judul Berita <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}" placeholder="Masukkan judul berita yang menarik" required
                                   style="border-radius:12px;border:2px solid #e5e7eb;padding:14px 18px">
                            @error("judul")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-tag mr-2"></i>Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required
                                    style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="umum" {{ old('kategori')=='umum'?'selected':'' }}>Umum</option>
                                <option value="koperasi" {{ old('kategori')=='koperasi'?'selected':'' }}>Koperasi</option>
                                <option value="pelatihan" {{ old('kategori')=='pelatihan'?'selected':'' }}>Pelatihan</option>
                                <option value="bantuan" {{ old('kategori')=='bantuan'?'selected':'' }}>Bantuan</option>
                            </select>
                            @error("kategori")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Thumbnail --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-image mr-2"></i>Gambar Thumbnail
                            </label>
                            <input type="file" name="thumbnail" accept="image/*" 
                                   class="form-control @error('thumbnail') is-invalid @enderror"
                                   onchange="previewImage(this)"
                                   style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Format: JPG, PNG, WEBP. Maksimal 2MB
                            </small>
                            @error("thumbnail")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                            
                            <div id="preview-container" style="display:none;margin-top:15px">
                                <img id="preview" src="" class="rounded" 
                                     style="max-width:100%;max-height:300px;box-shadow:0 4px 12px rgba(0,0,0,0.1)">
                            </div>
                        </div>

                        {{-- Konten --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-align-left mr-2"></i>Konten Berita <span class="text-danger">*</span>
                            </label>
                            <textarea name="konten" rows="15" class="form-control @error('konten') is-invalid @enderror"
                                      placeholder="Tulis konten berita secara lengkap dan jelas..." required
                                      style="border-radius:12px;border:2px solid #e5e7eb;padding:14px 18px;line-height:1.8">{{ old('konten') }}</textarea>
                            @error("konten")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Tulis konten berita dengan lengkap dan mudah dipahami
                            </small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('petugas.berita.index') }}" class="btn btn-secondary" style="border-radius:10px;padding:10px 24px">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-warning text-white" style="border-radius:10px;padding:10px 32px;background:linear-gradient(135deg,#f59e0b,#d97706);border:none">
                                <i class="fas fa-save mr-2"></i>Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push("styles")
<style>
    .form-control:focus {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
    }
    .form-control.is-invalid {
        border-color: #dc3545 !important;
    }
</style>
@endpush

@push("scripts")
<script>
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
    }
}
</script>
@endpush
@endsection
