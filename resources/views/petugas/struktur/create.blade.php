@extends('layouts.app')
@section('title','Tambah Pegawai')
@section('page-title','Tambah Pegawai')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.struktur.index') }}">Struktur Organisasi</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="card card-primary card-outline">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-plus mr-2"></i>Tambah Pegawai</h3></div>
    <form method="POST" action="{{ route('petugas.struktur.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Kosongkan jika belum ada">
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" placeholder="NIP pegawai">
                    </div>
                    <div class="form-group">
                        <label>Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" required>
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Sub Jabatan</label>
                        <input type="text" name="sub_jabatan" class="form-control" value="{{ old('sub_jabatan') }}" placeholder="Contoh: Seksi, Sub Bagian">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Bidang <span class="text-danger">*</span></label>
                        <select name="bidang" class="form-control @error('bidang') is-invalid @enderror" required>
                            <option value="">-- Pilih Bidang --</option>
                            <option value="kepala_dinas" {{ old('bidang')=='kepala_dinas'?'selected':'' }}>Kepala Dinas</option>
                            <option value="sekretariat" {{ old('bidang')=='sekretariat'?'selected':'' }}>Sekretariat</option>
                            <option value="perindustrian" {{ old('bidang')=='perindustrian'?'selected':'' }}>Bidang Perindustrian</option>
                            <option value="perdagangan" {{ old('bidang')=='perdagangan'?'selected':'' }}>Bidang Perdagangan</option>
                            <option value="koperasi" {{ old('bidang')=='koperasi'?'selected':'' }}>Bidang Koperasi</option>
                            <option value="koperasi" {{ old('bidang')=='koperasi'?'selected':'' }}>Bidang Koperasi</option>
                            <option value="uptd" {{ old('bidang')=='uptd'?'selected':'' }}>UPTD</option>
                        </select>
                        @error('bidang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan',0) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">Pilih foto...</label>
                        </div>
                        <small class="text-muted">Format: JPG, PNG. Max 2MB</small>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" checked>
                            <label class="custom-control-label" for="is_active">Aktif / Tampil di publik</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
            <a href="{{ route('petugas.struktur.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.querySelector('.custom-file-input').addEventListener('change',function(e){
    document.querySelector('.custom-file-label').textContent = e.target.files[0]?e.target.files[0].name:'Pilih foto...';
});
</script>
@endpush