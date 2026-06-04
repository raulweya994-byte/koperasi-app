@extends('layouts.app')
@section('title','Tambah Pelatihan')
@section('page-title','Tambah Pelatihan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.pelatihan.index') }}">Pelatihan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection
@section('content')
<div class="card card-primary card-outline">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-plus mr-2"></i>Tambah Pelatihan</h3></div>
    <form method="POST" action="{{ route('petugas.pelatihan.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul Pelatihan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Syarat Peserta</label>
                        <textarea name="syarat" class="form-control" rows="3">{{ old('syarat') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Penyelenggara</label>
                        <input type="text" name="penyelenggara" class="form-control" value="{{ old('penyelenggara','DISPERINDAGKOP Tolikara') }}">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" required>
                        @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">
                    </div>
                    <div class="form-group">
                        <label>Kuota Peserta</label>
                        <input type="number" name="kuota" class="form-control" value="{{ old('kuota',30) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">Pilih foto...</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
            <a href="{{ route('petugas.pelatihan.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>document.querySelector('.custom-file-input').addEventListener('change',function(e){document.querySelector('.custom-file-label').textContent=e.target.files[0]?e.target.files[0].name:'Pilih foto...';});</script>
@endpush