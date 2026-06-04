@extends('layouts.app')
@section('title','Edit Pelatihan')
@section('page-title','Edit Pelatihan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.pelatihan.index') }}">Pelatihan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<div class="card card-warning card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit: {{ $pelatihan->judul }}</h3>
    </div>
    <form method="POST" action="{{ route('admin.pelatihan.update', $pelatihan) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul Pelatihan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul',$pelatihan->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi',$pelatihan->deskripsi) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Syarat Peserta</label>
                        <textarea name="syarat" class="form-control" rows="3">{{ old('syarat',$pelatihan->syarat) }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Penyelenggara</label>
                        <input type="text" name="penyelenggara" class="form-control" value="{{ old('penyelenggara',$pelatihan->penyelenggara) }}">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai',$pelatihan->tanggal_mulai->format('Y-m-d')) }}" required>
                        @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai',$pelatihan->tanggal_selesai?$pelatihan->tanggal_selesai->format('Y-m-d'):'') }}">
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi',$pelatihan->lokasi) }}">
                    </div>
                    <div class="form-group">
                        <label>Kuota Peserta</label>
                        <input type="number" name="kuota" class="form-control" value="{{ old('kuota',$pelatihan->kuota) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @foreach(['dibuka'=>'Dibuka','berlangsung'=>'Berlangsung','ditutup'=>'Ditutup','selesai'=>'Selesai'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('status',$pelatihan->status)==$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        @if($pelatihan->foto)
                        <div class="mb-2">
                            <img src="{{ $pelatihan->foto_url }}" class="img-fluid rounded" style="max-height:150px;">
                        </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">{{ $pelatihan->foto ? 'Ganti foto...' : 'Pilih foto...' }}</label>
                        </div>
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-1"></i>Perbarui</button>
            <a href="{{ route('admin.pelatihan.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.querySelector('.custom-file-input').addEventListener('change',function(e){
    document.querySelector('.custom-file-label').textContent=e.target.files[0]?e.target.files[0].name:'Pilih foto...';
});
</script>
@endpush