@extends('layouts.admin')
@section('title', 'Edit Halaman')
@section('content')
<div class="content-header"><div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6"><h1 class="m-0">Edit Halaman</h1></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin.halaman-statis.index') }}">Halaman Statis</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </div>
  </div>
</div></div>
<section class="content"><div class="container-fluid">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
  </div>
  @endif
  <div class="card card-warning card-outline">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit: {{ $halamanStatis->judul }}</h3></div>
    <form method="POST" action="{{ route('admin.halaman-statis.update', $halamanStatis->id) }}" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="card-body">
        <div class="form-group">
          <label>Slug</label>
          <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                 value="{{ old('slug', $halamanStatis->slug) }}">
          @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label>Judul Halaman</label>
          <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                 value="{{ old('judul', $halamanStatis->judul) }}">
          @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label>Icon <small class="text-muted">(Font Awesome)</small></label>
          <input type="text" name="icon" class="form-control"
                 value="{{ old('icon', $halamanStatis->icon) }}">
          <small class="text-muted">fas fa-bullseye | fas fa-industry | fas fa-shopping-cart | fas fa-handshake | fas fa-star | fas fa-award | fas fa-sitemap</small>
        </div>
        <div class="form-group">
          <label>Konten</label>
          <textarea name="konten" class="form-control" rows="12">{{ old('konten', $halamanStatis->konten) }}</textarea>
        </div>
        <div class="form-group">
          <label>Gambar Header</label>
          @if($halamanStatis->gambar)
          <div class="mb-2">
            <img src="{{ Storage::url($halamanStatis->gambar) }}" style="max-height:120px;border-radius:8px">
            <small class="text-muted d-block mt-1">Gambar saat ini. Upload baru untuk mengganti.</small>
          </div>
          @endif
          <div class="custom-file">
            <input type="file" name="gambar" class="custom-file-input" id="gambar" accept="image/*">
            <label class="custom-file-label" for="gambar">Pilih gambar baru...</label>
          </div>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="status" class="form-control">
            <option value="aktif" {{ $halamanStatis->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ $halamanStatis->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-1"></i> Update</button>
        <a href="{{ route('admin.halaman-statis.index') }}" class="btn btn-secondary ml-2">Batal</a>
      </div>
    </form>
  </div>
</div></section>
@push('scripts')
<script>
document.querySelector('.custom-file-input').addEventListener('change',function(e){
  document.querySelector('.custom-file-label').textContent = e.target.files[0]?e.target.files[0].name:'Pilih gambar...';
});
</script>
@endpush
@endsection
