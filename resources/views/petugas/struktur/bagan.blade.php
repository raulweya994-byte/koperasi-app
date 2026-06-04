@extends('layouts.app')
@section('title','Upload Bagan Struktur')
@section('page-title','Upload Bagan Struktur')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.struktur.index') }}">Struktur Organisasi</a></li>
    <li class="breadcrumb-item active">Upload Bagan</li>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-upload mr-2"></i>Upload Foto Bagan Struktur</h3>
            </div>
            <form method="POST" action="{{ route('petugas.struktur.bagan.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <p class="text-muted">Upload foto/gambar bagan struktur organisasi. Foto ini akan tampil di halaman publik.</p>
                    <div class="form-group">
                        <label>Pilih Foto Bagan</label>
                        <div class="custom-file">
                            <input type="file" name="foto_bagan" class="custom-file-input" id="foto_bagan" accept="image/*" required>
                            <label class="custom-file-label" for="foto_bagan">Pilih gambar...</label>
                        </div>
                        <small class="text-muted">Format: JPG, PNG. Maks 5MB. Disarankan landscape.</small>
                    </div>
                    <div id="preview-wrap" class="mt-3 d-none">
                        <label>Preview:</label>
                        <img id="preview" src="" class="img-fluid rounded shadow-sm" style="max-height:300px;">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-upload mr-1"></i> Upload</button>
                    <a href="{{ route('petugas.struktur.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-info card-outline">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-image mr-2"></i>Bagan Saat Ini</h3></div>
            <div class="card-body text-center">
                @if($bagan && $bagan->value)
                    <img src="{{ asset('storage/'.$bagan->value) }}" class="img-fluid rounded shadow" style="max-height:350px;">
                    <p class="mt-2 text-muted small">Bagan struktur organisasi aktif</p>
                    <form method="POST" action="{{ route('petugas.struktur.bagan.hapus') }}" onsubmit="return confirm('Yakin hapus foto bagan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="fas fa-trash mr-1"></i> Hapus Foto Bagan</button>
                    </form>
                @else
                    <div class="py-5 text-muted">
                        <i class="fas fa-image fa-4x mb-3 d-block" style="opacity:.2"></i>
                        <p>Belum ada foto bagan diupload</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    document.querySelector('.custom-file-label').textContent = file.name;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('preview').src = e.target.result;
        document.getElementById('preview-wrap').classList.remove('d-none');
    };
    reader.readAsDataURL(file);
});
</script>
@endpush