@extends('layouts.app')
@section('title','Edit Pelatihan')
@section('page-title','Edit Pelatihan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.pelatihan.index') }}">Pelatihan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<div class="card card-warning card-outline">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit: {{ $pelatihan->judul }}</h3></div>
    <form method="POST" action="{{ route('petugas.pelatihan.update', $pelatihan) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Judul Pelatihan <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul',$pelatihan->judul) }}" required>
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
                        <label>Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai',$pelatihan->tanggal_mulai->format('Y-m-d')) }}" required>
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
                        <label>Kuota</label>
                        <input type="number" name="kuota" class="form-control" value="{{ old('kuota',$pelatihan->kuota) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @foreach(['aktif'=>'Aktif','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('status',$pelatihan->status)==$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        @if($pelatihan->foto)<img src="{{ $pelatihan->foto_url }}" class="img-fluid rounded mb-2" style="max-height:100px;">@endif
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">Ganti foto...</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-1"></i>Perbarui</button>
            <a href="{{ route('petugas.pelatihan.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection