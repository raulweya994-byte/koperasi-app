@extends('layouts.app')
@section('title', 'Tambah Halaman')

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
                                <h3 class="page-header-title">Tambah Halaman Statis</h3>
                                <p class="page-header-subtitle">Buat halaman profil atau informasi baru untuk website</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.halaman-statis.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('petugas.halaman-statis.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-edit"></i> Informasi Halaman
                        </h5>
                    </div>
                    <div class="content-card-body form-modern">
                        <div class="form-group">
                            <label>Slug <span class="text-danger">*</span> <small class="text-muted">(URL halaman)</small></label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug') }}" placeholder="contoh: visi-misi" required>
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pilihan: visi-misi | perindustrian | perdagangan | koperasi-koperasi | nilai | komitmen | struktur-organisasi
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Judul Halaman <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}" placeholder="contoh: Visi & Misi" required>
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Icon <small class="text-muted">(Font Awesome)</small></label>
                            <input type="text" name="icon" class="form-control" value="{{ old('icon','fas fa-file-alt') }}"
                                   placeholder="fas fa-bullseye">
                            <small class="text-muted">
                                <i class="fas fa-lightbulb mr-1"></i>
                                Contoh: fas fa-bullseye | fas fa-industry | fas fa-shopping-cart | fas fa-handshake | fas fa-star | fas fa-award | fas fa-sitemap
                            </small>
                        </div>

                        <div class="form-group">
                            <label>Konten <span class="text-danger">*</span></label>
                            <textarea name="konten" class="form-control @error('konten') is-invalid @enderror" rows="12"
                                      placeholder="Tulis konten halaman di sini..." required>{{ old('konten') }}</textarea>
                            @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label>Gambar Header</label>
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="gambar" accept="image/*">
                                <label class="custom-file-label" for="gambar">Pilih gambar...</label>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-image mr-1"></i>
                                Format: JPG, PNG (Max: 2MB)
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                {{-- Status Card --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-cog"></i> Pengaturan
                        </h5>
                    </div>
                    <div class="content-card-body form-modern">
                        <div class="form-group">
                            <label>Status Halaman <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="aktif" selected>Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Halaman aktif akan ditampilkan di website
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Tips Card --}}
                <div class="content-card mt-3">
                    <div class="content-card-header">
                        <h5 class="content-card-title">
                            <i class="fas fa-lightbulb"></i> Tips
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="alert alert-info-modern">
                            <i class="fas fa-info-circle"></i>
                            <div>
                                <strong>Panduan:</strong>
                                <ul class="mb-0 pl-3" style="font-size:13px">
                                    <li>Gunakan slug yang sesuai dengan menu navigasi</li>
                                    <li>Judul halaman akan muncul sebagai header</li>
                                    <li>Icon menggunakan Font Awesome 5</li>
                                    <li>Gambar header opsional</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="content-card mt-3">
                    <div class="content-card-body">
                        <button type="submit" class="btn btn-success-modern btn-block">
                            <i class="fas fa-save"></i> Simpan Halaman
                        </button>
                        <a href="{{ route('petugas.halaman-statis.index') }}" class="btn btn-secondary btn-block mt-2">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// File input label update
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih gambar...';
    document.querySelector('.custom-file-label').textContent = fileName;
});

// Slug auto-generate from judul
document.querySelector('[name="judul"]').addEventListener('input', function(e) {
    const slugInput = document.querySelector('[name="slug"]');
    if (!slugInput.value || slugInput.dataset.auto !== 'false') {
        const slug = e.target.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        slugInput.value = slug;
        slugInput.dataset.auto = 'true';
    }
});

document.querySelector('[name="slug"]').addEventListener('input', function() {
    this.dataset.auto = 'false';
});
</script>
@endpush

